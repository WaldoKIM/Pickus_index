<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_common  = " from {$g5['estimate_list']} a join {$g5['estimate_request']} b on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}'
				where 
					a.idx not in (
						select estimate_idx from {$g5['estimate_propose']} where rc_email = '{$member['mb_email']}'
					)
					and state in ('0','1') and format(NOW(),'Y-m-d') <= a.deadline";

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
	$page = 1;
} // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select 
			a.*, 
			b.*,
			concat(substr(a.nickname,1,1),'**') as nickname, 
			case when length(a.title) <= 60 then title else concat(substr(a.title,1,40),'...') end as title, 
			date_format(a.writetime, '%Y.%m.%d') as writetime  ";
$sql .= $sql_common;
$sql .= " order by a.idx desc ";
$sql .= " limit $from_record, $rows ";


$result = sql_query($sql);

$qna_noti_req = "select count(*) as cnt from g5_estimate_propose b inner join g5_notify gn on b.estimate_idx = gn.estimate_idx
	where gn.category = 'p2' AND b.rc_email = '{$member['mb_email']}' AND gn.read_gb = 0";

$qna_noti_req = sql_fetch($qna_noti_req);

?>

<style type="text/css">
	@media(max-width: 768px) {
		.top_list {
			display: none;
		}

		.sub_tt {
			font-size: 10px;
			padding-bottom: 0;
		}
		.esti_list .req_list .status_req {margin-right: 1rem;
		}

	}

	#board .subject {
		padding: 10px 0;
	}
	.status_req{width: 120px; text-align: center; border-radius: 20px; background-color: #1379cd; color: #fff; font-size: 2rem; padding: 5px 0;
float: right;}
</style>
<!-- <div class="tab_area">
	<div class="tab">
		<ul class="row">
			<li id="patiGubun1" class="col-xs-6">
				<a href="/estimate/partner_estimate_list.php?gubun1">참여현황</a>
			</li>
			<li id="patiGubun1" class="col-xs-6 on">
				<a href="/estimate/partner_estimate_list.php?gubun=3">문의현황</a>
			</li>
		</ul>
	</div>
</div> -->
<div class="list esti_list" id="tableList">
	<!--<h2 class='req_form msubtitle'> 매입&#47;철거 문의 관리 </h2>-->
	
	
	<?php
	for ($i = 0; $row = sql_fetch_array($result); $i++) {
		$state = $row['state'];
		$e_type = $row['e_type'];
		$img_path = estimate_img($row['estimate_idx']);
	?>	
		<div class='req_list req_form'>			
			<a class="subject" href='javascript:doDetailEstimate(<?php echo $row['estimate_idx'] ?>);'>
			<div class="abox">
				<h4 class='title_req'><?php echo $row['title'] ?></h4>			
			<div class="end_req">견적마감 : <?php
											if (intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) <= 0) {
												echo $row['deadline'];
											} else {
												echo 'D-' . floor(intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) / 86400);
											} ?></div>
			<div class='info_req'>
				<div class="ea_req">지역 : <?php echo $row['area1'] . ' ' . $row['area2'] ?></div>
				<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
				<div class="ea_req">문의일 : <?php echo $row['writetime'] ?></div>
				<!-- <div class='date'>작성자 : <?php echo $row['nickname']; ?> ㅣ 등록일 : <?php echo $row['writetime'] ?></div> -->
			</div>
			</div>
			
			<div class='status_req'>
				<div class='sub_tt '><?php
											if ($row['estimate_yn']) {
												echo " (견적불가) ";
											} else {
												echo get_estimate_state($state);
											} ?></div>
			</div>
										
			</a>
		</div>
	<?php }
	if ($i == 0) {
		echo "<div class='req_list req_form noco'>";
		echo "<div class='nocon'>";
		echo "<div class='noconicon'>";
		echo "<i class='fas fa-user-times fa-5x'></i>";
		echo "</div>";
		echo "<p class='onemountain bbold lfont'>매입/철거 관련 고객 문의가 없습니다.</p>";
		echo "<p class='donde'>";
		echo "<a href='#.' data-toggle='modal' data-target='#esti_guide' class='guide_estimate'><i class='xi-help main_co'></i>&#160;이미 선택이 되었거나 취소된 내역에 대한 문의글은 사라지게 됩니다</a></p>";
		//echo '<p>견적 문의 내역이 없습니다.<br/>문의사항 견적이 사라진 경우, 견적이 이미 선택 됐거나 취소가 됐을때 확인이 안될 수 있습니다.<br/>알림에서 정보를 확인해주시기 바랍니다.</p>';
		echo "</div>";
		echo "</div>";
		
	}
	?>
</div><!-- esti_list -->
<div style="display:none;" class="src_form">
<?php
include_once('../bbs/mypage_review_bottom.php');
?>
</div>

<? // 도움말 시작 with KJS dance ?>
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content newt">
		<div class="modal-header fallout">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
			<h4 class="modal-title cufflinks" id="myModalLabel">고객 관리 도움말</h4>
		</div>
		<div class="modal-body nomage">
					<div id="slider">					
					<ul>
						<li><img class="" src="/images/GuidedMissiles/qna_review_tip1.png" alt="guide1">
						<div class="niffler">
							<P class="myass"><span>1.</span>현재 화면이 고객 문의글 관리 화면임을 나타냅니다.<br></P>							
							<P class="myass"><span>2.</span>고객 문의글을 조회할 항목을 선택 해 주세요. 각 항목에 새 문의글이 있으면 알림이 표시됩니다.</P>
							<P class="vermil"><span class="vermil">※</span>문의글과 달리, 후기글은 새 글 알림이 표시되지 않습니다!</P>							
							<P class="myass"><span>3.</span>고객 문의글 / 고객 후기글 보기 전환 버튼입니다.</P>
							<P class="myass"><span>4.</span>고객 문의가 들어온 견적 목록을 확인 및 참여 하실 수 있습니다.</P>							
						</div>
						</li>
						<li><img class="" src="/images/GuidedMissiles/qna_review_tip2.png" alt="guide2">
						<div class="niffler">
							<P><span>5.</span>고객 후기글 보기 버튼으로 후기글 관리 화면으로 이동 가능합니다.</P>
							<P><span>6.</span>고객 후기글 관리 화면으로 전환된 것을 확인 하실 수 있습니다.</P>
							<P><span>7.</span>고객이 작성한 후기글 확인 및 상세 견적서 페이지로 이동 가능합니다</P>							
						</div>						
						</li>
						<li><img class="" src="/images/GuidedMissiles/qna_review_tip3.png" alt="guide3">
						<div class="niffler">
							<P><span>8.</span>마켓 상품 문의글 답변 여부 상태를 표시합니다.</P>
							<P><span>9.</span>마켓 상품 문의글 답변 작성을 하실 수 있습니다. 또는 작성한 답변을 수정하실 수 있습니다.</P>
							<P class="vermil"><span class="vermil">※</span>답변을 작성하시기 전 까지 마켓 문의 새 글 알림이 표시됩니다.</P>
							
						</div>
						</li>						
						<li><img class="" src="/images/GuidedMissiles/qna_review_tip4.png" alt="guide4">
						<div class="niffler">
						<P><span>10.</span>고객 후기글 보기 버튼으로 후기글 관리 화면으로 이동 가능합니다.</P>
						<P><span>11.</span>고객이 작성한 마켓 상품 후기글 목록이 표시됩니다.</P>							
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
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=3&&area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
</div><!-- page -->
<script type="text/javascript">
	function doDetailEstimate(idx) {
		location.href = "estimate_form.php?idx=" + idx;
	}
</script>