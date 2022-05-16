<?php
include_once('../theme/PICKUS/skin/estimate/_common.php');

$sub_idx = $_POST['sub_idx'];
$idx = $_POST['idx'];

$sql = " select * from g5_estimate_propose where idx = '$sub_idx' ";
$estimate_propose = sql_fetch($sql);

$sql = " select * from g5_estimate_list where idx = '{$estimate_propose['estimate_idx']}' ";
$estimate = sql_fetch($sql);

$now = date_create('now')->format('Y-m-d');


$sql = " update g5_estimate_propose set
			score = '$score', 
			review = '$review',
			updatetime = '$now'
		 where idx = '$sub_idx' ";



sql_query($sql);

insert_notify($estimate_propose['rc_email'], '22', $estimate['title'].' 후기가 작성되었습니다.','',$idx, '','p8');


alert('후기를 작성하였습니다.', '/theme/PICKUS/skin/estimate/my_estimate_form.php?idx='.$idx);
?>