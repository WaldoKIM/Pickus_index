<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_LIB_PATH.'/estimate.lib.php');

?>

<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'UA-146069223-1');

$(function(){
       /* 화면 최소높이  */
       
   function page_h() {
    if(!window.location.pathname == '/'){
       
        var wheight = $(window).height();
        var header =$('.board_visual_wrap').outerHeight();
        var footer =$('#ft').outerHeight();
        var wrap_h = wheight - header - footer;

        

        

        $('#bo_list,#bo_gall').css('min-height',wrap_h);

        $('#container').css('min-height',wheight -footer);
        
        console.log(header);
        console.log(footer);
        console.log(wrap_h);
    } page_h();
    
    $(window).on('resize', function(){
        page_h();
    });
    }

});


    $(function() {
        /* no thank you! -kjs */
        setInterval(function() {
            if ($(window).scrollTop() >= 20) {
                $("#hd").addClass("scroll_bg");
                $("#mb-open-menu").addClass("scroll_bg");
            } else {
              $("#hd").removeClass("scroll_bg");
              $("#mb-open-menu").removeClass("scroll_bg");
            }
        }
        , 400);


         /* 스크롤 top 버튼 */
         $('.scroll-top').on('click',function(){
                $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
                return false;
            });

            var lastScrollTop = 0;
            var scroll_btn = $('.scroll-top');

            btnScroll();

            $(window).on('scroll', function(e) {
                btnScroll();
            });

            function btnScroll() {
                st = $(this).scrollTop();
                lastScrollTop = st;

                if (st === 0) {
                    scroll_btn.fadeOut();

                }else{
                    $(scroll_btn).fadeIn();
                }
            }
    });
</script>

<!-- 상단 시작 { -->
<div id="hd">

    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
    <div id="tnb" class="pc">
        <div class="inner clearfix">
            <ul class="left_tnb">
                <li>
                    <i class="icon phone"></i><span>1800-5528</span>
                </li>
                <li>
                    <i class="icon clock"></i><span>(월~금) 9:00 - 18:00</span>
                </li>
            </ul>
            <ul class="right_tnb">
                <?php if ($is_member) {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><i class="fa fa-cog" aria-hidden="true"></i> 정보수정</a></li>
                <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> 알림</a></li>
                <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> 정산내역</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> 로그아웃</a></li>
                <?php if ($is_admin) {  ?>
                <li class="tnb_admin"><a href="<?php echo G5_ADMIN_URL ?>"><b><i class="fa fa-user-circle" aria-hidden="true"></i> 관리자</b></a></li>
                <?php }  ?>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/register_form.php"><i class="fa fa-user-plus" aria-hidden="true"></i> 회원가입</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b><i class="fa fa-sign-in" aria-hidden="true"></i> 로그인</b></a></li>
                <?php }  ?>
            </ul>
        </div>
    </div>
    <div id="hd_wrapper">
       <div class="inner">
        <div id="logo">
            <a href="<?php echo G5_URL ?>">
              PICKUS
            </a>
        </div>

        <div id="mb-open-menu" class="mb-button-menu">
            <span class="line1"></span>
            <span class="line2"></span>
            <span class="line3"></span>
        </div>
        <nav id="gnb">
            <h2>메인메뉴</h2>
            <div class="gnb_wrap">
                <ul id="gnb_1dul">
                    <li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li>
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
                    <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                        <?php
                        $k = 0;
                        foreach( (array) $row['sub'] as $row2 ){

                            if( empty($row2) ) continue;

                            if($k == 0)
                                echo '<span class="bg">하위분류</span><ul class="gnb_2dul">'.PHP_EOL;
                        ?>
                    <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
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
                <div id="gnb_all">
                    <h2>전체메뉴</h2>
                    <ul class="gnb_al_ul">
                        <?php

                        $i = 0;
                        foreach( $menu_datas as $row ){
                        ?>
                        <li class="gnb_al_li">
                            <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a"><?php echo $row['me_name'] ?></a>
                            <?php
                            $k = 0;
                            foreach( (array) $row['sub'] as $row2 ){
                                if($k == 0)
                                    echo '<ul>'.PHP_EOL;
                            ?>
                        <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $row2['me_name'] ?></a></li>
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
                        <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                        <?php } ?>
                    </ul>
                    <button type="button" class="gnb_close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
            </div>
        </nav>
    </div>
    </div>
    <script>
         /* no thank you! -kjs
        $(function() {
            $(".gnb_menu_btn").click(function() {
                $("#gnb_all").show();
            });
            $(".gnb_close_btn").click(function() {
                $("#gnb_all").hide();
            });



            
            setInterval(function() {
                if ($(window).scrollTop() >= 80) {
                    $("#hd").addClass("scroll_on");
                } else {
                    $("#hd").removeClass("scroll_on");
                }
            }, 400) 
        });
        */
    </script>
</div>
<!-- } 상단 끝 -->

<div class="scroll-top">
    <div class="scroll-top-icon"></div>
</div>

<hr>


<!-- 콘텐츠 시작 { -->
    <div id="wrapper">
    <div id="container_wr">

        <div id="container">
            <?php if (!defined("_INDEX_")) { ?><h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2><?php } ?>
