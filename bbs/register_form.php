<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$registerType = $_GET['registerType'];
//run_event('register_form_before');

// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

if( $provider && function_exists('social_nonce_is_valid') ){   //모바일로 소셜 연결을 했다면
    if( social_nonce_is_valid(get_session("social_link_token"), $provider) ){  //토큰값이 유효한지 체크
        $w = 'u';   //회원 수정으로 처리
        $_POST['mb_id'] = $member['mb_id'];
    }
}
$w == "";
if ($is_admin == 'super')
    alert('관리자의 회원정보는 관리자 화면에서 수정해 주십시오.', G5_URL);
if ($is_member)
    $w = "u";

include_once('./_head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
$required = ($w=='') ? 'required' : '';
$readonly = ($w=='u') ? 'readonly' : '';

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
if ($config['cf_use_addr'])
    add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

// 정보 수정일 시 페이지 컨트롤 소비자, 업체는 서로 다른 타입의 주소로 접근 불가
$mb = get_member($mb_id);
if ($w == 'u'){
    if ($mb['mb_level'] == 8 || $mb['mb_level'] == 0){
		$registerType = "customer";
	}else{
        $registerType = "partner";
    }
}

if (!$registerType) {
    $registerType = "customer";
}       

if ($registerType == "customer") {
    include_once($member_skin_path.'/register_customer_form.skin.php');
}elseif ($registerType == "partner") {
    
    include_once($member_skin_path.'/register_partner_form.skin.php');
}else {
    goto_url(G5_URL);
}

include_once('./_tail.php');
?>