<?php
	include_once('./_common.php');

	/*if (!$is_member || $member['mb_level'] != "0")
		alert("회원만 가능합니다.", G5_URL);*/

	include_once('./_head.php');
	$email = $member['mb_id'];
	$sql = "select * from g5_estimate_list AS a JOIN g5_estimate_propose AS b ON a.idx = b.estimate_idx WHERE b.rc_email = '$email' AND b.selected = 1 order by a.idx desc";
	$result = sql_query($sql);

	$sql = " select
			a.rc_email as rc_email,
			count(*) as pati_qty,
			sum(case when a.selected = '1' then 1 else 0 end) as pati_selected_sty,
			sum(case when b.state = '5' and a.selected = '1' then 1 else 0 end) as pati_complete_qty,
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
				sum(case when b.state = '5' and a.selected = '1' then 1 else 0 end) as pati_complete_qty,
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

	$sql = "select * from g5_member where mb_email = '{$member['mb_email']}'";
	$cli_biz_info = sql_fetch($sql);

	$sql = " select
									a.rc_email,
									round(avg(a.score),1) as score,
									round(avg(a.score)/5 * 100,0) as rate,
									count(*) as cnt
								from 
									g5_estimate_propose a
									join g5_estimate_list b on a.estimate_idx = b.idx
								where 
									ifnull(a.review,'') !=  '' 
									and a.rc_email = '{$member['mb_email']}'
								group by a.rc_email ";

						$score_row = sql_fetch($sql);

						$review_cnt = $score_row['cnt'];
						$score = $score_row['score'];

?>
<link rel="stylesheet" type="text/css" href="/css/board.css?kjs1"/>
<link rel="stylesheet" type="text/css" href="/css/member.css?kjs1"/>
<link rel="stylesheet" type="text/css" href="/css/historypartner.css?kjs1"/>


<div class="member com_pd">
	<div class="container">
					
		<div class="sub_title">
			<h1 class="main_co">정산 관리&#160;&#160;<a href='#.' data-toggle='modal' data-target='#esti_guide' class='tooltips'><i class="fa fa-info-circle"></i></a></h1>
			<p class="tit_desc">내 정산내역 확인 및 마켓 수익금 <br class="visible-xs">출금 신청을 하실 수 있습니다.</p>
		</div>
		<div class="tab_area">
			
			<ul class="tab mb-5">
				<li class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-2 main_bg on"  style="border-bottom: 1px solid #ececec  !important;">
					<a href="/bbs/history_partner.php"> 
						<h4>매입<span class="mnone">/철거</span></h4>
					</a>
				</li>
				<li class="col-lg-2 col-lg-offset-1 col-xs-2 col-xs-offset-1" style="border-bottom: 1px solid #ececec  !important;">
					<a href="/bbs/history_partner_match.php">
						<h4><span class="mnone">바로 </span>판매</h4>
					</a>
				</li>
				<li class="col-lg-2 col-lg-offset-1 col-xs-2 col-xs-offset-1" style="border-bottom: 1px solid #ececec  !important;">
					<a href="/market/seller/wallet/wallet.php">
						<h4>마켓</h4>
					</a>
				</li>
			</ul>
			</div>
		
			<div class='req_list'>
			<table class="top_list">
		
			<tr>
				<th>참여</th>
				<th>연결</th>
				<th>완료</th>
				<th class="starcol">평점</th>
			</tr>
			<tr>
				<td><?php echo $userInfo['pati_qty']; ?></td>
				<td><?php echo $userInfo['pati_selected_sty']; ?></td>
				<td><?php echo $userInfo['pati_complete_qty']; ?></td>
				<td>
					<?php
					//mb_biz_score가 실제 평점인지, 매입 평점인지 구매 평점인지 모름
					//echo $userInfo['mb_biz_score']; ?>
					<?php
					
					/*
					echo "<span class='icon_star'>";
						if($score < 1){
							echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 2){
							echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 3){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 4){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 5){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
						}else{
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
						}
						echo '</span>';
						echo'</br>';
						*/
						echo "<span class='main_co'>".$score."</span> / 5.0";
						echo'</br>';
						?>
						</td>
			</tr>
		</table>
		</div>
		
		<div class="join_wrap esti_list" id="board">
			<div class="view">
				<?php
					for ($i=0; $row=sql_fetch_array($result); $i++)
					{
					?>
						<div class='req_list'>
							<?php 
								if(!empty($row['completetime'])){
									$day = date('Y-m-d',strtotime($row['completetime']));
									$week = array("&#40;일&#41;" , "&#40;월&#41;"  , "&#40;화&#41;" , "&#40;수&#41;" , "&#40;목&#41;" , "&#40;금&#41;" ,"&#40;토&#41;") ;
									$weekday = $week[ date('w'  , strtotime($day)  ) ] ;																		
									echo "<p>".date('Y-m-d',strtotime($row['completetime'])).$weekday."</p>";
								}else if(!empty($row['selecttime'])){
									$day = date('Y-m-d',strtotime($row['selecttime']));
									$week = array("&#40;일&#41;" , "&#40;월&#41;"  , "&#40;화&#41;" , "&#40;수&#41;" , "&#40;목&#41;" , "&#40;금&#41;" ,"&#40;토&#41;") ;
									$weekday = $week[ date('w'  , strtotime($day)  ) ] ;																		
									echo "<p >".date('Y-m-d' , strtotime($row['selecttime'])).$weekday."</p>";
								}else{
									echo "<p>-</p>";
								}
							?>
							<!-- <h4 class='title_req subject'><?php echo $row['title'] ?></h4> -->
							<div>
								<table>
									<tr>
										<th>내역</th>
										<th>견적가</th>
										<th>수수료</th>
										<th style="font-weight: bold;">합계(원)</th>
									</tr>
									<? // 해당 내역이 없으면 표 자체가 안나오게 수정 with KJS Dance 
									if($last_price == 0 && !$row['price_minus'] == 0){
									}else{									
									?>

									<tr class="main_bg">
										<td class="white"><?php echo '매입'; ?></td>
										<td class="white"><?php
										if($last_price == 0 && $row['price_minus'] == 0){
											echo '무료수거';
										   }else if($last_price == 0 && !$row['price_minus'] == 0){
											   echo '-';
										   }else{
											   echo number_format($row['price']);} ?></td>
										<td class="white"><span class="amarillo" style="font-weight: bold;"><?php
										
										
										//업체 수수료율 정보가 DB에 없어 임시 조치 with KJS Dance 
											//if($cli_biz_info['mb_biz_charge_rate'] != 0){
											//	$price_amt = $success['price'] * ($cli_biz_info['mb_biz_charge_rate'] / 100);
											$price_amt = $row['price'] * (10 / 100);
												$last_price = $price_amt + ($price_amt / 10);
											//}else{
											//	$last_price = $success['price'];
											//}
		
											if($last_price == 0 && $row['price_minus'] == 0){
											 echo '무료수거';
											}else if($last_price == 0 && !$row['price_minus'] == 0){
												echo '-';
											}else{
												echo number_format(floor($last_price));
											}
											
												?>
										</span></td>
										<td class="white"><? $last_pricexx =$row['price'] + $last_price; 
										 if($last_price == 0 && !$row['price_minus'] == 0){
											echo '-';}else{
										echo number_format(floor($last_pricexx));}?>


										</td>
									</tr>
									<? }?>


									<? // 해당 내역이 없으면 표 자체가 안나오게 수정 with KJS Dance 
									if($row['price_minus'] == 0){
									}else{									
									?>

									<tr class="dark_knight">
										<td class="white"><?php echo '폐기'; ?></td>
										<td class="white"><?php 
										if($row['price_minus'] == 0){
											echo '-';
										}else{
										echo number_format($row['price_minus']);} ?></td>
										<td class="white"><span class="amarillo" style="font-weight: bold;">
										<?php 
										
										//if($cli_biz_info['mb_biz_charge_rate'] != 0){
										//$price_amt = $row['price_minus'] * ($cli_biz_info['mb_biz_charge_rate'] / 100);
										$price_amt = $row['price_minus'] * (10 / 100);
										$last_price = $price_amt + ($price_amt / 10);
										$last_pricex = $row['price_minus'] - $last_price;
									//}else{
									//	$last_price = $row['price_minus'];
									//}
									if($row['price_minus'] == 0){
										echo '-';
									}else{
									 echo number_format(floor($last_price));}
									?></span></td>
									<td class="white"><?php
									if($row['price_minus'] == 0){
										echo '-';
									}else{
									echo number_format(floor($last_pricex)); }?></td>
									</tr>
									<? }?>
								</table>
							</div>
						</div>
					<?php }
					if($i==0){
						echo "<br>"	;
							echo "<div class='req_list req_form noco'>";
							echo "<div class='nocon'>";
							echo "<div class='noconicon'>";
							echo "<i class='fas fa-user-times fa-5x'></i>";
							echo "</div>";
							echo "<p class='onemountain bbold lfont'>정산 내역이 없습니다.</p>";
							echo "<p class='donde'>";
							echo "<a href='#.' data-toggle='modal' data-target='#esti_guide' class='guide_estimate'><i class='xi-help main_co'></i>&#160;정산 내역에 대해 궁금하신 사항이 있으신가요?</a></p>";
							//echo '<p>견적 문의 내역이 없습니다.<br/>문의사항 견적이 사라진 경우, 견적이 이미 선택 됐거나 취소가 됐을때 확인이 안될 수 있습니다.<br/>알림에서 정보를 확인해주시기 바랍니다.</p>';
							echo "</div>";
							echo "</div>";
					}
				?>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<? // 도움말 시작 with KJS dance ?>
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content newt">
		<div class="modal-header fallout">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
			<h4 class="modal-title cufflinks" id="myModalLabel">정산 관리 도움말</h4>
		</div>
		<div class="modal-body nomage">
					<div id="slider">					
					<ul>
						<li><img class="" src="/images/GuidedMissiles/settle_tip0.png" alt="guide1">
						<div class="niffler">
							<P class="myass"><span>1.</span>각 항목별 정산 내역을 확인 하실 수 있습니다.<br></P>							
							<P class="myass"><span>2.</span>항목별 총 견적 요약 정보를 확인 하실 수 있습니다.</P>
						</div>
						</li>
						<li><img class="" src="/images/GuidedMissiles/settle_tip2.png" alt="guide2">
						<div class="niffler">
							<P><span>3.</span>매입/철거 정산 내역은 밝은색으로 표시됩니다.</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;매입 합계:</span>견적가와 수수료를 합친 금액</p>	
							</div>															
							<P><span>4.</span>폐기 정산 내역은 어두운 색으로 표시됩니다.</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;폐기 합계:</span>견적가에서 수수료 제외 금액</p>
							</div>	
								<P><span>※</span>수수료 항목은 수수료(10%) + 부가세(수수료의 10%)가 포함된 금액입니다.</P>								
							<P class="vermil medio"><span class="vermil">&#160;&#160;견적 진행 후 피커스(디휴브) 계좌로<br>수수료 입금 꼭! 부탁드립니다. ^_^</span></P>							
						</div>						
						</li>
						<li><img class="" src="/images/GuidedMissiles/settle_tip3.png" alt="guide3">
						<div class="niffler">
							<P><span>5.</span>마켓 탭에서 마켓 수익 내역 확인 및 수익금 <strong>출금 신청</strong>이 가능합니다.</P>
							<P><span>6.</span>출금 신청 전 먼저 입금 받으실 계좌정보 등록이 필요합니다.</P>
							<P><span>7.</span>계좌 정보 입력 후 등록 해 주세요.</P>
							<P class="vermil"><span class="vermil">※</span>계좌가 정확한지 꼭 확인해 주세요!</P>							
						</div>
						</li>						
						<li><img class="" src="/images/GuidedMissiles/settle_tip4.png" alt="guide4">
						<div class="niffler">
						<P><span>8.</span>현재 출금 가능한 수익금이 표시됩니다.</P>
						<P><span>9.</span>상품별 수익 내역이 표시됩니다.</P>
						<P><span>10.</span>수익금 출금 신청 버튼입니다. 신청 내역 및 진행사항은 '출금 내역' 메뉴에서 확인 가능합니다.</P>
							<P class="vermil"><span class="vermil">※</span>마켓 수익금 정산은 출금 신청일로부터 최대 14일까지 소요 될 수 있습니다.</P>
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
include_once('./_tail.php');
?>
