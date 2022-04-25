<?php
include_once('./_common.php');

$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$get_type = sql_fetch($sql);
$price_cha = $price - $price_pe;

$sql = " select * from {$g5['estimate_list']} where idx = '$idx' ";
$estimate = sql_fetch($sql);

$sql = " update {$g5['estimate_list']} set
			state = '5'
		where
			idx = '$idx' ";

sql_query($sql);

$sql = " update {$g5['estimate_propose']} set
		price = '$price',
		price_minus = '$price_pe',
		content = '$content',
		meet = '0',
		price_cha = '$price_cha',
		free = '$chk_free'
	where
		idx = '$sub_idx' and  rc_email = '{$member['mb_email']}'";


sql_query($sql);

$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$list = sql_fetch($sql);

insert_notify($list['email'], '11', $list['title'].' 업체 견적이 수정되었습니다.','',$idx, '','cp5');

if($estimate['e_type']=='2'){
	if($last_price_chul > 0){
		$sql = " update {$g5['estimate_propose']} set
			price = '$last_price_chul'
		where
			idx = '$sub_idx' ";

		sql_query($sql);
	}	
	insert_notify($estimate['email'], '11', $estimate['title'].' 에 철거가 완료 되었습니다. 업체가 어땠는지 후기작성해 주세요.','',$idx, '','cp9');

}else{
	insert_notify($estimate['email'], '11', $estimate['title'].' 에 수거가 완료 되었습니다. 업체가 어땠는지 후기작성해 주세요.','',$idx, '','cp9');
        kakaotalk_send($estimate['phone'], 'SJT_059831',   $estimate['title'] );
}

alert('완료하였습니다.', G5_URL.'/estimate/partner_estimate_form.php?idx='.$idx);

?>