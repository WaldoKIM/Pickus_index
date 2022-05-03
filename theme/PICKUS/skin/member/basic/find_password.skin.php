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
        <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
            <ul class="way">
                <li>
                    <a href="./find_id.php">아이디찾기</a>
                </li>
                <li class="current">
                    <a href="#none">비밀번호찾기</a>
                </li>
            </ul>
            <input type="text" class="login_input" id="srchEmail" name="srchEmail" aria-describedby="이메일 입력" placeholder="이메일 입력">
            <div class="find_id">
                <p>회원가입 시 입력하셨던 <span>이메일</span>로<br>비밀번호가 재발급 됩니다.</p>
            </div>
            <ul class="row">
                <input class="login_submit" type="submit" value="확인">
                <li class="cancel_submit"><a href="./login.php">취소</a></li>
            </ul>
        </form>
    </div>
</div>
<script>
function fpasswordlost_submit(f){
    if(!f.srchEmail.value){
        alert("true");
        return false;
    }
}

function goMove()
{
    location.href="<?php echo G5_URL; ?>";
}
</script>
