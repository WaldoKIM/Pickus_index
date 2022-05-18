<?php
class MyEstimateMatch{

	public $member;

	function __construct($member){
		$this->member=$member;
	}

	//내 구매매칭 견적 리스트의 총 갯수를 가져옵니다.
	public function myEstimateMatchTotalCnt(){

		$sql_common = " from
		g5_estimate_match a
		where a.email = '{$this->member['mb_email']}' ";

		$sql = " select count(*) as cnt " . $sql_common;
		$row = sql_fetch($sql);

		$total_count = $row['cnt'];
		return $total_count;
	}

	//나의 구매메칭 견적 리스트를 가져옵니다.
	public function myEstimateMatchList($from_record,$rows){
		$sql  = "select *
				from
				g5_estimate_match a
				where a.email = '{$this->member['mb_email']}' 
				order by a.no_estimate desc	
				limit $from_record, $rows";

		echo $sql;
		$result = sql_query($sql);
		$result_fetch = sql_fetch($sql);

		return $result;
	}

	//중고매칭 내 견적에 대한 제안 가져오기
	public function myEstimateMatchPropose($no_estimate){
		$sql = "select count(*) as pro_cnt FROM g5_estimate_match_propose WHERE no_estimate = $no_estimate";
		$pro_row = sql_fetch($sql);
		$pro_cnt = $pro_row['pro_cnt'];

		return $pro_cnt;
	}


}

?>