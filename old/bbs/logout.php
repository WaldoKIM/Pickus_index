<?php
include_once('./_common.php');





if(function_exists('social_provider_logout')){
    social_provider_logout();
}

// 이호경님 제안 코드
session_unset(); // 모든 세션변수를 언레지스터 시켜줌
session_destroy(); // 세션해제함

// 자동로그인 해제 --------------------------------
set_cookie('ck_mb_id', '', 0);
set_cookie('ck_auto', '', 0);
// 자동로그인 해제 end --------------------------------


//안쓰는거 다 지워버리려다 호오오옥시 몰라서 주석처리  with KJS dance 2022식목일  
//if ($url) {
//    if ( substr($url, 0, 2) == '//' )
//        $url = 'http:' . $url;

//    $p = @parse_url(urldecode($url));
    /*
        // OpenRediect 취약점관련, PHP 5.3 이하버전에서는 parse_url 버그가 있음 ( Safflower 님 제보 ) 아래 url 예제
        // http://localhost/bbs/logout.php?url=http://sir.kr%23@/
    */
//    if (preg_match('/^https?:\/\//i', $url) || $p['scheme'] || $p['host']) {
//        alert('url에 도메인을 지정할 수 없습니다.', G5_URL);
//    }

//    if($url == 'shop')
 //       $link = G5_SHOP_URL;
  //  else
    //    $link = $url;
//} else if ($bo_table) {
//    $link = G5_BBS_URL.'/board.php?bo_table='.$bo_table;
//} else {

//마켓에서 로그아웃시 마켓 메인으로 가게 수정 with KJS dance 2022식목일    
$url = parse_url($_SERVER["HTTP_REFERER"]);
$domain = $url["path"];
//echo $domain; 
$marketURL = "/market/main/";  
  
if(strpos($domain, $marketURL) !== false) {  
    $link = G5_URL."/market/main/";  
} else {  
    $link = G5_URL."?out=1";  
}  





//}

goto_url($link);
?>
