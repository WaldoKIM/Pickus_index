<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 760;
$thumb_height = 616;
?>
<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.0/swiper-bundle.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.0/swiper-bundle.min.js"></script>  -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>  -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.3.8/css/swiper.min.css"
  integrity="sha512-n5Hcb4VEEDI2N1H86KJQFfk0nR2tTZTrQLeDAGRFF24YfDP06lRH2YgDUiCh+hfWAVfJmW1qwNDzgtjneoVFSg=="
  crossorigin="anonymous" />

<div class="slide-product-round">
  <div class="pic_lt">
    <div class="lat_title_area clearfix">
      <h2 class="lat_title"><a
          href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject ?></a></h2>
      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="lt_more"><span
          class="sound_only"><?php echo $bo_subject ?></span>+ 더보기<span class="sound_only"> 더보기</span></a>
    </div>
    <div class="swiper-container round-latest-slide-container">
      <div class="swiper-wrapper latest-slide-wrap">
        <?php
              for ($i=0; $i<count($list); $i++) {
              $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

              if($thumb['src']) {
                  $img = $thumb['src'];
              } else {
                  $img = G5_THEME_URL.'/skin/board/gallery_table/img/no_image.png';
                  $thumb['alt'] = '이미지가 없습니다.';
              }
              $img_content = '<img src="'.$thumb['ori'].'" alt="'.$thumb['alt'].'" >';
              $img_content_bg = '<div class="board-thumbnail" style="background-image:url('.$thumb['ori'].')" ></div>';
          ?>
        <div class="item swiper-slide latest-slide-item " style=" cursor: pointer;"
          onclick="location.href='<?php echo $list[$i]['href'] ?>'">
          <a class="gall_img"><?php echo $img_content_bg; ?></a>
          <?php
                      echo "<a class=\"gall_text_area\" href=\"".$list[$i]['href']."\" >";
                      echo "<div class=\"text_area_box\">";
                      echo "<div class=\"gall_title\">";
                      if ($list[$i]['is_notice'])
                          echo "<strong>".$list[$i]['subject']."</strong>";
                      else
                          echo $list[$i]['subject'];
                      echo "</div>";

                      // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
                      // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

                      //echo $list[$i]['icon_reply']." ";
                  // if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
                      //if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;

                  /*   if ($list[$i]['comment_cnt'])  echo "<span class=\"lt_cmt\">+ ".$list[$i]['wr_comment']."</span>"; */
                      echo "<div class=\"gall_content\"><span class=\"sound_only\">본문내용</span><p>".$list[$i]['wr_content']."</p></div>";
                      echo "</div>";
                      echo "</a>";
                      ?>

        <!--  <span class="lt_date"></i><?php// echo $list[$i]['datetime'] ?></span> -->

        </div>
        <?php }  ?>
        <?php if (count($list) == 0) { //게시물이 없을 때  ?>
        <li class="empty_li">게시물이 없습니다.</li>
        <?php }  ?>

      </div>
        <!-- Add Pagination -->
        <div class="slide-control-wrap">
          <div class="swiper-pagination latest-slide-pagenation"></div>
            <div class="swiper-button-next latest-slide-next"></div>
            <div class="swiper-button-prev latest-slide-prev"></div>
        </div>
    </div>
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="lt_more"><span
        class="sound_only"><?php echo $bo_subject ?></span><i class="fa fa-plus" aria-hidden="true"></i><span
        class="sound_only"> 더보기</span></a>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.3.8/js/swiper.min.js"
  integrity="sha512-2zMI2fi89JcUksrmozsywzC0tcEJAACDO/WQHxjm3hzTnG9rgGiVRUwOAbN7Pc8b8/n3Q2+Q39Ih1JOQwAiBeA=="
  crossorigin="anonymous"></script>
<script>
  $(function () {
    var swiper = new Swiper('.swiper-container.round-latest-slide-container', {
     slidesPerView: 1,
      loop: true,
      navigation: {
        nextEl: '.round-latest-slide-container .swiper-button-next.latest-slide-next',
        prevEl: '.round-latest-slide-container .swiper-button-prev.latest-slide-prev',
      },
      pagination: {
        el: '.round-latest-slide-container .swiper-pagination.latest-slide-pagenation',
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 8,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
          slidesPerGroup:2,
        },

        992: {
          slidesPerView: 3,
          spaceBetween: 16,
          slidesPerGroup:3,
        },

      }
    });
  });
</script>
