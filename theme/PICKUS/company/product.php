<?php
include_once('./_common.php');
$g5['title'] = "제품소개";
include_once(G5_THEME_PATH.'/head.php');
?>
<script>
    new WOW().init();
</script>


<div id="product_wrap">
    <div class="product_visual_wrap">
        <div class="product_visual_img">
            <div class="product_visual_text">
                <h6 class="wow fadeInDown" data-wow-delay="0.5s"><?php echo $g5['title'] ?></h6>
                <p class="wow fadeInDown" data-wow-delay="0.7s">나미웹의 제품소개페이지입니다.</p>
            </div>
        </div>
        <?php include_once(G5_THEME_PATH.'/skin/nav/mysubmenu2/mysubmenu2.php'); ?>
    </div>


    <div class="section_wrap">
        <div class="section ">
            <div class="inner">
                <div class="sect_tit">
                    <h3 class="wow flipInX"><span>제품설명타입</span>의 페이지입니다.</h3>
                    <p class="wow fadeInUp" data-wow-delay="0.3s">세계로뻗어나가는 나미웹</p>
                </div>


                <div class="product_area">
                    <div class="product_notice wow fadeInUp">
                        <div class="product_notice_img">
                            <img src="<?php echo G5_THEME_IMG_URL?>/product/product_icon3.png" alt="">
                        </div>
                        <div>
                            <p class="product_txt01 bold5">우리만의 가치있는 제품</p>
                            <p class="product_txt02">단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다. </p>
                            <ul>
                                <li class="product_txt03 bold3">
                                    <p>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다. </p>
                                </li>
                                <li class="product_txt03 bold3">
                                    <p>홈페이지에 대한 전문적인 지식과 제작능력을 효율적으로 발휘하여 퍼블리싱한 나미웹만의 테마입니다.</p>
                                </li>
                                <li class="product_txt03 bold3">
                                    <p>어떠한 환경에서도 특정장치에 최적화된 uiux로 환경을 사용자에게 제공합니다.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product_tab wow fadeInUp">
                        <ul class="clearfix">
                            <li class="on tab_big">
                                <a href="#">제품_01</a>
                            </li>
                            <li>
                                <a href="#">제품_02</a>
                            </li>
                            <li>
                                <a href="#">제품_03</a>
                            </li>
                            <li>
                                <a href="#">제품_04</a>
                            </li>
                            <li>
                                <a href="#">제품_05</a>
                            </li>
                            <li>
                                <a href="#">제품_06</a>
                            </li>
                            <li>
                                <a href="#">제품_07</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product_content wow fadeInUp">
                        <div class="product_con_box on">
                            <p class="bold5 product_con_tit">제품_01</p>
                            <div class="product_box">
                                <ul class="product_info_list">
                                    <li>고객의 목적과 상황에 맞게 풍부한 경험으로 편리하고 재미있고 단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다. 끊임없는
                                        발전으로 새롭게 성장하는 나미웹을 찾아주셔서 감사합니다.</li>
                                    <li>나미웹만의 서비스와 스타일을 반영하여 홈페이지를 제작합니다. 사이트와 컨텐츠 구성에 맞는 문구를 추가해주세요.</li>
                                    <li>누구나 사용할수있는 기본적이고 심플한 나미웹만의 홈페이지 테마입니다.</li>
                                    <li>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</li>
                                    <li>단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다. 끊임없는 발전으로 새롭게 성장하는 나미웹.</li>
                                </ul>
                                <div class="product_con_img">
                                    <img src="<?php echo G5_THEME_IMG_URL?>/product/product_img1.jpg" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="product_con_box">
                            <p class="bold5 product_con_tit">제품_02</p>
                            <div class="product_box">
                                <ul class="product_info_list">
                                    <li>누구나 사용할수있는 기본적이고 심플한 나미웹만의 홈페이지 테마입니다.</li>
                                    <li>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</li>
                                </ul>
                                <div class="product_con_img">
                                    <img src="<?php echo G5_THEME_IMG_URL?>/product/product_img2.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="product_con_box">
                            <p class="bold5 product_con_tit">제품_03</p>
                            <div class="product_box">
                                <ul class="product_info_list">
                                    <li>나미웹만의 서비스와 스타일을 반영하여 홈페이지를 제작합니다. 사이트와 컨텐츠 구성에 맞는 문구를 추가해주세요.</li>
                                    <li>누구나 사용할수있는 기본적이고 심플한 나미웹만의 홈페이지 테마입니다.</li>
                                    <li>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</li>
                                    <li>단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다. 끊임없는 발전으로 새롭게 성장하는 나미웹.</li>
                                    <li>나미웹만의 서비스와 스타일을 반영하여 홈페이지를 제작합니다. 사이트와 컨텐츠 구성에 맞는 문구를 추가해주세요.</li>
                                </ul>
                                </ul>
                                <div class="product_con_img">
                                    <img src="<?php echo G5_THEME_IMG_URL?>/product/product_img3.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="product_con_box">
                            <p class="bold5 product_con_tit">제품_04</p>
                            <div class="product_box">
                                <ul class="product_info_list">
                                    <li>누구나 사용할수있는 기본적이고 심플한 나미웹만의 홈페이지 테마입니다.</li>
                                    <li>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</li>
                                </ul>
                                <div class="product_con_img">
                                    <img src="<?php echo G5_THEME_IMG_URL?>/product/product_img4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="product_con_box">
                            <p class="bold5 product_con_tit">제품_05</p>
                            <div class="product_box">
                                <ul class="product_info_list">
                                    <li>누구나 사용할수있는 기본적이고 심플한 나미웹만의 홈페이지 테마입니다.</li>
                                    <li>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</li>
                                    <li>단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다. 끊임없는 발전으로 새롭게 성장하는 나미웹.</li>
                                </ul>
                                <div class="product_con_img">
                                    <img src="<?php echo G5_THEME_IMG_URL?>/product/product_img5.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="product_con_box">
                            <p class="bold5 product_con_tit">제품_06</p>
                            <div class="product_box">
                                <ul class="product_info_list">
                                    <li>누구나 사용할수있는 기본적이고 심플한 나미웹만의 홈페이지 테마입니다.</li>
                                    <li>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</li>
                                </ul>
                                <div class="product_con_img">
                                    <img src="<?php echo G5_THEME_IMG_URL?>/product/product_img6.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="product_con_box">
                            <p class="bold5 product_con_tit">제품_07</p>
                            <div class="product_box">
                                <ul class="product_info_list">
                                    <li>누구나 사용할수있는 기본적이고 심플한 나미웹만의 홈페이지 테마입니다.</li>
                                    <li>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</li>
                                    <li>단순한 레이아웃으로 심플하지만 어떤 기업과도 어울리는 홈페이지입니다. 끊임없는 발전으로 새롭게 성장하는 나미웹.</li>
                                    <li>누구나 사용할수있는 기본적이고 심플한 나미웹만의 홈페이지 테마입니다.</li>
                                    <li>홍보,소개,안내 등의 홈페이지 구축을 목적으로 하는 고객에게 맞춤 웹사이트를 제공합니다.</li>
                                </ul>
                                <div class="product_con_img">
                                    <img src="<?php echo G5_THEME_IMG_URL?>/product/product_img7.jpg" alt="">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    $('.product_tab a').on('click', function (e) {
        n = $('.product_tab a').index($(this));
        $('.product_tab li').eq(n).addClass('on').siblings().removeClass('on');
        $('.product_con_box').eq(n).addClass('on').siblings().removeClass('on');
        e.preventDefault();
    });
</script>



<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
