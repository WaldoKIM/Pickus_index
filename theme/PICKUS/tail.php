<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

</div>
</div>
<div id="aside">
    <div class="close_menu" id="mobile_menu_close">
        <a href="javascript:;" class="line_box">
            <span class="close-line1"></span>
            <span class="close-line2"></span>
        </a>
    </div>
    <div class="mobile_menu">
        <div id="tnb" class="mobile">
            <?php echo outlogin('theme/basic');?>
        </div>
        <ul class="mobile_menu_box">
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
                <div class="icon_arrow icon">
                    <i class="xi-angle-down-thin"></i>
                </div>

                <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){

                        if( empty($row2) ) continue;

                        if($k == 0)
                            echo '<ul class="mb-sub-ul">'.PHP_EOL;
                        ?>
                    <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
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


        <div class="side_contact">
            <div class="contact_info">
                <h3 class="contact_title">Contact Us</h3>
                <p class="contact_list">Tel. 1800-5528</p>
                <p class="contact_list">평일 09:00 - 18:00 <span> (주말/공휴일 휴무)</span></p>
            </div>

            <div class="side_sns">
                <ul class="side_sns_list clearfix">
                    <li class="sns_icon"><a href="#"><i class="xi-kakaotalk"></i> <span class="sound_only">카카오톡</span> </a></li>
                    <li class="sns_icon"><a href="#"><i class="xi-twitter"></i> <span class="sound_only">트위터</span> </a></li>
                    <li class="sns_icon"><a href="#"><i class="xi-youtube-play"></i> <span class="sound_only">유투브</span> </a></li>
                    <li class="sns_icon"><a href="#"><i class="xi-facebook"></i> <span class="sound_only">페이스북</span> </a></li>
                    <li class="sns_icon"><a href="#"><i class="xi-instagram"></i> <span class="sound_only">인스타그램</span> </a></li>
                </ul>
            </div>

        </div>


    </div>
</div>
<div class="mask"></div>

<script>
    $(function() {

        $('.mobile_menu > ul > li .icon_arrow').click(function() {
            if (!$(this).parent().hasClass('on')) {
                $(this).parent().siblings().removeClass('on');
                $('.mb-sub-ul').slideUp();
                $(this).parent().addClass('on');
                $(this).parent().find('ul').slideDown();
            } else {
                $(this).parent().removeClass('on');
                $(this).parent().find('ul').slideUp();

            }

            return false;
            $('.mobile_menu > ul > li .icon_arrow')
        });
        $('.mobile_menu > ul > li .icon_arrow').bind('touchstart', function(e) {
            $(this).trigger('click');
            e.preventDefault();
        });

        $(".mb-button-menu").click(function() {
            $("#aside").css('display', 'block').animate({
                "right": "0px"
            }, 200);
            $(".mask").css('display', 'block');
            $("html").css('overflow', 'hidden');


        });

        $("#mobile_menu_close, .mask").click(function() {
            $("#aside").css('display', 'none').animate({
                "right": "-100%"
            }, 200);

            $("html").css('overflow', 'auto');
            $(".mask").css('display', 'none');
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
                    <li class="ft_company-info-list">DEHUV</li>
                    <li class="ft_company-info-list">대표자 : 천정훈</li>
                    <li class="ft_company-info-list">경기도 고양시 일산동구 동국로 32 동국대학교 산학협력관 203호</li>
                    <li class="ft_company-info-list">TEL : 1800-5528</li>
                    <li class="ft_company-info-list">E-mail : cs@repickus.com</li>
                    <li class="ft_company-info-list">사업자등록번호 : 291-39-00208</li>
                </ul>
            </div>
            <div id="ft_copy">Copyright &copy; dehuv All rights reserved.</div>
            <div id="ft_logo">
                <a href="<?php echo G5_URL ?>">PICKUS</a>
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
