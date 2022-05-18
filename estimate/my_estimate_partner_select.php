<!--추천 업체를 가저옵니다. -->
<?php
$totalCount = 0;
$rows = 0;
$totalpage = 0;
$startpage = 0;


if ($state == "1" || $state == "2") {

	$cnt = " select count(*) as cnt from {$g5['member_table']} a left join g5_estimate_request b on a.mb_email = b.rc_email and b.estimate_idx = '$idx'";
	if ($e_type == "0" || $e_type == "1") {
		$cnt .= " where mb_biz_type in ('1','3') ";
	} else {
		$cnt .= " where mb_biz_type in ('2','3') ";
	}

	$marea1 = $master['area1'];
	$marea2 = $master['area2'];
	if ($member['mb_level'] == 10) {
		$cnt .= " and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
	} else {
		$cnt .= " and a.mb_show_type = '1' and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
	}

	$cnt .= " and mb_email not in ( select rc_email from g5_estimate_propose where estimate_idx = '$idx') ";
	$cnt .= " order by mb_biz_score desc";

	$request_cnt = sql_fetch($cnt);

	$totalCount = $request_cnt['cnt'];
	$rows = 8;
	$totalpage = ceil($totalCount / $rows);

	if($page < 1){
		$page = 1;
	}
	$startpage = ($page - 1) * $rows;

	$sql = " select a.*, case when b.rc_email is not null then 'Y' else 'N' end as request_yn, b.estimate_yn from {$g5['member_table']} a left join g5_estimate_request b on a.mb_email = b.rc_email and b.estimate_idx = '$idx'";
	if ($e_type == "0" || $e_type == "1") {
		$sql .= " where mb_biz_type in ('1','3') ";
	} else {
		$sql .= " where mb_biz_type in ('2','3') ";
	}

	$sql = " select a.*, case when b.rc_email is not null then 'Y' else 'N' end as request_yn, b.estimate_yn from {$g5['member_table']} a left join g5_estimate_request b on a.mb_email = b.rc_email and b.estimate_idx = '$idx'";
	if ($e_type == "0" || $e_type == "1") {
		$sql .= " where mb_biz_type in ('1','3') ";
	} else {
		$sql .= " where mb_biz_type in ('2','3') ";
	}


	$marea1 = $master['area1'];
	$marea2 = $master['area2'];
	if ($member['mb_level'] == 10) {
		$sql .= " and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
	} else {
		$sql .= " and a.mb_show_type = '1' and mb_id in ( select mb_id from {$g5['member_area_table']} where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
	}
	$sql .= " and mb_email not in ( select rc_email from g5_estimate_propose where estimate_idx = '$idx') ";
	$sql .= " order by mb_biz_score desc limit $startpage , $rows";

	$request_list = sql_query($sql);

	for ($i = 0; $row = sql_fetch_array($request_list); $i++) {
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
					and a.rc_email = '{$row['mb_email']}'
				group by a.rc_email ";

		$score_row = sql_fetch($sql);

		$score = $score_row['score'];
		echo "<li>";
		echo "<div>";
		echo "<div class='img'><img src='/data/estimate/" . $row['mb_photo_site'] . "'><p id='partner_show' onclick='show_partner_detail(\"" . $row['mb_email'] . "\")'>업체소개</p></div>";
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
			echo "<a class='re_btn' href='javascript:doReview(\"" . $row['mb_email'] . "\",\"" . $row['mb_biz_score'] . "\")'>후기보기 <i class='xi-angle-right-min'></i></a>";
		}
		$row['mb_name'] = preg_replace('/(?<=.{1})./u', '○', $row['mb_name']);
		echo "<h4>" . $row['mb_name'] . "</h4>";
		//echo "<h5 style='text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden'>".$row['mb_biz_addr1']."</h5>";
		echo "</div>";
		echo "<div class='btn_list'>";
		echo "<ul class='row'>";


		if ($row['estimate_yn']) {
			echo "<a class='sub_bg' href='javascript:' style='background:#da1a1a !important; color:#fff;'>수거불가</a>";
		} else {
			if ($row['request_yn'] == "Y") {
				echo "<a class='sub_bg' href='javascript:'>문의중</a>";
			} else {
				echo "<a class='main_bg' href='javascript:doRequest(\"" . $idx . "\",\"" . $row['mb_email'] . "\")'>문의하기</a>";
			}
		}

		echo "</ul>";
		echo "</div>";
		echo "</div>";
		echo "</li>";
	}
}
?>