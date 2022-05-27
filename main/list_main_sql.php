<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//메인 리스트 쿼리문 -kjs
/*
아래 쿼리는 임시로 작성되었으며, 추후 쿼리문을 논리적으로 수정할 필요 있음
가급적이면 섹션번호 = 게시글 id 를 일치시키시고, 여의치 않으면 특정 번호대로 분리 지정하세요
e.g. 특정 번호대에 특정 데이터 저장(shortcut 메뉴는 100~110번대 사용 등)
*/

if(isset($main_inc)){
    if($main_inc == 4){$mainsection = '4 or wr_id = 5 or wr_id = 6';
    }else if($main_inc == 7){$mainsection = 1;    
    }else if($main_inc == 5){$mainsection = 7;
    }else if($main_inc == 6){$mainsection = 14;
    }else if($main_inc == 1){$mainsection = '100 or wr_id > 100 and wr_id < 110';
        }else{$mainsection = $main_inc;}
    }

/*
    if(isset($main_inc)){
        if($main_inc == 1){$mainsection = '100 or wr_id > 100 and wr_id < 110';
        }else if($main_inc == x){$mainsection = x or wr_id > x and wr_id < x+3;        
            }else{$mainsection = $main_inc;}
        }        
*/
