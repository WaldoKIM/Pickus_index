<?php
class MyEstimateList{

	public $member;

	function __construct($member){
		$this->member=$member;
	}

	//내 견적 리스트의 총 갯수를 가져옵니다.
	public function myEstimateListTotalCnt(){

		$sql_common = " from
			g5_estimate_list a
			left join g5_estimate_propose b on a.idx = b.estimate_idx and b.selected = '1'
			left join (
				select estimate_idx, count(*) as cnt from g5_estimate_propose group by estimate_idx
			) c on a.idx = c.estimate_idx 
			where a.email = '{$this->member['mb_email']}' ";

			$sql = " select count(*) as cnt " . $sql_common;
			$row = sql_fetch($sql);
			$total_count = $row['cnt'];
			return $total_count;
	}

	//나의 견적 리스트를 가져옵니다.
	public function myEstimateList($from_record, $rows){

		$sql  = "select
			a.idx,
			b.idx as sub_idx,
			a.title,
			a.area1,
			a.area2,
			a.area3,
			a.state,
			a.photo1,
			a.e_type,
			a.deadline,
			date_format(a.writetime, '%Y.%m.%d') as writetime,
			case when a.selecttime is null then '-' else date_format(a.selecttime, '%Y-%m-%d') end as selecttime,
			case when b.completetime is null then '-' else date_format(b.completetime, '%Y-%m-%d') end as completetime,
			case when trim(ifnull(b.review,'')) = '' then '0' else '1' end as review_yn,
			a.simple_yn
			from g5_estimate_list a
			left join g5_estimate_propose b on a.idx = b.estimate_idx and b.selected = '1'
			left join (
				select estimate_idx, count(*) as cnt from g5_estimate_propose group by estimate_idx
			) c on a.idx = c.estimate_idx 
			where a.email = '{$this->member['mb_email']}'
           order by a.idx desc	
           limit $from_record, $rows ";

			//echo $sql;
			//echo '\n';

			$result = sql_query($sql);
			$result_fetch = sql_fetch($sql);
			//echo $result['title'];

			//var_dump(array($result));

			return $result;
	}
}

?>