<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<div class="main_page">
    <div class="visual_banner">
        <div class="swiper-container mb_container">
            <div class="swiper-wrapper mb_wrapper">
                <div class="swiper-slide mb_slide slide-img1">
                    <div class="bn_tit inner">
                        <h2 >나미웹만의 가치있는 브랜드를 <strong>소개합니다.</strong></h2>
                        <p class="desc"> 편리하고 재미있는 나미웹을 만들어 나가겠습니다. <br>나미웹만의 퍼블리싱기술로 홈페이지를 제작하고있습니다.</p>
                    </div>
                </div>
                <div class="swiper-slide mb_slide slide-img2">
                    <div class="bn_tit inner">
                        <h2 >편리하고 재미있는 홈페이지는<p><strong>Creative Web Site</strong></p>
                        </h2>
                        <p class="desc">하나의 홈페이지를 제공합니다.</p>
                    </div>
                </div>
                <div class="swiper-slide mb_slide slide-img3">
                    <div class="bn_tit inner">
                        <h2 >누구나 사용할수있는 기본적이고 심플한 <strong> 홈페이지 테마입니다.</strong></h2>
                        <p class="desc">메인배너 문구를 추가해주세요. <br> 사이트와 컨텐츠 구성에 맞는 문구를 추가해주세요. </p>
                    </div>
                </div>
       
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next visual_banner_next"></div>
            <div class="swiper-button-prev visual_banner_prev"></div>
            <!-- Add Pagination -->
            <div class="swiper-pagination visual_banner-pagination"></div>
        </div>
    </div>
    <script>
        var swiper = new Swiper('.visual_banner .swiper-container', {
            speed: 1000,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next.visual_banner_next',
                prevEl: '.swiper-button-prev.visual_banner_prev',
            },
            pagination: {
                el: '.swiper-pagination.visual_banner-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
            },
        });


    </script>
    <div class="main_section main_sec0">
        <div class="inner clearfix">
            <div class="sec0_box_list">
                    <ul class="clearfix">
                        <li class="sec0_box_box sec0_box_box1">
                            <div class="sec0_box_icon">

                            </div>
                            <div class="sec0_box_article">
                                <p class="sec0_box_name">디자인/퍼블리싱  </p>
                                <p class="sec0_box_desc">단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다.</p>
                            </div>
                        </li>
                        <li class="sec0_box_box sec0_box_box2">
                            <div class="sec0_box_icon">
                            </div>
                            <div class="sec0_box_article">
                                <p class="sec0_box_name">선택과안내</p>
                                <p class="sec0_box_desc">홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다. </p>
                            </div>
                        </li>
                        <li class="sec0_box_box sec0_box_box3">
                            <div class="sec0_box_icon">
                            </div>
                            <div class="sec0_box_article">
                                <p class="sec0_box_name">환경설정 및 설치</p>
                                <p class="sec0_box_desc">나미웹만의 서비스와 스타일을 반영하여 홈페이지를 제작합니다.</p>
                            </div>
                        </li>
                    </ul>
                </div>
        </div>
    </div>

    <div class="main_section main_sec1">
        <div class="inner clearfix">
            <div class="tit_area main">
                <h2 class="main_tit">Creative Web Site</h2>
                <p class="desc">
                사용자 경험 기반의 uiux와 어떠한 환경에서도 특정장치에 <br>최적화된 환경을 사용자에게 제공할수 있도록 반응형 웹 사이트를 제작합니다.
                </p>
            </div>
            <div class="list_area">
                <ul class="clearfix">
                    <li>
                        <div class="sec1_info_box">
                            <div class="info_img">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_section_1.jpg" alt="">
                            </div>

                            <div class="text_box">
                                <div class="text">
                                    <h3 class="main_tit">풍부한 경험 </h3>
                                    <p class="desc">
                                    홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 발휘하여 퍼블리싱한 나미웹만의 테마입니다.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="sec1_info_box">
                            <div class="info_img">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_section_2.jpg" alt="">
                            </div>
                            <div class="text_box">
                                <div class="text">
                                    <h3 class="main_tit">가치있는 서비스</h3>
                                    <p class="desc">
                                    홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 발휘하여 퍼블리싱한 나미웹만의 테마입니다.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="sec1_info_box">
                            <div class="info_img">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_section_3.jpg" alt="">
                            </div>
                            <div class="text_box">
                                <div class="text">
                                    <h3 class="main_tit">함께 나아가는 </h3>
                                    <p class="desc">
                                    홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 발휘하여 퍼블리싱한 나미웹만의 테마입니다.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="sec1_info_box">
                            <div class="info_img">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_section_4.jpg" alt="">
                            </div>
                            <div class="text_box">
                                <div class="text">
                                    <h3 class="main_tit">우리의 브랜드</h3>
                                    <p class="desc">
                                    홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 발휘하여 퍼블리싱한 나미웹만의 테마입니다.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>




    <div class="main_section main_sec2" >
        <div class="main_sec2-bg" >
            <div class="inner">
                <div class="tit_area main">
                    <h2 class="main_tit">Our brand</h2>
                    <p class="desc">
                    최신트랜드와 미래를 선도하는 나미웹의 브랜드를<br> 소개하겠습니다.
                    </p>
                </div>
                <div class="view_more">
                    <a href="/namiTheme/theme/namiWeb/sub/introduce.php">Read More</a>
                </div>
            </div>
        </div>
    </div>

  
    
    <div class="main_section main_sec3">
        <div class="inner">
            <div class="latest_area">

                <div class="latest_wr">
                    <div class="tit_area main">
                        <h2 class="main_tit">Media</h2>
                        <p class="desc">
                        갤러리 소식을 만나보세요.
                        </p>
                    </div>
                    <?php echo latest('theme/slide_basic', 'gallery_basic2', 6, 0 );?>
                </div>
            </div>
        </div>
    </div>

    <div class="main_section main-latest-list">
        <div class=" inner">
            <div class="latest_wr wow fadeInUp" data-wow-delay="0.4s">
                <div class="latest-list-box">
                    <div class="latest-list-tit">
                        <h2 class="board-tit">공지사항</h2>
                        <p class="board-desc"> 새로운 소식을 전해드립니다. </p>
                    </div>
                    <?php echo latest('theme/basic', 'basic_list2', 4, 40, 1);?>
                </div>
                
                <div class="latest-list-box wow fadeInUp" data-wow-delay="0.5s">
                    <div class="latest-list-tit">
                        <h2 class="board-tit">FAQ </h2>
                        <p class="board-desc">자주하시는 질문과 답변을 안내해드립니다.
                        </p>
                    </div>
                    <?php echo latest('theme/basic', 'faq_list2', 4,40, 2);?>
                </div>
            </div>
        </div>
    </div>



<div class="main_section main_sec4">
    <div class="inner">
        <div class="main_sec4-content">
                <div class="main_sec4-box">
                    <div class="main_sec4-box-info">
                        <p class="tit">고객센터</p>
                        <p class="txt"><span>여러분의 소중한 <br></span> 의견을 언제나 <br> 기다리고 있습니다.</p>
                        <a href="/namiTheme/theme/namiWeb/sub/introduce.php" class="con4-detail"><span>Read More</span><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
        
                <div class="main_sec4-box2">
                    <div class="box-list box-list1">    
                        <a href="javascript:;" class="box-item">
                            <span class="tit">VISION</span>
                            <span class="txt">끊임없는 발전으로<br> 새롭게 성장하는 비전</span>
                            <span class="more-btn">more<i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                        </a>
                    </div>
                     <div class="box-list box-list2"> 
                        <a href="javascript:;" class="box-item">
                            <span class="tit">BUSINESS</span>
                            <span class="txt">고객의 목적과 상황에 맞는<br>비즈니스</span>
                            <span class="more-btn">more<i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 사업영역 , 오시는길, 공지사항,  gallery, vision -->



</div>


    <div class="main_section main_sec5">
        <div class="inner">
            <div class="tit_area main">
                <h2 class="main_tit">Contact Us</h2>
            <!--     <p class="desc"> </p> -->
            </div>
            <div class="main-map-wrap">
                <div class="detail">
                    <!--
                        * 카카오맵 - 약도서비스
                        * 한 페이지 내에 약도를 2개 이상 넣을 경우에는
                        * 약도의 수 만큼 소스를 새로 생성, 삽입해야 합니다.
                    -->
                    <!-- 1. 약도 노드 -->
                    <div id="daumRoughmapContainer1614844365491" class="root_daum_roughmap root_daum_roughmap_landing"></div>

                    <!-- 2. 설치 스크립트 -->
                    <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

                    <!-- 3. 실행 스크립트 -->
                    <script charset="UTF-8">
                        new daum.roughmap.Lander({
                            "timestamp" : "1614844365491",
                            "key" : "24pz5",
                        /*   "mapWidth" : "640",
                            "mapHeight" : "360" */
                        }).render();
                    </script>
                </div>
            </div>
        </div>
    </div>




<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>