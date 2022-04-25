<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<div class="main_page">
    <div class="main_banner default_banner">
        <div class="swiper-container mb_container">
            <div class="swiper-wrapper mb_wrapper">
                <div class="swiper-slide mb_slide visual_slide_video">
                    <!-- videoURL 의 주소를 원하시는 유투브 링크로 변경해주시면 됩니다. -->
                    <div id="background" class="player" data-property="{
                        videoURL:'https://www.youtube.com/embed/T6dYlD256tE',
                        mute: true,
                        showControls: false,
                        useOnMobile: true,
                        quality: 'highres',
                        containment: 'self',
                        loop: true,
                        anchor : 'center, center',
                        autoPlay: true,
                        stopMovieOnBlur: false,
                        startAt: 0,
                        opacity: 1
                        }">
                    </div> 
                    <div class="banner_tit inner">
                        <h2>YOUTUBE</h2>
                        <p class="desc">YOUTUBE background를 사용하실수있습니다.
                             <br>원하시는 영상을 넣어주세요.      </p>
                        <div class="view_more">
                            <a href="<?php echo G5_THEME_URL ?>/sub/introduce.php">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb_slide mb_slide1">
                    <div class="banner_tit inner">
                        <h2>WEBSITE</h2>
                        <p class="desc">사용자 경험 기반의 uiux와 어떠한 환경에서도 특정장치에 최적화된 환경을 <br> 사용자에게 제공할수 있도록 반응형 웹 사이트를 제작합니다.</p>
                        <div class="view_more">
                            <a href="<?php echo G5_THEME_URL ?>/sub/introduce.php">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb_slide mb_slide2">
                    <div class="banner_tit inner">
                        <h2>HOMEPAGE</h2>
                        <p class="desc">홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 <br> 발휘하여 퍼블리싱한 나미웹만의 테마입니다.</p>
                        <div class="view_more">
                            <a href="<?php echo G5_THEME_URL ?>/sub/directions.php">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb_slide mb_slide3">
                    <div class="banner_tit inner">
                        <h2>PROJECT</h2>
                        <p class="desc"> 홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 <br> 고객에게 맞춤 웹사이트를 제공합니다. </p>
                        <div class="view_more">
                            <a href="<?php echo G5_THEME_URL ?>/sub/bs_area.php">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb_slide mb_slide4">
                    <div class="banner_tit inner">
                        <h2>UNIQUE</h2>
                        <p class="desc">어떠한 환경에서도 특정장치에 최적화된 uiux로 환경을 사용자에게 제공합니다.</p>
                        <div class="view_more">
                            <a href="<?php echo G5_THEME_URL ?>/sub/bs_area.php">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next main-slide-next"></div>
            <div class="swiper-button-prev main-slide-prev"></div>
            <div class="swiper-pagination main-slide-pagination"></div>
        </div>
    </div>
    <script>
        $(function(){
            var swiper = new Swiper('.default_banner .swiper-container', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                 autoplay: {
                    delay: 8000,
                    disableOnInteraction: false,
                }, 
            });

             $('.main_banner .swiper-slide').on('mouseenter', function(e){
                console.log('stop autoplay');
                swiper.autoplay.stop();
            });

        $('.main_banner .swiper-slide').on('mouseleave', function(e){
                console.log('start autoplay');
                swiper.autoplay.start();
            }); 
        })
    
    
        $(function(){
            jQuery( '#background' ).YTPlayer();
        });
  

    </script>
   
    <div class="main_sec main_sec1">
        <div class="inner">
            <div class="tit_area">
                <h2 class="main_tit">Creative Web Site</h2>
                <p class="desc">
                단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다. <br>
                끊임없는 발전으로 새롭게 성장하는 나미웹이 되겠습니다.
                </p>
            </div>
            <div class="list_area">
                <ul class="clearfix">
                    <li>
                        <div class="figure_box">
                            <div class="figure">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/section1_img1.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <div class="num">
                                <span>01.</span>
                            </div>
                            <div class="text">
                                <h3 class="main_tit">Simple is the best</h3>
                                <p class="desc">
                                사용자 경험 기반의 uiux와 어떠한 환경에서도 특정장치에 최적화된 환경을 사용자에게 제공할수 있도록 반응형 웹 사이트를 제작합니다.고객이 알아보기 쉬운 간편하고 직관적인 컨텐츠 구성의 홈페이지입니다.
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="figure_box">
                            <div class="figure">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/section1_img2.png" alt="">
                            </div>
                        </div>
                        <div class="text_box">
                            <div class="num">
                                <span>02.</span>
                            </div>
                            <div class="text">
                                <h3 class="main_tit">Easy and Fast</h3>
                                <p class="desc">
                                단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다.
                                어떠한 환경에서도 특정장치에 최적화된 uiux로 환경을 사용자에게 제공합니다.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main_sec main_sec2">
        <div class="list_area">
            <ul class="clearfix">
                <li>
                    <div class="tit_area">
                        <span class="sub_tit">Web Development</span>
                        <h2 class="main_tit">가치있는 서비스</h2>
                        <div class="view_more">
                            <a href="<?php echo G5_THEME_URL ?>/sub/bs_info.php">View More</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="tit_area">
                        <span class="sub_tit">Web Design</span>
                        <h2 class="main_tit">다양한 홈페이지</h2>
                        <div class="view_more">
                            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=nami_notice">View More</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="main_sec main_sec3">
        <div class="inner clearfix">
            <div class="sec3_content">
                <div class="tit_area">
                    <h2 class="main_tit">Product</h2>
                    <div class="area_box">
                        <p class="desc">
                        나미웹만의 서비스와 스타일을 반영하여 홈페이지를 제작합니다. <br> 사이트와 컨텐츠 구성에 맞는 문구를 추가해주세요.
                        </p>
                        <div class="view_more">
                            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=basic_gallery">View More</a>
                        </div>
                    </div>
                </div>
                <div class="sec3_board">
                    <?php echo latest('theme/slide_product_round', 'basic_gallery', 8, 0, 300,300);?> 
                </div>
            </div>
        </div>
    </div>


    <div class="main_sec main_sec5 main-latest-list">
        <div class=" inner">
            <div class="latest_wr wow fadeInUp" data-wow-delay="0.4s">
                <div class="latest-list-box">
                    <div class="latest-list-tit">
                        <h2 class="board-tit">공지사항</h2>
                    </div>
                    <?php echo latest('theme/basic2', 'basic_list', 4, 40, 1);?>
                </div>
                
                <div class="latest-list-box wow fadeInUp" data-wow-delay="0.5s">
                    <div class="latest-list-tit">
                        <h2 class="board-tit">FAQ </h2>
                    </div>
                    <?php echo latest('theme/basic2', 'faq_list', 4,40, 2);?>
                </div>
            </div>
        </div>
    </div>




    <div class="main_sec main_sec4">
        <div class="inner">
            <div class="tit_area">
                <h2 class="main_tit">홈페이지 소식을 알려드립니다.</h2>
                <p class="desc">
                최신트랜드드를 이해하고 제시하는 단순한 레이아웃으로 <br> 심플하지만 어떤 기업과도 어울리는 홈페이지입니다.
                </p>
            </div>
            <div class="latest_area">
                <div class="latest_wr">
                    <?php echo latest('theme/slide_product_basic', 'gallery_simple', 10, 0 );?>
                </div>
            </div>
        </div>
    </div>




   


    <div class="main_sec main_sec6">
        <div class="inner">
            <li class="btm-con-list list-long con-list">
                <div class="main-sub clearfix">
                    <div class="box-list">
                        <div class="box-item">
                            <a href="javascript:;" class="box-info">
                                <div class="info-content">
                                    <div class="info">
                                        <p class="tit">Event</p>
                                        <p class="txt"><span>새롭고 다양한 <br></span>이벤트를 만나보세요.</p>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:;" class="box-info">
                                <div class="info-content">
                                    <div class="info">
                                        <p class="tit">Business</p>
                                        <p class="txt"><span>우리만의 특별한<br></span>사업을 소개합니다.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="long-list1">
                        <ul class="list-item clearfix">
                            <li class="board-icon"><a href="javascript:;"><img src="<?php echo G5_THEME_IMG_URL ?>/main/sec6_icon1.png" alt=""> <h4>고객센터</h4></a></li>
                            <li class="board-icon"><a href="javascript:;"><img src="<?php echo G5_THEME_IMG_URL ?>/main/sec6_icon2.png" alt="" title=""> <h4>오시는길</h4></a></li>
                            <li class="board-icon"><a href="javascript:;"><img src="<?php echo G5_THEME_IMG_URL ?>/main/sec6_icon3.png" alt=""> <h4>business</h4></a></li>
                        </ul>
                    </div>
                    <div class="long-list2">
                        <div class="board-cs">
                            <h4>고객센터</h4>
                            <p class="cs-tell">1234-1234</p>
                            <p class="cs-open">평일 09:00~18:00(주말, 공휴일 휴무)<br>FAX:01-1234-5678</p>
                        </div>
                    </div>
                </div>
            </li>
        </div>
    </div>
</div>




<?php
include_once(G5_THEME_PATH.'/tail.php');
?>