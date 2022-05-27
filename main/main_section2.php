<?php    
$main_inc = 2;
include(G5_MAIN_PATH.'/main_section_board.php');
?>
<div class="left_40">
<?php    
include('./bbs/board.php');
unset($main_inc);
?>
</div>
<div class="right_60">
<?php
include_once(G5_MAIN_PATH.'/main_section2_half.php');
?>
</div>
<div class="clearboth"></div>