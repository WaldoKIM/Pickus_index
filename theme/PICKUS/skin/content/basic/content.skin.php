<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>


<div class="info_visual_wrap">
    <div class="intro_visual_img content_visual_img ">
        <div class="intro_visual_text">
            <h6 class="wow fadeInDown" data-wow-delay="0.5s"><?php echo $g5['title']; ?></h6>
                <p class="wow fadeInDown" data-wow-delay="0.7s"> </p>
                <span class="wow fadeInDown" data-wow-delay="0.7s"></span>
            </div>
        </div>
</div>

<article id="ctt" class="ctt_<?php echo $co_id; ?>">
    <div class="inner">
        <header>
            <h1><?php echo $g5['title']; ?></h1>
        </header>

        <div id="ctt_con">
            <?php echo $str; ?>
        </div>
    </div>
</article>