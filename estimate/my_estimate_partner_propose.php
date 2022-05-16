<!-- 견적에 대한 제안 요청한 업체를 가저옵니다. -->
<?php
	if ($centerCnt > 0) {
		if ($state == "3" || $state == "4" || $state == "5" || $state == "8") {
			// $sql = " select
			// 			a.rc_email,
			// 			round(avg(a.score),1) as score,
			// 			round(avg(a.score)/5 * 100,0) as rate,
			// 			count(*) as cnt
			// 		from
			// 			g5_estimate_propose a
			// 			join g5_estimate_list b on a.estimate_idx = b.idx
			// 		where
			// 			ifnull(a.review,'') !=  ''
			// 			and a.rc_email = '{$propose_success['rc_email']}'
			// 		group by a.rc_email ";

			// $score_row = sql_fetch($sql);

			$score = $score_row['score'];
			echo "<li>";
			echo "<div>";
			echo "<div class='img'> <img src = '/data/estimate/" . $propose_success['mb_photo_site'] . "'><p id='partner_show' onclick='show_partner_detail(\"" . $propose_success['rc_email'] . "\")'>업체소개</p></div>";
			echo "<div class='text'>";
			if ($score > 0 && $score_row['cnt'] > 0) {
				if ($score < 1) {
					echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
				} else if ($score < 2) {
					echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
				} else if ($score < 3) {
					echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
				} else if ($score < 4) {
					echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
				} else if ($score < 5) {
					echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
				} else {
					echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
				}
				echo "<a class='re_btn' href='javascript:doReview(\"" . $propose_success['rc_email'] . "\",\"" . $propose_success['score'] . "\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
			}

			$propose_success['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $propose_success['rc_nickname']);
			echo "<h4>" . $propose_success['rc_nickname'] . "</h4>";
			//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$propose_success['mb_biz_addr1']."</h5>";
			if ($propose_success['meet']) {
				echo "<div class='pay main_co'><span>방문견적</span></div>";
			} else {
				if (!$propose_success['price'] && !$propose_success['price_minus']) {
					if ($e_type == "2") {
						echo "<div class='pay main_co'><span>무료철거</span></div>";
					} else {
						echo "<div class='pay main_co'><span>무료수거</span></div>";
					}
				} else {
					if ($e_type == "2") {
						echo "<div class='pay'><span class=' ma'>견적가</span> " . number_format($propose_success['price']) . "원</div>";
					} else {
						if ($propose_success['price']) {
							echo "<div class='pay'><span class='white ma'>매입</span>" . number_format($propose_success['price']) . "원<span>보상</span></div>";
						}
						if ($propose_success['price_minus']) {
							echo "<div class='pay'><span class='white pe'>폐기</span>" . number_format($propose_success['price_minus']) . "원<span>결제</span></div>";
						}
					}
				}
			}
			echo "</div>";
			echo "<div class='btn_list'>";
			echo "<ul class='row'>";
			if ($e_type == "2") {
				echo "<a class='line_bg' href='javascript:doPriceDetail(\"" . $propose_success['idx'] . "\",\"" . $propose_success['estimate_idx'] . "\",\"" . $propose_success['rc_email'] . "\")'>상세견적</a>";
			} else {
				if ($propose_success['attach_file']) {
					echo "<a class='line_bg' href='" . G5_DATA_URL . '/estimate/' . $propose_success['attach_file'] . "'>파일확인</a>";
				}
			}


			echo "<a class='sub_bg' href='javascript:'>선택완료</a>";
			/*echo "<a class='main_bg1' href='javascript:doSelect(\"".$row['idx']."\",\"".$row['estimate_idx']."\",\"".$row['rc_nickname']."\")'>파일확인</a>";*/
			echo "</ul>";
			echo "</div>";
			echo "</div>";
			echo "</li>";
			if ($member['mb_level'] == '10') {
				for ($i = 0; $row = sql_fetch_array($propose_process); $i++) {
					// $sql = " select
					// 		a.rc_email,
					// 		round(avg(a.score),1) as score,
					// 		round(avg(a.score)/5 * 100,0) as rate,
					// 		count(*) as cnt
					// 	from
					// 		g5_estimate_propose a
					// 		join g5_estimate_list b on a.estimate_idx = b.idx
					// 	where
					// 		ifnull(a.review,'') !=  ''
					// 		and a.rc_email = '{$row['rc_email']}'
					// 	group by a.rc_email ";
						

					$score_row = sql_fetch($sql);

					$score = $score_row['score'];

					echo "<li>";
					echo "<div>";
					echo "<div class='img'> <img src = '/data/estimate/" . $row['mb_photo_site'] . "'><p id='partner_show' onclick='show_partner_detail(\"" . $row['mb_email'] . "\")'>업체소개</p></div>";
					echo "<div class='text'>";
					if ($score > 0 && $score_row['cnt'] > 0) {
						if ($score < 1) {
							echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						} else if ($score < 2) {
							echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						} else if ($score < 3) {
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						} else if ($score < 4) {
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						} else if ($score < 5) {
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
						} else {
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
						}
						echo "<a class='re_btn' href='javascript:doReview(\"" . $row['rc_email'] . "\",\"" . $row['score'] . "\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
					}
					$row['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $row['rc_nickname']);
					echo "<h4>" . $row['rc_nickname'] . "</h4>";
					//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$row['mb_biz_addr1']."</h5>";
					if ($row['meet']) {
						echo "<div class='pay main_co'><span>방문견적</span></div>";
					} else {
						if (!$row['price'] && !$row['price_minus']) {
							if ($e_type == "2") {
								echo "<div class='pay main_co'><span>무료철거</span></div>";
							} else {
								if (!$row['price_minus']) {
									echo "<div class='pay main_co'><span>무료수거</span></div>";
								}
							}
						} else {
							if ($e_type == "2") {
								echo "<div class='pay'><span class=' ma'>견적가</span> " . number_format($row['price']) . "원</div>";
							} else {
								$arUnit = array(
									'price' => $row['price'],
									'price_minus' => $row['price_minus']
								);
								array_push($price_array, $arUnit);
								if ($row['price']) {
									echo "<div class='pay'><span class='white ma'>매입</span>" . number_format($row['price']) . "원 <span>보상</span></div>";
								}
								if ($row['price_minus']) {
									echo "<div class='pay'><span class='white pe'>폐기</span>" . number_format($row['price_minus']) . "원<span>결제</span></div>";
								}
							}
						}
					}
					echo "</div>";
					echo "<div class='btn_list'>";
					echo "<ul class='row'>";
					echo "<li class='col-xs-12'>";
					if ($e_type == "2" && !$row['meet']) {
						echo "<a class='line_bg' href='javascript:doPriceDetail(\"" . $row['idx'] . "\",\"" . $row['estimate_idx'] . "\",\"" . $row['rc_email'] . "\")'>상세견적</a>";
					} else {
						if ($row['attach_file']) {
							echo "<a class='line_bg' href='" . G5_DATA_URL . '/estimate/' . $row['attach_file'] . "'>파일확인</a>";
						}
					}
					echo "</li>";
					echo "<li class='col-xs-12'>";
					if ($row['meet']) {
						echo "<a class='main_bg' href='javascript:'>방문견적</a>";
					}

					echo "</li>";
					echo "</ul>";
					echo "</div>";
					echo "</div>";
					echo "</li>";
				}
			}
		} else if ($state == "1" || $state == "2" || $state == "6") {
			for ($i = 0; $row = sql_fetch_array($propose_process); $i++) {
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
							and a.rc_email = '{$row['rc_email']}'
						group by a.rc_email ";

				$score_row = sql_fetch($sql);

				$score = $score_row['score'];

				echo "<li>";
				echo "<div>";
				echo "<div class='img'> <img src = '/data/estimate/" . $row['mb_photo_site'] . "'><p id='partner_show' onclick='show_partner_detail(\"" . $row['rc_email'] . "\")'>업체소개</p></div>";
				echo "<div class='text'>";
				if ($score > 0 && $score_row['cnt'] > 0) {
					if ($score < 1) {
						echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
					} else if ($score < 2) {
						echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
					} else if ($score < 3) {
						echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
					} else if ($score < 4) {
						echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
					} else if ($score < 5) {
						echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
					} else {
						echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
					}
					echo "<a class='re_btn' href='javascript:doReview(\"" . $row['rc_email'] . "\",\"" . $row['score'] . "\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
				}
				$row['rc_nickname'] = preg_replace('/(?<=.{1})./u', '○', $row['rc_nickname']);
				echo "<h4>" . $row['rc_nickname'] . "</h4>";
				//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$row['mb_biz_addr1']."</h5>";
				if ($row['meet']) {
					echo "<div class='pay main_co'><span>방문견적</span></div>";
				} else {
					if (!$row['price'] && !$row['price_minus']) {
						if ($e_type == "2") {
							echo "<div class='pay main_co'><span>무료철거</span></div>";
						} else {
							if (!$row['price_minus']) {
								echo "<div class='pay main_co'><span>무료수거</span></div>";
							}
						}
					} else {
						if ($e_type == "2") {
							echo "<div class='pay'><span class=' ma'>견적가</span> " . number_format($row['price']) . "원</div>";
						} else {
							$arUnit = array(
								'price' => $row['price'],
								'price_minus' => $row['price_minus']
							);
							//array_push($price_array, $arUnit);
							if ($row['price']) {
								echo "<div class='pay'><span class='white ma'>매입</span>" . number_format($row['price']) . "원<span>보상</span></div>";
							}
							if ($row['price_minus']) {
								echo "<div class='pay'><span class='white pe'>폐기</span>" . number_format($row['price_minus']) . "원<span>결제</span></div>";
							}
						}
					}
				}
				echo "</div>";
				echo "<div class='btn_list'>";
				echo "<ul class='row'>";
				echo "<li class='col-xs-12'>";
				if ($e_type == "2" && !$row['meet']) {
					echo "<a class='line_bg' href='javascript:doPriceDetail(\"" . $row['idx'] . "\",\"" . $row['estimate_idx'] . "\",\"" . $row['rc_email'] . "\")'>상세견적</a>";
				} else {
					if ($row['attach_file']) {
						echo "<a class='line_bg' href='" . G5_DATA_URL . '/estimate/' . $row['attach_file'] . "'>파일확인</a>";
					}
				}
				echo "</li>";
				echo "<li class='col-xs-12'>";
				if ($row['meet']) {
					echo "<a class='main_bg' href='javascript:'>방문견적</a>";
				} else {
					if ($row['price'] > 0 && $e_type != '2') {
						echo "<a class='main_bg' href='javascript:doSelect(\"" . $row['idx'] . "\",\"" . $row['estimate_idx'] . "\",\"" . $row['rc_nickname'] . "\")'>업체선택</a>";
					} else {
						echo "<a class='main_bg' href='javascript:doSelect_normal(\"" . $row['idx'] . "\",\"" . $row['estimate_idx'] . "\",\"" . $row['rc_nickname'] . "\")'>업체선택</a>";
					}
				}
				echo "</li>";
				echo "</ul>";
				echo "</div>";
				echo "</div>";
				echo "</li>";
			}
		}
	} else {
		echo '<p style="text-align: center; margin-bottom: 5px;">업체 견적이 들어오지 않았습니다.</p>';
	}

?>