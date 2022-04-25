<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 284;
$thumb_height = 185;
?>
<link rel="stylesheet" href="<?php echo $latest_skin_url;?>/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo $latest_skin_url;?>/owl.theme.default.min.css">
<link rel="stylesheet" href="<?php echo $latest_skin_url;?>/owl.theme.default.css">
<link rel="stylesheet" href="<?php echo $latest_skin_url;?>/owl.theme.green.css">
<link rel="stylesheet" href="<?php echo $latest_skin_url;?>/owl.theme.green.min.css">
<link rel="stylesheet" href="<?php echo $latest_skin_url;?>/owl.carousel.css">
<script src="<?php echo $latest_skin_url;?>/owl.carousel.js"></script>
<script src="<?php echo $latest_skin_url;?>/owl.carousel.min.js"></script>

<div class="pic_lt">
    <div class="lat_title_area clearfix">
        <h2 class="lat_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject ?></a></h2>
        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="lt_more"><span class="sound_only"><?php echo $bo_subject ?></span>더보기&ensp;&ensp;&ensp;+<span class="sound_only"> 더보기</span></a>
    </div>
    <div class="owl-carousel owl-theme">

        <?php
    for ($i=0; $i<count($list); $i++) {
    $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

    if($thumb['src']) {
        $img = $thumb['ori'];
    } else {
        $img = G5_THEME_IMG_URL.'/customer/s_event_img.png';
        $thumb['alt'] = '이미지가 없습니다.';
    }
    $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
    ?>


        <li>
            <a href="<?php echo $list[$i]['href'] ?>" class="lt_img"><?php echo $img_content; ?></a>
            <?php
            if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";

            if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";

            if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";

 
            echo "<a href=\"".$list[$i]['href']."\"> ";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];



            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

             //echo $list[$i]['icon_reply']." ";
           // if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
            //if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;

            if ($list[$i]['comment_cnt'])  echo "
            <span class=\"lt_cmt\">+ ".$list[$i]['wr_comment']."</span>";

            ?>

            <span class="lt_date"><?php echo $list[$i]['datetime2'] ?></span>
        </li>





        <!--
        <div class="item">
            <a href="<?php echo $list[$i]['href'] ?>"><?php echo $img_content; ?></a>
        </div>-->
        <?php }  ?>
        <?php if (count($list) == 0) { //게시물이 없을 때  ?>
        <li class="empty_li">게시물이 없습니다.</li>
        <?php }  ?>
    </div>


</div>

<script>
    $(document).ready(function() {
                var owl = $('.owl-carousel');
                owl.owlCarousel({
                    autoplay: false,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    loop: true,
                    margin: 10,
                    responsive: {
                        60: {
                            items:1
                        },
                        600: {
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        1920: {
                            items: 4
                        }
                    }
                });
 });
</script>
<!--  // });

        /*       $(function() {


         function partBox() {

          var wsize = $(window).width();

          if (wsize >= 768) {
                   $('.owl-item').css('width', '50%')

          }
         }
         partBox();


        $(window).resize(function() {
           partBox();
         });
            
               
            
            
             }); */
   // });


-->
