<?php 
//메인 화면 공통 함수 -kjs

//메인 화면에 출력할 테이블 설정
$bo_table = 'main_inc';
$board['bo_table'] = 'main_inc';

//메인 화면에 출력할 내용 불러오기
function boardCommon(){
global $bo_table;
global $g5;
$board = get_board_db($bo_table, true);
if (isset($board['bo_table']) && $board['bo_table']) {
        $write_table = $g5['write_prefix'] . $bo_table;
}
return array ($board, $write_table);
}

$board = boardCommon()[0];
$write_table = boardCommon()[1];


//메인 화면에 썸네일이 아닌 전체 이미지가 필요한 경우
function boardCommonImg(){
global $main_inc;
global $main_inc_img;
global $bo_table;
global $g5;
global $board;
global $board_skin_path;
if(isset($main_inc_img)){
    $wr_id = $main_inc_img;    
}else{
$wr_id = $main_inc;
}
$write_table = $g5['write_prefix'] . $bo_table;                                                                  
$write = get_write($write_table, $wr_id);
$view = get_view($write, $board, $board_skin_path);                                
$main_img = get_file_thumbnail($view['file'][0]);                                                                                                                                    
unset($wr_id);
return $main_img;}


 /* main_shortcut_url 추가(lib\common.lib.php 500번째 줄 참조)

$list['href_custom'] 사용시 custom url이 적용되며, 이 경로는 아래 설정을 변경하시면 됩니다 -kjs

lib\uri.lib.php 110번째 줄 get_pretty_url_main 함수의
$url = G5_SUB_URL.'/somthing.php'; 부분(182째 줄)
*/

 


