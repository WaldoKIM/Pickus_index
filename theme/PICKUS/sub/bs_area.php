<?php
include_once('./_common.php');
$g5['title'] = "비즈니스";
include_once(G5_THEME_PATH.'/head.php');
?>

<div class="business_area">
    <div class="intro_visual_wrap ">
        <div class="intro_visual_img business_visual_img" >
            <div class="intro_visual_text">
                <h6 class="wow fadeInDown" data-wow-delay="0.5s"><?php echo $g5['title'] ?></h6>
                <p class="wow fadeInDown" data-wow-delay="0.7s">나미웹을 소개합니다.</p>
            </div>
        </div>
        <?php include_once(G5_THEME_PATH.'/skin/nav/mysubmenu2/mysubmenu2.php'); ?>
    </div>

    <div class="sub_sec bsarea_sec1">
        <div class="inner clearfix">
            <div class="tit_area subpage clearfix">
                <h3 class="main_tit"><strong>나미웹만</strong>의 <br> 퍼블리싱기술로 홈페이지를 <br> 제작하고있습니다. </h3>
                <p class="desc">
                    홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 발휘하여 퍼블리싱한 나미웹만의 테마입니다.
                    나미웹만의 서비스와 스타일을 반영하여 홈페이지를 제작합니다. 사이트와 컨텐츠 구성에 맞는 문구를 추가해주세요.
                    어떠한 환경에서도 특정장치에 최적화된 uiux로 환경을 사용자에게 제공합니다.
                    사용자 경험 기반의 uiux와 어떠한 환경에서도 특정장치에 최적화된 환경을 사용자에게 제공할수 있도록 반응형 웹 사이트를 제작합니다.
                    고객이 알아보기 쉬운 간편하고 직관적인 컨텐츠 구성의 홈페이지입니다.
                </p>
            </div>
            <div class="figure_area clearfix">
                <div class="figure figure1"><img src="<?php echo G5_THEME_IMG_URL ?>/business/ba_section1_img1.png" alt=""></div>
                <div class="figure figure2"><img src="<?php echo G5_THEME_IMG_URL ?>/business/ba_section1_img2.png" alt=""></div>
            </div>
        </div>
    </div>
    <div class="sub_sec bsarea_sec2">
        <div class="inner clearfix">
            <div class="list_area">
                <ul class="clearfix">
                    <li>
                        <div class="icon_box">
                            <div class="icon">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/ba_section2_icon1.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <h3 class="tit">Communication</h3>
                            <p class="desc">쉽게 사이트를 제작할 수 있으며 빠른 시간 안에 웹사이트를 만나볼 수 있습니다.</p>
                        </div>
                    </li>

                    <li>
                        <div class="icon_box">
                            <div class="icon">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/ba_section2_icon2.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <h3 class="tit">vision</h3>
                            <p class="desc">전문적 제작 컨설팅 및 다양한 경험을 바탕으로 제대로 된 웹 서비스를 제공합니다.</p>
                        </div>
                    </li>
                    <li>
                        <div class="icon_box">
                            <div class="icon">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/ba_section2_icon3.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <h3 class="tit">setting</h3>
                            <p class="desc">차별화된 디자인과 체계적인 제작으로 고객님이 만족하는 웹사이트를 제작합니다.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="sub_sec bsarea_sec3">
        <div class="inner clearfix">
            <div class="tit_area subpage clearfix">
                <div class="tit_box">
                    <h3 class="main_tit">your brand</h3>
                    <p class="sub_tit">홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</p>
                </div>
                <p class="desc">
                사용자 경험 기반의 uiux와 어떠한 환경에서도 특정장치에 최적화된 환경을 사용자에게 제공할수 있도록 반응형 웹 사이트를 제작합니다.
                고객이 알아보기 쉬운 간편하고 직관적인 컨텐츠 구성의 홈페이지입니다.
                나미웹만의 퍼블리싱기술로 홈페이지를 제작하고있습니다.
                </p>
                <div class="view_more">
                    <a href="<?php echo G5_THEME_URL ?>/sub/bs_info.php">View More</a>
                </div>
            </div>
            <div class="figure_area">
                <div class="figure">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/business/ba_section3_img.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>