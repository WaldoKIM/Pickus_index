<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$save_mb_id = get_cookie("save_mb_id");
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
    <div class="info_visual_wrap">
        <div class="info_visual_img info_default_img">
            <div class="inner">
                <div class="info_visual_text visual_txt">
                    <h6 class="wow fadeInDown" data-wow-delay="0.5s">로그인</h6>
                    <p class="wow fadeInDown" data-wow-delay="0.7s">방문해주셔서 감사합니다. </p>
                </div>
            </div>
        </div>
    </div>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <div class="mbskin_box">
        <div class="mb_log_cate">
            <ul class="way">
                <li class="current" data-tab="tab1">
                    <a href="#none">회원 로그인</a>
                </li>
                <li data-tab="tab2">
                    <a href="#none">비회원 로그인</a>
                </li>
            </ul>
        </div>
        <form name="flogin" action="<?php echo $login_action_url ?>" onkeydown="if(event.keyCode==13) return false;" onsubmit="return flogin_submit(this);" method="post">
            <input type="hidden" id="url" name="url" value="">
            <input type="hidden" id="mb_login_gubun" name="mb_login_gubun" value="1">
            <input type="hidden" id="mb_password_md5" name="mb_password_md5">
			<input type="hidden" id="login_go" name="login_go" value="<?php echo $_GET['login_go']?>">
            <input type="hidden" id="save_id" name="save_id" value="">
            <input type="hidden" name="login_action_url" value="<?php echo $login_action_url ?>">
        
            <fieldset id="login_fs">
                <div id="tab2" class="tabcontent">
                    <input type="text" id="mb_name" class="login_input" name="mb_name" aria-describedby="사용자 이름" placeholder="사용자 이름">
                </div>
                <input type="text" id="mb_id" name="mb_id" class="login_input" aria-describedby="사용자 이메일" placeholder="사용자 이메일" value="<?php echo $save_mb_id ?>">
                <div id="tab1" class="tabcontent current">
                    <input type="password" id="mb_password" class="login_input" name="mb_password" aria-describedby="사용자 패스워드" placeholder="사용자 패스워드">
                    <div id="login_info">
                        <div class="login_if_auto chk_box">
                            <input type="checkbox" name="auto_login" id="login_auto_login" class="selec_chk">
                            <label for="login_auto_login"><span></span> 자동로그인</label>  
                        </div>
                        <div class="login_if_save chk_box">
                            <input type="checkbox" id="saveid" name="saveid" class="selec_chk" <?php if($save_mb_id) echo 'checked'; ?> value="1">
                            <label for="saveid"><span></span>이메일기억하기</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="login_submit">로그인</button>
            </fieldset> 
        </form>
        <?php @include_once(get_social_skin_path().'/social_login.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>
    </div>
</div>

<script>
$(function() {
    $('.way li').click(function() {
        var activeTab = $(this).attr('data-tab');
        if(activeTab == "tab1"){
            $("#mb_name").val("");
            $("#mb_id").val("");
            $("#mb_password").val("");
            $("#mb_login_gubun").val("1");
            $(".tab").show();
        }else{
            $("#mb_name").val("");
            $("#mb_id").val("");
            $("#mb_password").val("");
            $("#mb_login_gubun").val("2");
            $(".tab").hide();
        }
        $('ul li').removeClass('current');
        $('.tabcontent').removeClass('current');
        $(this).addClass('current');
        $('#' + activeTab).addClass('current');
    })

    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });

    $("#mb_id").keydown(function(){
        if(event.keyCode == 13) $("#mb_password").focus();
    });

    $("#mb_password").keydown(function(){
        if(event.keyCode == 13){
            var f = document.flogin;
            if(flogin_submit(f))
                document.flogin.submit();
        }
    });

    $("#saveid").change(function(){
        if($("#saveid").is(":checked")){
          $("#save_id").val($("#saveid").val());
        }else{
            $("#save_id").val();
        }
    });



});

function flogin_submit(f)
{

    if(f.mb_login_gubun.value == "1"){
        if(!f.mb_id.value){
            alert("이메일을 입력해주세요.");
            return false;
        }
        if(!f.mb_password.value){
            alert("비밀번호를 입력해주세요.");
            return false;
        }
        f.mb_password_md5.value = hex_md5(f.mb_password.value);
    }else{
        if(!f.mb_name.value){
            alert("이름을 입력해주세요.");
            return false;
        }
        if(!f.mb_id.value){
            alert("이메일을 입력해주세요.");
            return false;
        }
    }

    return true;
}
function goMove()
{
    location.href="<?php echo G5_URL; ?>";
}
</script>
<!-- } 로그인 끝 -->
