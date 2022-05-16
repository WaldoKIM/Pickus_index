<?php
class MyEstimateMatchSelect{

	//회원정보 가져오기
	public function getMember($email){
		$sql = " select * from g5_member_table where mb_email = '$email' ";
		$mm = sql_fetch($sql);

		return $mm;
	}

	//중고구매 물품 정보 가져오기
	public function getEstmateMatch($no_estimate){
		$sql = "select * from g5_estimate_match
			where
				no_estimate =  '$no_estimate'";

		$master = sql_fetch($sql);

		return $master;
	}

	//중고구매 주문정보 가져오기
	public function getShopOrder($no_estimate){
		$sql = " select
			*
		from
			g5_shop_order
		where
			od_id = '$no_estimate'";
			$shop = sql_fetch($sql);
		
		return $shop;
	}

	//중고구매 정보 가져오기
	public function getMatchInfo($no_estimate){
		
		$sql = " select *
				from
					g5_estimate_match_info
				where
					no_estimate = '$no_estimate'";
			$info = sql_query($sql);

		return $info;
	}

	//견적에 해당하는 중고구매 견적을 가져옵니다.
	public function getCenterCnt($no_estimate){ 
		$sql = " select count(*) as cnt from g5_estimate_match_propose where no_estimate = '$no_estimate' ";
		$propose_cnt = sql_fetch($sql);
		$centerCnt = $propose_cnt['cnt'];
	
		return $centerCnt;
	}

	//선택되지 않은 제안을 가져옵니다. 
	public function getProposeProcess($no_estimate){
		
		$sql = "select
					a.*,b.*,c.*
				from
					g5_estimate_match_propose a
					join g5_member_table b on a.rc_email = b.mb_email
					join g5_estimate_match_propose_detail c on c.no_estimate = a.no_estimate AND c.rc_email = a.rc_email AND a.selected = 0
				where
					a.no_estimate = '$no_estimate'";
		$propose_process = sql_query($sql);
	
		return $propose_process;
	}

	//선택된 견적의 정보를 가져옵니다. 
	public function getProposeSelect($no_estimate){
		
		$sql = "select
					*
				from
					g5_estimate_match_propose a
					join g5_member_table b on a.rc_email = b.mb_email
					join g5_estimate_match_propose_detail c on c.no_estimate = a.no_estimate AND c.rc_email = a.rc_email
				where
					a.no_estimate = '$no_estimate'
					and a.selected = '1'";

				$propose_select = sql_fetch($sql);
	
		return $propose_select;
	}

	//중고구매 물품의 후기를 가져옵니다.
	public function getProposeReview($no_estimate){
		
		$sql = "select
					*
				from
					g5_estimate_match_propose a
					join g5_estimate_match b on a.no_estimate = b.no_estimate
				where
					a.no_estimate = '$no_estimate'
					and ifnull(a.review,'') !=  '' ";

		$propose_review = sql_fetch($sql);
	
		return $propose_review;
	}

	//중고구매 견적제안의 상세정보를 가져옵니다.
	public function getProposeDetail($no_estimate){
		
		$sql_info = "select * 
			from
				g5_estimate_match_propose_detail a
				join g5_member_table b on a.rc_email = b.mb_email
			where a.no_estimate = '$no_estimate'";

		$propose_detail = sql_fetch($sql_info);

		return $propose_Detail; 
	}

	//견적제안을 선택한 업체의 평점을 가져옵니다.
	public function getSuccScoreRow($propose_success){
		
		$sql = " select
				a.*,
				round(avg(a.score),1) as score,
				round(avg(a.score)/5 * 100,0) as rate,
				count(*) as cnt
			from
				g5_estimate_match_propose a
				join g5_estimate_match b on a.no_estimate = b.no_estimate
			where
				ifnull(a.review,'') !=  ''
				and a.rc_email = '{$propose_success['rc_email']}'
			group by a.rc_email ";

		$score_row = sql_fetch($sql);

		return $score_row;
	}

	//견적제안한 업체의 평점을 가져옵니다.
	public function getScoreRow($row){
		
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
			and a.rc_email = '{$row['rc_email']}'
		group by a.rc_email ";

		$score_row = sql_fetch($sql);

		return $photo;
	}

	//중고구매 추천 업체를 가져옵니다.
	public function getPartnerList($no_estimate,$master, $page){
		
		$cnt = " select count(*) as cnt from g5_member_table a left join g5_estimate_request_match b on a.mb_email = b.rc_email and b.no_estimate = '$no_estimate ' ";
		$cnt .= "where mb_show_type = 1 and mb_match = 1 and mb_id in ( select mb_id from g5_member_area_table where 1=1 and ( ( mb_area1 = '$area1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$area1' and mb_area2 = '$area2'))) ";
		$cnt .= " and mb_email not in ( select rc_email from g5_estimate_match_propose where no_estimate = '$no_estimate ') ";
		$cnt .= " order by mb_biz_score desc";

		$sql = " select a.*, case when b.rc_email is not null then 'Y' else 'N' end as request_yn, b.estimate_yn from g5_member_table a left join g5_estimate_request_match b on a.mb_email = b.rc_email and b.no_estimate = '$no_estimate ' ";

		$request_cnt = sql_fetch($cnt);

		$totalCount = $request_cnt['cnt'];
		$rows = 8;
		$totalpage = ceil($totalCount / $rows);

		if($page < 1){
			$page = 1;
		}
		$startpage = ($page - 1) * $rows;

		$area1 = $master['area1'];
		$area2 = $master['area2'];
		$sql .= "where mb_show_type = 1 and mb_match = 1 and mb_id in ( select mb_id from g5_member_area_table where 1=1 and ( ( mb_area1 = '$area1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$area1' and mb_area2 = '$area2'))) ";
		$sql .= " and mb_email not in ( select rc_email from g5_estimate_match_propose where no_estimate = '$no_estimate ') ";
		$sql .= " order by mb_biz_score desc";

		$request_list = sql_query($sql);

			$request["page"] = $page;
			$request["totalpage"] = $totalpage;
			$request["state"] = $state;
			$request["master"] = $master;
			$request["no_estimate"] = $no_estimate;
			$request["request_list"] = $request_list;
	
		return $request;
	}	

	//견적의 참고사항의 갯수을 가져옵니다.
	public function getContentCount($no_estimate){
		
		$sql = " select count(*) as cnt from g5_estimate_match_propose where no_estimate = '$no_estimate' and ifnull(content,'') != '' ";

		$request_cnt = sql_fetch($sql);

		return $request_cnt;
	}

	//견적의 참고사항을 가져옵니다.
	public function getContent($no_estimate){
		
		$sql = " select * from g5_estimate_match_propose where no_estimate = '$no_estimate ' and ifnull(content,'') != '' ";
		$request_list = sql_query($sql);

		return $request_list;
	}


	

}
		
		
	
	



// if ($master['sub_key'] != '0') {
// 	$sql = " select count(*) as cnt from g5_estimate_list_multi where sub_key = '{$master['sub_key']}'  ";
// 	$detail_cnt = sql_fetch($sql);
// 	$detailCnt = $detail_cnt['cnt'];
// 	$sql = " select * from g5_stimate_list_multi where sub_key = '{$master['sub_key']}'  ";
// 	if ($detail_cnt['cnt'] == 1 && $master['e_type'] == "2") {
// 		$detail = sql_fetch($sql);
// 	} else {
// 		$detail = sql_query($sql);
// 	}
// }

//선택된 견적 가져오기
// $sql = "select
// 		a.idx,
// 		a.estimate_idx,
// 		a.rc_email,
// 		a.rc_nickname,
// 		a.email,
// 		a.nickname,
// 		a.price,
// 		a.price_minus,
// 		a.charge_rate,
// 		a.charge_amt,
// 		a.remain_amt,
// 		a.meet,
// 		a.selected,
// 		a.proposetime,
// 		a.free,
// 		b.mb_biz_addr1,
// 		b.mb_biz_score,
// 		b.mb_photo_site,
// 		b.mb_hp,
// 		a.attach_file
// 	from
// 		g5_estimate_propose a
// 		join {$g5['member_table']} b on a.rc_email = b.mb_email
// 	where
// 		a.estimate_idx = '$idx'
// 		and a.selected = '1'
// 	order by a.selected desc, a.price desc, a.idx desc ";
// $propose_success = sql_fetch($sql);

// $sql = " 		select
// 		a.idx,
// 		a.estimate_idx,
// 		a.rc_email,
// 		a.rc_nickname,
// 		a.email,
// 		a.nickname,
// 		a.price,
// 		a.price_minus,
// 		a.charge_rate,
// 		a.charge_amt,
// 		a.remain_amt,
// 		a.meet,
// 		a.selected,
// 		a.proposetime,
// 		b.mb_biz_addr1,
// 		b.mb_biz_score,
// 		b.mb_photo_site,
// 		a.free,
// 		a.attach_file
// 	from
// 		g5_estimate_propose a
// 		join {$g5['member_table']} b on a.rc_email = b.mb_email
// 	where
// 		a.estimate_idx = '$idx'
// 		and a.selected = '0'
// 	order by a.selected desc, a.price desc, a.idx desc ";
// $propose_process = sql_query($sql);

//선택되지 않은 견적 가져오기
// $sql = "select
// 		a.idx,
// 		a.estimate_idx,
// 		a.rc_email,
// 		a.rc_nickname,
// 		a.email,
// 		a.nickname,
// 		a.price,
// 		a.price_minus,
// 		a.charge_rate,
// 		a.charge_amt,
// 		a.remain_amt,
// 		a.meet,
// 		a.selected,
// 		a.proposetime,
// 		b.mb_biz_addr1,
// 		b.mb_biz_score,
// 		b.mb_photo_site,
// 		a.attach_file,
// 		a.free
// 	from
// 		g5_estimate_propose a
// 		join {$g5['member_table']} b on a.rc_email = b.mb_email
// 	where
// 		a.estimate_idx = '$idx'
// 		and a.selected = '0'
// 	order by a.selected desc, a.price desc, a.idx desc ";
// $propose_process_fetch = sql_fetch($sql);


// $sql = "select
// 		a.idx,
// 		a.photo1,
// 		b.photo1_rotate,
// 		b.e_type,
// 		b.item_cat,
// 		concat(substr(a.nickname,1,1),'**') AS nickname,
// 		b.area1,
// 		b.area2,
// 		a.score,
// 		b.goods_state,
// 		case when length(b.title) <= 20 then b.title else concat(substr(b.title,1,10),'...') end as title,
// 		a.review,
// 		date_format(a.proposetime,'%y.%m.%d') as completetime,
// 		case when ifnull(a.review,'') !=  ''  then 'Y' else 'N' end as review_yn,
// 		a.attach_file
// 	from
// 		g5_estimate_propose a
// 		join g5_estimate_list b on a.estimate_idx = b.idx
// 	where
// 		a.estimate_idx = '$idx'
// 		and ifnull(a.review,'') !=  '' ";

// $propose_review = sql_fetch($sql);
// $sql = "update g5_notify set read_gb = 1 where email = '{$member['mb_email']}' AND estimate_idx = '$idx' ";
//sql_query($sql);


// $sql = " select count(*) as cnt from g5_estimate_propose where estimate_idx = '$idx' AND NOT selected = 2";
// $propose_cnt = sql_fetch($sql);
// $centerCnt = $propose_cnt['cnt'];

// $sql = " select
// 			a.idx,
// 			ifnull(b.idx,0) as sub_idx,
// 			a.sub_key,
// 			a.email,
// 			a.nickname,
// 			concat(substr(a.nickname,1,1),'**') as nickname1,
// 			a.title,
// 			concat('<p>',replace(a.content,'\n','</p><p>'),'</p>') as content,
// 			case when ifnull(a.phone,'') = '' then '-' else a.phone end as phone,
// 			a.item_cat,
// 			a.item_cat_dtl,
// 			a.manufacturer,
// 			a.floor,
// 			a.elevator_yn,
// 			a.pickup_date,
// 			a.medel_name,
// 			a.year,
// 			a.use_year,
// 			a.goods_state,
// 			a.item_qty,
// 			a.area_total,
// 			a.area1,
// 			a.area2,
// 			a.area3,
// 			a.photo1,
// 			a.photo2,
// 			a.photo3,
// 			a.photo4,
// 			a.photo5,
// 			a.photo6,
// 			a.photo7,
// 			a.photo8,
// 			a.photo9,
// 			a.photo1_rotate,
// 			a.photo2_rotate,
// 			a.photo3_rotate,
// 			a.photo4_rotate,
// 			a.photo5_rotate,
// 			a.photo6_rotate,
// 			a.photo7_rotate,
// 			a.photo8_rotate,
// 			a.photo9_rotate,
// 			a.state,
// 			a.e_type,
// 			a.simple_yn,
// 			a.writetime,
// 			a.deadline,
// 			a.pull_kind,
// 			a.pull_kind_etc,
// 			a.pull_floor_bottom,
// 			a.test_type,
// 			b.price,
// 			b.price_minus,
// 			b.charge_rate,
// 			b.charge_amt,
// 			b.remain_amt,
// 			a.attach_file,
// 			b.attach_file as attach_file1,
// 			ifnull(b.selected,'0') as selected,
// 			b.meet,
// 			b.meet_confirm,
// 			b.free,
// 			date_format(ifnull(b.requesttime, ''), '%Y-%m-%d') as requesttime,
// 			date_format(ifnull(b.completetime,''), '%Y-%m-%d') as completetime,
// 			date_format(now(),'%Y-%m-%d') as completedate,
// 			d.*
// 		from
// 			g5_estimate_list a
// 			left join g5_estimate_propose b  on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}'
// 			left join g5_estimate_propose_detail c on a.idx = c.estimate_idx and c.rc_email = '{$member['mb_email']}'
// 			left join (
// 				select estimate_idx, count(*) as cnt from g5_estimate_propose group by estimate_idx
// 			) d on a.idx = d.estimate_idx

// 		where
// 			a.idx =  '$idx'	 ";
// 		$master2 = sql_fetch($sql);

		// $sql = "select * from g5_member a
		// 		left join g5_estimate_list b on a.mb_email = b.email where a.mb_email = '{$master2['email']}'";
		// $cli_info = sql_fetch($sql);

		
		
		//견적에 대한 사진을 가져옵니다.
		// $sql = " select * from g5_estimate_list_photo where estimate_idx = '$idx' ";
		// $sqlx = " select count(*) as cnt from g5_estimate_list_photo where estimate_idx = '$idx' ";

		// $photo = sql_query($sql);
		// $fet_noti_choice = sql_fetch($sqlx);
		// $cxc = $fet_noti_choice['cnt'];

		// $sql = " select * from g5_estimate_list_photo where estimate_idx = '$idx' ";
		// $photo = sql_query($sql);

?>

