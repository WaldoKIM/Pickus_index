<?php
include_once('./_common.php');


$g5['title'] = '연결 내역';
include_once('./_head.php');

$gubun = $_GET['gubun'];


if(!$gubun)
	$gubun = "2";	

if($gubun == "2")
{
	$class_on1 = "on";
	$class_on2 = "";
	$class_on3 = "";	
}else if($gubun == "5"){
	$class_on1 = "";
	$class_on2 = "on";
	$class_on3 = "";	
}else if($gubun == "9"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "on";
}else{
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";	
}


$sql = " select
			a.rc_email as rc_email,
			count(*) as pati_qty,
			sum(case when a.selected = '1' then 1 else 0 end) as pati_selected_sty,
			sum(case when b.state = '3' and a.selected = '1' then 1 else 0 end) as pati_complete_qty,
			c.mb_biz_score,
			format(ifnull(c.mb_point,0),0) as mb_point
		from
			{$g5['estimate_propose']} a
			join {$g5['estimate_list']} b on a.estimate_idx = b.idx
			join {$g5['member_table']} c on a.rc_email = c.mb_email
		where
			a.rc_email = '{$member['mb_email']}'
		group by a.rc_email	 ";

$userInfo = sql_fetch($sql);

$sql = " select
			a.rc_email as rc_email,
			count(*) as pati_qty,
			sum(case when a.selected = '1' then 1 else 0 end) as pati_selected_sty,
			sum(case when b.state = '3' and a.selected = '1' then 1 else 0 end) as pati_complete_qty,
			c.mb_biz_score,
			format(ifnull(c.mb_point,0),0) as mb_point
		from
			{$g5['estimate_match_propose']} a
			join {$g5['estimate_match']} b on a.no_estimate = b.no_estimate
			join {$g5['member_table']} c on a.rc_email = c.mb_email
		where
			a.rc_email = '{$member['mb_email']}'
		group by a.rc_email	 ";

$userInfo_match = sql_fetch($sql);

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 연결된 리스트에 새 알림이 있는지 표기 with KJS dance 20220119, With PSS 20220328
$sql_noti_choice = "select count(*) as cnt from g5_estimate_propose p   
inner join g5_notify gn on p.estimate_idx = gn.estimate_idx where gn.email = '{$member['mb_email']}' and gn.read_gb = 0 and gn.category = 'p3' 	
and p.selected = 1";
$fet_noti_choice = sql_fetch($sql_noti_choice);

$newnotice = $fet_noti_choice['cnt'];

if($newnotice == "0")
{
    $class_off = "off";
}else{
    $class_off = "";
}

//바로판매 연결리스트 With PSS
//$sql_noti_choice_match = "select count(*) as cnt from g5_notify where category = 'p23' AND email = '{$member['mb_email']}' AND read_gb = '0'";
$sql_noti_choice_match = "select count(*) as cnt from g5_estimate_match_propose gemp join g5_estimate_match gem on gemp.no_estimate  = gem.no_estimate  	
join g5_notify gn on gemp.no_estimate  = gn.estimate_idx  where category = 'p23' AND gn.email = '{$member['mb_email']}' AND read_gb = '0' and gem.state = 3";
$fet_noti_choice_match = sql_fetch($sql_noti_choice_match);

$newnotice_match = $fet_noti_choice_match['cnt'];

if($newnotice_match == "0")
{
    $class_off_match = "off";
}else{
    $class_off_match = "";
}

$sql_noti_choice_market = "select count(*) as cnt from cs_trade_goods where seller = '{$member['mb_email']}' and trade_stat = 2";
$fet_noti_choice_market = sql_fetch($sql_noti_choice_market);

$newnotice_market = $fet_noti_choice_market['cnt'];

if($newnotice_market == "0")
{
    $class_off_market = "off";
}else{
    $class_off_market = "";
}


?> 
<link rel="stylesheet" type="text/css" href="/css/board.css?kjs2"/>
<link rel="stylesheet" type="text/css" href="/css/member.css?kjs2"/>
<link rel="stylesheet" type="text/css" href="/css/estimatelist.css?kjs2"/>
<link rel="stylesheet" type="text/css" href="/css/estimateconnect.css?kjs3"/>


<style>
.tab .on span { color: #fff}	
	
</style>

<script type="text/javascript">
	$(".mob_back").hide();
	var gubun = "<?php echo $gubun; ?>";
	function doChangePatiGubun(v_gubun)
	{
		if(v_gubun != gubun)
		{
			location.href = "./partner_estimate_connect.php?gubun="+v_gubun;
		}
	}	
</script>  
<div class="member com_pd esti_list">
	<div class="container">
		<div class="sub_title">
		<? // 모달 충돌로 인해 data-target을 esti_guide1로 변경 KJS ?>
			<h1 class="main_co htitle">연결 내역&#160;&#160;<a href='#.' data-toggle='modal' data-target='#esti_guide1' class='tooltips'><i class="fa fa-info-circle"></i></a></h1>
			<p class="tit_desc hdesc">매입&#44;&#160;판매&#44;&#160;마켓&#160;고객과&#160;연결된&#160;<br class="visible-xs">내역들을&#160;확인&#160;하실&#160;수&#160;있습니다. 
			</p>
		</div>
		<div id="board">
			<div class="tab">
				<ul class="row">
				
						

					<li class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-2  <?php echo $class_on1; ?>">
                    <span class="newconnect <?php echo $class_off; ?>"><?php echo $fet_noti_choice['cnt']?></span>
						<!-- <a href="/estimate/estimate_list2.php">매입/철거 견적</a>-->
                        <a href="javascript:doChangePatiGubun('2');">매입<span class="tab1sub">&#47;철거</span></a>
					</li>
					<li class="col-lg-2 col-lg-offset-1 col-xs-2 col-xs-offset-1 <?php echo $class_on2; ?>">
                    <span class="newconnect <?php echo $class_off_match; ?>"><?php echo $fet_noti_choice_match['cnt']?></span>                    
                         <a href="javascript:doChangePatiGubun('5');"><span class="tab1sub">바로 </span>판매<span class="tab2sub"></span></a>
					</li>
					<li class="col-lg-2 col-lg-offset-1 col-xs-2 col-xs-offset-1 <?php echo $class_on3; ?>">
					<span class="newconnect <?php echo $class_off_market; ?>"><?php echo $fet_noti_choice_market['cnt']?></span>
                    <a href="/market/seller/order/trade.php">마켓<span class="tab3sub"></span></a>
					</li>					
				</ul>
				<br />
			</div>
			<? // 도움말 시작 with KJS dance ?>
			<? // 모달 충돌로 인해 ID를 esti_guide1로 변경 KJS ?>
<div class="modal fade guide" id="esti_guide1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content newt">
		<div class="modal-header fallout">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
			<h4 class="modal-title cufflinks" id="myModalLabel">고객 연결 내역 도움말</h4>
		</div>
		<div class="modal-body nomage">
			<? // 모달 충돌로 인해 ID를 x로 변경 KJS ?>
					<div id="sliderx">					
					<ul>
						<li><img class="" src="/images/GuidedMissiles/est_conn_tip1.png" alt="guide1">
						<div class="niffler">
							<P class="myass"><span>1.</span>고객과 연결된 모든 거래내역을 한 곳에서 확인 하실 수 있습니다.<br></P>
							<P class="myass"><span>2.</span>매입 / 판매 / 마켓 탭</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;매입 :</span>고객과 연결된 매입 견적 목록 조회</p>
								<p class="uwin"><span class="ninja">&#160;&#160;:::</span><span class="vermil">※매입/철거 메뉴의 '연결' 목록과 동일</span></p>
								<p class="uwin"><span>&#160;&#160;참여 :</span>고객과 연결된 판매 견적 목록 조회</p>
								<p class="uwin"><span class="ninja">&#160;&#160;:::</span><span class="vermil">※바로판매 메뉴의 '연결' 목록과 동일</span></p>
								<p class="uwin"><span>&#160;&#160;마켓 :</span>결재가 완료된 마켓 상품 목록 조회</p>
								<p class="uwin"><span class="ninja">&#160;&#160;:::</span><span class="vermil">※마켓상품 배송상태 및 거래 관리 가능</span></p>
								

							</div>
							<P class="myass"><span>3.</span>매입 / 판매 견적 및 마켓 상품 목록</P>
							
						</div>
						</li>
						<li><img class="" src="/images/GuidedMissiles/est_conn_tip2.png" alt="guide2">
						<div class="niffler">
							<P><span>3.</span>연결 내역 -> 마켓 메뉴에서는 마켓 판매 관리를 하실 수 있습니다.</P>
							<P><span>4.</span>현 거래 상태별로 상품 목록을 조회합니다.</P>							
							<P><span>5.</span>특정 기간 내 판매된 상품을 검색 하실 수 있습니다.</P>
							<P><span>6.</span>거래중인 상품 정보 및 구매 고객 정보를 확인할 수 있습니다.</P>														
						</div>						
						</li>
						<li><img class="" src="/images/GuidedMissiles/est_conn_tip3.png" alt="guide3">
						<div class="niffler">
							<P><span>7.</span>상품 거래 진행 상태를 표시합니다.</P>
							<P><span>8.</span>상세 상품 거래 내역서를 확인 할 수 있습니다.</P>
							<P><span>9.</span>상품 배송상태를 변경하실 수 있습니다.</P>
							<P><span>10.</span>상품 거래를 취소할 수 있습니다.</P>
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

			
			<?php
				include_once('./partner_estimate_list.skin'.$gubun.'.php');
			?>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->

<?php

include_once('./_tail.php');
?>
<script type="text/javascript">
	function doDetail(idx)
	{
		location.href = "./partner_estimate_form.php?idx="+idx+"&&gubun="+gubun+"&&page=<?php echo $page; ?>";
	}
	function doDetail_match(no_estimate)
	{
		location.href = "./partner_estimate_match_form.php?no_estimate="+no_estimate+"&&gubun="+gubun+"&&page=<?php echo $page; ?>";
	}
</script>