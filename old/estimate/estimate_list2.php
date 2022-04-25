<?php
include_once('./_common.php');
include_once(G5_LIB_PATH . '/thumbnail.lib.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$sql_where  = " where state = '1' and simple_yn != '1' and e_type in ('0','1','2') ";
//$sql_where .= " where 1=1 ";
$sql_where .= " and idx not in ( select estimate_idx from {$g5['estimate_propose']} where rc_email = '{$member['mb_email']}' ) ";
$sql_where .= " and deadline >= DATE_FORMAT(now(), '%Y-%m-%d') ";

if ($area1)
	$sql_where .= " and area1 = '$area1' ";

if ($area2)
	$sql_where .= " and area2 = '$area2' ";

if ($e_type) {
	if ($e_type == "1") {
		$sql_where .= " and e_type = '1' ";
		if ($item_cat) {
			$sql_where .= " and item_cat_dtl = '$item_cat' ";
		}
	} else if ($e_type == "2") {
		$sql_where .= " and e_type = '2' ";
		if ($item_cat) {
			$sql_where .= " and sub_key in ( select distinct sub_key from {$g5['estimate_list_multi']} where pull_kind='$item_cat' ) ";
		}
	} else {
		$sql_where .= " and e_type = '0' ";
		$sql_where .= " and item_cat = '$e_type' ";
		if ($item_cat) {
			$sql_where .= " and item_cat_dtl = '$item_cat' ";
		}
	}
}

$sql = " select count(*) as cnt from {$g5['estimate_list']} " . $sql_where;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
	$page = 1;
} // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 게시글 제목 글자수 제한을 없애기 위한 임시방편 with KJS dance 20220126
$sql  = " select
			idx,
			concat(substr(nickname,1,1),'**') as nickname,			
			case when length(title) <= 60 then title else concat(substr(title,1,60),'...') end as title,
			area1,
			area2,
			state,
			e_type,
			deadline,
			date_format(writetime, '%Y.%m.%d') as writetime
		  from {$g5['estimate_list']} ";
$sql .= $sql_where;

if ($_POST['deadline_ord'] == '1'){
 	$sql .= " order by deadline";
}else{
 	$sql .= " order by idx desc ";
}

$sql .= " limit $from_record, $rows ";


$result = sql_query($sql);

// 연결된 목록에 새 알림이 있는지 표기 with KJS dance 20220119
// 매입/철거 연결목록 읽지 않은 견적 갯수 표시 with PSS 20220217
//$sql_noti_choice = "select count(*) as cnt from g5_notify where category in ('p3','p4') AND email = '{$member['mb_email']}' AND read_gb = 0";
$sql_noti_choice =  "select count(*) as cnt from g5_estimate_propose p   
inner join g5_notify gn on p.estimate_idx = gn.estimate_idx where gn.email = '{$member['mb_email']}' and gn.read_gb = 0 and category in ('p3','p4')";

$fet_noti_choice = sql_fetch($sql_noti_choice);

$newnotice = $fet_noti_choice['cnt'];

if($newnotice == "0")
{
    $class_off = "off";
}else{
    $class_off = "";
}


?>
<link rel="stylesheet" type="text/css" href="/css/board.css?kjs2" />
<link rel="stylesheet" type="text/css" href="/css/member.css?kjs2" />
<link rel="stylesheet" type="text/css" href="/css/estimatelist.css?kjs1" />

<style>
.tab .row { margin-top : 4.6rem;}
@media (max-width: 768px) {
	.tab .row { margin-top : 1rem;}
}

@media (max-width: 768px){
.esti_list .abox .status_req {margin-right:0;}
}

</style>

<div class="member com_pd esti_list">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">매입&#47;철거 견적 목록&#160;&#160;<a href='#.' data-toggle='modal' data-target='#esti_guide' class='tooltips'><i class="fa fa-info-circle"></i></a></h1>
			<p class="tit_desc">피커스에 등록된 모든 매입&#47;철거 견적<br class="visible-xs"> 목록을 확인 하실 수 있습니다.			
			</p>
		</div>
		<div id="board">
			<div class="tab">
				<ul class="row">
					<li class="col-lg-2 col-lg-offset-1 col-xs-2 col-xs-offset-1 on main_bg tab14">
						<a class="white tooltips" href="/estimate/estimate_list2.php">전체<span class="white tab1sub"> 목록</span></a>					
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 tab24">
						<a class="tooltips" href="/estimate/estimate_list1.php">맞춤<span class="tab2sub"> 추천 목록</span></a>
						
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 tab34">
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=1">참여<span class="tab3sub"> 견적 목록</span></a>
						
					</li>
					<li class="col-lg-2 col-lg-offset-0 col-xs-2 col-xs-offset-0 tab44">
						<span class="newconnect <?php echo $class_off; ?>"><?php echo $fet_noti_choice['cnt'] ?></span>
						<a class="tooltips" href="/estimate/partner_estimate_list.php?gubun=2">연결<span class="tab4sub"> 목록</span></a>						
						
					</li>
					<li class="col-lg-10 col-md-10 col-xs-10 col-xs-offset-1 srch">
						<a class="tooltips control_btnon" href="javascript:offsrcform()" style="display:none">창 닫기<i class="fa fa-search-minus"></i></a>
						<a class="tooltips control_btnoff" href="javascript:onsrcform()" ><span class="tab5sub"></span>상세 검색<i class="fa fa-search-plus"></i></a>						
						
					</li>
				</ul>
				<br />
			</div>

			<div class="control_wrap" style="display:none">
				<form name="fregisterform" action="./estimate_list2.php" method="get" autocomplete="off">
					<div id="control">
						<div class="controlwrap">
						<div class="col-md-2 col-xs-6 mr5">
							<select id="srchArea1" name="area1">
								<option value="" selected>시도</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-6 mr5">
							<select id="srchArea2" name="area2">
								<option value="" selected>군구</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-6 mr5">
							<select id="srchEType" name="e_type">
								<option value="" selected>종류</option>
								<option value="가전">가전</option>
								<option value="가구">가구</option>
								<option value="주방집기">주방집기</option>
								<option value="헬스용품">헬스용품</option>
								<option value="1">다량매입</option>
								<option value="2">철거/원상복구</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-6 mr5">
							<select id="srchItemCat" name="item_cat">
								<option value="" selected>세부</option>
							</select>
						</div>
						<div class="mob"></div>
						<!--
						<div class="col-md-2 col-xs-6">
							<div class="border">
								<input type="text">
							</div>
						</div>
						-->
						<div class="col-md-1 col-xs-6 mr5">
							<input class="main_bg" type="submit" value="검색">
						</div>
						<div class="col-md-1 col-xs-6">
							<a class="gray_bg" href="./estimate_list2.php">전체</a>
						</div>
						</div>
					</div>
				</form>
			</div>

			<div id="board">
				<a class="col-xs-6 themeblue lorder" href="./estimate_list2.php">최신글 순</a>	
				<form name="finform" action = "./estimate_list2.php" method="post">
					<input type ="hidden" name="deadline_ord" value = "1">
					<input class="col-xs-6 vermillion lorder" type="submit" value="마감일 순">				
				</form>
			
			</div>
			

			<div id="board bclear">
				<div class="member">
					<?php
					for ($i = 0; $row = sql_fetch_array($result); $i++) {
						$state = $row['state'];
						$e_type1 = $row['e_type'];
						$img_path = estimate_img($row['idx']);

						// 썸네일 생성
						$srcfile = G5_DATA_PATH . "/estimate/" . $img_path;
						$filename = basename($srcfile);
						$filepath = dirname($srcfile);
						$thumb = thumbnail($filename, $filepath, $filepath, '350', '350', false);

						$dir_path = explode("/", $img_path);
						$thumb_img = "<img src='/data/estimate/" . $dir_path[0] . "/" . $dir_path[1] . "/" . $dir_path[2] . "/" . $thumb . "'>";

						if ($img_path == "") {    //만약 썸네일 이미지가 없다면,첨부파일 조사
							$imgsql = " select attach_file from {$g5['estimate_list']} where idx = '" . $row['idx'] . "' ";
							$imgphoto = sql_query($imgsql);
							$row1 = sql_fetch_array($imgphoto);
							$file_ext = strtolower(preg_replace('/^.+\.([^\.]{1,})$/', '\\1', $row1['attach_file'])); //file 확장자 추출
							$thumb_img = "<img src='/data/estimate/" . $row1['attach_file'] . "'>";
							if (!$file_ext == "jpg" || !$file_ext == "jpeg" || !$file_ext == "peg" || !$file_ext == "png" || !$file_ext == "gif" || !$file_ext == "bmp") {
								//echo "<script>console.log('등록된 이미지 파일이 없습니다.')</script>";
								$thumb_img = "<img src='/img/pickus_icon.png'>";
							}
						}
					?>
						<div class='req_list'>
							<a href='javascript:doDetailEstimate(<?php echo $row['idx'] ?>);'>
							<div class ="abox">								
								<h4 class="subject title_req"><?php echo $row['title'] ?></h4>
								<div class="thumb_area">
									<?php echo $thumb_img; ?>
								</div>
								<div class='info_area'>

											<div class="end_req">견적마감일 : <?php if (intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) < 1) {
																				echo '오늘';
																			} else if (intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) < 0) {
																				echo '선택중';
																			} else {
																				echo 'D-' . floor(intval(strtotime($row['deadline']) - strtotime(date("Y-m-d"))) / 86400);
																			} ?></div>
											<div class="ea_req">지역 : <?php echo $row['area1'] . ' ' . $row['area2'] ?></div>
											<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
								</div>									
								<div class='status_req'>
									<div class='sub_tt white'><?php echo get_estimate_state($state); ?></div>
							</div>
							
							</div>
							
							</a>
						</div>
					<?php }
					if ($i == 0) {
						echo '<p>견적 내역이 없습니다</p>';
					}
					?>
				</div><!-- list -->

				<div id="page">
					<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?area1=$area1&&area2=$area2&&e_type=$e_type&&item_cat=$item_cat&&page="); ?>
				</div><!-- page -->
			</div>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<? // 도움말 시작 with KJS dance ?>
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content newt">
		<div class="modal-header fallout">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
			<h4 class="modal-title cufflinks" id="myModalLabel">매입/철거 견적 도움말</h4>
		</div>
		<div class="modal-body nomage">
					<div id="slider">					
					<ul>
						<li><img class="" src="/images/GuidedMissiles/est2_tip1.png" alt="guide1">
						<div class="niffler">
							<P class="myass"><span>1.</span>종류별로 견적 목록을 조회합니다.<br></P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;전체 :</span>모든 견적 목록 조회</p>
								<p class="uwin"><span>&#160;&#160;맞춤 :</span>내 지역/품목과 맞는 견적만 조회</p>
								<p class="uwin"><span class="ninja">&#160;&#160;맞춤 :</span>※ 조건은 '내설정' 에서 변경 가능</p>
								<p class="uwin"><span>&#160;&#160;참여 :</span>내가 참여한 견적 목록 조회</p>
								<p class="uwin"><span>&#160;&#160;연결 :</span>고객과 연결된 견적 목록 조회</p>
							</div>
							<P class="myass"><span>2.</span>조건을 입력해 상세 검색을 합니다.</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;※</span>전체 목록에서만 사용가능</p>
							</div>
							<P class="myass"><span>3.</span>목록 순서를 변경하실 수 있습니다.</P>
							<div class="wtsup">
								<p class="uwin"><span>&#160;&#160;등록 순 :</span>최근 등록된 견적부터 조회</p>
								<p class="uwin"><span>&#160;&#160;마감 순 :</span>마감 임박한 견적부터 조회</p>								
							</div>
						</div>
						</li>
						<li><img class="" src="/images/GuidedMissiles/est2_tip2.png" alt="guide2">
						<div class="niffler">
							<P><span>4.</span>견적 제목입니다. 견적글을 터치하면 상세 내용 조회 및 견적에 참여 하실 수 있습니다.</P>
							<P><span>5.</span>해당 견적에 대한 요약 정보입니다.</P>
							<P><span>6.</span>해당 견적의 현재 상태를 표시합니다.</P>							
						</div>						
						</li>
						<li><img class="" src="/images/GuidedMissiles/est2_tip3.png" alt="guide3">
						<div class="niffler">
							<P><span>7.</span>내가 참여한 견적은 '참여' 목록에서 확인 할 수 있습니다.</P>							
							<P class="vermil"><span class="vermil">※</span>내가 참여한 견적글은 다른 목록 에서는 사라집니다. '참여' 목록 에서만 확인 가능합니다.</P>
							<P class="vermil"><span class="vermil">※</span>내가 참여한 견적이 고객에 의해 선택된 경우, 이후 '연결' 목록에서 확인 가능합니다.</P>
							
						</div>
						</li>						
						<li><img class="" src="/images/GuidedMissiles/est2_tip4.png" alt="guide4">
						<div class="niffler">
						<P><span>8.</span>내가 참여한 견적을 고객이 선택한 경우, '연결' 목록 탭 알림을 통해 알려드립니다.<<br>
						해당 견적글은 '연결' 목록에서 확인 가능합니다.
						<P><span>9.</span>고객과 연결된 견적은 '견적선택됨' 으로 상태가 변하게 됩니다.</P>							
							<P class="vermil"><span class="vermil">※</span>이후 진행 완료된 견적도 '연결'목록에서 확인 하실 수 있습니다.</P>
						</div>
					</li>
					</ul>  
					</div>
				<div class="btn_wrap">
					<ul class="row">
						<li class="col-xs-4"><a href="#" class="control_prev">이전</a></li>					
						<li class="col-xs-4"><a class="line_bg l_bg" href="#" data-dismiss="modal">닫기</a></li>
						<li class="col-xs-4"><a href="#" class="control_next">다음</a></li>
					</ul>
				</div><!-- btn_wrap -->
			</div>
		</div><!-- modal-body -->
	</div>
</div>
<? // 도움말 끝 with KJS dance ?>
<style>
	@media(max-width:1024px){
		#page{
			margin-bottom: 50% !important;
		}
	}
</style>
<script type="text/javascript">
	var v_area1 = "<?php echo $area1; ?>";
	var v_area2 = "<?php echo $area2; ?>";
	var v_e_type = "<?php echo $e_type; ?>";
	var v_item_cat = "<?php echo $item_cat; ?>";

	jQuery(document).ready(function() {
		$(".mob_back").hide();

		$('#srchEType').change(function() {
			doChangeEType();
		})

		doSelectArea1();

		if (v_e_type) {
			$("#srchEType").val(v_e_type);
			v_e_type = "";
			doChangeEType();
		}

	});

	function doSelectArea1() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area1.php",
			data: {
				"area1": $('#srchArea1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "<option value=\"\" selected>시/도 전체</option>";
				fvHtml += data;
				$("#srchArea1").html(fvHtml);

				if (v_area1) {
					$("#srchArea1").val(v_area1);
					v_area1 = "";
					doSelectArea2();
				} else {
					fvHtml = "<option value=\"\" selected>시/구/군  전체</option>";
					$("#srchArea2").html(fvHtml);
				}
				$('#srchArea1').change(function() {
					doSelectArea2();
				});
			}
		});
	}

	function doSelectArea2() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
			data: {
				"area1": $('#srchArea1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "";
				if ($("#srchArea1").val()) {
					fvHtml += "<option value=\"\" selected>" + $("#srchArea1").val() + " 전체</option>";
				} else {
					fvHtml += "<option value=\"\" selected>시/도</option>";
				}
				fvHtml += data;
				$("#srchArea2").html(fvHtml);
				if (v_area2) {
					$("#srchArea2").val(v_area2);
					v_area2 = "";
				}

			}
		});
	}

	function doDetailEstimate(idx) {
		location.href = "estimate_form.php?idx=" + idx;
	}

	function doChangeEType() {
		$("#srchItemCat").html("");
		var vEType = $("#srchEType").val();
		if (vEType == "1") {
			$("#srchItemCat").html("<option value='' selected>세부</option>");
		} else if (vEType == "2") {
			var fvHtml = "<option value='' selected>세부</option>";
			var pullKinds = cfnGetRemoveItem();
			for (var i = 0; i < pullKinds.length; i++) {
				fvHtml += "<option value='" + pullKinds[i] + "'>" + pullKinds[i] + "</option>";
			}
			$("#srchItemCat").html(fvHtml);
			if (v_item_cat) {
				$("#srchItemCat").val(v_item_cat);
				v_item_cat = "";
			}
		} else {
			$.ajax({
				type: "POST",
				url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
				data: {
					"category1": $("#srchEType").val()
				},
				cache: false,
				success: function(data) {
					var fvHtml = "<option value='' selected>세부</option>";
					fvHtml += data;
					$("#srchItemCat").html(fvHtml);
					if (v_item_cat) {
						$("#srchItemCat").val(v_item_cat);
						v_item_cat = "";
					}
				}
			});
		}
	}


function onsrcform(){		
	$('.control_wrap').show();
	$('.control_btnon').show();
	$('.control_btnoff').hide();	
		}	
function offsrcform(){
	$('.control_wrap').hide();
	$('.control_btnon').hide();
	$('.control_btnoff').show();	
		}



</script>
<?php

include_once('./_tail.php');
?>