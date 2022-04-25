<?php
include_once('./_common.php');

include_once(G5_PATH . '/head.php');
$g5['title'] = '견적신청';

if ($member['mb_level'] == '2') {
	alert('업체회원은 이용하실 수 없습니다.');
}

//비회원 견젹등록 시 이용약관, 개인정보보호방침 내역 보기 with PSS
$sql = " select * from {$g5['content_table']} where co_id = 'privacy' ";
$row = sql_fetch($sql);
$privacy = $row['co_content'];

$sql = " select * from {$g5['content_table']} where co_id = 'provision' ";
$row = sql_fetch($sql);
$provision = $row['co_content'];

?>
<link rel="stylesheet" type="text/css" href="/css/base2.css?after">
<link rel="stylesheet" type="text/css" href="/css/board2.css" />
<link rel="stylesheet" type="text/css" href="/css/member2.css?after" />
<link rel="stylesheet" type="text/css" href="/css/estimate2.css" />
<link rel="stylesheet" type="text/css" href="/css/new_estimate.css?after" />
<!--GW-전환-견적신청-->
<script>
	gtag('event', 'conversion', {
		'send_to': 'AW-715468370/chWuCOrEiakBENLclNUC',
		'transaction_id': 'estimate'
	});
</script>
<style type="text/css">
	.estimate_image_bg img {
		max-height: 180px;
	}

	.btn_wrap a {
		margin: 0;
	}

	li.col-md-9 {
		overflow: hidden;
	}

	ul#btm_fixed_bar {
		display: none
	}

	@media(max-width: 800px) {
		#txt_simple_pbAgree {
			font-size: 12px;
		}
	}
</style>
<!--NAVER ADS-전환-견적신청-->
<script type="text/javascript">
	var _nasa = {};
	_nasa["cnv"] = wcs.cnv("4", "100000");
</script>


<style type="text/css">
	ul#btm_fixed_bar {
		display: none;
	}

	@media(max-width: 800px) {
		.sub_title {
			padding-top: 10px;
		}

		.sub_title h1 {
			font-size: 26px;
			margin-bottom: 0;
		}

		.form-group {
			margin: 0 !important;
		}

		.btn_cate .col-md-2 {
			width: 25%;
		}

		.sell_single .section_view01 .box input[type="radio"]+i {
			padding: 0px;
		}

		.sell_single .section_view01 .box i p {
			font-size: 12px;
		}

		.btn_cate .col-md-2 {
			padding: 0 5px;
		}

		.form_order {
			padding: 0 25px;
		}

		#content {
			margin-top: 15px;
		}

		.form-group h2.txt_title {
			margin-top: 1em;
		}
	}

	h5.guide_title {
		font-size: 14px !important;
		font-weight: 800 !important;
		font-stretch: normal !important;
		font-style: normal !important;
		line-height: normal !important;
		letter-spacing: normal !important;
		text-align: left !important;
		color: #333333 !important;
		margin-bottom: 15px !important;
	}

	ul.guide_content>li {
		font-size: 14px;
		font-weight: 800;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #333333;
		margin-bottom: 10px;
	}

	em.em_nu {
		color: #0b71c8;
	}

	em.em_un {
		color: #333333;
		border-bottom: 2px solid #0b71c8;
	}
</style>

<div id="process_banner" style="width: 100%; height:450px;">
	<div style="
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-left: 30%; padding-top:7%;">
		<p style="color:#fff;  font-weight: 800;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: normal;text-align:cetner; font-size:24px; margin-bottom:30px;">우리동네 재활용센터 '피커스'</p>
		<p style="color:#fff; text-align:cetner; font-size:20px; margin-bottom:10px;">중고 전문가와 함께 하는 안심거래부터 공간정리까지</p>
		<p style="color:#fff; text-align:cetner; font-size:20px;">총 견적가 : 6,719,266,000원 || 총 파트너 : 230명</p>
	</div>
</div>

<div style="margin-top:65px;" id="margin" class="form_estimate layout_estimate">

	<div class="request">
		<div class="form_wrap layout_wrap">
			<form style="height:100%;" name="frmregister" action="<?php echo G5_URL; ?>/estimate/estimate_register2D_update.php" method="post" enctype="multipart/form-data" autocomplete="off" class="form_order sell_single process_margin layout_form">
				<input type="hidden" name="sub_key" value="<?php echo time(); ?>">
				<input type="hidden" name="e_type" value="1">
				<input type="hidden" name="simple_yn" value="0">
				<input type="hidden" name="test_type" value="B">



				<!--==================================섹션1====================================-->
				<div class="form_section section_view01">
					<div class="header">
						<div class="container_sub_title">
							<p>품목정보입력</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:0%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>0%</p>
							</div>
							<div class="container_title">
								<p>물품정보를 입력주세요!</p>
							</div>

						</div>
					</div>
					<!--===================섹션 - 입력 영역==================-->
					<hr class="hr">

					<div class="form_section_value">
						<div class="form-group btn_cate">

							<ul class="row">
								<li class="col-md-2 title">
									견적제목
								</li>
								<li style="overflow: unset !important;" class="col-md-9">
									<input type="text" id="title" name="title" aria-describedby="ex) 이사정리, 집기정리, 사무정리 등" placeholder="ex) 이사정리, 집기정리, 사무정리 등">
								</li>
							</ul>

						</div>
					</div>
					<hr class="hr">
					<div class="form_section_value">
						<div class="form-group">
							사진을 등록해주세요!
						</div>
						<div class="form-group">
							<div class="row" id="imageList"></div>
						</div><!-- 사진업로드 -->
					</div>
					<hr class="hr">
					<div class="form_section_value">
						<div class="form-group">
							<ul>
								<li class="title">
									참고사항을 작성해주세요!
								</li>
								<li>
									<textarea id="content" name="content" placeholder="품목리스트, 수량, 년식을 적어주세요. EX. 스크래치, 문콕 등&#13;&#10;물품상태에 대해 상세히 적어주세요&#13;&#10;물품에 대해 상세히 작성해 주시면 좀 더 정확한 견적이 가능합니다. "></textarea>
								</li>
							</ul>
						</div>

						<hr class="hr">
					</div>
					<!--===================섹션 - 입력 영역 끝==================-->

					<p class="btng_bottom">
						<a href="#" class="next_section_btn first_btn" onclick="prev_section_btn()" style="left:25%; background: #fff; height:50px;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn third_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션2끝====================================-->


				<!--==================================섹션2====================================-->
				<div class="form_section section_view02">

					<div class="header">
						<div class="container_sub_title">
							<p>수거환경입력</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:25%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>25%</p>
							</div>
							<div class="container_title">
								<p>수거환경을 알려주세요!</p>
							</div>
						</div>
					</div>

					<!--=================섹션 - 입력 영역===================-->
					<hr class="hr">
					<div class="form_section_value">
						<div class="form-group address">
							<ul class="row">
								<li class="col-md-2 title">시.도</li>
								<li style="overflow: unset !important;" class="col-md-9 col-xs-6">
									<select id="area1" name="area1">
										<option value="" selected="selected">선택</option>
									</select>
								</li>

							</ul>
						</div>
						<hr class="hr">
						<div class="form-group address">
							<ul class="row">
								<li class="col-md-2 title">구.군</li>
								<li style="overflow: unset !important;" class="col-md-9 col-xs-6">
									<select id="area2" name="area2">
										<option value="" selected="selected">선택</option>
									</select>
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div style="padding-top:15px;" class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									읍.면.동
								</li>
								<li style="overflow: unset !important;" class="col-md-9 col-xs-8">
									<input type="text" id="area3" name="area3" aria-describedby="읍.면.동을 입력해 주세요" placeholder="읍.면.동을 입력해 주세요">
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div class="form-group qs">
							<div class="col-md-2 title" style="margin-top: 15px;">
								엘리베이터 유무를 알려주세요!
							</div>
							<ul style="justify-content: center;" class="row adr">

								<li class="col-md-2 col-xs-6 btn_check">
									<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn1" onchange="setDisplay()" value="엘리베이터 있음" checked /><i>유</i></label>
								</li>
								<li class="col-md-2 col-xs-6 btn_check">
									<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn2" onchange="setDisplay()" value="엘리베이터 없음" /><i>무</i></label>

								</li>
							</ul>
							<div style="display:none;" id="noneDiv">
								<div style="margin-bottom:10px;" class="col-md-2 title">
									층수를 알려주세요!
								</div>
								<ul class="row">

									<li class="col-md-9">
										<input type="text" id="floor" name="floor" aria-describedby="ex) 아파트 8층" placeholder="ex) 아파트 8층">
									</li>
								</ul>
							</div>
						</div>
						<hr class="hr">
					</div>

					<p class="btng_bottom">
						<a href="#" class="next_section_btn third_btn" onclick="prev_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn fifth_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션3끝====================================-->


				<!--==================================섹션3====================================-->
				<div style="padding-bottom:100px;" class="form_section section_view03">
					<div class="header">
						<div class="container_sub_title">
							<p>날짜선택</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:50%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>50%</p>
							</div>
							<div class="container_title">
								<p>날짜를 골라주세요!</p>
							</div>
						</div>
					</div>
					<!--=================섹션 - 입력 영역===================-->
					<hr class="hr">
					<div class="form_section_value">

						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									견적마감일
								</li>
								<li style="overflow: unset !important;" class="col-md-9">
									<input type="text" readonly="" id="pickup_date_magam" name="pickup_date_magam" aria-describedby="희망 마감날짜를 입력해 주세요" placeholder="희망 마감날짜를 입력해 주세요">
								</li>
							</ul>
						</div>
						<hr class="hr">
						<div class="form-group">
							<ul class="row">
								<li class="col-md-2 title">
									수거요청일
								</li>
								<li style="overflow: unset !important;" class="col-md-9">
									<input type="text" id="pickup_date" name="pickup_date" aria-describedby="희망 수거날짜를 입력해 주세요" placeholder="희망 수거날짜를 입력해 주세요">
								</li>
							</ul>
						</div>
						<hr class="hr">
					</div>
					<p class="btng_bottom">
						<a href="#" class="next_section_btn fourth_btn" onclick="prev_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn sixth_btn" onclick="next_section_btn()">다음</a>
					</p>
				</div>
				<!--==================================섹션3끝====================================-->


				<!--==================================섹션4====================================-->
				<div class="form_section section_view04">
					<div class="header">
						<div class="container_sub_title">
							<p>개인정보입력</p>
						</div>
						<div>
							<div class="progress">
								<div style="width:75%;" class="progressbar"></div>
							</div>
							<div class="progress-desc">
								<p>75%</p>
							</div>
							<div class="container_title">
								<p>개인정보를 입력해주세요!</p>
							</div>
						</div>
					</div>
					<!--=================섹션 - 입력 영역===================-->
					<hr class="hr">
					<div class="form_section_value">
						<?php
						$readonly = "";
						if ($is_member) {
							$readonly = "readonly";
						}
						?>
						<div class="form_wrap" id="divNotLogin">
							<div>
								<div class="form-group">
									<ul class="row">
										<li class="col-md-2 title">
											이름
										</li>
										<li style="overflow: unset !important;" class="col-md-9">
											<input type="text" name="nickname" id="nickname" aria-describedby="이름" placeholder="이름" value="<?php echo $member['mb_name'] ?>" <?php echo $readonly ?>>
											<p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
										</li>
									</ul>
								</div>
								<hr class="hr">

								<div class="form-group">
									<ul class="row">
										<li style="margin-top: 15px;" class="col-md-2 title">
											이메일
										</li>
										<li style="overflow: unset !important;" class="col-md-9">
											<input type="text" name="email" id="email" aria-describedby="이메일" placeholder="이메일" value="<?php echo $member['mb_email'] ?>" <?php echo $readonly ?>>
											<p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
										</li>
									</ul>
								</div>
								<hr class="hr">
								<div class="form-group">
									<ul class="row">
										<li style="margin-top: 15px;" class="col-md-2 title">
											휴대폰 번호
										</li>
										<li style="overflow: unset !important;" class="col-md-9">
											<input placeholder="숫자만 입력해주세요" type="number" name="phone" id="phone" min="0" step="1" aria-describedby="휴대폰 번호" value="<?php echo $member['mb_hp'] ?>">
										</li>
									</ul>

								</div>
								<hr class="hr">
								<?php
								if (!$is_member) {
								?>
									<div style="margin-top:1.2%;" class="form-group">
										<label for="pbAgree" style="margin-top: 15px;" name="pbAgree_lbl">
											<input type="checkbox" id="pbAgree" style="display: none;" />
											<i></i>&nbsp;&nbsp;본인은
											<a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a>
											및
											<a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>에 대한 내용을 모두 이해하였으며 이에 동의합니다.
										</label>
									</div>
									<!--비회원 가입 시 이용약관, 개인정보보호방침 보기 추가 with PSS -->
									<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">이용약관</h4>
												</div>
												<div class="modal-body">
													<div class="scroll">
														<?php echo $provision ?>
													</div>
												</div>
											</div>
										</div>
									</div><!-- 이용약관 -->

									<div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">개인정보보호방침</h4>
												</div>
												<div class="modal-body">
													<div class="scroll">
														<?php echo $privacy ?>
													</div>
												</div>
											</div>
										</div>
									</div>	
								<?php
								}
								?>
							</div>
						</div>
					</div>

					<p class="btng_bottom">
						<a href="#" class="next_section_btn fifth_btn" onclick="prev_section_btn()" style="left:25%; background: #fff;
    color: #0b71c8 !important;
    border: 1px solid;">이전</a>
						<a href="#" class="next_section_btn end_btn" name="click_et" onclick="doRegistEstimate()">견적신청하기</a>
					</p>
				</div>
				<!--==================================섹션6끝====================================-->
				<script>
					// $("a[name='click_et']").click(function() {
					// 	
					// 	$('#load').show();

					// 	return true;

					// });
				</script>

				<div style="display:none;" id="load">
					<p class="loading_font">견적신청중...</p>
				</div>

				<style type="text/css">
					@media(max-width:768px) {
						.loading_font {
							font-size: 24px;
							font-weight: 800;
							color: #1379cd;
							margin: auto;
							margin-top: 70%;
							opacity: 1 !important;
						}

						#load {
							width: 100%;
							height: 100%;
							top: 0;
							left: 0;
							position: fixed;
							display: block;
							opacity: 0.8;
							background: white;
							z-index: 99999999;
							text-align: center;
						}
					}

					@media(min-width:768px) {
						.loading_font {
							font-size: 24px;
							font-weight: 800;
							color: #1379cd;
							margin: auto;
							margin-top: 20%;
							opacity: 1 !important;
						}

						#load {
							width: 100%;
							height: 100%;
							top: 0;
							left: 0;
							position: fixed;
							display: block;
							opacity: 0.8;
							background: white;
							z-index: 99999999;
							text-align: center;
						}
					}
				</style>

				<!-- <div style="display:none; background: #0b71c8;
    padding: 10px;
    border-radius: 10px;" class="form_section section_view07">
					<div class="form_section_value">
						<div class="form_wrap">
							<p style="margin-top:132px; " class="end_content">견적신청이 완료되었습니다!</br>업체에서 확인 후에 연락 드리겠습니다!</p>
							<div style="margin-top:132px; margin-bottom:252px;" class="end_btn_flex"><a style="margin-right:20px;" class="end_btn2" href="">견적신청내역</a><a class="end_btn" href="">홈으로</a></div>
						</div>
					</div>
				</div> -->
			</form>

			<!--스텝별 가이드-->
			<!-- <div class="section_view01" id="process_text">
				<div class="process_text_flex">
					<div class="step_guide_content">
						<p class="step_guide_title">피커스는?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								중고 가전/가구 무료견적, 철거/원상 복구 비교서비스이며 다양한 전문가들을 통해서 서비스를 제공해드리고 있습니다.</div>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">보상제외 가전은?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								고장 및 파손으로 인한 작동이 불가능한 가전</p>
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">빌트인가전(가구와 함께 인테리어 된 가전)</p>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">보상가 감가 사유는?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">사다리차 이용 및 엘리베이터 유/무에 따른 사유</p>
						</div>
					</div>
				</div>
			</div> -->

			<!-- <div class="section_view02" id="process_text">
				<div class="process_text_flex">
					<div class="step_guide_content">
						<p class="step_guide_title">모델명가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								에너지 효율표와 제품의 뒷면에서 찾을 수 있습니다.</div>
						</div>
						<div class="img_flex">
							<img style="width:90px; height:120px;" src="/estimate/img/mdguide1.png">
							<img style="width:90px; height:120px;" src="/estimate/img/mdguide2.png">
							<img style="width:90px; height:120px;" src="/estimate/img/mdguide3.png">
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								모델명을 모르시면 견적을 진행하실수 없습니다.</div>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">제조년식은 어떻게?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								제품정보표에 표시되거나 구매년도, 사용기간입니다.</p>
						</div>
						<div class="img_flex">
							<img style="width:90px; height:120px;" src="/estimate/img/mdguide3.png">
							<img style="width:90px; height:120px;" src="/estimate/img/mdguide4.png">
						</div>
					</div>
				</div>
			</div> -->

			<div class="section_view01" id="process_text">
				<div class="process_text_flex">
					<div class="step_guide_content">
						<p class="step_guide_title">사진가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								물품의 전체사진이나 흠집 사진을 찍어주세요.</div>
						</div>
						<div class="img_flex">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide1.png">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide2.png">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide3.png">
						</div>
						<div class="img_flex">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide4.png">
							<img style="width:90px; height:120px;" src="/estimate/img/phguide5.png">
						</div>

					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">모델명가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								에너지 효율표와 제품의 뒷면에서 찾을 수 있습니다.</div>
						</div>
						<div class="img_flex">
							<img style="width:90px; height:120px;" src="/estimate/img/mdguide1.png">
							<img style="width:90px; height:120px;" src="/estimate/img/mdguide2.png">
							<img style="width:90px; height:120px;" src="/estimate/img/mdguide3.png">
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								모델명을 모르시면 견적을 진행하실수 없습니다.</div>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">참고사항가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								물품의 상태와 특이사항을 적어주세요.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="section_view02" id="process_text">
				<div class="process_text_flex">
					<div class="step_guide_content">
						<p class="step_guide_title">피커스는?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								중고 가전/가구 무료견적, 철거/원상 복구 비교서비스이며 다양한 전문가들을 통해서 서비스를 제공해드리고 있습니다.</div>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">수집환경입력 가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								수거를 진행하시는 파트너님들께서 엘리베이터 유/무에 따라서 견적을 진행하셔서, 꼭 입력해주셔야 합니다.</p>
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">엘리베이터 유/무에 따라 견적가가 달라질 수 있습니다.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="section_view03" id="process_text">
				<div class="process_text_flex">
					<div class="step_guide_content">
						<p class="step_guide_title">피커스는?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								중고 가전/가구 무료견적, 철거/원상 복구 비교서비스이며 다양한 전문가들을 통해서 서비스를 제공해드리고 있습니다.</div>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">날짜선택 가이드</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								견적 마감이과 수거 요청일은 추후 수정이 가능합니다.</p>
						</div>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">견적 마감일에도 견적이 신청되지 않았을 경우에는 재신청을 하실 수 있습니다.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="section_view04" id="process_text">
				<div class="process_text_flex">
					<div class="step_guide_content">
						<p class="step_guide_title">피커스는?</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<div class="step_guide_subtitle">
								중고 가전/가구 무료견적, 철거/원상 복구 비교서비스이며 다양한 전문가들을 통해서 서비스를 제공해드리고 있습니다.</div>
						</div>
					</div>
					<div class="step_guide_content">
						<p class="step_guide_title">정산과정안내</p>
						<div class="dot_flex">
							<div class="dot">●</div>
							<p class="step_guide_subtitle">
								파트너님께서 수거진행, 완료 후에 고객님에게 직접 정산을 해주십니다.</p>
						</div>
					</div>
				</div>
			</div>
			<!--스텝별 가이드 끝-->
		</div>
		<!--form_wrap 끝-->
	</div>
	<!--request 끝-->
	<div class="step_layout">
		<div style="width:100%; margin-bottom:50px;">
			<p class="step_img_title" style="color:#555; text-align: center;">신속하고 간편하게 무료 비교 견적을 원할 땐
				＇피커스＇에게 맡기세요!</p>
		</div>
		<div style="width:240px" class="step_img_margin">
			<p class="step_img_title">1. 간편하게 무료견적신청!</p>
			<img class="step_img" src="/estimate/img/pick1.png">
			<p class="step_img_subtitle">PC, 모바일 상관없이 5분안에 쉽고 빠른 과정을 통해서 간편하게 신청 가능합니다.</p>
		</div>
		<div style="width:271px" class="step_img_margin">
			<p class="step_img_title">2. 다양한 견적을 고르고 선택!</p>
			<img class="step_img" src="/estimate/img/pick2.png">
			<p class="step_img_subtitle">원하시는 파트너님을 선택하시면 파트너님이 고객님께 연락드려서 작업일정을 조율합니다.</p>
		</div>
		<div style="width:311px" class="step_img_margin">
			<p class="step_img_title">3. 전문가를 통해 안전하고 빠르게!</p>
			<img class="step_img" src="/estimate/img/pick3.png">
			<p class="step_img_subtitle">수거일에 맞춰 파트너님들이 직접 방문하셔서 안전하고 빠르게 수거 완료 후 계좌 또는 현금으로 정산됩니다!</p>
		</div>
	</div>
</div>

<!-- 사진 등록 가이드 -->
<div class="modal fade guide" id="img_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">가이드</h4>
			</div>
			<div class="modal-body">
				<div>

					<h5>중고가전/가구매입 시</h5>
					<ul class="row">
						<li>
							<img src="/img/estimate/estimate_popup01.png">
							각 물품의 정면 사진
						</li>
						<li>
							<img src="/img/estimate/estimate_popup02.png">
							가전 및 집기 모델명, 제조년식
						</li>
						<li>
							<img src="/img/estimate/estimate_popup03.png">
							물품 상태 (스크래치, 문콕 등)
						</li>
					</ul>

					<h5>가전 모델명&제조년식 확인 하는 곳</h5>
					<img src="/img/estimate/estimate_popup04.png">
					<ul>
						<li>1. 에너지 효율표와 함께 확인 가능</li>
						<li>2. 냉장/냉동고 내부 양옆 벽면</li>
						<li>3. 세탁기 앞면, 윗면, 양 옆면</li>
						<li>4. 벽걸이 에어컨 옆면, 밑면</li>
						<li>5. 그외 각 제품 뒷면</li>
					</ul>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4">
								<a class="line_bg" href="#" data-dismiss="modal">닫기</a>
							</li>
						</ul>
					</div>
					<!-- btn_wrap -->
				</div>
			</div>
			<!-- modal-body -->
		</div>
	</div>
</div>

<!-- 모델명 확인 가이드 -->
<div class="modal fade guide" id="img_guide_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<h5>가전 모델명&제조년식 확인 하는 곳</h5>
					<img src="/img/estimate/estimate_popup04.png">
					<ul>
						<li>1. 에너지 효율표와 함께 확인 가능</li>
						<li>2. 냉장/냉동고 내부 양옆 벽면</li>
						<li>3. 세탁기 앞면, 윗면, 양 옆면</li>
						<li>4. 벽걸이 에어컨 옆면, 밑면</li>
						<li>5. 그외 각 제품 뒷면</li>
					</ul>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4">
								<a class="line_bg" href="#" data-dismiss="modal">닫기</a>
							</li>
						</ul>
					</div>
					<!-- btn_wrap -->
				</div>
			</div>
			<!-- modal-body -->
		</div>
	</div>
</div>


<!-- 이용후기 -->

<script type="text/javascript">
	var imageMaxCnt = 9;
	var estimateCnt = 0;

	var section_toggle = 1;
	var request_parner = 0;

	var request_parner_cnt = 0;

	function next_section_btn() {
		if (!doCheckForm(section_toggle)) return;
		if (section_toggle == 1) {
			$("#two").addClass("active");

			$(".section_view01").css("display", "none");
			$(".section_view02").css("display", "block");
			section_toggle = 2;
		} else if (section_toggle == 2) {
			$("#three").addClass("active");
			$(".section_view02").css("display", "none");
			$(".section_view03").css("display", "block");
			section_toggle = 3;
		} else if (section_toggle == 3) {
			$("#three").addClass("active");
			$(".section_view03").css("display", "none");
			$(".section_view04").css("display", "block");
			section_toggle = 4;
		}

	}

	function prev_section_btn() {
		if (section_toggle == 2) {
			$("#two").removeClass("active");
			$(".section_view01").css("display", "block");
			$(".section_view02").css("display", "none");
			section_toggle = 1;
		} else if (section_toggle == 3) {
			$("#three").removeClass("active");
			$(".section_view02").css("display", "block");
			$(".section_view03").css("display", "none");
			section_toggle = 2;
		} else if (section_toggle == 4) {
			$("#three").removeClass("active");
			$(".section_view03").css("display", "block");
			$(".section_view04").css("display", "none");
			section_toggle = 3;
		}

	}


	$(document).ready(function() {

		$.datepicker.setDefaults({
			dateFormat: 'yymmdd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			dayNames: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			showMonthAfterYear: true,
			yearSuffix: '년'
		});

		var now = new Date();

		var Year = now.getFullYear();

		var Month = now.getMonth() + 1;
		if (Month < 10) Month = "0" + Month

		var Day = now.getDate();
		if (Day < 10) Day = "0" + Day

		var toDate = Year + "-" + Month + "-" + Day;

		var date = $.datepicker.parseDate("yy-mm-dd", toDate);

		$("#pickup_date").datepicker({
			dateFormat: "yy-mm-dd",
			language: "kr",
			minDate: date
		}).change(function() {

			var t1 = $('#pickup_date').val().split("-");
			var t2 = toDate.split("-"); // 오늘

			var t1_date = new Date(t1[0], t1[1], t1[2]);
			var t2_date = new Date(t2[0], t2[1], t2[2]);

			var diff = t1_date - t2_date;
			var currDay = 24 * 60 * 60 * 1000;

			if (parseInt(diff / currDay) > 29) {
				alert('견적변동이 가능하여 업체견적이 늦을 수도 있습니다.');
			}

		});
		$("#pickup_date_magam").datepicker({
			dateFormat: "yy-mm-dd",
			language: "kr",
			minDate: date
		}).change(function() {

			var t1 = $('#pickup_date_magam').val().split("-");
			var t2 = toDate.split("-"); // 오늘

			var t1_date = new Date(t1[0], t1[1], t1[2]);
			var t2_date = new Date(t2[0], t2[1], t2[2]);

			var diff = t1_date - t2_date;
			var currDay = 24 * 60 * 60 * 1000;

			if (parseInt(diff / currDay) > 29) {
				alert('견적변동이 가능하여 업체견적이 늦을 수도 있습니다.');
			}

		});
		$("#item_qty").inputFilter(function(value) {
			return /^\d*$/.test(value);
		});


		$("#use_year").html(cfnEstimateYearsCombo("선택"));

		$('#use_year').change(function() {
			$('#year').val($("#use_year option:selected").text());
			var itemCat = $('input[name="item_cat"]:checked').val();
			if (itemCat) {
				var vYear = $("#use_year").val();
				if (itemCat == "가구") {
					if (vYear >= 5) {
						alert("년식이 오래되어 무료수거나 수거 불가 할 수도 있습니다.");
					}
				} else {
					if (vYear >= 10) {
						alert("년식이 오래되어 무료수거나 수거 불가 할 수도 있습니다.");
					}
				}

			}
		});

		$(document).on("click", ".delete_item", function() {
			$(this).closest("tr").remove();
			estimateCnt--;
		});

		doInitImage2("250");
		doSelectArea1();

		$('#item_cat_s').change(function() {
			doSelectCategory2();

		});

		$('#item_cat_dtl_s').change(function() {
			doSelectCategory3();

		});

		$("#attfile").bind('change', function() {
			$("#attfilename").html(this.files[0].name);
		});

		doSelectCategory1();

	});

	function doSelectArea1() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.area1.php",
			data: {
				"area1": $('#area1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "<option value=\"\" selected>선택</option>";
				fvHtml += data;
				$("#area1").html(fvHtml);
				fvHtml = "<option value=\"\" selected>선택</option>";
				$("#area2").html(fvHtml);
				$('#area1').change(function() {
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
				"area1": $('#area1').val()
			},
			cache: false,
			success: function(data) {
				var fvHtml = "";
				fvHtml += "<option value=\"\" selected>선택</option>";
				fvHtml += data;
				$("#area2").html(fvHtml);
				$('#area2').change(function() {
					doSelectPartner();
				});

			}
		});
	}

	function doSelectPartner() {
		request_parner = 0;
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.partner.php",
			data: {
				"area1": $('#area1').val(),
				"area2": $('#area2').val(),
				"e_type": "1"
			},
			cache: false,
			success: function(data) {
				if (data) {
					request_parner_cnt = 1;
				} else {
					request_parner_cnt = 0;
				}
				$("#recommand_list").html(data);
			}
		});
	}

	function doSelectCategory1() {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.category1.php",
			data: {},
			cache: false,
			success: function(data) {
				var fvHtml = "<option value=\"\" selected>선택</option>";
				fvHtml += data;
				$("#item_cat_s").html(fvHtml);
			}
		});
	}

	function doSelectCategory2() {
		var itemCat = $('#item_cat_s').val();
		if (itemCat == "가구") {
			$("#divModelName").hide();
		} else {
			$("#divModelName").show();
		}
		if (itemCat == "가전") {
			$("#spanYear").html("*가전 제조년식을 넣어주세요");
		} else if (itemCat == "가구") {
			$("#spanYear").html("*가구 사용년식을 넣어주세요");
		} else {
			//$("#spanYear").html("");.
			if (itemCat) {
				$("#spanYear").html(itemCat + " 제조년식을 넣어주세요");
				$("#spanYear").show();
			} else {
				$("#spanYear").hide();
			}
		}

		$("#manufacturer_s").val("");
		$("#medel_name").val("");
		$("#year").val("");
		$("#use_year").val("");

		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
			data: {
				category1: $('#item_cat_s').val()
			},
			cache: false,
			success: function(data) {
				$('#item_cat_dtl_etc').hide();
				$('#manufacturer_etc').hide();
				$("#item_cat_dtl_s").html("");
				var fvHtml = "<option value=\"\" selected>선택</option>";
				$("#manufacturer_s").html(fvHtml);
				if ($('#item_cat_s').val()) {
					fvHtml += data;

					$("#item_cat_dtl_s").html(fvHtml);
					$('#item_cat_dtl_s').change(function() {
						$('#item_cat_dtl_etc').val("");
						if ($(this).val() == "직접입력") {
							$('#item_cat_dtl_etc').show();
						} else {
							$('#item_cat_dtl_etc').hide();
						}
					});


				}
				$("#item_cat_dtl_s").html(fvHtml);
			}
		});
	}

	function doSelectCategory3() {

		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.category3.php",
			data: {
				category1: $('#item_cat_s').val(),
				category2: $('#item_cat_dtl_s').val()
			},
			cache: false,
			success: function(data) {
				$('#manufacturer_etc').hide();
				var fvHtml = "<option value=\"\" selected>선택</option>";
				if ($('#item_cat_dtl_s').val()) {
					fvHtml += data;
				}
				$("#manufacturer_s").html(fvHtml);

				$('#manufacturer_s').change(function() {
					$('#manufacturer_etc').val("");
					if ($(this).val() == "직접입력") {
						$('#manufacturer_etc').show();
					} else {
						$('#manufacturer_etc').hide();
					}
				});
			}
		});
	}

	function doAddItem() {
		if (estimateCnt == 9) {
			alert("최대 9개까지만 등록하실수 있습니다.");
			return;
		}
		$('#item_cat_s').val("");
		$('#manufacturer_s').val("");
		$('#manufacturer_etc').val("");
		$('#medel_name').val("");
		$('#item_qty').val("1");
		$('#use_year').val("");
		$('#year').val("");
		doSelectCategory2();
		doSelectCategory3();
		$("#spanYear").hide();
		$("#divAddItem").show();
		$("#divModifyItem").hide();

		$('#modal_regist_item').modal();
	}

	function doSaveItem() {
		if (!cfnNullCheckSelect($('#item_cat_s').val(), "품목")) return;
		var itemCatDtl = $("#item_cat_dtl_s").val();
		if (itemCatDtl == "직접입력") {
			itemCatDtl = $("#item_cat_dtl_etc").val();
		}

		var manufacturer = $("#manufacturer_s").val();
		if (manufacturer == "직접입력") {
			manufacturer = $("#manufacturer_etc").val();
		}

		if (!cfnNullCheckSelect(itemCatDtl, "세부카테고리")) return;
		if (!cfnNullCheckInput(manufacturer, "제조사")) return;

		if (!cfnNullCheckInput($('#item_qty').val(), "수량")) return;
		if (!cfnNullCheckInput($('#use_year').val(), "연식")) return;
		var itemCat = $('#item_cat_s').val();
		if (itemCat != "가구") {
			//if(!cfnNullCheckInput($("#medel_name").val(), "모델명")) return;
		}

		var vHtml = "";
		vHtml += "<tr>";
		vHtml += "<input type='hidden' name='item_cat[]' value='" + $("#item_cat_s").val() + "'>";
		vHtml += "<input type='hidden' name='item_cat_dtl[]' value='" + itemCatDtl + "'>";
		vHtml += "<input type='hidden' name='manufacturer[]' value='" + manufacturer + "'>";
		vHtml += "<input type='hidden' name='medel_name[]' value='" + $("#medel_name").val() + "'>";
		vHtml += "<input type='hidden' name='year[]' value='" + $("#year").val() + "'>";
		vHtml += "<input type='hidden' name='use_year[]' value='" + $("#use_year").val() + "'>";
		vHtml += "<input type='hidden' name='item_qty[]' value='" + $("#item_qty").val() + "'>";
		vHtml += "<td>" + $("#item_cat_s").val() + "</td>";
		vHtml += "<td>" + itemCatDtl + "</td>";
		vHtml += "<td>" + manufacturer + "</td>";
		vHtml += "<td>" + $("#medel_name").val() + "</td>";
		vHtml += "<td>" + $("#year").val() + "</td>";
		vHtml += "<td>" + $("#item_qty").val() + "</td>";
		vHtml += "<td><a class='form_btn line_bg delete_item' href='javascript:' >삭제</a></td>";
		vHtml += "</tr>";

		$("#multiList").append(vHtml);
		estimateCnt++;
		doAddItem();
	}

	function doCompleteItem() {
		if (!cfnNullCheckSelect($('#item_cat_s').val(), "품목")) return;
		var itemCatDtl = $("#item_cat_dtl_s").val();
		if (itemCatDtl == "직접입력") {
			itemCatDtl = $("#item_cat_dtl_etc").val();
		}

		var manufacturer = $("#manufacturer_s").val();
		if (manufacturer == "직접입력") {
			manufacturer = $("#manufacturer_etc").val();
		}

		if (!cfnNullCheckSelect(itemCatDtl, "세부카테고리")) return;
		if (!cfnNullCheckInput(manufacturer, "제조사")) return;

		if (!cfnNullCheckInput($('#item_qty').val(), "수량")) return;
		if (!cfnNullCheckInput($('#use_year').val(), "연식")) return;
		var itemCat = $('#item_cat_s').val();
		if (itemCat != "가구") {
			//if(!cfnNullCheckInput($("#medel_name").val(), "모델명")) return;
		}

		var vHtml = "";
		vHtml += "<tr>";
		vHtml += "<input type='hidden' name='item_cat[]' value='" + $("#item_cat_s").val() + "'>";
		vHtml += "<input type='hidden' name='item_cat_dtl[]' value='" + itemCatDtl + "'>";
		vHtml += "<input type='hidden' name='manufacturer[]' value='" + manufacturer + "'>";
		vHtml += "<input type='hidden' name='medel_name[]' value='" + $("#medel_name").val() + "'>";
		vHtml += "<input type='hidden' name='year[]' value='" + $("#year").val() + "'>";
		vHtml += "<input type='hidden' name='use_year[]' value='" + $("#use_year").val() + "'>";
		vHtml += "<input type='hidden' name='item_qty[]' value='" + $("#item_qty").val() + "'>";
		vHtml += "<td>" + $("#item_cat_s").val() + "</td>";
		vHtml += "<td>" + itemCatDtl + "</td>";
		vHtml += "<td>" + manufacturer + "</td>";
		vHtml += "<td>" + $("#medel_name").val() + "</td>";
		vHtml += "<td>" + $("#year").val() + "</td>";
		vHtml += "<td>" + $("#item_qty").val() + "</td>";
		vHtml += "<td><a class='form_btn line_bg delete_item' href='javascript:' >삭제</a></td>";
		vHtml += "</tr>";

		$("#multiList").append(vHtml);
		estimateCnt++;
		$('#modal_regist_item').modal('hide');
	}

	function doSimpleEstimate() {
		$("#simple_content").val("");
		$("#modal_regist_simple").modal();
	}

	function doSaveSimpleEstimate() {
		if (!cfnNullCheckInput($("#simple_nickname").val(), "이름")) return;
		if (!cfnNullCheckInput($("#simple_email").val(), "이메일")) return;
		if (!cfnNullCheckInput($("#simple_phone").val(), "연락처")) return;
		<?php
		if (!$is_member) {
		?>
			if (!validateEmail($("#simple_email").val())) {
				alert("이메일 형식이 잘못되었습니다.");
				return false;
			}

			if (!$("#simple_pbAgree").prop("checked")) {
				alert("이용약관에 동의해주세요!");
				return false;
			}
		<?php
		}
		?>
		if (!cfnNullCheckInput($("#simple_content").val(), "참고사항")) return;

		var f = document.frmsimple;
		$('#load').show();
		f.submit();
	}

	function doCheckForm(vGubun) {
		if (vGubun == "1") {
			if (!cfnNullCheckInput($("#title").val(), "견적제목")) return false;
			if (!cfnNullCheckInput($("#content").val(), "참고사항")) return false;
			if (photo_count == 0) {
				alert("사진을 등록하십시오.");
				return false;
			}

		} else if (vGubun == "2") {
			if (!cfnNullCheckSelect($("#area1").val(), "시.도")) return false;
			if (!cfnNullCheckSelect($("#area2").val(), "구.군")) return false;
			if (!cfnNullCheckInput($("#area3").val(), "읍.면.동")) return false;
			if ($('input:radio[id=elevator_yn2]').is(':checked')) {
				if (!cfnNullCheckInput($("#floor").val(), "층수"))
					return false;
			}

		} else if (vGubun == "3") {
			if (!cfnNullCheckInput($("#pickup_date").val(), "수거요청일")) return false;
			if (!cfnNullCheckInput($("#pickup_date_magam").val(), "견적마감일")) return false;
			var req_Array = $('#pickup_date').val().split('-');
			var close_Array = $('#pickup_date_magam').val().split('-');

			var date_req = new Date(req_Array[0], req_Array[1], req_Array[2]);
			var date_close = new Date(close_Array[0], close_Array[1], close_Array[2]);

			if (date_req.getTime() < date_close.getTime()) {
				alert('마감일이 수거요청일보다 뒤에 있을 수 없습니다.');
				return false;
			}

			//수거요청일은 마감일 이후로 선택 처리 wtih PSS
			if (date_req.getTime() == date_close.getTime()) {
				alert('마감일과 수거요청일은 같을 수 없습니다. \n수거요청일은 마감일 이후여야 입니다.');
				return false;
			}
		}

		return true;
	}

	function doRegistEstimate() {
		if (!cfnNullCheckSelect($("#area1").val(), "기본주소")) return;
		if (!cfnNullCheckSelect($("#area2").val(), "기본주소")) return;
		if (!cfnNullCheckInput($("#area3").val(), "상세주소")) return;
		if ($('input:radio[id=elevator_yn2]').is(':checked')) {
			if (!cfnNullCheckInput($("#floor").val(), "층수"))
				return false;
		}
		if (!cfnNullCheckInput($("#pickup_date").val(), "수거요청일")) return;
		if (!cfnNullCheckInput($("#title").val(), "견적제목")) return;

		if (!cfnNullCheckInput($("#content").val(), "참고사항")) return;


		if (photo_count == 0) {
			alert("사진을 등록하십시오.");
			return;
		}

		if (!cfnNullCheckInput($("#nickname").val(), "이름")) return;
		if (!cfnNullCheckInput($("#email").val(), "이메일")) return;
		if (!cfnNullCheckInput($("#phone").val(), "연락처")) return;
		<?php
		if (!$is_member) {
		?>
				if (!cfnNullCheckInput($("#nickname").val(), "이름")) return;
			if (!cfnNullCheckInput($("#email").val(), "이메일")) return;

			if (!validateEmail($("#email").val())) {
				alert("이메일 형식이 잘못되었습니다.");
				return false;
			}

			if (!cfnNullCheckInput($("#phone").val(), "연락처")) return;

			if (!$("#pbAgree").prop("checked")) {
				alert("이용약관에 동의해주세요!");
				return false;
			}
		<?php
		}
		?>
		$(".layer").removeClass("hidden");

		var f = document.frmregister;
		f.submit();
	}

	function doRequsetPartner(idx) {
		var rp_chk = $("#rc_email_chk_" + idx).val();
		if (rp_chk == "N") {
			$("#rc_email_chk_" + idx).val("Y");
			$("#request_" + idx).removeClass("main_bg");
			$("#request_" + idx).addClass("sub_bg");
			$("#request_" + idx).html("문의중");
			request_parner++;
		} else {
			$("#rc_email_chk_" + idx).val("N");
			$("#request_" + idx).removeClass("sub_bg");
			$("#request_" + idx).addClass("main_bg");
			$("#request_" + idx).html("문의하기");
			request_parner--;
		}
	}

	function setDisplay() {
		if ($('input:radio[id=elevator_yn1]').is(':checked')) {
			$('#noneDiv').hide();
		} else {
			$('#noneDiv').show();
		}
	}
</script>
<?php
include_once(G5_PATH . '/tail.php');
?>