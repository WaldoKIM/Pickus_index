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
        <li class="current" data-tab="tab1">
            <a href="#none">일반회원가입</a>
        </li>
        <li data-tab="tab2">
            <a href="./register_form.php?registerType=partner">파트너회원가입</a>
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
		<input type="hidden" name="mb_level" value="0">
        <input type="hidden" name="mb_id">
        <input type="hidden" name="mb_password">
        <input type="hidden" name="mb_password_type" value="md5">
		<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
		<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
		<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
		<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
		<?php }  ?>
		
		<div id="register_form" class="form_01">
			<div class="register_form_inner register_form_flex">
				<h2>가입정보작성</h2>
				<ul>
					<li>
						<label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label>
						<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input full_input <?php echo $required ?> <?php echo $readonly ?>" size="10" placeholder="이름">
						<?php
						if($config['cf_cert_use']) {
							if($config['cf_cert_ipin'])
								echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>'.PHP_EOL;
							if($config['cf_cert_hp'])
								echo '<button type="button" id="win_hp_cert" class="btn_frmline">휴대폰 본인확인</button>'.PHP_EOL;
		
							echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
						}
						?>
						<?php
						if ($config['cf_cert_use'] && $member['mb_certify']) {
							if($member['mb_certify'] == 'ipin')
								$mb_cert = '아이핀';
							else
								$mb_cert = '휴대폰';
						?>
		
						<div id="msg_certify">
							<strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
						</div>
						<?php } ?>
						<?php if ($config['cf_cert_use']) { ?>
						<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
						<span class="tooltip">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</span>
						<?php } ?>
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
						<label for="reg_mb_hp">휴대폰번호<?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
						
						<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input full_input <?php echo ($config['cf_req_hp'])?"required":""; ?>" maxlength="20" placeholder="휴대폰번호">
						<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
						<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
						<?php } ?>
					<?php }  ?>
					</li>
				</ul>
				<!-- 필수 정보 입력 끝  아래부턴 선택 정보 입력입니다. 관리자 페이지에서 사용 체크된 문항만 표시 됩니다. -->
				<ul>
					<?php if ($req_nick) {  ?>
					<li>
						<label for="reg_mb_nick">
							닉네임<strong class="sound_only">필수</strong>
							<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
							<span class="tooltip">공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)<br> 닉네임을 바꾸시면 앞으로 <?php echo (int)$config['cf_nick_modify'] ?>일 이내에는 변경 할 수 없습니다.</span>
						</label>
						
						<input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
						<input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" required class="frm_input required nospace full_input" size="10" maxlength="20" placeholder="닉네임">
						<span id="msg_mb_nick"></span>	                
					</li>
					<?php }  ?>
		
					<?php if ($config['cf_use_homepage']) {  ?>
					<li>
						<label for="reg_mb_homepage">홈페이지<?php if ($config['cf_req_homepage']){ ?><strong class="sound_only">필수</strong><?php } ?></label>
						<input type="text" name="mb_homepage" value="<?php echo get_text($member['mb_homepage']) ?>" id="reg_mb_homepage" <?php echo $config['cf_req_homepage']?"required":""; ?> class="frm_input full_input <?php echo $config['cf_req_homepage']?"required":""; ?>" size="70" maxlength="255" placeholder="홈페이지">
					</li>
					<?php }  ?>
		
					<?php if ($config['cf_use_tel']) {  ?>
					
						<label for="reg_mb_tel">전화번호<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
						<input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="frm_input full_input <?php echo $config['cf_req_tel']?"required":""; ?>" maxlength="20" placeholder="전화번호">
					<?php }  ?>
		
					<?php if ($config['cf_use_signature']) {  ?>
					<li>
						<label for="reg_mb_signature">서명<?php if ($config['cf_req_signature']){ ?><strong class="sound_only">필수</strong><?php } ?></label>
						<textarea name="mb_signature" id="reg_mb_signature" <?php echo $config['cf_req_signature']?"required":""; ?> class="<?php echo $config['cf_req_signature']?"required":""; ?>"   placeholder="서명"><?php echo $member['mb_signature'] ?></textarea>
					</li>
					<?php }  ?>
		
					<?php if ($config['cf_use_profile']) {  ?>
					<li>
						<label for="reg_mb_profile">자기소개</label>
						<textarea name="mb_profile" id="reg_mb_profile" <?php echo $config['cf_req_profile']?"required":""; ?> class="<?php echo $config['cf_req_profile']?"required":""; ?>" placeholder="자기소개"><?php echo $member['mb_profile'] ?></textarea>
					</li>
					<?php }  ?>
		
					<?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) {  ?>
					<li>
						<label for="reg_mb_icon" class="frm_label">
							회원아이콘
							<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
							<span class="tooltip">이미지 크기는 가로 <?php echo $config['cf_member_icon_width'] ?>픽셀, 세로 <?php echo $config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.<br>
							gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_icon_size']) ?>바이트 이하만 등록됩니다.</span>
						</label>
						<input type="file" name="mb_icon" id="reg_mb_icon">
		
						<?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
						<img src="<?php echo $mb_icon_url ?>" alt="회원아이콘">
						<input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
						<label for="del_mb_icon" class="inline">삭제</label>
						<?php }  ?>
					
					</li>
					<?php }  ?>
		
					<?php if ($member['mb_level'] >= $config['cf_icon_level'] && $config['cf_member_img_size'] && $config['cf_member_img_width'] && $config['cf_member_img_height']) {  ?>
					<li class="reg_mb_img_file">
						<label for="reg_mb_img" class="frm_label">
							회원이미지
							<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
							<span class="tooltip">이미지 크기는 가로 <?php echo $config['cf_member_img_width'] ?>픽셀, 세로 <?php echo $config['cf_member_img_height'] ?>픽셀 이하로 해주세요.<br>
							gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_img_size']) ?>바이트 이하만 등록됩니다.</span>
						</label>
						<input type="file" name="mb_img" id="reg_mb_img">
		
						<?php if ($w == 'u' && file_exists($mb_img_path)) {  ?>
						<img src="<?php echo $mb_img_url ?>" alt="회원이미지">
						<input type="checkbox" name="del_mb_img" value="1" id="del_mb_img">
						<label for="del_mb_img" class="inline">삭제</label>
						<?php }  ?>
					
					</li>
					<?php } ?>

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

    // 이름 검사
    if (f.w.value=="") {
        if (f.mb_name.value.length < 1) {
            alert("이름을 입력하십시오.");
            f.mb_name.focus();
            return false;
        }

        /*
        var pattern = /([^가-힣\x20])/i;
        if (pattern.test(f.mb_name.value)) {
            alert("이름은 한글로 입력하십시오.");
            f.mb_name.select();
            return false;
        }
        */
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
	$("#reg_mb_hp").inputFilter(function(value) {
			return /^\d*$/.test(value);
		});
});

</script>

<!-- } 회원정보 입력/수정 끝 -->