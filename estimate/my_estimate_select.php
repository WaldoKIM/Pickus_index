<?php
class MyEstimateSelect{

	public $member;
	public $idx;

	function __construct($member,$idx){
		$this->member=$member;
		$this->idx=$idx;
	}

	//견젹 제안 내역 가져오기
	public function myEstimateSelect(){
		$sql = " select
			a.idx,
			ifnull(c.idx,0) as sub_idx,
			a.sub_key,
			a.email,
			a.nickname,
			a.title,
			concat('<p>',replace(a.content,'\n','</p><p>'),'</p>') as content,
			a.phone,
			a.item_cat,
			a.item_cat_dtl,
			a.manufacturer,
			a.floor,
			a.elevator_yn,
			a.pickup_date as pickup_date,
			a.medel_name,
			a.year,
			a.use_year,
			a.goods_state,
			a.item_qty,
			a.area_total,
			a.area1,
			a.area2,
			a.area3,
			a.photo1,
			a.photo2,
			a.photo3,
			a.photo4,
			a.photo5,
			a.photo6,
			a.photo7,
			a.photo8,
			a.photo9,
			a.photo1_rotate,
			a.photo2_rotate,
			a.photo3_rotate,
			a.photo4_rotate,
			a.photo5_rotate,
			a.photo6_rotate,
			a.photo7_rotate,
			a.photo8_rotate,
			a.photo9_rotate,
			a.attach_file,
			a.state,
			a.e_type,
			a.simple_yn,
			a.writetime,
			a.deadline as deadline,
			a.pull_kind,
			a.pull_kind_etc,
			a.pull_floor_bottom,
			a.test_type,
			b.price_qty,
			case when a.e_type = '0' then b.min_price_pe end as price_pe,
			case when a.e_type = '1' then b.max_price_cha end as max_price_cha,
			case when a.e_type = '2' then b.min_price else b.max_price end as price,
			ifnull(c.review,'') as review,
			case when trim(ifnull(c.review,'')) = '' then '0' else '1' end as review_yn,
			ifnull(c.selected,'0') as selected,
			date_format(ifnull(c.requesttime, ''), '%Y-%m-%d') as requesttime,
			date_format(ifnull(c.completetime, ''), '%Y-%m-%d') as completetime
		from
			g5_estimate_list a
			left join (
				select
						estimate_idx,
						count(*) as price_qty,
						max(price) as max_price,
						max(price_cha) as max_price_cha,
						min(price) as min_price,
						min(price_minus) as min_price_pe
				from
					g5_estimate_propose
				where
					estimate_idx =  '{$this->idx}'
					and meet = '0'
					and NOT selected = '2'
				group by estimate_idx
			) b on a.idx = b.estimate_idx
			left join g5_estimate_propose c on a.idx = c.estimate_idx and c.selected = '1'
			left join (
				select estimate_idx, count(*) as cnt from g5_estimate_propose group by estimate_idx
			) d on a.idx = d.estimate_idx
		where
			a.idx =  '{$this->idx}'";
			$master = sql_fetch($sql);

			return $master;
	}

	public function daryangChk(){
		$sql = "select * from g5_estimate_propose where price_cha = '{$this->master['max_price_cha']}' and estimate_idx = '{$this->idx}' ";
		$daryang_chk = sql_fetch($sql);

		return $daryang_chk;
	}

	//다중견적 물품 갯수 가져오기
	public function detailCnt(){
		$sql = " select count(*) as cnt from g5_estimate_list_multi where sub_key = '{$this->master['sub_key']}'  ";
		$detail_cnt = sql_fetch($sql);
		$detailCnt = $detail_cnt['cnt'];

		return $detailCnt;
	}

	//다중견적 물품 리스트 가져오기
	public function estimateMultiList(){
		if ($this->$master['sub_key'] != '0') {
			$detailCnt = $this->detailCnt();
			$sql = " select * from g5_stimate_list_multi where sub_key = '{$this->$master['sub_key']}'  ";
			if ($detail_cnt['cnt'] == 1 && $this->$master['e_type'] == "2") {
				$detail = sql_fetch($sql);
			} else {
				$detail = sql_query($sql);
			}
			return $detail;
		}
	}

	//선택된 견적과 업체의 정보를 가져옵니다.
	public function proposeSuccess(){
		$sql = "select
				a.idx,
				a.estimate_idx,
				a.rc_email,
				a.rc_nickname,
				a.email,
				a.nickname,
				a.price,
				a.price_minus,
				a.charge_rate,
				a.charge_amt,
				a.remain_amt,
				a.meet,
				a.selected,
				a.proposetime,
				a.free,
				b.mb_biz_addr1,
				b.mb_biz_score,
				b.mb_photo_site,
				b.mb_hp,
				a.attach_file
			from
				g5_estimate_propose a
				join g5_member_table b on a.rc_email = b.mb_email
			where
				a.estimate_idx = '{$this->$idx}'
				and a.selected = '1'
			order by a.selected desc, a.price desc, a.idx desc ";
			$propose_success = sql_fetch($sql);
	
		return $propose_success;
	}

	//선택되지 않은 업체의 정보를 가져옵니다. 
	public function proposeProcess(){
		
		$sql = "select
			a.idx,
			a.estimate_idx,
			a.rc_email,
			a.rc_nickname,
			a.email,
			a.nickname,
			a.price,
			a.price_minus,
			a.charge_rate,
			a.charge_amt,
			a.remain_amt,
			a.meet,
			a.selected,
			a.proposetime,
			b.mb_biz_addr1,
			b.mb_biz_score,
			b.mb_photo_site,
			a.free,
			a.attach_file
		from
			g5_estimate_propose a
			join g5_member_table b on a.rc_email = b.mb_email
		where
			a.estimate_idx = '{$this->$idx}'
			and a.selected = '0'
		order by a.selected desc, a.price desc, a.idx desc ";
		$propose_process = sql_query($sql);
	
		return $propose_process;
	}

	//선택되지 않은 업체의 정보를 가져옵니다. 
	public function proposeProcessFetch(){
		
		$sql = "select
		a.idx,
		a.estimate_idx,
		a.rc_email,
		a.rc_nickname,
		a.email,
		a.nickname,
		a.price,
		a.price_minus,
		a.charge_rate,
		a.charge_amt,
		a.remain_amt,
		a.meet,
		a.selected,
		a.proposetime,
		b.mb_biz_addr1,
		b.mb_biz_score,
		b.mb_photo_site,
		a.attach_file,
		a.free
	from
		g5_estimate_propose a
		join g5_member_table b on a.rc_email = b.mb_email
	where
		a.estimate_idx = '{$this->idx}'
		and a.selected = '0'
	order by a.selected desc, a.price desc, a.idx desc ";
	$propose_process_fetch = sql_fetch($sql);
	
		return $propose_process_fetch;
	}

	//제안서의 해당하는 물품의 후기를 가져옵니다.
	public function proposeReview(){
		
		$sql = "select
				a.idx,
				a.photo1,
				b.photo1_rotate,
				b.e_type,
				b.item_cat,
				concat(substr(a.nickname,1,1),'**') AS nickname,
				b.area1,
				b.area2,
				a.score,
				b.goods_state,
				case when length(b.title) <= 20 then b.title else concat(substr(b.title,1,10),'...') end as title,
				a.review,
				date_format(a.proposetime,'%y.%m.%d') as completetime,
				case when ifnull(a.review,'') !=  ''  then 'Y' else 'N' end as review_yn,
				a.attach_file
			from
				g5_estimate_propose a
				join g5_estimate_list b on a.estimate_idx = b.idx
			where
				a.estimate_idx = '{$this->idx}'
				and ifnull(a.review,'') !=  '' ";

				$propose_review = sql_fetch($sql);
	
		return $propose_review;
	}

	//내 견적에 대한 알림 읽음 처리합니다.
	public function notifyUpdate(){
		
		$sql = "update g5_notify set read_gb = 1 where email = '{$this->member['mb_email']}' AND estimate_idx = '{$this->idx}' ";
		sql_query($sql);
	}

	//수거취소하지 않은 견적을 가져옵니다.
	public function centerCnt(){
		
		$sql = " select count(*) as cnt from g5_estimate_propose where estimate_idx = '{$this->$idx}' AND NOT selected = 2";
		$propose_cnt = sql_fetch($sql);
		$centerCnt = $propose_cnt['cnt'];

		return $centerCnt;
	}

	//나의 결제정보를 가져옵니다.
	public function cliInfo(){
		
		$$sql = "select * from g5_member a
		left join g5_estimate_list b on a.mb_email = b.email where a.mb_email = '{$this->$master['email']}'";
		$cli_info = sql_fetch($sql);

		return $cli_info;
	}

	//나의 견적 이미지를 가져옵니다.
	public function photoInfo(){
		
		$sql = " select * from g5_estimate_list_photo where estimate_idx = '{$this->idx}' ";
		$photo = sql_query($sql);

		return $photo;
	}

	//나의 견적 이미지 개수를 가져옵니다.
	public function photoCount(){
		
		$sqlx = " select count(*) as cnt from g5_estimate_list_photo where estimate_idx = '{$this->idx}' ";

		$fet_noti_choice = sql_fetch($sqlx);
		$cxc = $fet_noti_choice['cnt'];

		return $cxc;
	}	

	//추천 업체를 가져옵니다.
	public function partnerList($e_type,$master, $state, $page){
		
		$totalCount = 0;
		$rows = 0;
		$totalpage = 0;
		$startpage = 0;

		if ($state == "1" || $state == "2") {

			$cnt = " select count(*) as cnt from g5_member a left join g5_estimate_request b on a.mb_email = b.rc_email and b.estimate_idx = '{$this->$idx}'";
			if ($e_type == "0" || $e_type == "1") {
				$cnt .= " where mb_biz_type in ('1','3') ";
			} else {
				$cnt .= " where mb_biz_type in ('2','3') ";
			}

			$marea1 = $master['area1'];
			$marea2 = $master['area2'];
			if ($this->$member['mb_level'] == 10) {
				$cnt .= " and mb_id in ( select mb_id from g5_member_area where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
			} else {
				$cnt .= " and a.mb_show_type = '1' and mb_id in ( select mb_id from g5_member_area where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
			}

			$cnt .= " and mb_email not in ( select rc_email from g5_estimate_propose where estimate_idx = '{$this->$idx}') ";
			$cnt .= " order by mb_biz_score desc";

			$request_cnt = sql_fetch($cnt);

			$totalCount = $request_cnt['cnt'];
			$rows = 8;
			$totalpage = ceil($totalCount / $rows);

			if($page < 1){
				$page = 1;
			}
			$startpage = ($page - 1) * $rows;

			$sql = " select a.*, case when b.rc_email is not null then 'Y' else 'N' end as request_yn, b.estimate_yn from g5_member a left join g5_estimate_request b on a.mb_email = b.rc_email and b.estimate_idx = '{$this->$idx}'";
			if ($e_type == "0" || $e_type == "1") {
				$sql .= " where mb_biz_type in ('1','3') ";
			} else {
				$sql .= " where mb_biz_type in ('2','3') ";
			}

			$sql = " select a.*, case when b.rc_email is not null then 'Y' else 'N' end as request_yn, b.estimate_yn from g5_member a left join g5_estimate_request b on a.mb_email = b.rc_email and b.estimate_idx = '{$this->$idx}'";
			if ($e_type == "0" || $e_type == "1") {
				$sql .= " where mb_biz_type in ('1','3') ";
			} else {
				$sql .= " where mb_biz_type in ('2','3') ";
			}


			$marea1 = $master['area1'];
			$marea2 = $master['area2'];
			if ($this->$member['mb_level'] == 10) {
				$sql .= " and mb_id in ( select mb_id from g5_member_area where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
			} else {
				$sql .= " and a.mb_show_type = '1' and mb_id in ( select mb_id from g5_member_area where 1=1 and ( ( mb_area1 = '$marea1' and ifnull(mb_area2,'') = '' ) or ( mb_area1 = '$marea1' and mb_area2 = '$marea2'))) ";
			}
			$sql .= " and mb_email not in ( select rc_email from g5_estimate_propose where estimate_idx = '{$this->$idx}') ";
			$sql .= " order by mb_biz_score desc limit $startpage , $rows";

			echo $sql;

			$request_list = sql_query($sql);

			$request["page"] = $page;
			$request["totalpage"] = $totalpage;
			$request["state"] = $state;
			$request["master"] = $this->$master;
			$request["idx"] = $idx;
			$request["request_list"] = $request_list;

			
		}	
		return $request;
		
	}
	//내견적에 제안한 업체의 정보(제안 선택된 업체)를 가져옵니다.
	public function partnerSelectList($propose_success){
		
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
				and a.rc_email = '{$propose_success['rc_email']}'
			group by a.rc_email ";

			echo $sql;
			$score_row = sql_fetch($sql);

		return $score_row;
	}
	
	//내견적에 제안한 업체의 정보(제안 선택되지 않은 업체)를 가져옵니다.
	public function partnerNoSelect($row){

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

		return $score_row;
	}	

	//견적의 참고사항 개수를 가
	public function getContentCount(){

		$sql = " select count(*) as cnt from g5_estimate_propose where estimate_idx = '{$this->$idx}' and ifnull(content,'') != '' ";
		$request_cnt = sql_fetch($sql);
		return $request_cnt;
	}	

	//견적의 참고사항을 가져옵니다.
	public function getContent(){

		$sql = " select count(*) as cnt from g5_estimate_propose where estimate_idx = '{$this->$idx}' and ifnull(content,'') != '' ";
		$request_list = sql_fetch($sql);
		return $request_list;
	}	

	//견적에 대한 후기의 이미지를 가져옵니다.
	public function getReviewPhoto(){

		$sql1 = " select * from g5_estimate_list_photo where estimate_idx = '{$this->$idx}' order by idx limit 1 ";
		$photo = sql_fetch($sql1);
		return $photo;
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

