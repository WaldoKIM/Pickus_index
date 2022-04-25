<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_common  = " from ";
$sql_common .= " 	{$g5['estimate_match']} a ";
$sql_common .= " 	join {$g5['estimate_match_propose']} b on a.no_estimate = b.no_estimate and b.rc_email = '{$member['mb_email']}' and b.selected = '0' ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select no_estimate, count(*) as cnt from {$g5['estimate_match_propose']} group by no_estimate ";
$sql_common .= " 	) c on a.no_estimate = c.no_estimate where a.date_close >= NOW()";
/*$sql_common .= " where ";
$sql_common .= " 	a.state in ('0', '1') ";*/

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select * ";
$sql .= $sql_common;
$sql .= " order by a.no_estimate desc ";
$sql .= " limit $from_record, $rows ";

$result_list = sql_query($sql);
?>
<style type="text/css">
	.title_req{padding: 10px 0;}
	.partner_li li{border-bottom: 1px solid #ddd; font-size: 20px; padding: 10px 0;}
	.partner_li li a{width: 100%;}
	.partner_li li span{float: right; color: #999;}
	
	.req_list + .req_list:nth-of-type(2n){margin-left: 2%;}
	.status_req{width: 80px; text-align: center; border-radius: 20px; background-color: #1379cd; color: #fff; font-size: 14px; padding: 5px 0;}
	.thumb_area{width: 20%; float: left;}
	.info_area{width: 76%; float: left; margin-left: 4%;}
	.end_req{color: #fe8e3a; font-weight: 600; font-size: 14px; margin-bottom: 5px;}
	.ea_req{line-height: 21px; font-size: 16px;}
	.btn_req{text-align: center; overflow: hidden; width: 100%; font-size: 18px; margin-top: 20px;}
	.btn_req a{background-color:#1379cd; color: #fff; text-align: center; max-width: 450px; margin: 0 auto; display: block; padding: 10px;margin-top: 20px; border-radius: 10px;}
	@media(max-width: 768px){
		.req_list{width: 100%; margin-left: 0 !important;}
		.req_list .abox{height: auto;} 
	}
</style>
<!-- <div class="tab_area">
	<div class="tab">
		<ul class="row">
			<li id="patiGubun1" class="col-xs-6 on">
				<a href="/estimate/partner_estimate_list.php?gubun=4">참여현황</a>
			</li>
			<li id="patiGubun1" class="col-xs-6 ">
				<a href="/estimate/partner_estimate_list.php?gubun=7">문의현황</a>
			</li>
		</ul>
	</div>
</div> -->
<div class="list esti_list" id="tableList">
	<div class="board">
	<div class="member">
		<?php 
			for ($i=0; $row_list=sql_fetch_array($result_list); $i++){ ?>
				<div class='req_list list_<?php echo $i ?>'>
					
					<a class="subject" href='javascript:doDetail_match(<?php echo $row_list['no_estimate'] ?>);'>
					<div class="abox">
					<h4 class='subject title_req'><?php echo $row_list['title'] ?></h4>	
						<div class="end_req">견적마감일 : <?php 
						if(intval(strtotime($row_list['date_close'])-strtotime(date("Y-m-d"))) <= 0){
							echo $row_list['date_close'];
						}else{
							echo 'D-' . intval(strtotime($row_list['date_close'])-strtotime(date("Y-m-d"))) / 86400;
						} ?></div>
						<div class="ea_req">지역 : <?php echo $row_list['area1'] . ' '. $row_list['area2'] ?></div>
					</div>
					<div class='status_req'>
    					<div class='sub_tt white'><?php echo get_estimate_state_match($state); ?></div>
    				</div>
					</a>
				</div>
		<?php } ?>
	
	
	<?php 
		if($i == 0){
			echo "<div class='req_list req_form noco'>";
			echo "<div class='nocon'>";
			echo "<div class='noconicon'>";
			echo "<i class='fas fa-user-times fa-5x'></i>";
			echo "</div>";
			echo "<p class='onemountain'>참여한 견적이 없습니다. 지금 바로 참여해 보세요.</p>";
			echo "<p class='donde'>";
			echo "<a href='#.' data-toggle='modal' data-target='#esti_guide' class='guide_estimate'><i class='xi-help main_co'></i>&#160;이미 다른 업체로</br>선택이 되었거나 취소된 견적은 나타나지 않습니다.</a></p>";
			//echo '<p>견적 문의 내역이 없습니다.<br/>문의사항 견적이 사라진 경우, 견적이 이미 선택 됐거나 취소가 됐을때 확인이 안될 수 있습니다.<br/>알림에서 정보를 확인해주시기 바랍니다.</p>';
			echo "</div>";
			echo "</div>";
			} 
			?>
	</div>
	</div>
	<style type="text/css">
		#board .list{border-top: 0;}
		.form_req{width: 100%; overflow: hidden; padding: 20px 0; border-bottom: 1px solid #ccc;}
		.form_req:first-of-type{padding-top: 0 !important}		
		.form_req .form_now span{font-size: 16px; border-radius: 40px; border:1px solid #ededed; background-color: #1379cd; color: #fff; padding: 7px 10px; text-align: center;} 
		.form_req .tit_req{padding-bottom: 10px;}
		.form_req .tit_req h2{font-size: 24px; background-color: #f4f5f9; padding: 15px;}
		.form_req .detail_info{width: 100%; display: block;}
		.form_req .detail_info p{width: 100%; display: block; overflow: hidden; padding-top: 15px; color:#333; line-height: 20px; font-size: 16px;}
		.form_req .detail_info img{width: 20%; max-width: 120px; max-height: 90px; float: left;}
		.form_req .detail_info .info_table{width: 80%; float: left;}
		.form_req .detail_info .info_table table{width: 100%;}
		.form_req table td{border-bottom: 0 !important; text-align: left !important; color: #333 !important; font-size: 18px !important;} 
		.form_req table td:nth-of-type(2){border-right: 1px solid #ccc;}
		tr:hover{background-color: transparent !important; }
		.tab li{font-size: 18px;}
		td.td_ten{width: 40%;}
		td.td_tw{width: 40%;}
	</style>
</div><!-- list -->
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

<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=1&&page="); ?>
</div><!-- page -->