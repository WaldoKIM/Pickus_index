<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_common  = " from ";
$sql_common .= " 	{$g5['estimate_list']} a ";
$sql_common .= " 	join {$g5['estimate_propose']} b on a.idx = b.estimate_idx ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx ";
$sql_common .= " 	) c on a.idx = c.estimate_idx ";
$sql_common .= " where ";
$sql_common .= " 	b.rc_email = '{$member['mb_email']}' ";
$sql_common .= " 	and b.selected = '1' ";

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select
			a.*,
			b.idx as sub_idx,
			date_format(a.writetime, '%y.%m.%d') as writetime,
			case when b.requesttime is null then '-' else date_format(b.requesttime, '%y.%m.%d') end as requesttime,
			case when a.selecttime is null then '-' else date_format(a.selecttime, '%Y-%m-%d') end as selecttime,
			case when b.completetime is null then '-' else date_format(b.completetime, '%Y-%m-%d') end as completetime,	
			a.e_type as e_type,
			a.title,
			b.meet,
			b.price,
			a.state as state,
			a.simple_yn as simple_yn ";
$sql .= $sql_common;
$sql .= " order by a.idx desc ";
$sql .= " limit $from_record, $rows ";

$result = sql_query($sql);



?>
<style type="text/css">
	.req_list a{width:100%}
	#board .subject{padding: 10px 0;}
	.status_req{width: 120px; text-align: center; border-radius: 20px; background-color: #1379cd; color: #fff; font-size: 2rem; padding: 5px 0;
float: right; }
</style>
<div class="list esti_list" id="tableList">
		<?php
		for ($i=0; $row=sql_fetch_array($result); $i++)
		{
			$state = $row['state'];
			$e_type1 = $row['e_type'];
			$img_path = estimate_img($row['idx']);
		?>
			<div class='req_list'>
				<a class="" href='javascript:doDetail(<?php echo $row['idx'] ?>);'>
				<div class ="abox"> 
					
					<h4 class='title_req subject'><?php echo $row['title'] ?></h4>
					<div class="thumb_area">
						<?php echo estimate_img_thumbnail($img_path, 350, 350); ?>
					</div>
					
					<div class="info_area">
						<?php if($row['completetime']!== '-'){ ?>
							<div class="end_req">수거일 : <?php 
								echo $row['completetime'];
								?>
							</div>
						<?php }else{ ?>
							<div class="end_req">선택일 : <?php 
								echo $row['selecttime'];
								?>
							</div>
						<?php } ?>
						<div class='info_req'>
							<div class="ea_req">지역 : <?php echo $row['area1'] . ' '. $row['area2'] ?></div>
							<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
							<!-- <div class='date'>작성자 : <?php echo $row['nickname']; ?> ㅣ 등록일 : <?php echo $row['writetime'] ?></div> -->
						</div>
					</div>
						</div>
						<div class='status_req contop'>
						<div class='sub_tt white'><?php 
						if($e_type1==2 && $state == 4){
							echo '철거중';
						}else if($e_type1==2 && $state == 5){
							echo '철거완료';
						}else{
							echo get_estimate_state($state);
						}?></div>
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
			echo "<p class='onemountain'>고객과 연결된 견적이 없습니다. 지금 바로 참여해서 고객을 확보해보세요.</p>";
			echo "<p class='donde'>";
			echo "<a href='#.' data-toggle='modal' data-target='#esti_guide' class='guide_estimate'><i class='xi-help main_co'></i>&#160;혹시 사라진 견적글을 찾고 계신가요?</a></p>";
			//echo '<p>견적 문의 내역이 없습니다.<br/>문의사항 견적이 사라진 경우, 견적이 이미 선택 됐거나 취소가 됐을때 확인이 안될 수 있습니다.<br/>알림에서 정보를 확인해주시기 바랍니다.</p>';
			echo "</div>";
			echo "</div>";
			}
	?>		
</div><!-- list -->
<div class="assoff">
<div>
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
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=2&&page="); ?>
</div><!-- page -->