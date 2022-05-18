<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

$estimateType = $_GET['estimateType'];

include_once('../head.php');

if (!$estimateType) {
    $estimateType = "single";
}

if ($estimateType == "single") {
    include('../theme/PICKUS/estimate/estimate_single.skin.php'); // 실 배포시 절대경로로 변경 [G5_THEME_URL.'/estimate/estimate_single.skin.php']

}elseif ($estimateType == "multiple") {
    include('../theme/PICKUS/estimate/estimate_multiple.skin.php');

}elseif ($estimateType == "demolition") {
    include('../theme/PICKUS/estimate/estimate_demolition.skin.php');

}elseif ($estimateType == "business") {
    include('../theme/PICKUS/estimate/estimate_business.skin.php');

}elseif ($estimateType == "match") {
    include('../theme/PICKUS/estimate/estimate_match.skin.php');

}else {
    goto_url(G5_URL);
}

include_once('../tail.php');
?>