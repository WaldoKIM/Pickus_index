<script type="text/javascript">
    function display_submenu(num) {
        document.getElementById("current_sub" + num).style.display = "block";
        document.getElementById("all_sub" + num).style.display = "block";
        document.getElementById("current_main" + num).style.display = "block";
    }
</script>


<script>
    $(function() {
  $(".mysubmenu .current_menu").click(function(){

        if ($(this).hasClass('active')) {
           $(this).removeClass('active');
           $(this).siblings().slideUp();
       } else {

           $(this).addClass('active');
           $(this).siblings().slideDown();
       } 
   
    });
});
</script>

<div class="mysubmenu">
   <div class="inner clearfix">
        <div class="home menu_select"><a href="<?php echo G5_URL ?>"><i class="xi-home-o"></i></a></div>
        <div class="main_menulist_area menu_select">
            <div class="current_mainmenu current_menu">
                <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
            ?>

                <ul id="current_main<?php echo $i ?>" style="display:none" class="">
                    <li class="mainmenu_li">
                        <a>
                            <h3><?php echo $row['me_name'] ?></h3>
                        </a>
                    </li>
                </ul>
                <?php } ?>
            </div>
            <div class="all_mainmenu all_menu">
                <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
                <ul>
                    <li class="mainmenu_li">
                        <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?>
                        </a>
                    </li>
                </ul>
                <?php } ?>
            </div>
        </div>
        <div class="sub_menulist_area menu_select">
            <div class="current_submenu current_menu">
                <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
                <div id="current_sub<?php echo $i ?>" style="display:none;">
                    <?php
                    $sql2 = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '4'
                                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                                order by me_order, me_id ";
                    $result2 = sql_query($sql2);

                    //좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌
                    if ( ($row['me_name']==$board['bo_subject'])||($row['me_name']==$g5['title']) ) {
                        echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> ");
                    }

                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        if($k == 0)
                            echo '<ul>'.PHP_EOL;
                    ?>
                    <li<?php if(($row2['me_name']==$board['bo_subject'])||($row2['me_name']==$g5['title'])) { echo " style=\"display: block\""; } ?> style="display: none" class="submenu_li"><a><h3><?php echo $row2['me_name'] ?></h3></a></li>
                        <?php  
                    }
                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </div>
                <?php } ?>
            </div>
            <div class="all_submenu all_menu">
                <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
                <div id="all_sub<?php echo $i ?>" style="display:none;">
                    <?php
                    $sql2 = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '4'
                                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                                order by me_order, me_id ";
                    $result2 = sql_query($sql2);

                    //좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌
                    if ( ($row['me_name']==$board['bo_subject'])||($row['me_name']==$g5['title']) ) {
                        echo ("<script language='javascript'> display_submenu(".$i."); </script> ");
                    }

                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        if($k == 0)
                            echo '<ul>'.PHP_EOL;
                    ?>
                    <li<?php if(($row2['me_name']==$board['bo_subject'])||($row2['me_name']==$g5['title'])) { echo " class=\"submenu_li on\""; } ?> class="submenu_li"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
                        <?php  
                        //좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌
                        //게시판 아닌 페이지는 각 페이지에서 $g5['title'] 지정 후 사용
                        if ( ($row2['me_name']==$board['bo_subject'])||($row2['me_name']==$g5['title']) ) {
                            echo ("<script language='javascript'> display_submenu(".$i."); </script> ");
                        }
                    }
                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>