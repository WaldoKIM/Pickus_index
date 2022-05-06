<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="info_visual_wrap">
    <div class="info_visual_img info_default_img">
        <div class="inner">
            <div class="info_visual_text visual_txt">
                <h6 class="wow fadeInDown" data-wow-delay="0.5s">회원가입</h6>
                <p class="wow fadeInDown" data-wow-delay="0.7s">회원정보를 입력해주세요. </p>
            </div>
        </div>
    </div>
</div>
<div class="inner">
	<ul class="register_way">
        <li data-tab="tab1">
            <a href="./register_form.php?registerType=customer">일반회원가입</a>
        </li>
        <li class="current" data-tab="tab2">
            <a href="#none">파트너회원가입</a>
        </li>
    </ul>
	<div class="register">
	<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
	<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
	<script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
	<?php } ?>

		<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="url" value="<?php echo $urlencode ?>">
		<input type="hidden" name="agree" value="<?php echo $agree ?>">
		<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
		<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
		<input type="hidden" name="cert_no" value="">
        <input type="hidden" id="mb_biz_type" name="mb_biz_type" value="<?php echo $biztype ?>">
		<input type="hidden" name="mb_level" value="1">
		<input type="hidden" name="mb_id">
		<input type="hidden" name="mb_name">
		<input type="hidden" name="mb_password">
		<input type="hidden" name="mb_password_type" value="md5">
		<input type="hidden" name="mb_biz_goods_item">
		<input type="hidden" name="mb_biz_goods_year">
		<input type="hidden" name="mb_biz_remove_item">
		<input type="hidden" name="mb_biz_remove_etc">
		<input type="hidden" name="mb_biz_charge_rate" value="10">
		<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
		<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
		<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
		<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
		<?php }  ?>
        <div class="form-group" style="padding-bottom: 50px;">
			<ul class="way" id="divBizType">
				<li class="current" data-tab="tab1">
					<a href="#none">재활용 센터</a>
				</li>
				<li data-tab="tab2">
					<a href="#none">철거업체</a>
				</li>
				<li id="two_line" data-tab="tab3">
					<a href="#none">센터, 업체 둘다</a>
				</li>
			</ul>
		</div>
		<div id="register_form" class="form_01">
			<div class="register_form_inner register_form_flex">
				<ul>
                    <li>
                        <label for="mb_biz_name">센터이름<strong class="sound_only">필수</strong></label>
                        <input type="text" id="mb_biz_name" name="mb_biz_name" <?php echo $required ?> class="frm_input full_input required" aria-describedby="센터이름" placeholder="센터이름">
                    </li>
                    <li>
						<label for="reg_mb_email">E-mail<strong class="sound_only">필수</strong>
						<?php if ($config['cf_use_email_certify']) {  ?>
						<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
						<span class="tooltip">
							<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
							<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
						</span>
						<?php } ?>
						</label>
						<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
						<input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email full_input required" size="70" maxlength="100" placeholder="E-mail">
					</li>
					<li class=" left_input margin_input">
						<label for="reg_mb_password">비밀번호<strong class="sound_only">필수</strong></label>
						<input type="password" name="password_new" id="reg_mb_password" <?php echo $required ?> class="frm_input full_input <?php echo $required ?>" minlength="3" maxlength="20" placeholder="비밀번호">
					</li>
					<li class=" left_input">
						<label for="reg_mb_password_re">비밀번호 확인<strong class="sound_only">필수</strong></label>
						<input type="password" name="password_new_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input full_input <?php echo $required ?>" minlength="3" maxlength="20" placeholder="비밀번호 확인">
					</li>
					<li>
					<?php if ($config['cf_use_hp'] || $config['cf_cert_hp']) {  ?>
						<label for="reg_mb_hp">센터전화번호<?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
						
						<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input full_input <?php echo ($config['cf_req_hp'])?"required":""; ?>" maxlength="20" placeholder="센터전화번호">
						<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
						<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
						<?php } ?>
					<?php }  ?>
					</li>
					<li>
						<label>주소</label>
						<strong class="sound_only">필수</strong>
						<label for="mb_biz_post" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
						<input type="text" name="mb_biz_post" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="mb_biz_post" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input twopart_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6"  placeholder="우편번호">
						<button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_biz_post', 'mb_biz_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">검색</button><br>
						<input type="text" name="mb_biz_addr1" value="<?php echo get_text($member['mb_biz_addr1']) ?>" id="mb_biz_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address full_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="50"  placeholder="센터주소">
						<label for="mb_biz_addr1" class="sound_only">기본주소<?php echo $config['cf_req_addr']?'<strong> 필수</strong>':''; ?></label><br>
						<input type="text" name="mb_biz_addr2" value="<?php echo get_text($member['mb_biz_addr2']) ?>" id="mb_biz_addr2" class="frm_input frm_address full_input" size="50" placeholder="상세주소">
						<label for="mb_biz_addr2" class="sound_only">상세주소</label>
						<br>
						<input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="frm_input frm_address full_input" size="50" readonly="readonly" placeholder="참고항목">
						<label for="reg_mb_addr3" class="sound_only">참고항목</label>
						<input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
					</li>
					<li>
						<label for="mb_bank">정산계좌번호<strong class="sound_only">필수</strong></label>
						<input type="hidden" name="mb_bank" id="mb_bank" value="NH농협">
							<select id="mb_bank_select">
								<option value="NH농협">NH농협</option>
								<option value="우리은행">우리은행</option>
								<option value="국민은행">국민은행</option>
								<option value="기업은행">기업은행</option>
								<option value="신한은행">신한은행</option>
								<option value="하나은행">하나은행</option>
								<option value="SC은행">SC은행</option>
								<option value="카카오뱅크">카카오뱅크</option>
								<option value="산업은행">산업은행</option>
								<option value="대구은행">대구은행</option>
								<option value="광주은행">광주은행</option>
								<option value="전북은행">전북은행</option>
								<option value="한국씨티은행">한국씨티은행</option>
								<option value="부산은행">부산은행</option>
								<option value="수협은행">수협은행</option>
								<option value="경남은행">경남은행</option>
								<option value="기타은행입력">기타은행입력</option>
							</select>
						<input id="mb_bank_txt" class="frm_input" style="display: none" type="text" name="mb_bank_txt" placeholder="은행명">
						<input type="number" id="mb_bank_num" class="frm_input full_input" name="mb_bank_num" aria-describedby="계좌번호" placeholder="정산계좌번호">
					</li>
					<li>
						<label for="mb_photo_bizcard">사업자등록증<strong class="sound_only">필수</strong></label>
						<input type="file" id="mb_photo_bizcard" name="mb_photo_bizcard" aria-describedby="사업자등록증" placeholder="사업자등록증">
					</li>
					<li>
						<label for="mb_photo_site">사업장정면or내부사진<strong class="sound_only">필수</strong></label>
						<input type="file" id="mb_photo_site" name="mb_photo_site" aria-describedby="사업장사진" placeholder="사업장사진">
					</li>
					<li>
						<label for="mb_photo">담당자사진<strong class="sound_only">필수</strong></label>
						<input type="file" id="mb_photo" name="mb_photo" aria-describedby="담당자사진" placeholder="담당자사진">
					</li>
				</ul>
				<h2>담당자정보</h2>
				<ul>
					<li class=" left_input">
						<label for="mb_biz_worker_name">담당자이름<strong class="sound_only">필수</strong></label>
						<input type="text" name="mb_biz_worker_name" id="mb_biz_worker_name" <?php echo $required ?> class="frm_input full_input <?php echo $required ?>"  placeholder="담당자이름">
					</li>
					<li class=" left_input">
						<label for="mb_biz_worker_phone">담당자전화번호<strong class="sound_only">필수</strong></label>
						<input type="text" name="mb_biz_worker_phone" id="mb_biz_worker_phone" <?php echo $required ?> class="frm_input full_input <?php echo $required ?>"  placeholder="담당자전화번호">
					</li>
					<li class=" left_input">
						<label for="mb_biz_intro">업체소개글<strong class="sound_only">필수</strong></label>
						<textarea name="mb_biz_intro" id="mb_biz_intro" <?php echo $required ?> class="frm_input full_input <?php echo $required ?>"  placeholder="업체소개글" style="height:270px;"></textarea>
					</li>
				</ul>
				<h2>견적설정</h2>
				<ul>
					<li class=" left_input">
						<label for="mb_biz_worker_name">수거/철거 주 지역<br>* 여러 지역 설정이 가능합니다.<strong class="sound_only">필수</strong></label>
						<select id="area1" name="area1">
							<option>시/도</option>
						</select>
						<select id="area2" name="area2">
							<option>시/구/군</option>
						</select>
						<a class="main_bg form_btn" href="javascript:doSaveArea()">지역 추가</a>
						<div class="col-xs-12" id="divArea"></div>
					</li>
					<li class=" left_input">
						<label for="mb_biz_worker_phone">담당자전화번호<strong class="sound_only">필수</strong></label>
						<input type="text" name="mb_biz_worker_phone" id="mb_biz_worker_phone" <?php echo $required ?> class="frm_input full_input <?php echo $required ?>"  placeholder="담당자전화번호">
					</li>
					<li class=" left_input">
						<label for="mb_biz_intro">업체소개글<strong class="sound_only">필수</strong></label>
						<textarea name="mb_biz_intro" id="mb_biz_intro" <?php echo $required ?> class="frm_input full_input <?php echo $required ?>"  placeholder="업체소개글" style="height:270px;"></textarea>
					</li>
				</ul>
			</div>
			<div id="fregister">
				<section id="fregister_term">
            		<h2>회원가입약관</h2>
            		<textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
        		</section>
				<section id="fregister_term">
            		<h2>개인정보처리방침</h2>
            		<textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea>
       			</section>
			</div>
			<div class="tbl_frm01 tbl_wrap register_form_inner ">
				<h2>동의설정</h2>
				<ul>
					<li class="chk_box">
						<input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling'])?'checked':''; ?> class="selec_chk">
						<label for="reg_mb_mailling">
							<span></span>
							<b class="sound_only">메일링서비스</b>
						</label>
						<span class="chk_li">정보 메일을 받겠습니다.</span>
					</li>
					<li class="chk_box">
						<input type="checkbox" id="pbAgree" checked class="selec_chk">
						<label for="pbAgree">
							<span></span>
							<b class="sound_only">약관동의</b>
						</label>
						<span class="chk_li">회원가입약관과 개인정보처리방침에 동의합니다.</span>
					</li>
		
					<?php //if ($config['cf_use_hp']) { ?>
					<!-- <li class="chk_box">
						<input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?php echo ($w=='' || $member['mb_sms'])?'checked':''; ?> class="selec_chk">
						<label for="reg_mb_sms">
							<span></span>
							<b class="sound_only">SMS 수신여부</b>
						</label>        
						<span class="chk_li">휴대폰 문자메세지를 받겠습니다.</span>
					</li> -->
					<?php //} ?>
		
					<?php
					//회원정보 수정인 경우 소셜 계정 출력
					if( $w == 'u' && function_exists('social_member_provider_manage') ){
						social_member_provider_manage();
					}
					?>
					
					<?php if ($w == "" && $config['cf_use_recommend']) {  ?>
					<li>
						<label for="reg_mb_recommend" class="sound_only">추천인아이디</label>
						<input type="text" name="mb_recommend" id="reg_mb_recommend" class="frm_input" placeholder="추천인아이디">
					</li>
					<?php }  ?>
		
					<li class="is_captcha_use">
						자동등록방지
						<?php echo captcha_html(); ?>
					</li>
				</ul>
			</div>
		</div>
		<div class="btn_confirm">
			<a href="<?php echo G5_URL ?>" class="btn_close">취소</a>
			<button type="submit" id="btn_submit" class="btn_submit" accesskey="s"><?php echo $w==''?'회원가입':'정보수정'; ?></button>
		</div>
		</form>
	</div>
</div>
<script>
	var vBizType;
	jQuery(document).ready(function() {
		doInitImageAjax("mb_photo", "divPhoto", "담당자 사진");
		doInitImageAjax("mb_photo_site", "divPhotoSite", "사업장 정면 또는 내부 사진");
		vBizType = $("#mb_biz_type").val();
		cfnBizTypes("divBizType", vBizType, "./register_partner_form.php");
		cfnGoodsItem("divGoodsItem", "가전", "2006년");
		cfnRemoveItem("divRemoveItem", "", "");

		$('#mb_bank_select').change(function() {
			if ($(this).val() == '기타은행입력') {
				$('#mb_bank_txt').css('display', 'block');
				$("#mb_bank").val('');
			} else {
				$('#mb_bank_txt').css('display', 'none');
				$("#mb_bank").val($(this).val());
			}
		});

		if (vBizType == "1") {
			$("#divGoodsItemList").show();
			$("#divRemoveItemList").hide();
		} else if (vBizType == "2") {
			$("#divRemoveItemList").show();
			$("#divGoodsItemList").hide();
		} else if (vBizType == "3") {
			$("#divGoodsItemList").show();
			$("#divRemoveItemList").show();
		}

		$('input[name="goodsItem"]').click(function() {
			var vId = $(this).attr('id');
			var vIdx = vId.replace("goodsItem", "");
			var vValue = $(this).val();
			if ($(this).is(':checked')) {
				if (vValue == "모두수거") {
					$("input:checkbox[name='goodsItem']").each(function() {
						this.checked = true;
					});
					for (var i = 0; i < cfnGoodsItemLength() - 1; i++) {
						$("#goodsYear" + i).show();
						$("#goodsYear" + vIdx).val("1");
					}
				}
				$("#goodsYear" + vIdx).show();
				$("#goodsYear" + vIdx).val("1");
			} else {
				if (vValue == "모두수거") {
					$("input:checkbox[name='goodsItem']").each(function() {
						this.checked = false;
					});
					for (var i = 0; i < cfnGoodsItemLength() - 1; i++) {
						$("#goodsYear" + i).hide();
					}
				}
				$("#goodsYear" + vIdx).hide();
			}

		});

		$('#goodsYear4').change(function() {
			var vValue = $(this).val();
			for (var i = 0; i < cfnGoodsItemLength() - 1; i++) {
				$("#goodsYear" + i).val(vValue);
			}
		});

		$('input[name="removeItem"]').click(function() {
			var vValue = $(this).val();
			var vId = $(this).attr('id');
			var vIdx = vId.replace("removeItem", "");
			var vSeq = cfnRemoveItemLength();
			if (vIdx == vSeq) {
				$("#removeEtc").val("");
				if ($(this).is(':checked')) {
					$("#removeEtc").show();
				} else {
					$("#removeEtc").hide();
				}
			}

			if ($(this).is(':checked')) {
				if (vValue == "모두철거") {
					$("input:checkbox[name='removeItem']").each(function() {
						this.checked = true;
					});
					$("#removeEtc").val("");
					$("#removeEtc").show();
				}
			} else {
				if (vValue == "모두철거") {
					$("input:checkbox[name='removeItem']").each(function() {
						this.checked = false;
					});
					$("#removeEtc").val("");
					$("#removeEtc").hide();
				}
			}
		});

		$("#mb_hp").inputFilter(function(value) {
			return /^\d*$/.test(value);
		});

		$("#mb_biz_worker_phone").inputFilter(function(value) {
			return /^\d*$/.test(value);
		});

		doSelectArea1();

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
				var fvHtml = "<option value=\"\" selected>시/도</option>";
				fvHtml += data;
				$("#area1").html(fvHtml);
				fvHtml = "<option value=\"\" selected>시/구/군</option>";
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
				// if ($("#area1").val()) {
				// 	fvHtml += "<option value=\"\" selected>" + $("#area1").val() + " 전체</option>";
				// } else {
				// 	fvHtml += "<option value=\"\" selected>시/도</option>";
				// }

				if (!$("#area1").val()) {
				 	fvHtml += "<option value=\"\" selected>시/도</option>";
				}
				fvHtml += data;
				
				$("#area2").html(fvHtml);

			}
		});
	}

	function doSaveArea() {
		if (!$("#area1").val()) {
			alert("시/도를 선택하십시오.");
			return;
			
		}

		var area1 = $("#area1").val();
		var area2 = $("#area2").val();

		var vHtml = "";
		vHtml += "<p class='signup_txt_area'>";
		vHtml += "<input type='hidden' name='mb_area1[]' value='" + area1 + "'>";
		vHtml += "<input type='hidden' name='mb_area2[]' value='" + area2 + "'>";
		vHtml += area1 + " " + cfNvl2(area2, "전체");
		vHtml += "&nbsp;&nbsp;";
		vHtml += "<a href='javascript:' class='remove_area'>";
		vHtml += "<i class='xi-close-min'></i>";
		vHtml += "</a></p>";
		//vHtml += "</p>";
		$("#divArea").append(vHtml);
		$('.remove_area').click(function() {
			var $el = $(this).closest(".signup_txt_area");
			$el.remove();
		})
	}
$(function() {
    $("#reg_zip_find").css("display", "inline-block");

    <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
    // 아이핀인증
    $("#win_ipin_cert").click(function() {
        if(!cert_confirm())
            return false;

        var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
        certify_win_open('kcb-ipin', url);
        return;
    });

    <?php } ?>
    <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
    // 휴대폰인증
    $("#win_hp_cert").click(function() {
        if(!cert_confirm())
            return false;

        <?php
        switch($config['cf_cert_hp']) {
            case 'kcb':
                $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                $cert_type = 'kcb-hp';
                break;
            case 'kcp':
                $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                $cert_type = 'kcp-hp';
                break;
            case 'lg':
                $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                $cert_type = 'lg-hp';
                break;
            default:
                echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                echo 'return false;';
                break;
        }
        ?>

        certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
        return;
    });
    <?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f)
{   
    f.mb_name.value = f.mb_biz_name.value;
    f.mb_id.value = f.mb_email.value;
	f.mb_password.value = hex_md5(f.password_new.value);
    f.mb_password_re.value = hex_md5(f.password_new_re.value);

    if (f.w.value == "") {
        if (f.mb_password.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오.");
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert("비밀번호가 같지 않습니다.");
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오.");
            f.mb_password_re.focus();
            return false;
        }
    }
			
    <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
    // 본인확인 체크
    if(f.cert_no.value=="") {
        alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
        return false;
    }
    <?php } ?>

    // 닉네임 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
        var msg = reg_mb_nick_check();
        if (msg) {
            alert(msg);
            f.reg_mb_nick.select();
            return false;
        }
    }

    // E-mail 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
        var msg = reg_mb_email_check();
        if (msg) {
            alert(msg);
            f.reg_mb_email.select();
            return false;
        }
    }

    <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
    // 휴대폰번호 체크
    var msg = reg_mb_hp_check();
    if (msg) {
        alert(msg);
        f.reg_mb_hp.select();
        return false;
    }
    <?php } ?>

    if (typeof f.mb_icon != "undefined") {
        if (f.mb_icon.value) {
            if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                alert("회원아이콘이 이미지 파일이 아닙니다.");
                f.mb_icon.focus();
                return false;
            }
        }
    }

    if (typeof f.mb_img != "undefined") {
        if (f.mb_img.value) {
            if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                alert("회원이미지가 이미지 파일이 아닙니다.");
                f.mb_img.focus();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
        if (f.mb_id.value == f.mb_recommend.value) {
            alert("본인을 추천할 수 없습니다.");
            f.mb_recommend.focus();
            return false;
        }

        var msg = reg_mb_recommend_check();
        if (msg) {
            alert(msg);
            f.mb_recommend.select();
            return false;
        }
    }

	if (!$("#pbAgree").prop("checked")) {
		alert("이용약관에 동의해주세요!");
		return false;
	}

    <?php echo chk_captcha_js();  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

jQuery(function($){
	
	//tooltip
    $(document).on("click", ".tooltip_icon", function(e){
        $(this).next(".tooltip").fadeIn(400).css("display","inline-block");
    }).on("mouseout", ".tooltip_icon", function(e){
        $(this).next(".tooltip").fadeOut();
    });
});

</script>

<!-- } 회원정보 입력/수정 끝 -->