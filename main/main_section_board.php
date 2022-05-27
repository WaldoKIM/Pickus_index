<?php

// *섹션별로 적용할 테마명을 입력(board theme) - with KJS dance

if(isset($main_inc)){
    if($main_inc == 1){
     $board_skin_path=G5_MAIN_THEM_PATH.'v4_gallery_portfolio';
     }else if($main_inc == 2){
     $board_skin_path=G5_MAIN_THEM_PATH.'v4_gallery_simple';
      }else if($main_inc == 3){
        $board_skin_path=G5_MAIN_THEM_PATH.'v4_gallery_simple';         
     }else if($main_inc == 4){$board_skin_path=G5_MAIN_THEM_PATH.'v4_gallery_basic';
     }else if($main_inc == 6){$board_skin_path=G5_MAIN_THEM_PATH.'v4_webzine_table';
     }else if($main_inc == 7){$board_skin_path=G5_MAIN_THEM_PATH.'v4_webzine_table';
     }else{$board_skin_path=G5_MAIN_THEM_PATH.'v4_youtube';}    
    }else{}