<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

//사용자의 지역을 조회한다.
$sql = " select * from {$g5['member_area_table'] } where  mb_id = '{$member['mb_id']}' ";
$result_area = sql_query($sql);

$biztype    = $member['mb_biz_type'];
$goodsItem  = $member['mb_biz_goods_item'];
$goodsYear  = $member['mb_biz_goods_year'];
$removeItem = $member['mb_biz_remove_item'];
if($biztype == "1"){
	if(!$goodsItem){
		alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요",G5_BBS_URL."/mypage_partner.php");
	}
}else if($biztype == "2"){
	if(!$removeItem){
		alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요",G5_BBS_URL."/mypage_partner.php");
	}
}else if($biztype == "3"){
	if(!$goodsItem && !$removeItem){
		alert("마이페이지에서 업체가 원하는 견적을 설정해 보세요",G5_BBS_URL."/mypage_partner.php");
	}
}

$sql_common = "";
$sql_area   = "";
for ($i=0; $row=sql_fetch_array($result_area); $i++){
	if($i > 0){
		$sql_area .= " or ";
	}
	$sql_area .= "( area1 = '{$row['mb_area1']}' ";
	if($row['mb_area2']){
		$sql_area .= " and area2 = '{$row['mb_area2']}' ";
	}
	$sql_area .= " ) ";
}

if($sql_area){
	$sql_common .= " and ( ".$sql_area." ) ";
}

if(!$goodsItem){
	$sql_common .= " and e_type != 0 and e_type != 1 ";
}

if(!$removeItem){
	$sql_common .= " and e_type != 2 ";
}
$sql_common .= " and ( 1!=1 ";
//매입확인하기
if($biztype == "1" || $biztype == "3"){
	$array_goodsItem = explode(',',$goodsItem);
	$array_goodsYear = explode(',',$goodsYear);
	//가전/가구 매입
	$sql_common .= " or ( e_type = 0 and ( ";
	$sql_common .= " 1!=1 ";
	for($i=0; $i<count($array_goodsItem); $i++){
		if($array_goodsItem[$i] == "모두수거"){
			$sql_common .= " or ( ifnull(use_year,'0') <= ".$array_goodsYear[$i]." ) ";
		}else{
			$sql_common .= " or ( item_cat='".$array_goodsItem[$i]."' and ifnull(use_year,'0') <= ".$array_goodsYear[$i]." ) ";
		}
	}
	$sql_common .= " )) or ( e_type = 1 and ( sub_key in ( select distinct sub_key from {$g5['estimate_list_multi']} where 1=1 and ( 1=1 ";
	for($i=0; $i<count($array_goodsItem); $i++){
		if($array_goodsItem[$i] == "모두수거"){
			$sql_common .= " or ( ifnull(use_year,'0') <= ".$array_goodsYear[$i]." ) ";
		}else{
			$sql_common .= " or ( item_cat='".$array_goodsItem[$i]."' and ifnull(use_year,'0') <= ".$array_goodsYear[$i]." ) ";
		}
	}
	$sql_common .= " )))) ";
}else if($biztype == "2" || $biztype == "3"){
	$array_removeItem = explode(',',$removeItem);
	$sql_common .= " or ( e_type = 2 and ( sub_key in ( select distinct sub_key from {$g5['estimate_list_multi']} where 1=1 and ( 1=1 ";
	for($i=0; $i<count($array_removeItem); $i++){
		if($array_removeItem[$i] == "모두철거"){
			$sql_common .= " or ( 1=1 ) ";		
		}else{
			$sql_common .= " or ( pull_kind='".$array_removeItem[$i]."' ";
		}

	}
	$sql_common .= " )))) ";
}
$sql_common .= " ) ";

$sql_where  = " where state = '1' and simple_yn != '1' and e_type in ('0','1','2') ";
$sql_where .= " and idx not in ( select estimate_idx from {$g5['estimate_propose']} where rc_email = '{$member['mb_email']}' ) ";
$sql_where .= " and deadline >= DATE_FORMAT(now(), '%Y-%m-%d') ";
$sql_where .= " $sql_common ";

$sql = " select count(*) as cnt from {$g5['estimate_list']} " . $sql_where;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select 
			idx, 
			concat(substr(nickname,1,1),'**') as nickname, 
			case when length(title) <= 40 then title else concat(substr(title,1,39),'...') end as title, 
			area1,
			area2,
			state,
			e_type,
			deadline,
			date_format(writetime, '%Y.%m.%d') as writetime 
		  from {$g5['estimate_list']} ";
$sql .= $sql_where;
$sql .= " order by idx desc ";
$sql .= " limit $from_record, $rows ";



$result = sql_query($sql);

// 연결된 목록에 새 알림이 있는지 표기 with KJS dance 20220119
// 매입/철거 연결목록 읽지 않은 견적 갯수 표시 with PSS 20220217
//$sql_noti_choice = "select count(*) as cnt from g5_notify where category in ('p3','p4') AND email = '{$member['mb_email']}' AND read_gb = 0";
$sql_noti_choice =  "select count(*) as cnt from g5_estimate_propose m inner join g5_notify gn on m.estimate_idx = gn.estimate_idx 
where gn.email = '{$member['mb_email']}' and gn.read_gb = 0 and category in ('p3','p4') ";
$fet_noti_choice = sql_fetch($sql_noti_choice);
$newnotice = $fet_noti_choice['cnt'];

if($newnotice == "0")
{
    $class_off = "off";
}else{
    $class_off = "";
}

?> 
<link rel="stylesheet" type="text/css" href="/css/board.css?kjs1"/>
<link rel="stylesheet" type="text/css" href="/css/member.css?kjs1"/>
<link rel="stylesheet" type="text/css" href="/css/estimatelist.css?kjs1" />
<style>
#board {margin-bottom: 10rem;}
.tab .row { margin-top : 4.6rem;}
@media (max-width: 768px) {
	.tab .row { margin-top : 1rem;}
}

@media (max-width: 768px){
.esti_list .status_req {margin-right:0;}
}
</style>


<div class="member com_pd esti_list">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">맞춤 추천 견적 목록&#160;&#160;<a href='#.' data-toggle='modal' data-target='#esti_guide' class='tooltips'><i class="fa fa-info-circle"></i></a></h1>
			<p class="tit_desc">내 지역 및 취급 품목 설정에 따른<br class="visible-xs"> 맞춤형 매입&#47;철거 견적 목록 입니다.</p>
						
		</div>
		<div id="board">
			<div class="tab">
				<ul class="row">
					<li class="col-lg-2 col-lg-offset-1 col-xs-2 col-xs-offset-1 tab14">
						<a class="tooltips" href="/estimate/estimate_list2.php">전체<span class="tab1sub"> 목록</span></a>
						<span class="tooltiptexts"><p>모든 매입&#47;철거 견적 목록를 확인합니다.</p></span>
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 on main_bg tab24">
						<a class="white tooltips" href="/estimate/estimate_list1.php">맞춤<span class="tab2sub white"> 추천 목록</span></a>
						<span class="tooltiptexts"><p>내가 설정한 조건에 맞는 매입&#47;철거 견적 목록만 확인합니다.</p></span>
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 tab34">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=1">참여<span class="tab3sub"> 견적 목록</span></a>
						<span class="tooltiptexts"><p>내가 입찰에 참여한 매입&#47;철거 견적 목록를 확인합니다.</p></span>
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 tab44">
						<span class="newconnect <?php echo $class_off; ?>"><?php echo $fet_noti_choice['cnt'] ?></span>
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=2">연결<span class="tab4sub"> 목록</span></a>						
						<span class="tooltiptexts"><p>입찰 후 고객과 연결된 매입&#47;철거 견적 목록를 확인합니다.</p></span>						
					</li>				
				</ul>
				<br/>
			</div>
			<br>

			<div id="board">
				<div class="member">
					<?php
	    				for ($i=0; $row=sql_fetch_array($result); $i++)
	    				{
	    					$state = $row['state'];
	    					$e_type1 = $row['e_type'];
	    					$img_path = estimate_img($row['idx']);
	    				?>
	    					<div class='req_list'>
	    						<a  href='javascript:doDetailEstimate(<?php echo $row['idx'] ?>);'>
		    					<div class ="abox">
		    						<h4 class="subject title_req"><?php echo $row['title'] ?></h4>
		    						<div class="thumb_area">
			    					<?php echo estimate_img_thumbnail($img_path, 350, 350); ?>
			    					</div>
		    						<div class='info_area'>
												<!-- <div class="end_req">견적마감일 : <?php 
												if(intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) == 0){
												echo $row['deadline'];
												}else{
													echo 'D-' . intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) / 86400;
												} ?></div> -->
													<div class="end_req">견적마감 : <?php if (intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) < 1) {
																					echo '오늘';
																				} else if (intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) < 0) {
																					echo '선택중';
																				} else {
																					echo 'D-' . floor(intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) / 86400);
																				} ?></div>
									
													<div class="ea_req">지역 : <?php echo $row['area1'] . ' '. $row['area2'] ?></div>
													<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
									
									</div>
												
								
								<div class='status_req dang'>
												<div class='sub_tt white'><?php echo get_estimate_state($state); ?></div>
			    								</div>
												</div>	
	    						</a>
								
	    					</div>
	    				<?php }
	    				if($i == 0){
							echo "<br>"	;
							echo "<div class='req_list req_form noco'>";
							echo "<div class='nocon'>";
							echo "<div class='noconicon'>";
							echo "<i class='fas fa-user-times fa-5x'></i>";
							echo "</div>";
							echo "<p class='onemountain bbold lfont'>마이페이지를 통해 지역 및 취급 품목년식 설정에 따라 추천해 드리고 있습니다.</p>";
							echo "<p class='donde'>";
							echo "<a href='#.' data-toggle='modal' data-target='#esti_guide' class='guide_estimate'><i class='xi-help main_co'></i>&#160;맞춤 추천 견적 목록를 활용하려면?</a></p>";
							//echo '<p>견적 문의 내역이 없습니다.<br/>문의사항 견적이 사라진 경우, 견적이 이미 선택 됐거나 취소가 됐을때 확인이 안될 수 있습니다.<br/>알림에서 정보를 확인해주시기 바랍니다.</p>';
							echo "</div>";
							echo "</div>";
							}
					?>
				</div><!-- list -->	
				
				<? // 도움말 시작 with KJS dance ?>
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content newt">
		<div class="modal-header fallout">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
			<h4 class="modal-title cufflinks" id="myModalLabel">매입/철거 견적 도움말</h4>
		</div>
		<div class="modal-body nomage">
					<div id="slider">					
					<ul>
						<li><img class="" src="/images/GuidedMissiles/est2_tip1.png" alt="guide1">
						<div class="niffler">
							<P class="myass"><span>1.</span>종류별로 견적 목록을 조회합니다.<br></P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;전체 :</span>모든 견적 목록 조회</p>
								<p class="uwin"><span>&#160;&#160;맞춤 :</span>내 지역/품목과 맞는 견적만 조회</p>
								<p class="uwin"><span class="ninja">&#160;&#160;맞춤 :</span>※ 조건은 '내설정' 에서 변경 가능</p>
								<p class="uwin"><span>&#160;&#160;참여 :</span>내가 참여한 견적 목록 조회</p>
								<p class="uwin"><span>&#160;&#160;연결 :</span>고객과 연결된 견적 목록 조회</p>
							</div>
							<P class="myass"><span>2.</span>조건을 입력해 상세 검색을 합니다.</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;※</span>전체 목록에서만 사용가능</p>
							</div>
							<P class="myass"><span>3.</span>목록 순서를 변경하실 수 있습니다.</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;등록 순 :</span>최근 등록된 견적부터 조회</p>
								<p class="uwin"><span>&#160;&#160;마감 순 :</span>마감 임박한 견적부터 조회</p>								
							</div>
						</div>
						</li>
						<li><img class="" src="/images/GuidedMissiles/est2_tip2.png" alt="guide2">
						<div class="niffler">
							<P><span>4.</span>견적 제목입니다. 견적글을 터치하면 상세 내용 조회 및 견적에 참여 하실 수 있습니다.</P>
							<P><span>5.</span>해당 견적에 대한 요약 정보입니다.</P>
							<P><span>6.</span>해당 견적의 현재 상태를 표시합니다.</P>							
						</div>						
						</li>
						<li><img class="" src="/images/GuidedMissiles/est2_tip3.png" alt="guide3">
						<div class="niffler">
							<P><span>7.</span>내가 참여한 견적은 '참여' 목록에서 확인 할 수 있습니다.</P>							
							<P class="vermil"><span class="vermil">※</span>내가 참여한 견적글은 다른 목록 에서는 사라집니다. '참여' 목록 에서만 볼 수 있습니다.</P>
							
						</div>
						</li>						
						<li><img class="" src="/images/GuidedMissiles/est2_tip4.png" alt="guide4">
						<div class="niffler">
						<P><span>8.</span>내가 참여한 견적을 고객이 선택한 경우, '연결' 목록에 알림을 통해 알려드립니다. 동시에 해당 견적글은 '연결' 목록에서 확인하실 수 있습니다.</P>
						<P><span>9.</span>고객과 연결된 견적은 '견적 선택됨' 으로 상태가 변하게 됩니다.</P>							
							<P class="vermil"><span class="vermil">※</span>이후 수거완료까지 진행된 견적도 '연결'목록에서 확인 하실 수 있습니다.</P>
						</div>
					</li>
					</ul>  
					</div>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-4"><a href="#" class="control_prev">이전</a></li>					
						<li class="col-xs-4"><a class="line_bg l_bg" href="#" data-dismiss="modal">닫기</a></li>
						<li class="col-xs-4"><a href="#" class="control_next">다음</a></li>
					</ul>
				</div><!-- btn_wrap -->
			</div>
		</div><!-- modal-body -->
	</div>
</div>
<? // 도움말 끝 with KJS dance ?>
				<div id="page">
					<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
				</div><!-- page -->
			</div>
		</div><!-- board -->		

			<div id="page">
				<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?page="); ?>
			</div><!-- page -->
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<script type="text/javascript">
$(".mob_back").hide();
function doDetailEstimate(idx)
{
	location.href = "estimate_form.php?idx="+idx;
}



</script>
<?php

include_once('./_tail.php');
?>