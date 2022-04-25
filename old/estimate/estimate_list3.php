<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql_where  = " where state = '1'";
//$sql_where .= " where 1=1 ";
$sql_where .= " and no_estimate not in ( select no_estimate from {$g5['estimate_match_propose']} where rc_email = '{$member['mb_email']}' ) ";
$sql_where .= " and date_close  >= DATE_FORMAT(now(), '%Y-%m-%d') ";

if ($area1)
	$sql_where .= " and area1 = '$area1' ";

if ($area2)
	$sql_where .= " and area2 = '$area2' ";

/*if($e_type){
	if($e_type == "1"){
		$sql_where .= " and e_type = '1' ";
		if($item_cat){
			$sql_where .= " and item_cat_dtl = '$item_cat' ";
		}
	}else if($e_type == "2"){
		$sql_where .= " and e_type = '2' ";
		if($item_cat){
			$sql_where .= " and sub_key in ( select distinct sub_key from {$g5['estimate_list_multi']} where pull_kind='$item_cat' ) ";
		}
	}else{
		$sql_where .= " and item_cat = '$e_type' ";
		if($item_cat){
			$sql_where .= " and item_cat_dtl = '$item_cat' ";
		}
	}
}*/

$sql = " select count(*) as cnt from {$g5['estimate_match']} " . $sql_where;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
	$page = 1;
} // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select 
			no_estimate, 
			concat(substr(name,1,1),'**') as nickname, 
			case when length(title) <= 40 then title else concat(substr(title,1,39),'...') end as title, 
			area1,
			area2,
			place,
			state,
			apply_date as writetime,
			date_close,
			jangso,
			cate
		  from {$g5['estimate_match']} ";
$sql .= $sql_where;

if ($_POST['deadline_ord'] == '1'){
	$sql .= " order by date_close";
}else{
	$sql .= " order by no desc ";
}

$sql .= " limit $from_record, $rows ";


$result = sql_query($sql);

$sql_noti_choice_match = "select count(*) as cnt from g5_notify where category = 'p23' AND email = '{$member['mb_email']}' AND read_gb = '0'";
$fet_noti_choice_match = sql_fetch($sql_noti_choice_match);

$newnotice_match = $fet_noti_choice_match['cnt'];

if($newnotice_match == "0")
{
    $class_off_match = "off";
}else{
    $class_off_match = "";
}

//바로판매 연결 목록 알림 wtth PSS 2022-04-18
$sql_noti_connect_match = "select count(*) as cnt from g5_estimate_match_propose m inner join g5_notify gn on m.no_estimate = gn.estimate_idx where gn.email = '{$member['mb_email']}'
	and gn.read_gb = 0 and gn.category = 'p23'";

echo $fet_noti_connect_match;

$fet_noti_connect_match = sql_fetch($sql_noti_connect_match);

$newnotice_connect_match = $fet_noti_connect_match['cnt'];

if($newnotice_connect_match == "0")
{
    $class_off_connect_match = "off";
}else{
    $class_off_connect__match = "";
}

//바로판매 배송내역 알림 with PSS 2022-04-18
$sql_noti_del_match = "select count(*) as cnt from g5_estimate_match_propose m inner join g5_notify gn on m.no_estimate = gn.estimate_idx where gn.email = '{$member['mb_email']}'
	and gn.read_gb = 0 and gn.category in ('cm9');";

echo $fet_noti_del_match;

$fet_noti_del_match = sql_fetch($sql_noti_del_match);

$newnotice_del_match = $fet_noti_del_match['cnt'];

if($newnotice_del_match == "0")
{
    $class_off_del_match = "off";
}else{
    $class_off_del__match = "";
}


?>
<link rel="stylesheet" type="text/css" href="/css/board.css?kjs2" />
<link rel="stylesheet" type="text/css" href="/css/member.css?kjs2" />
<link rel="stylesheet" type="text/css" href="/css/estimatelist.css?kjs2" />
<style type="text/css">
	.req_list a{width:100%}
	.member .sub_title{margin-bottom: -15px;}
	.tab .row{margin-top: 92px;}
	@media (max-width: 768px) {
.tab .row{margin : 1rem auto;}		
.member .sub_title {
  margin-top: 0rem;
  margin-bottom: 1.3rem;}
 
.esti_list .status_req {margin-right:0;}

}
</style>

<div class="member com_pd esti_list">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">바로 판매 견적 목록<span>&#160;&#160;<a href='#.' data-toggle='modal' data-target='#esti_guide' class='tooltips'><i class="fa fa-info-circle"></i></a></h1>
			<p class="tit_desc">피커스에 등록된 모든 중고 바로 판매<br class="visible-xs">견적 목록를 확인 하실 수 있습니다.
			</p>
		</div>
		<div id="board">
			<div class="tab">
				<ul class="row">
				<li class="col-lg-2 col-lg-offset-1 col-xs-2 col-xs-offset-1 on main_bg tab14">
						<a class="white tooltips" href="/estimate/estimate_list3.php">전체<span class="white tab1sub"> 목록</span><span></a>
						
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 tab24">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=4">참여<span class="tab2sub"> 판매 목록</span></a>
						
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 tab34">
					<span class="newconnect <?php echo $class_off_connect_match;?>"><?php echo $fet_noti_connect_match['cnt']?></span> 
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=5">연결<span class="tab3sub"> 목록</span></a>
					
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 tab44">
					<span class="newconnect <?php echo $class_off_del_match; ?>"><?php echo $fet_noti_del_match['cnt']?></span>
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=8">배송<span class="tab4sub"> 내역 관리</span></a>									
					</li>
					<li class="col-lg-10 col-md-10 col-xs-10 col-xs-offset-1 srch">
						<a class="tooltips control_btnon" href="javascript:offsrcform()" style="display:none">창 닫기<i class="fa fa-search-minus"></i></a>
						<a class="tooltips control_btnoff" href="javascript:onsrcform()" ><span class="tab5sub"></span>상세 검색<i class="fa fa-search-plus"></i></a>							
					</li>
				</ul>
				<br />
			</div>
			
			<div class="control_wrap" style="display:none">
				<form name="fregisterform" action="./estimate_list3.php" method="get" autocomplete="off">
					<div id="control">
					<div class="controlwrap">
						<div class="col-md-2 col-xs-6 mr5">
							<select id="srchArea1" name="area1">
								<option value="" selected>시도</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-6 mr5">
							<select id="srchArea2" name="area2">
								<option value="" selected>군구</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-6 mr5">
							<select id="srchEType" name="e_type">
								<option value="" selected>종류</option>
								<option value="가전">가전</option>
								<option value="가구">가구</option>
								<option value="주방집기">주방집기</option>
								<option value="헬스용품">헬스용품</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-6 mr5">
							<select id="srchItemCat" name="item_cat">
								<option value="" selected>세부</option>
							</select>
						</div>
						<div class="mob"></div>
						<!-- 
						<div class="col-md-2 col-xs-6">
							<div class="border">
								<input type="text">
							</div>
						</div>
						-->
						<div class="col-md-1 col-xs-6">
							<input class="main_bg" type="submit" value="검색">
						</div>
						<div class="col-md-1 col-xs-6">
							<a class="gray_bg" href="./estimate_list3.php">전체</a>
						</div>
						</div>
					</div>
				</form>
			</div>

			<div id="board">
				<a class="col-xs-6 themeblue lorder" href="./estimate_list3.php">최신글 순</a>	
				<form name="finform" action = "./estimate_list3.php" method="post">
					<input type ="hidden" name="deadline_ord" value = "1">
					<input class="col-xs-6 vermillion lorder" type="submit" value="마감일 순">				
				</form>
			
			</div>

			<div id="board bclear">
				<div class="member">
					<?php
					for ($i = 0; $row = sql_fetch_array($result); $i++) {
						$state = $row['state'];
					?>
						<div class='req_list'>
							<a  href='javascript:doDetailEstimate(<?php echo $row['no_estimate'] ?>);'>
							<div class ="abox"> 								
								<h4 class='subject title_req'><?php echo $row['title'] ?></h4>
								<div class="end_req">견적 마감일 : <?php
																if (intval(strtotime($row['date_close']) - strtotime(date("Y-m-d"))) == 0) {
																	echo '오늘 마감됩니다';
																} else {
																	echo 'D-' . intval(strtotime($row['date_close']) - strtotime(date("Y-m-d"))) / 86400;
																} ?></div>
								<div class='info_req'>
									<div class="ea_req"><?php echo $row['area1'] . ' ' . $row['area2'] . ' ' . $row['place'] ?></div>
									<!-- <div class="ea_req">장소 : <?php echo $row['jangso']; ?></div> -->
								</div>
							
								<div class='status_req'>

									<div class='sub_tt white'><?php echo get_estimate_state($state); ?></div>
								</div>
								</div>		
							</a>
						</div>
					<?php
					}
					
	    				if($i == 0){
							echo "<br>"	;
							echo "<div class='req_list req_form noco'>";
							echo "<div class='nocon'>";
							echo "<div class='noconicon'>";
							echo "<i class='fas fa-user-times fa-5x'></i>";
							echo "</div>";
							echo "<p class='onemountain bbold lfont'>바로 판매 견적글이 없습니다.</p>";
							echo "<p class='donde'>";
							echo "<a href='#.' data-toggle='modal' data-target='#esti_guide' class='guide_estimate'><i class='xi-help main_co'></i>&#160;피커스 마켓을 통해서도 상품을 판매하실 수 있습니다.</a></p>";
							//echo '<p>견적 문의 내역이 없습니다.<br/>문의사항 견적이 사라진 경우, 견적이 이미 선택 됐거나 취소가 됐을때 확인이 안될 수 있습니다.<br/>알림에서 정보를 확인해주시기 바랍니다.</p>';
							echo "</div>";
							echo "</div>";
							}
					
					?>

				</div><!-- list -->

				<div style="margin-bottom:10%;" id="page">
					<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
				</div><!-- page -->
			</div>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<? // 도움말 시작 with KJS dance ?>
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content newt">
		<div class="modal-header fallout">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
			<h4 class="modal-title cufflinks" id="myModalLabel">바로 판매 견적 도움말</h4>
		</div>
		<div class="modal-body nomage">
					<div id="slider">					
					<ul>
						<li><img class="" src="/images/GuidedMissiles/est3_tip1.png" alt="guide1">
						<div class="niffler">
							<P class="myass"><span>1.</span>종류별로 견적 목록을 조회합니다.<br></P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;전체 :</span>모든 견적 목록 조회</p>
								<p class="uwin"><span>&#160;&#160;참여 :</span>내가 참여한 견적 목록 조회</p>
								<p class="uwin"><span>&#160;&#160;연결 :</span>고객과 연결된 견적 목록 조회</p>
								<p class="uwin"><span>&#160;&#160;배송 :</span>고객 결재가 완료된 견적 목록 조회</p>
								<p class="uwin"><span class="ninja">&#160;&#160;맞춤 :</span>(배송대기중인 견적 및 배송완료된</p>
								<p class="uwin"><span class="ninja">&#160;&#160;맞춤 :</span>견적도 확인 가능합니다.)</p>

							</div>
							<P class="myass"><span>2.</span>조건을 입력해 상세 검색을 합니다.</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;※</span>전체 목록에서만 사용가능</p>
							</div>
							<P class="myass"><span>3.</span>목록 순서를 변경하실 수 있습니다.</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;최신 순 :</span>최근 등록된 견적부터 조회</p>
								<p class="uwin"><span>&#160;&#160;마감 순 :</span>마감 임박한 견적부터 조회</p>								
							</div>
						</div>
						</li>
						<li><img class="" src="/images/GuidedMissiles/est3_tip2.png" alt="guide2">
						<div class="niffler">
							<P><span>4.</span>견적 제목입니다. 견적글을 터치하면 상세 내용 조회 및 견적에 참여 하실 수 있습니다.</P>
							<P><span>5.</span>해당 견적에 대한 요약 정보입니다.</P>
							<P><span>6.</span>해당 견적의 현재 상태를 표시합니다.</P>							
						</div>						
						</li>
						<li><img class="" src="/images/GuidedMissiles/est3_tip3.png" alt="guide3">
						<div class="niffler">
							<P><span>7.</span>내가 참여한 견적은 '참여' 목록에서 확인 할 수 있습니다.</P>
							<P><span>8.</span>내가 참여한 견적의 상태를 확인 할 수 있습니다.</P>							
							<P class="vermil"><span class="vermil">※</span>내가 참여한 견적글은 다른 목록 에서는 사라집니다. '참여' 목록 에서만 볼 수 있습니다.</P>
							
						</div>
						</li>						
						<li><img class="" src="/images/GuidedMissiles/est3_tip4.png" alt="guide4">
						<div class="niffler">
						<P><span>9.</span>고객이 내 견적을 선택한 경우, '연결'목록 에서 확인 하실 수 있습니다.</P>
						<P><span>10.</span>견적이 연결되면, 해당 상품의 재고 확인 후 고객에게 결재를 요청 해 주세요.</P>
						<P><span>11.</span>고객의 결제를 대기 중인 견적은 '결제요청'으로 표시됩니다.</P>
						<P><span>12.</span>결재가 완료된 견적은 '배송'목록에서 확인 가능합니다.</P>	
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



<script type="text/javascript">
	var v_area1 = "<?php echo $area1; ?>";
	var v_area2 = "<?php echo $area2; ?>";
	var v_e_type = "<?php echo $e_type; ?>";
	var v_item_cat = "<?php echo $item_cat; ?>";

	jQuery(document).ready(function() {
		$(".mob_back").hide();

		$('#srchEType').change(function() {
			doChangeEType();
		})

		doSelectArea1();

		if (v_e_type) {
			$("#srchEType").val(v_e_type);
			v_e_type = "";
			doChangeEType();
		}

	});

	function doSelectArea1() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area1.php",
			data: {
				"area1": $('#srchArea1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "<option value=\"\" selected>시/도 전체</option>";
				fvHtml += data;
				$("#srchArea1").html(fvHtml);

				if (v_area1) {
					$("#srchArea1").val(v_area1);
					v_area1 = "";
					doSelectArea2();
				} else {
					fvHtml = "<option value=\"\" selected>시/구/군  전체</option>";
					$("#srchArea2").html(fvHtml);
				}
				$('#srchArea1').change(function() {
					doSelectArea2();
				});
			}
		});
	}

	function doSelectArea2() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
			data: {
				"area1": $('#srchArea1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "";
				if ($("#srchArea1").val()) {
					fvHtml += "<option value=\"\" selected>" + $("#srchArea1").val() + " 전체</option>";
				} else {
					fvHtml += "<option value=\"\" selected>시/도</option>";
				}
				fvHtml += data;
				$("#srchArea2").html(fvHtml);
				if (v_area2) {
					$("#srchArea2").val(v_area2);
					v_area2 = "";
				}

			}
		});
	}

	function doDetailEstimate(no_estimate) {
		location.href = "estimate_form_match.php?no_estimate=" + no_estimate;
	}

	function doChangeEType() {
		$("#srchItemCat").html("");
		var vEType = $("#srchEType").val();
		if (vEType == "1") {
			$("#srchItemCat").html("<option value='' selected>세부</option>");
		} else if (vEType == "2") {
			var fvHtml = "<option value='' selected>세부</option>";
			var pullKinds = cfnGetRemoveItem();
			for (var i = 0; i < pullKinds.length; i++) {
				fvHtml += "<option value='" + pullKinds[i] + "'>" + pullKinds[i] + "</option>";
			}
			$("#srchItemCat").html(fvHtml);
			if (v_item_cat) {
				$("#srchItemCat").val(v_item_cat);
				v_item_cat = "";
			}
		} else {
			$.ajax({
				type: "POST",
				url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
				data: {
					"category1": $("#srchEType").val()
				},
				cache: false,
				success: function(data) {
					var fvHtml = "<option value='' selected>세부</option>";
					fvHtml += data;
					$("#srchItemCat").html(fvHtml);
					if (v_item_cat) {
						$("#srchItemCat").val(v_item_cat);
						v_item_cat = "";
					}
				}
			});
		}
	}


	function onsrcform(){		
	$('.control_wrap').show();
	$('.control_btnon').show();
	$('.control_btnoff').hide();	
		}	
function offsrcform(){
	$('.control_wrap').hide();
	$('.control_btnon').hide();
	$('.control_btnoff').show();	
		}
</script>
<?php

include_once('./_tail.php');
?>