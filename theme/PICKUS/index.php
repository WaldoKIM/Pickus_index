<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
$sql = "select sum(price) As totalprice from g5_estimate_propose";
$amtInfo = sql_fetch($sql);
$sql = "select count(idx) As totalestimate from g5_estimate_list";
$estimateInfo = sql_fetch($sql);

include_once(G5_THEME_PATH.'/head.php');
?>

<div class="main_page">
    <div class="main_banner default_banner">
        <div class="swiper-container mb_container">
            <div class="swiper-wrapper mb_wrapper">
                <div class="swiper-slide mb_slide visual_slide_video">
                    <!-- videoURL 의 주소를 원하시는 유투브 링크로 변경해주시면 됩니다. -->
                    <div id="background" class="player" data-property="{
                        videoURL:'https://www.youtube.com/embed/mA5THpy0zsg',
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
                        <h2><?php echo number_format($estimateInfo['totalestimate']); ?>건</h2>
                        <p class="desc">피커스와 함께 지구를 구한 수
                             <br>끈임없이 노력합니다.</p>
                             
                        <div class="view_more">
                            <a href="#">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb_slide mb_slide1">
                    <div class="banner_tit inner">
                        <h2><?php echo number_format($amtInfo['totalprice']); ?>원</h2>
                        <p class="desc">피커스에서 입찰된 견적 총합</p>
                        <div class="view_more">
                            <a href="#">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb_slide mb_slide2">
                    <div class="banner_tit inner">
                        <h2>일반배너</h2>
                        <p class="desc">일반배너 테스트입니다.</p>
                        <div class="view_more">
                            <a href="#">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb_slide mb_slide3">
                    <div class="banner_tit inner">
                        <h2>일반배너</h2>
                        <p class="desc">일반배너 테스트입니다.</p>
                        <div class="view_more">
                            <a href="#">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb_slide mb_slide4">
                    <div class="banner_tit inner">
                        <h2>일반배너</h2>
                        <p class="desc">일반배너 테스트입니다.</p>
                        <div class="view_more">
                            <a href="#">Learn More</a>
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
                    delay: 8000000,
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
                <h2 class="main_tit">갤러리 불러오기 테스트입니다.</h2>
                <p class="desc">
                리뷰 게시판을 생성하여 <br> 리뷰란으로 활용 가능합니다.
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
