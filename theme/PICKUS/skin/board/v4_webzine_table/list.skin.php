<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>


<div class="board_visual_wrap">
    <div class="board_visual_img board_qna_visual_img">
        <div class="board_visual_text">
            <h6 class="wow fadeInDown" data-wow-delay="0.5s"><?php echo $board['bo_subject'] ?></h6>
            <p class="wow fadeInDown" data-wow-delay="0.7s">웹진형 게시판입니다.</p>
        </div>
    </div>
    <?php include_once(G5_THEME_PATH.'/skin/nav/mysubmenu2/mysubmenu2.php'); ?>
</div>




<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">
    <div class="inner">

    <div class="board_content_head list_tit">
        <h3 class="board_content_tit">웹진형</h3>
        <p class="board_content_info">테마 게시판을 사용해보세요.</p>
    </div>

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
    
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
        	<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
            <li>
            	<button type="button" class="btn_bo_sch btn_b01 btn" title="게시판 검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">게시판 검색</span></button>
            </li>
   <!--          <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?> -->
        	<?php if ($is_admin == 'super' || $is_auth) {  ?>
        	<li>
        		<button type="button" class="btn_more_opt is_list_btn btn_b01 btn" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
        		<?php if ($is_checkbox) { ?>	
		        <ul class="more_opt is_list_btn">  
		            <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
		            <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
		            <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
		        </ul>
		        <?php } ?>
        	</li>
        	<?php }  ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
        <ul class="board-webzine-wrap">
            <!--   <caption><?php echo $board['bo_subject'] ?> 목록</caption> -->

        
                <?php
                for ($i=0; $i<count($list); $i++) {
                ?>
                <li class=" board-webzine-body <?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> ">
                    <?php if ($is_checkbox) { ?>
                    <div class="webzine_chk">
                        <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                        <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                    </div>
                    <?php } ?>

                    <div class="webzine_thumbnail">
            
                        <a href="<?php echo $list[$i]['href'] ?>">
                            <?php
        
                                $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);
                                
                                if($thumb['src']) {
                                    $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" >';
                                } else {
                                  /*   $img_content = '<img src="'.$board_skin_url.'/img/no_image.png" alt="이미지가 없습니다" />'; */
                                  $img_content = '<span class="no_image">No Image</span>';
                                }
                                echo $img_content;

                                
                            ?>
                        </a>
                    </div>
                    <div class="webzine_content">

                        <div class="webzine_subject" style=" cursor: pointer;" onclick="location.href='<?php echo $list[$i]['href'] ?>'">
                          


                            <div class="bo_tit">
                                <?php if ($is_category && $list[$i]['ca_name']) { ?>
                                <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link color-gray mt-1"><?php echo $list[$i]['ca_name'] ?></a>
                                <?php } ?>
                                <a class="webzine_subject_link" href="<?php echo $list[$i]['href'] ?>">
                  
                                    <?php echo ( isset($list[$i]['icon_secret']) && !empty($list[$i]['icon_secret']) ) ? "<i class='oi oi-lock-locked'></i>" : "";?>
                                    <?php echo $list[$i]['subject'] ?>
                                </a>

                                <?php
                                // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
                                //if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
                                //if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
                                //if (isset($list[$i]['icon_new'])) echo rtrim($list[$i]['icon_new']);
                                //if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
                                ?>
                                <!--   <?php if ($list[$i]['comment_cnt']) { ?><span class="comment_b"><?php echo $list[$i]['wr_comment']; ?></span><?php } ?> -->
                            </div>

                            <!--
                            <?php if (strstr($list[$i][wr_option], "secret")) { ?>
                                비밀글의 경우 출력내용 
                            <?php } else { ?>
                            <br><span class="small text-muted"><?php echo  cut_str(strip_tags($list[$i]['content']),100)?></span><br><br>
                            <?php } ?>-->


                            
                            <div class="webzine_text">
                                <span class="sound_only">본문내용 </span><?php echo $list[$i]['wr_content'] ?>
                            </div>
                    
                        </div>
                        <div class="webzine_info_wrap">
                            <div class="webzine_name webzine_info"><?php echo $list[$i]['name'] ?></div>
                            <div class="webzine_count webzine_info">조회수<?php echo $list[$i]['wr_hit'] ?></div>
                            <?php if ($list[$i]['comment_cnt']) { ?> <div class="webzine_info webzine_comment">댓글 <?php echo $list[$i]['wr_comment']; ?></div><?php } ?>
                            <?php if ($is_good) { ?><div class="webzine_info list-num webzine_gcount"><span class="list-pc-none"> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </span> <?php echo $list[$i]['wr_good'] ?></div><?php } ?>
                            <?php if ($is_nogood) { ?><div class="webzine_info list-num webzine_bcount"><span class="list-pc-none"> <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> </span><?php echo $list[$i]['wr_nogood'] ?></div><?php } ?>
                            <div class="webzine_datetime webzine_info"><?php echo $list[$i]['datetime'] ?></div>
                        </div>
                    </div>
                    

                </li>
                <?php } ?>
                <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
    
        </ul>
    </div>
	<!-- 페이지 -->
	<?php echo $write_pages; ?>
	<!-- 페이지 -->
	
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
        	<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
            <?php if ($write_href) { ?><li class="board-write-btn"><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="board-write">글쓰기</span></a></li><?php } ?>
        </ul>	
        <?php } ?>
    </div>
    <?php } ?>   
    </form>

    <!-- 게시판 검색 시작 { -->
    <div class="bo_sch_wrap">
        <fieldset class="bo_sch">
            <h3>검색</h3>
            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>
            <select name="sfl" id="sfl">
                <?php echo get_board_sfl_select_options($sfl); ?>
            </select>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <div class="sch_bar">
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input"  maxlength="100" placeholder=" 검색어를 입력해주세요">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
            </div>
            <button type="button" class="bo_sch_cls" title="닫기"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
            </form>
        </fieldset>
        <div class="bo_sch_bg"></div>
    </div>
    <script>
    jQuery(function($){
        // 게시판 검색
        $(".btn_bo_sch").on("click", function() {
            $(".bo_sch_wrap").toggle();
        })
        $('.bo_sch_bg, .bo_sch_cls').click(function(){
            $('.bo_sch_wrap').hide();
        });
    });
    </script>
    <!-- } 게시판 검색 끝 --> 
    </div>
</div>

<script>
$(function(){

    function no_image() {
        var web_thumb =$('.webzine_thumbnail img').outerHeight();
        var no_img =$('.webzine_thumbnail span.no_image');
        
        console.log(web_thumb);
        no_img.css('line-height',web_thumb+'px');
        
    } no_image();

    $(window).on('resize', function(){
        no_image();
    });

});


</script>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
