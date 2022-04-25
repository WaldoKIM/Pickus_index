<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>

<div id="board">
					<div class="view">
						<ul class="shop_list" id="proposeList">
						<li style="width: 100% !important">
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
						$sql = " select
									a.idx,
									a.estimate_idx,
									b.e_type,
									b.item_cat,
									concat(substr(a.nickname,1,1),'**') AS nickname,
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

                        //사진, 이름, 거래지역 등 불러오기 추가 with KJS dance 20220117
						
						$sql = " select
						mb_photo_site,
						mb_name,
						mb_biz_goods_item
					from 
						g5_member
					where 
						mb_email = '{$member['mb_email']}'"
						;

			$seller_info = sql_query($sql);
			$seller_profile = mysqli_fetch_array($seller_info);


			//랜덤 인삿말 with KJS Dance 20220126

$inArray1 = array("안녕하세요", "반갑습니다", "어서오세요", "환영합니다", "Hello," ,"Hi");

$outArray1 = array_rand($inArray1, 2);


  $inArray = array("즐겁고", "힘세고", "건강하고", "재미있고", "행복하고", "근심없고", "힘차고", "");

  $outArray = array_rand($inArray, 2);


 $inArray2 = array("활기찬", "건강한", "팔팔한", "신나는", "기분좋은", "평안한", "강한", "편안한");

  $outArray2 = array_rand($inArray2, 2);
			

						echo '<div id="board" class="boardx">';
						echo '<span class="roof"></span>';
						echo '<div class="form-group">';
						echo '<ul class="shop_list" id="selectList">';
						echo '<br class="brx">';
						echo '<div class="myreti" style="text-align: center; margin-bottom: 5px;">';
						echo "<span class='main_co'><a href='/bbs/mypage_partner.php'>".$inArray1[$outArray1[0]]." <strong class='main_co'>".$seller_profile['mb_name']."</strong>님!</a></span>";
						echo "<span class='waldo'>&#160오늘도&#160".$inArray[$outArray[0]]."&#160;".$inArray2[$outArray2[1]]."&#160하루 되세요!</span>";
						echo'</div>';						
						echo '<div class="text-right" id="reviewTitle">';
						echo "<div class='img'><a href='/bbs/mypage_partner.php'><img class='portx' src = '/data/estimate/" .$seller_profile['mb_photo_site']. "'></a></div>";
						echo "<div class='infbox'>";
						echo "<span class='main_cowrap'>";								
						echo "<span class='main_co'>".$seller_profile['mb_biz_goods_item']."</span><a href='/bbs/mypage_partner.php'>품목</a>";
						echo "</span>";
						echo'</br>';
						echo "<span class='main_cowrap'>";						
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
						echo '</span>';
						echo'</br>';
						echo "<span class='main_cowrap'><span class='main_co'>".$score."<span class='sco'> / 5.0</span></span><a href='/bbs/mypage_review.php'>평점&#160;</a></span>";
						echo'</br>';
						//echo '<p style="text-align: center; margin-bottom: 5px;">';
						
						echo "<span class='main_cowrap'><span class='main_co'>".$review_cnt."</span><a href='/bbs/mypage_review.php'>거래후기&nbsp;</a></span>";
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
						
						$sql = " select
						count(*) as goods_cnt
					from 
						cs_goods
					where 
						seller = '{$member['mb_email']}'"
						;

						$row = sql_fetch($sql);
						$goods_cnt = $row['goods_cnt'];

						echo'</br>';
						
						echo "<span class='main_cowrap'><span class='main_co'>".$total_count."</span><a href='/estimate/partner_estimate_list.php?gubun=2'>총 견적&nbsp;</a></span>";
						echo'</br>';
						echo "<span class='main_cowrap'><span class='main_co'>".$goods_cnt."</span><a href='/market/seller/product/product_list.php'>총 상품&nbsp;</a></span>";
						echo'</div>';
						
												
						//거래지역 및 수거품목
							$sql = " select * from {$g5['member_area_table']} where mb_id = '{$member['mb_id']}' ";

							$member_area = sql_query($sql);
							echo  "</div>";								
							echo  "<div class='signup_txt_area'>";								
							echo  "<span class='areatitle'>내지역</span> <span class='main_co'>";

							for ($i=0; $row=sql_fetch_array($member_area); $i++)
							{
								
								echo  $row['mb_area1']."&nbsp;";
								if($row['mb_area2']){
									echo $row['mb_area2']."&nbsp;&nbsp;&nbsp;";
								}else{
									echo "전체&nbsp;&nbsp;&nbsp;";
														
							}
							}
							echo  "</span>";
							
							echo "</div>";

														

						//$row['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $row['rc_nickname']);
						//		echo "<h4>" . $row['rc_nickname'] . "</h4>";
						
						echo '</div>';
						echo '</div>';
						


						
						


							?>
						</li>
						</ul>
					</div>
				</div>