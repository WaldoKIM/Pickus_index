<?php
include_once('./_common.php');
$g5['title'] = "사업정보";
include_once(G5_THEME_PATH.'/head.php');
?>

<div class="business_info">
    <div class="intro_visual_wrap ">
        <div class="intro_visual_img business_visual_img">
            <div class="intro_visual_text">
                <h6 class="wow fadeInDown" data-wow-delay="0.5s"><?php echo $g5['title'] ?></h6>
                <p class="wow fadeInDown" data-wow-delay="0.7s">나미웹을 소개합니다.</p>
            </div>
        </div>
        <?php include_once(G5_THEME_PATH.'/skin/nav/mysubmenu2/mysubmenu2.php'); ?>
    </div>
    <div class="inner sub_tit_top">
        <div class="tit_area subpage">
            <h2 class="main_tit">web business </h2>
            <p class="desc">
            홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 발휘하여 퍼블리싱한 나미웹만의 테마입니다. <br>
            나미웹만의 서비스와 스타일을 반영하여 홈페이지를 제작합니다. 사이트와 컨텐츠 구성에 맞는 문구를 추가해주세요.
            </p>
        </div>
    </div>
    <div class="sub_sec bsinfo_sec1">
        <div class="inner clearfix">
            <div class="list_area">
                <ul class="clearfix">
                    <li>
                        <div class="figure_box">
                            <div class="figure">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/bi_section1_img1.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <div class="text">
                                <h3 class="tit">Value creation</h3>
                                <p class="desc">연구 및 유지보수</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="figure_box">
                            <div class="figure">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/bi_section1_img2.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <div class="text">
                                <h3 class="tit">brand site</h3>
                                <p class="desc">환경설정 및 설치</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="figure_box">
                            <div class="figure">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/bi_section1_img3.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <div class="text">
                                <h3 class="tit">your project</h3>
                                <p class="desc">자료수집과 단계별 구성및 절차 안내</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="figure_box">
                            <div class="figure">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/bi_section1_img4.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <div class="text">
                                <h3 class="tit">responsive Web</h3>
                                <p class="desc">마크업/퍼블리싱</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="figure_box">
                            <div class="figure">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/bi_section1_img5.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <div class="text">
                                <h3 class="tit">theme</h3>
                                <p class="desc">다양한 정보와 유용한 컨텐츠</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="figure_box">
                            <div class="figure">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/business/bi_section1_img6.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <div class="text">
                                <h3 class="tit">service</h3>
                                <p class="desc">풍부한 경험과 서비스 </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="sub_sec bsinfo_sec2">
        <div class="inner clearfix">
            <div class="tit_area subpage">
                <h3 class="main_tit"><strong>재미있는 서비스</strong> <span>나미웹사이트</span></h3>
                <div class="bsinfo_tit_icon">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/business/bs_info_icon.png" alt="">
                </div>
            </div>
            <div class="desc_area">
                <p class="desc1">
                홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다. 
                최신트랜드드를 이해하고 제시하는 단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다.
                끊임없는 발전으로 새롭게 성장하는 나미웹입니다.  홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다. 
                최신트랜드드를 이해하고 제시하는 홈페이지입니다.
                어떠한 환경에서도 특정장치에 최적화된 uiux로 환경을 사용자에게 제공합니다.홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 발휘하여 퍼블리싱한 나미웹만의 테마입니다.
                나미웹만의 서비스와 스타일을 반영하여 홈페이지를 제작합니다.
                </p>
            </div>
        </div>
    </div>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>