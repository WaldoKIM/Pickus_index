

						<div>
						<p style="text-align: center; margin-bottom: 5px;" class="reviewtb">
						내 매입&#47;철거 고객 후기
						</p>
						</div>


						<?php 

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

						//concat(substr(a.nickname,1,1),'**') AS nickname,
						$sql = " select
									a.idx,
									a.estimate_idx,
									b.e_type,
									b.item_cat,
									a.nickname AS nickname,
									b.area1,
									b.area2,
									a.score,
									b.goods_state,
									b.title,
									a.review,
									date_format(a.updatetime,'%Y.%m.%d') as updatetime,
									case when ifnull(a.review,'') !=  ''  then 'Y' else 'N' end as reviewYn
								from 
									g5_estimate_propose a
									join g5_estimate_list b on a.estimate_idx = b.idx
								where 
									ifnull(a.review,'') !=  '' 
									and a.rc_email = '{$member['mb_email']}'
								order by a.estimate_idx desc ";
								
						$result = sql_query($sql);

					
						echo '<div id="board">';
						echo '<div class="photo_list">';
						echo '<table id="reviewList">';
						if($review_cnt > 0){
							for ($i=0; $row=sql_fetch_array($result); $i++){
								$img_path = estimate_img($row['estimate_idx']);
								$score = $row['score'];
								echo "<tr class='reviewboxfloat'>";
								echo "<td class='reviewbox'>";
								echo "<a href='/estimate/partner_estimate_form.php?idx&#61;".$row['estimate_idx']."'>";
								echo "<div class='title reviewbuy'>";
								echo "<p class='type reviewcatebold'>".get_etype($row['e_type'])."</p>";
								
								echo "</div>";
								echo "<div class='con_wrap'>";
								echo "<div class='img'>".estimate_img_thumbnail($img_path, 70, 70)."</div>";
								echo "<div class='con'>";
								echo "<h5 class='main_co'>".$row['title']."</h5>";								
								
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
								echo "</span>";
								echo "<span class='area1'>".$row['area1']."</span>&nbsp;&nbsp;";
                                echo "<span class='area2'>".$row['area2']."</span>&nbsp;&nbsp;";
								echo "<span class='name'>".$row['nickname']."&nbsp;&nbsp;".$row['updatetime']."</span>";
								//echo "<p class='date'>".$row['updatetime']."</p>";
								//echo "<div class='subject2' href='javascript:'>".$row['review']."</div>";
								echo "</div>";
								echo "</div>";
								echo "</a>";
								echo "</td>";
								echo "</tr>";
							}
						}else{
							
							echo "<div class='req_list req_form noco cmanage'>";
							echo "<div class='nocon'>";
							echo "<div class='noconicon'>";
							echo "<i class='fas fa-user-times fa-3x'></i>";
							echo "</div>";
							echo "<p class='onemountain bbold lfont'>매입/철거 고객 후기가 없습니다.</p>";
							echo "<p class='donde'>";
							echo "<a href='#.' data-toggle='modal' data-target='#esti_guide' class='guide_estimate'><i class='xi-help main_co'></i>&#160;고객과 거래 진행 후에 수거완료 하여 많은 후기를 받아 보세요!</a></p>";
							//echo '<p>견적 문의 내역이 없습니다.<br/>문의사항 견적이 사라진 경우, 견적이 이미 선택 됐거나 취소가 됐을때 확인이 안될 수 있습니다.<br/>알림에서 정보를 확인해주시기 바랍니다.</p>';
							echo "</div>";
							echo "</div>";


						}
						echo '</table>';
						echo '</div>';
						echo '</div>';
						
					
					?>
					
				
