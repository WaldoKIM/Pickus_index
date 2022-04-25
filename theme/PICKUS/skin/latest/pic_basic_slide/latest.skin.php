<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 315;
$thumb_height = 200;
?>

<style>
.product_lt .slick-initialized .slick-slide{margin:0 5px;}
.product_lt .slick-initialized .slick-slide img{width:100%;}

.product_lt .slick-dots{bottom:0; position:relative;}
.product_lt .slick-dots li{width:15px; height:15px;}
.product_lt .slick-dots li button{width:15px; height:15px;}
.product_lt .slick-dots li.slick-active button:before{color:#01a982; font-size:12px; background:#01a982;}
.product_lt .slick-dots li button:before{content:''; width:15px; height:15px; background:#cccccc; border-radius:15em}

.slick-prev, .slick-next{width:60px; height:120px;}
.product_lt .slick-next{right:-40px;}

</style>


<div class="product_lt">
	<h2 class="lat_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject ?></a></h2>

	<div class="variable slider">
		<?php
			for ($i=0; $i<count($list); $i++) {
			$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

			if($thumb['src']) {
				$img = $thumb['src'];
			} else {
				$img = G5_IMG_URL.'/no_img.png';
				$thumb['alt'] = '이미지가 없습니다.';
			}
			$img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
		?>
            <div>
                 <a href="<?php echo $list[$i]['href'] ?>" class="lt_img"><?php echo $img_content; ?></a>
				 	<div class="gall_content">
					<?php
					//if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";

					//if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";

					//if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";

		 
					echo "<a href=\"".$list[$i]['href']."\"> ";
					if ($list[$i]['is_notice'])
						echo "<strong>".$list[$i]['subject']."</strong>";
					else
						echo $list[$i]['subject'];

				

					// if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
					// if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

					 //echo $list[$i]['icon_reply']." ";
				   // if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
					//if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;

					if ($list[$i]['comment_cnt'])  echo "
					<span class=\"lt_cmt\">+ ".$list[$i]['wr_comment']."</span>";

					?>
					
						<div class="box-content">
							<?php echo $list[$i]['wr_content'];?>
							<!--<?php $list[$i][wr_content] = cut_str($list[$i][wr_content], 70, ".."); echo $list[$i]['wr_content'] ?>-->
						</div>
					</div>
				</a>
					<!--<span class="lt_date"><?php echo $list[$i]['datetime2'] ?></span>-->
           </div>

		   <?php }  ?>
				<?php if (count($list) == 0) { //게시물이 없을 때  ?>
				<li class="empty_li">게시물이 없습니다.</li>
		   <?php }  ?>


	</div>
                                                                
</div>

<script type="text/javascript">
    $(document).on('ready', function() {
      $(".variable").slick({
        dots: true, //페이징
        infinite: true,
		arrows:false,
		slidesToShow: 4,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,

		// the magic 
		responsive: [{ 
			breakpoint: 1024, 
			settings: { 
				slidesToShow: 3, 
				infinite: true 
				} 
			}, { 
			breakpoint: 600, 
			settings: { 
				slidesToShow: 1, 
				dots: true 
				} 
			}, { 
			breakpoint: 300, 
			settings: "unslick" // destroys slick 
		}]
      });

    });
</script>