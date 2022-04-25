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

						if($review_cnt== ''){$review_cntx = 0;
						}else{$review_cntx = $review_cnt;};

							//바로 판매 고객 후기 수 구하기 with KJS dance 20220303
							$sql = " select
							a.rc_email,
							round(avg(a.score),1) as score,
							round(avg(a.score)/5 * 100,0) as rate,
							count(*) as cnt
						from 
							g5_estimate_match_propose a
							join g5_estimate_match b on a.no_estimate = b.no_estimate
						where 
							ifnull(a.review,'') !=  '' 
							and a.rc_email = '{$member['mb_email']}'
						group by a.rc_email ";

							$score_row_match = sql_fetch($sql);

							$review_cnt_match = $score_row_match['cnt'];

							if($review_cnt_match== ''){$review_cntx_match = 0;
							}else{$review_cntx_match = $review_cnt_match;};

							//마켓 후기글 수 구하기 With PSS
							$sql_market_req_match = "select count(*) as cnt from cs_goods_qna where seller = '{$member['mb_email']}'";
							$fet_market_req_match = sql_fetch($sql_market_req_match);

							$review_market_match = $fet_market_req_match['cnt'];
									
						$total_review_cnt = $review_cntx + $review_cntx_match + $review_market_match;
						

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
?>			

						<div id="board" class="boardx">
						<span class="roof">
							<a class="minfo" href="/bbs/mypage_partner.php"><i class="fa fa-gear fa-spin"></i>내설정</a>
						</span>
						<div class="form-group fwrap">
						<ul class="shop_list" id="selectList">
						<br class="brx">
						<div class="myreti" style="text-align: center; margin-bottom: 5px;">
						<span class='main_co main_nom'><a href='/bbs/mypage_partner.php'><?=$inArray1[$outArray1[0]]?><strong class='main_co'>&#160;<?=$seller_profile['mb_name']?></strong>님!</a></span>
						<span class='waldo'>&#160;오늘도&#160;<?=$inArray[$outArray[0]]?>&#160;<?=$inArray2[$outArray2[1]]?>&#160;하루 되세요!</span>
						</div>						
						<div class="text-right" id="reviewTitle">
						<div class='img'><a href='/bbs/mypage_partner.php'><img class='portx' src = '/data/estimate/<?=$seller_profile['mb_photo_site']?>'></a></div>
						<div class='infbox'>
						<span class='main_cowrap nope'>								
						<span class='main_co'><?=$seller_profile['mb_biz_goods_item']?></span><a href='/bbs/mypage_partner.php'>품목</a>
						</span>
						</br>
						<span class='main_cowrap'>						
						<span class='icon_star'>
						<?	
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
						?>
						</span>
						</span>
						</br>
						<span class='main_cowrap'>평점&#160;<span class='main_co overall'><?=$score?><span class='sco'> / 5.0</span></span></span>
						</br>

						<? //	echo $review_cntx;
						 //		echo $review_cntx_match;
						 //		echo $review_market_match;
						 ?>
						<span class='main_cowrap  halvsl'><span class='main_co'><?=$notify_cnt?></span><a href='/bbs/notify.php'>새 알림&nbsp;</a></span>
						<span class='main_cowrap  halvsr'><span class='main_co'><?=$total_review_cnt?></span><a href='/estimate/partner_estimate_list.php?gubun=3'>고객 후기&nbsp;</a></span>

						<?
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
						
						//바로판매 연결내역수
						$sql = "select count(*) as cnt from {$g5['estimate_match']} a join {$g5['estimate_match_propose']} b on a.no_estimate = b.no_estimate 
						where b.rc_email ='{$member['mb_email']}' and b.selected = '1' and a.state in ('3')";
						$match_row = sql_fetch($sql);

						//마켓판매 내역수 with PSS
						$sql = "select count(*) as cnt from cs_trade_goods where seller='{$member['mb_email']}' and trade_stat='4'";
						$market_sell_row = sql_fetch($sql);


						$sql_noti_choice = "select count(*) as cnt from g5_notify where category = 'p3' AND email = '{$member['mb_email']}' AND read_gb = 0";
						$fet_noti_choice = sql_fetch($sql_noti_choice);
						$newnotice = $fet_noti_choice['cnt'];

						//바로판매 연결 알림
						$sql_noti_choice_match = "select count(*) as cnt from g5_notify where category = 'p23' AND email = '{$member['mb_email']}' AND read_gb = '0'";
						$fet_noti_choice_match = sql_fetch($sql_noti_choice_match);
						
						$newnotice_match = $fet_noti_choice_match['cnt'];

						$newnotice = $fet_noti_choice['cnt'] + $fet_noti_choice_match['cnt'];


						//마켓 연결내역수
						// $sql = "select count(*) as cnt from cs_trade_goods where seller='{$member['mb_email']}' and (trade_stat = '3' or trade_stat = '4') and (invoice_stat = '1' or invoice_stat = '0')";
						// $market_row = sql_fetch($sql);
						//$total_count = $row['cnt']  + $match_row['cnt'];	
						//$sell_total_count = $market_row['cnt'];					
						
						$sql = " select
						count(*) as goods_cnt
					from 
						cs_goods
					where 
						seller = '{$member['mb_email']}'"
						;

						$row = sql_fetch($sql);
						$goods_cnt = $row['goods_cnt'];	?>

						</br>
						<div class="mot">
						<span class='main_cowrap halvsl'><span class='main_co'><?=$newnotice?></span><a href='/estimate/partner_estimate_list.php?gubun=2'>총 견적연결&nbsp;</a></span>
						<span class='main_cowrap  halvsr'><span class='main_co'><?=$market_sell_row['cnt']?></span><a href='/market/seller/product/product_list.php'>총 마켓판매&nbsp;</a></span>
						</div>
						<span class='main_cowrap nope'><span class='main_co'><?=$goods_cnt?></span><a href='/market/seller/product/product_list.php'>총 상품&nbsp;</a></span>
						</div>
						
						<?						
						//거래지역 및 수거품목
							$sql = " select * from {$g5['member_area_table']} where mb_id = '{$member['mb_id']}' ";

							$member_area = sql_query($sql);
							?>

						</div>
						<div class='signup_txt_area nope'>
						<span class='areatitle'>내지역</span> <span class='main_co'>
						<?
							for ($i=0; $row=sql_fetch_array($member_area); $i++)
							{
								
								echo  $row['mb_area1']."&nbsp;";
								if($row['mb_area2']){
									echo $row['mb_area2']."&nbsp;&nbsp;&nbsp;";
								}else{
									echo "전체&nbsp;&nbsp;&nbsp;";
														
							}
							}
							?>

							</span>							
							</div>					
<?
						//$row['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $row['rc_nickname']);
						//		echo "<h4>" . $row['rc_nickname'] . "</h4>";
?>						
						
					</div>
					</div>
						

						</li>
						</ul>
					</div>
				</div>