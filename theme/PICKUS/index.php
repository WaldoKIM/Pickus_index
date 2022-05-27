<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
$sql = "select sum(price) As totalprice from g5_estimate_propose";
$amtInfo = sql_fetch($sql);
$sql = "select count(idx) As totalestimate from g5_estimate_list";
$estimateInfo = sql_fetch($sql);

include_once(G5_THEME_PATH.'/head.php');
?>


<!--- 여기부터 작업 -KJS ---->


<div class="main_page">
<?php
//*main 화면을 가급적이면 섹션별로 별개 파일로 구성하기 위해 분리 -with KJS dance
include_once(G5_MAIN_PATH.'/main_section1.php');


/*
*여기부터 main 화면용 board include
$main_inc로 섹션을 구분하고, 그에 맞는 스킨과 SQL을 불러와 board에 적용함

*모든 변경사항은 메인화면에서만 적용됩니다. 일반적인 경로로 게시판 접근시 원래 설정으로 원복됨.

*파일 구조
섹션별 스킨 경로 설정은 main_section_board.php 에서(Controller)
섹션별 SQL 수정은 main/list.php에서(Model)
화면 디자인은 해당 스킨/list.sikn.php 및 해당 스킨/style_main.css에서 담당(View)

*추가된 파일들
/main 폴더 내 파일들
/skin/board 폴더 내 style_main.css 파일

-with KJS dance */


// 메인 공통 함수 -kjs
include_once(G5_MAIN_PATH.'/main_section_board_common.php');


/* 섹션1은 custom url 사용
추후 사이트 구조에 맞게 이 경로를 수정하려면 get_pretty_url_main 함수를 변경하세요(main_section_board_common.php 파일 내 설명 참조) -kjs 
*/
$main_inc = 1;
include(G5_MAIN_PATH.'/main_section_board.php');
include('./bbs/board.php');
unset($main_inc);

// *섹션2는 half and half 구조. board 파트는 텍스트 본문, half 파트는 마켓 상품 정보를 담당. -kjs
include_once(G5_MAIN_PATH.'/main_section2.php');

$main_inc = 3;
include(G5_MAIN_PATH.'/main_section_board.php');
include('./bbs/board.php');
unset($main_inc);

$main_inc = 5;
include(G5_MAIN_PATH.'/main_section_board.php');
include('./bbs/board.php');
unset($main_inc);

$main_inc = 7;
include(G5_MAIN_PATH.'/main_section_board.php');
include('./bbs/board.php');
unset($main_inc);

$main_inc = 6;
include(G5_MAIN_PATH.'/main_section_board.php');
include('./bbs/board.php');
unset($main_inc);

$main_inc = 4;
include(G5_MAIN_PATH.'/main_section_board.php');
include('./bbs/board.php');
unset($main_inc);

include_once(G5_MAIN_PATH.'/main_section3.php');

//마지막 섹션 영역, div 닫히지 않게 주의 -kjs
include_once(G5_MAIN_PATH.'/main_sectionf.php');?>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
