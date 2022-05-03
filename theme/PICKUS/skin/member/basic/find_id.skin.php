<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<div class="info_visual_wrap">
        <div class="info_visual_img info_default_img">
            <div class="inner">
                <div class="info_visual_text visual_txt">
                    <h6 class="wow fadeInDown" data-wow-delay="0.5s">회원정보찾기</h6>
                    <p class="wow fadeInDown" data-wow-delay="0.7s">방문해주셔서 감사합니다. </p>
                </div>
            </div>
        </div>
</div>
<div id="mb_login" class="mbskin">
    <div class="mbskin_box">
        <form>
            <ul class="way">
                <li class="current">
                    <a href="#none">아이디찾기</a>
                </li>
                <li>
                    <a href="./find_password.php">비밀번호찾기</a>
                </li>
            </ul>
            <input type="text" class="login_input" id="srchHpNo" aria-describedby="휴대폰번호 입력" placeholder="휴대폰번호 입력">
            <div class="find_id">
                <p id="srchUserIdInfo"></p>
            </div>
            <ul class="row">
                <input type="button" id="button" class="login_submit" onclick="doSearchUserIdCompete();" value="확인" />
                <li class="cancel_submit"><a href="./login.php">취소</a></li>
            </ul>
        </form>
    </div>
</div>
<script>
jQuery(document).ready(function(){
    $("#srchHpNo").inputFilter(function(value) {
          return /^\d*$/.test(value);
    });
});

function doSearchUserIdCompete()
{
    if(!$('#srchHpNo').val()){
        alert("휴대폰번호를 입력하십시오.");
        return;
    }
    $.ajax({
        type: "POST",
        url: "./ajax.mb_id_find.php",
        data: {
            "mb_hp": $('#srchHpNo').val()
        },
        cache: false,
        success: function(data) {
            $("#srchUserIdInfo").html(data);
        }
    });
}

function goMove()
{
    location.href="<?php echo G5_URL; ?>";
}
</script>