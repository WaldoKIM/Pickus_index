<?php include_once('_common.php'); ?>
<!--with KJS dance 20220114
main_seller.css 추가, d-none d-lg-block 부트스트랩 옵션으로 작은 화면에서 숏컷 설명 노출 안되게 설정
-->

<?php 
  // 연결된 리스트에 새 알림이 있는지 표기 with KJS dance 20220119
//매입철거 알림
$sql_noti_choice = "select count(*) as cnt from g5_estimate_propose gep inner join g5_notify gn on gn.estimate_idx = gep.estimate_idx 
where gn.email = '{$member['mb_email']}' and gn.read_gb = '0' and category in ('p3','p4')";
$fet_noti_choice = sql_fetch($sql_noti_choice);
$newnotice = $fet_noti_choice['cnt'];

if($newnotice == "0")
{
    $class_off = "off";
}else{
    $class_off = "";
}
//바로판매 알림
$sql_noti_matching = "select count(*) as cnt from g5_estimate_match_propose gem inner join g5_notify gn on gn.estimate_idx = gem.no_estimate 
where gn.email = '{$member['mb_email']}' and gn.read_gb = '0' and category in ('p3','p23','cm9');";

$fet_noti_matching = sql_fetch($sql_noti_matching);

$newnotice_noti_match = $fet_noti_matching['cnt'];

if($newnotice_noti_match == "0")
{
    $class_off_match = "off";
}else{
    $class_off_match = "";
}


//연결내역 알림 With PSS
$sql_noti_connect = "select count(*) as cnt from g5_notify where email = '{$member['mb_email']}' 
and read_gb = '0' and category in ('p3','p23')";
$fet_noti_connect = sql_fetch($sql_noti_connect);

$sql_noti_match = "select count(*) as cnt from g5_estimate_match_propose gemp join g5_estimate_match gem on gemp.no_estimate  = gem.no_estimate  
join g5_notify gn on gemp.no_estimate = gn.estimate_idx  where category = 'p23' AND gn.email = '{$member['mb_email']}' AND read_gb = '0' and gem.state = 3";
$fet_noti_match = sql_fetch($sql_noti_match);


$sql_noti_choice_market = "select count(*) as cnt from cs_trade_goods where seller = '{$member['mb_email']}' and trade_stat = 2";
$fet_noti_choice_market = sql_fetch($sql_noti_choice_market);


$newnotice_connect = $fet_noti['cnt'] + $fet_noti_match['cnt'] + $fet_noti_choice_market['cnt'];

$newnotice_connect = $fet_noti_connect['cnt'] + $fet_noti_choice_market['cnt'];

if($newnotice_connect == "0")
{
    $class_off_connect = "off";
}else{
    $class_off_connect = "";
}

//문의글 알림
$qna_noti_req = "select count(*) as cnt from g5_notify where category in ('p2','p15') AND email = '{$member['mb_email']}' AND read_gb = 0";

$fet_qna_noti_req = sql_fetch($qna_noti_req);


//마켓 문의글 알림 With PSS
$sql_market_req_match = "select count(*) as cnt from cs_goods_qna where seller = '{$member['mb_email']}' AND coment_check = 0";
$fet_market_req_match = sql_fetch($sql_market_req_match);

$newnotice_qna_match = $fet_market_req_match['cnt'] + $fet_qna_noti_req['cnt'];

if($newnotice_qna_match == "0")
{
    $market_off_qna_match = "off";
}else{
    $market_off_qna_match = "";
}

?>
<link rel="stylesheet" href="./bbs/css/main_seller.css?kjs11"><style type="text/css">	
	.fixbar {display: flex !important;}
</style>


<section class="cont_01">
          <div class="contico_t">
            <div class="topwrap">
              <div class="myinfowrap">              
                <?php include_once ('./bbs/mypage_review_top.php'); ?>
              </div>
              <div class="myinfowrap2 visible-lg">
                <h3>배너가 들어갈 공간입니다.</h3> 
              </div>
            </div>               
            <ul class="cboth">
              <li>
                <a href="/estimate/estimate_list2.php">
                  <img src="/img/main_seller/new/main_seller_shortcut1.png" alt="">
                  <span class="newconnect <?php echo $class_off;?>"><span class="innercircle"><?php echo $fet_noti_choice['cnt']?></span></span> 
                  <p class="contico_t_title">매입&#47;철거</p>
                  <p class="contico_t_subtitle d-none d-lg-block">매입&#47;철거와 관련된 서비스를</br>확인하실 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="/estimate/estimate_list3.php">
                  <img src="/img/main_seller/new/main_seller_shortcut2.png" alt="">
                  <span class="newconnect <?php echo $class_off_match;?>"><span class="innercircle"><?php echo $newnotice_noti_match?></span></span> 
                  <p class="contico_t_title">바로 판매</p>
                  <p class="contico_t_subtitle d-none d-lg-block">고객과 1&#58;1로 매칭되는 바로 판매</br>서비스를 이용하실 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="/estimate/partner_estimate_connect.php">
                  <img src="/img/main_seller/new/main_seller_shortcut3.png" alt="">
                  
                  <span class="newconnect <?php echo $class_off_connect;?>"><span class="innercircle"><?php echo $newnotice_connect?></span></span> 
                  <p class="contico_t_title">연결 내역</p>
                  <p class="contico_t_subtitle d-none d-lg-block">거래를 희망하는 고객과 연결된</br>내역을 확인하실 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="/estimate/partner_estimate_list.php?gubun=3">
                  <img src="/img/main_seller/new/main_seller_shortcut4.png" alt="">
                  <span class="newconnect <?php echo $market_off_qna_match;?>"><span class="innercircle"><?php echo $newnotice_qna_match ?></span></span> 
                  <p class="contico_t_title">고객 관리</p>
                  <p class="contico_t_subtitle d-none d-lg-block">고객 문의, 후기 현황을</br>확인하실 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="/market/seller/product/product_preadd.php">
                  <img src="/img/main_seller/new/main_seller_shortcut5.png" alt="">
                  <p class="contico_t_title">상품 등록</p>
                  <p class="contico_t_subtitle d-none d-lg-block">피커스 마켓에서 판매할 상품을</br>등록하실 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="/market/seller/product/product_list.php">
                  <img src="/img/main_seller/new/main_seller_shortcut6.png" alt="">
                  <p class="contico_t_title">상품 관리</p>
                  <p class="contico_t_subtitle d-none d-lg-block">피커스 마켓에서 판매중인 상품을</br>관리하실 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="/bbs/history_partner.php">
                  <img src="/img/main_seller/new/main_seller_shortcut7.png" alt="">
                  <p class="contico_t_title">정산 관리</p>
                  <p class="contico_t_subtitle d-none d-lg-block">정산내역 확인 및 마켓 수익금</br>출금신청을 하실 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="/market/seller/wallet/wallet_settle.php">
                  <img src="/img/main_seller/new/main_seller_shortcut8.png" alt="">
                  <p class="contico_t_title">출금 내역</p>
                  <p class="contico_t_subtitle d-none d-lg-block">마켓 수익금 출금 신청</br>내역을 확인하실 수 있습니다.</p>
                </a>
              </li>
            </ul>
          </div>
</section>
<!--with KJS dance 20220114
업체 메인 페이지 허리 추가 (main_seller_middle.php), 시간상 main_guide 기반으로 급조
-->
</br>
<section class="cont_03 visible-lg visible-md">
  <?include_once('main_seller_middle.php');?>  
    <!--
      <div class="main_guide_form">
        <div class="main_guide_blue"></div>
        <div class="main_guide_mid">
            <div>
                <p class="main_guide_mid_font1">Pickus</p>
                <p class="main_guide_mid_font2">피커스</p>
            </div>
            <div>
                <img class="" src="/img/main_seller/pickus_shadow.png" alt="피커스 로고">
            </div>
        </div>
    
    </div> -->
</section>
<!--with KJS dance 20220114
업체 메인 CSS에 tm5 속성 추가, -->
<section class="tm5 cont_01">
    <div style="border:none;" class="est est_design breabg">
          <div class="Brea brea1">
            <div>
              
              <div class="swiper-req" style="height: 100px; overflow: hidden;">
                <div class="list swiper-wrapper">
                  <?php for ($i = 0; $row = sql_fetch_array($fec_union); $i++) {
                    $type = '';
                    if ($row['e_type'] == '0') {
                      $type = '<li class="first01">팝니다</li>';
                    } else if ($row['e_type'] == '1') {
                      $type = '<li class="first01">다량</li>';
                    } else if ($row['e_type'] == '2') {
                      $type = '<li class="first03">철거</li>';
                    }
                    echo "<ul class='swiper-slide' style='min-width:300px'>";
                    echo "<a href='/estimate/estimate_list2.php'>";
                    echo $type;
                    echo "<li>" . mb_substr($row['area1'], 0, 2) . "</li>";
                    echo "<li>" . mb_substr($row['title'], 0, 8) . "</li>";
                    echo "</a>";
                    echo "</ul>";
                  } ?>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="Brea brea2">
            <div>
            
              <div class="swiper-req" style="height: 100px; overflow: hidden;">
                <div class="list swiper-wrapper">
                  <?php for ($i = 0; $row = sql_fetch_array($fec_union_match); $i++) {
                    
                   
                    $type = '<li class="first02">삽니다</li>';
                    
                    echo "<ul class='swiper-slide' style='min-width:300px'>";
                    echo "<a href='/estimate/estimate_list3.php'>";
                    echo $type;
                    echo "<li>" . mb_substr($row['area1'], 0, 2) . "</li>";
                    echo "<li>" . mb_substr($row['title'], 0, 8) . "</li>";
                    echo "</a>";
                    echo "</ul>";
                  } ?>
                  
                </div>
              </div>
            </div>
          </div>
        </div> 
</section>
<!--with KJS dance 20220114
업체 메인 CSS에 cont_04 요소 추가, main_guide 기반으로 개조한 1200px 크기의 main_seller_guide.php 추가
-->
<section class="cont_04">
  <?include_once('main_seller_guide.php');?>  
        <!-- <div class="how">
          <h2 class="how_bar">업체 이용가이드</h2>
          <div class="how_slider">
            <div class="service swiper-container swiper1">
              <div class="btn">
                <a href="" class="prev swiper-button-prev">이전</a>
                <a href="" class="next swiper-button-next">다음</a>
              </div>
              <div class="serv_box swiper-wrapper">
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      
                    </div>
                    <div class="con_step_title">
                        <span>STEP 1</span>
                         <h3>신청 견적 참여</h3>
                    </div>
                    <div class="serv_con tab" id="tabs1">
                      <ul>
                        <li class="on"><span></span><a href="#tabs-1">가전/가구 구매</a></li>
                        <li><span></span><a href="#tabs-2">다량매입</a></li>
                        <li><span></span><a href="#tabs-3">철거/원상복구</a></li>
                        <li><span></span><a href="#tabs-4">중고 구매 매칭</a></li>
                        <li><span></span><a href="#tabs-5">피커스 마켓</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_01 conbox on">
                        
                        <div class="conbox_txt">
                          <p>고객님이 신청하신 가전/가구 구매견적에 참여합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                      <div id="tabs-2" class="conbox_02 conbox">
                        
                        <div class="conbox_txt">
                          <p>고객님이 신청하신 다량 매입 견적에 참여합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                      <div id="tabs-3" class="conbox_03 conbox">
                        
                        <div class="conbox_txt">
                          <p>고객님이 신청하신 철거/원상복구 견적에 참여합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                      <div id="tabs-4" class="conbox_04 conbox">
                        
                        <div class="conbox_txt">
                          <p>고객님이 신청하신 가전/가구 구매 견적에 참여합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                      <div id="tabs-5" class="conbox_05 conbox">
                        
                        <div class="conbox_txt">
                          <p>마켓을 이용하여 중고 가전/가구를 판매합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      
                    </div>
                    <div class="con_step_title">
                        <span>STEP 2</span>
                        <h3>업체 선정</h3>
                    </div>
                    <div class="serv_con tab" id="tabs2">
                      <ul>
                        <li class="on"><span></span><a href="#tabs-1">업체 선정</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_07 conbox on">
                        <div class="conbox_txt">
                          <p>고객님이 견적을 확인하고 선택합니다</p>
                        </div>
                        <span class="con_img02n">icon</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      
                    </div>
                    <div class="con_step_title">
                        <span>STEP 3</span>
                        <h3>일정조율</h3>
                    </div>
                    <div class="serv_con tab" id="tabs3">
                      <ul>
                        <li id="txt_last" data-id="con1" class="on"><span></span><a href="#tabs-1">일정 조율</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_10 conbox on">
                        
                        <div class="conbox_txt">
                          <p>참여한 견적이 선택되면 고객님과 상세 일정을 조율합니다</p>
                        </div>
                        <span class="con_img03n">icon</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                    </div>
                    <div class="con_step_title">
                        <span>STEP 4</span>
                      <h3>작업 후 정산</h3>
                    </div>
                    <div class="serv_con tab" id="tabs4">
                      <ul>
                        <li id="txt_last" data-id="con1" class="on"><span></span><a href="#tabs-1">작업 후 정산</a></li>

                      </ul>
                      <div id="tabs-1" class="conbox_11 conbox on">
                        <div class="conbox_txt">
                          <p>조율한 일정에 맞춰서 방문 수거/철거 및 배송 후 정산을 받습니다</p>
                         </div>
                         <span class="con_img04n">icon</span>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
</section>


             
