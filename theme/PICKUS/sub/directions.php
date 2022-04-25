<?php
include_once('./_common.php');
$g5['title'] = "오시는길";
include_once(G5_THEME_PATH.'/head.php');
?>

<div class="sub_directions">
    <div class="intro_visual_wrap">
        <div class="intro_visual_img">
            <div class="intro_visual_text">
                <h6 class="wow fadeInDown" data-wow-delay="0.5s"><?php echo $g5['title'] ?></h6>
                <p class="wow fadeInDown" data-wow-delay="0.7s">나미웹을 소개합니다.</p>
            </div>
        </div>
        <?php include_once(G5_THEME_PATH.'/skin/nav/mysubmenu2/mysubmenu2.php'); ?>
    </div>

    <div class="inner sub_tit_top">
        <div class="tit_area subpage">
            <h2 class="main_tit"><span>나미웹</span> <?php echo $g5['title'] ?></h2>
        </div>
    </div>

    <div class="sub_sec dir_sec1">
        <div class="inner">
            <div class="desc_area">
                <ul class="info">
                    <li class="clearfix">
                        <span class="icon">
                            <span class="oi" data-glyph="map-marker"></span>
                        </span>
                        <h3 class="tit">주소</h3>
                        <p class="desc">서울특별시 나미구 나미로 29 , 나미빌딩 4층 1055 1호점</p>
                    </li>
                    <li class="clearfix">
                        <span class="icon">
                            <span class="oi" data-glyph="phone"></span>
                        </span>
                        <h3 class="tit">대표전화</h3>
                        <p class="desc">1234-5678</p>
                    </li>
                </ul>
            </div>
            <div class="map_area">
                <div class="map_box">
                <div class="map_img">
                            <div id="daumRoughmapContainer1618561251507"
                                class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%"></div>
                        </div>
                   <!--
                            * 카카오맵 - 약도서비스
                            * 한 페이지 내에 약도를 2개 이상 넣을 경우에는
                            * 약도의 수 만큼 소스를 새로 생성, 삽입해야 합니다.
                        -->
                    <!-- 1. 약도 노드 -->


                    <!-- 2. 설치 스크립트 -->
                    <script charset="UTF-8" class="daum_roughmap_loader_script"
                        src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

                    <!-- 3. 실행 스크립트 -->
                    <script charset="UTF-8">
                        new daum.roughmap.Lander({
                            "timestamp": "1618561251507",
                            "key": "25ef8",

                        }).render();
                    </script>
                </div>
            </div>


            <div class="desc_method clearfix">
                            <ul class="info">
                                <h3 class="tit">지점</h3>
                                <li><h4 class="tit2">서울특별시 나미구 나미로 29 , 나미빌딩 4층 1055 1호점</h4></li>
                                <li><p class="desc">Tel : 1234-1234</p></li>
                                <li><p class="desc">E-Mail :namiweb@mail.com</p></li>
                            </ul>
                            <ul class="transit">
                                <h3 class="tit">교통편</h3>
                                <li>
                                    <h4 class="tit2">지하철</h4>
                                    <p class="desc">서울특별시 나미구 나미로 29 , 나미빌딩 4층 1055</p>
                                </li>
                                <li>
                                    <h4 class="tit2">버스</h4>
                                    <p class="desc">마을버스 : 강남 1004번</p>
                                    <p class="desc">간선 : 1000번, 1001번, 1002번, 1003번</p>
                                    <p class="desc">지선 : 4번, 3번, 2번, 1번 등</p>
                                </li>
                            </ul>
                        </div>
        </div>
    </div>
</div>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>