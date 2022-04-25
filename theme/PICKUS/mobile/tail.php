<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


?>

</div>
</div>
<div id="aside">
    <div class="mobile_menu">
        <div id="tnb" class="mobile">
            <?php echo outlogin('theme/basic');?>
        </div>
        <ul>
            <?php
                $sql = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '2'
                            order by me_order, me_id ";
                $result = sql_query($sql, false);
                $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                $menu_datas = array();

                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    $menu_datas[$i] = $row;

                    $sql2 = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '4'
                                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                                order by me_order, me_id ";
                    $result2 = sql_query($sql2);
                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        $menu_datas[$i]['sub'][$k] = $row2;
                    }

                }

                $i = 0;
                foreach( $menu_datas as $row ){
                    if( empty($row) ) continue; 
                ?>
            <li class="mobile-list">
                <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da" data-hover="<?php echo $row['me_name'] ?>"><?php echo $row['me_name'] ?>
                </a>

                <div class="menu-arrow"> <i class="xi-angle-down-min"></i></div>

                <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){

                        if( empty($row2) ) continue; 

                        if($k == 0)
                            echo '<ul class="mb-submmenu-list">'.PHP_EOL;
                            ?>
                            <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><i class="xi-subdirectory"></i><?php echo $row2['me_name'] ?></a></li>
                            <?php
                            $k++;
                            }   //end foreach $row2

                            if($k > 0)
                                echo '</ul>'.PHP_EOL;
                            ?>
                    </li>
            <?php
                $i++;
                }   //end foreach $row

                if ($i == 0) {  ?>
            <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="mask"></div>

<script>
    $(function() {

        $('.mobile_menu > ul > li .menu-arrow').click(function() {
            if (!$(this).parent().hasClass('on')) {
                $(this).parent().addClass('on');
                $(this).parent().siblings().removeClass('on');
                $('.mb-submmenu-list').slideUp();
                $(this).parent().find('ul').slideDown();
            } else {
                $(this).parent().find('ul').slideUp();
                $(this).parent().removeClass('on');
            }

           

            return false;
            $('.mobile_menu > ul > li .menu-arrow')
        });
        $('.mobile_menu > ul > li .menu-arrow').bind('touchstart', function(e) {
            $(this).trigger('click');
            e.preventDefault();
        });

        $("#mb-open-menu").click(function() {
            $("#aside").animate({
                "right": "0px"
            }, 200);
            $(".mask").css('display', 'block');

          /*   $("body").css("position", "fixed"); */
        });

        $(" .mask").click(function() {
            $("#aside").animate({
                "right": "-100%"
            }, 200);

            $(".mask").css('display', 'none');
            $("body").css("position", "relative");
        });

    });
</script>




</div>
<!-- } 콘텐츠 끝 -->
<hr>
<!-- 하단 시작 { -->
<div id="ft">
    <div id="ft_wr">
        <div class="inner">
            <div id="ft_link">
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
               <!--  <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a> -->
            </div>
            <div id="ft_company">
                <ul class="ft_company-info">
                    <li class="ft_company-info-list">(주)NAMIWEB</li>
                    <li class="ft_company-info-list">대표자 : 김나미</li>
                    <li class="ft_company-info-list">서울특별시 나미구 나미로 29 , 나미빌딩 4층 </li>
                    <li class="ft_company-info-list">TEL : 1234-1234</li>
                    <li class="ft_company-info-list">E-mail : namiweb@mail.com</li>
                    <li class="ft_company-info-list">사업자등록번호 : 987-65-43210</li>
                </ul>
            </div>
            <div id="ft_copy">Copyright &copy; NAMIWEB All rights reserved.</div>
            <div id="ft_logo">
                <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
            </div>
        </div>
        <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
        <script>
            $(function() {
                $("#top_btn").on("click", function() {
                    $("html, body").animate({
                        scrollTop: 0
                    }, '500');
                    return false;
                });
            });
        </script>
    </div>
</div>
<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>
<!-- } 하단 끝 -->
<script>
    $(function() {
        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
    });
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>