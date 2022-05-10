<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/estimate/_common.php');


$g5['title'] = '견적신청';
include_once($_SERVER['DOCUMENT_ROOT'].'/estimate/_head.php');

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
					estimate_idx =  '$idx'
					and meet = '0'
					and NOT selected = '2'
				group by estimate_idx
			) b on a.idx = b.estimate_idx
			left join g5_estimate_propose c on a.idx = c.estimate_idx and c.selected = '1'
			left join (
				select estimate_idx, count(*) as cnt from g5_estimate_propose group by estimate_idx
			) d on a.idx = d.estimate_idx
		where
			a.idx =  '$idx'	 ";
$master = sql_fetch($sql);

$sql = "select * from g5_estimate_propose where price_cha = '{$master['max_price_cha']}' and estimate_idx = '$idx' ";
$daryang_chk = sql_fetch($sql);

if(count($master) == 0){
	$url = G5_URL."/estimate/my_estimate_form_match_sa.php?idx=".$estimate_idx ;
}

if ($master['sub_key'] != '0') {
	$sql = " select count(*) as cnt from g5_estimate_list_multi where sub_key = '{$master['sub_key']}'  ";
	$detail_cnt = sql_fetch($sql);
	$detailCnt = $detail_cnt['cnt'];
	$sql = " select * from g5_stimate_list_multi where sub_key = '{$master['sub_key']}'  ";
	if ($detail_cnt['cnt'] == 1 && $master['e_type'] == "2") {
		$detail = sql_fetch($sql);
	} else {
		$detail = sql_query($sql);
	}
}

$sql = " 		select
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
					join {$g5['member_table']} b on a.rc_email = b.mb_email
				where
					a.estimate_idx = '$idx'
					and a.selected = '1'
				order by a.selected desc, a.price desc, a.idx desc ";
$propose_success = sql_fetch($sql);

$sql = " 		select
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
					join {$g5['member_table']} b on a.rc_email = b.mb_email
				where
					a.estimate_idx = '$idx'
					and a.selected = '0'
				order by a.selected desc, a.price desc, a.idx desc ";
$propose_process = sql_query($sql);


$sql = " 		select
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
					join {$g5['member_table']} b on a.rc_email = b.mb_email
				where
					a.estimate_idx = '$idx'
					and a.selected = '0'
				order by a.selected desc, a.price desc, a.idx desc ";
$propose_process_fetch = sql_fetch($sql);

$sql = " 		select
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
					a.estimate_idx = '$idx'
					and ifnull(a.review,'') !=  '' ";

$propose_review = sql_fetch($sql);
$sql = "update g5_notify set read_gb = 1 where email = '{$member['mb_email']}' AND estimate_idx = '$idx' ";

sql_query($sql);
$sql = " select count(*) as cnt from g5_estimate_propose where estimate_idx = '$idx' AND NOT selected = 2";
$propose_cnt = sql_fetch($sql);
$centerCnt = $propose_cnt['cnt'];

$sql = " select
			a.idx,
			ifnull(b.idx,0) as sub_idx,
			a.sub_key,
			a.email,
			a.nickname,
			concat(substr(a.nickname,1,1),'**') as nickname1,
			a.title,
			concat('<p>',replace(a.content,'\n','</p><p>'),'</p>') as content,
			case when ifnull(a.phone,'') = '' then '-' else a.phone end as phone,
			a.item_cat,
			a.item_cat_dtl,
			a.manufacturer,
			a.floor,
			a.elevator_yn,
			a.pickup_date,
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
			a.state,
			a.e_type,
			a.simple_yn,
			a.writetime,
			a.deadline,
			a.pull_kind,
			a.pull_kind_etc,
			a.pull_floor_bottom,
			a.test_type,
			b.price,
			b.price_minus,
			b.charge_rate,
			b.charge_amt,
			b.remain_amt,
			a.attach_file,
			b.attach_file as attach_file1,
			ifnull(b.selected,'0') as selected,
			b.meet,
			b.meet_confirm,
			b.free,
			date_format(ifnull(b.requesttime, ''), '%Y-%m-%d') as requesttime,
			date_format(ifnull(b.completetime,''), '%Y-%m-%d') as completetime,
			date_format(now(),'%Y-%m-%d') as completedate,
			d.*
		from
			g5_estimate_list a
			left join g5_estimate_propose b  on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}'
			left join g5_estimate_propose_detail c on a.idx = c.estimate_idx and c.rc_email = '{$member['mb_email']}'
			left join (
				select estimate_idx, count(*) as cnt from g5_estimate_propose group by estimate_idx
			) d on a.idx = d.estimate_idx

		where
			a.idx =  '$idx'	 ";
$master2 = sql_fetch($sql);

$sql = "select * from g5_member a
		left join g5_estimate_list b on a.mb_email = b.email where a.mb_email = '{$master2['email']}'";
$cli_info = sql_fetch($sql);

if ($master['state'] == "7" && $member['mb_level'] > 9) {
	alert("취소된 견적입니다.");
}

$price = 0;
$price_minus = 0;
if ($propose_success) {
	$price = $propose_success['price'];
	$price_minus = $propose_success['price_minus'];
}

?>

