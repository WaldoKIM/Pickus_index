<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>
<a href="#" id="SignIn"><b><i class="fa fa-sign-in" aria-hidden="true"></i> 레이어 로그인</b></a>

<div class='layer_login'>
    <button class='close' id='close'></button>
    <form name="foutlogin" action="<?php echo $outlogin_action_url ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">
        <input type="hidden" name="url" value="<?php echo $outlogin_url ?>">
        <div class='top'>
            <h2>LOGIN</h2>
        </div>
        <div class='user'>
            <input name='mb_id' placeholder='ID' type='text'>
        </div>
        <div class='pw'>
            <input name='mb_password' placeholder='Password' type='password'>
        </div>
        <div class='remlog'>
            <div class='remember'>
                <input id='remember' name="auto_login" value="1" type='checkbox' >
                <label for='remember'></label>자동로그인
            </div>
            <input type='submit' value='로그인'>
        </div>
        <div class='forgot'>
            <h4>
                Forgot your password?
            </h4>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="layer_password_lost">click here</a> to order a new password.
        </div>
        <?php
        // 소셜로그인 사용시 소셜로그인 버튼
        @include_once(get_social_skin_path().'/social_layerLogin.skin.1.php');
        ?>
    </form>
</div>

<script>
$('#SignIn').on('click', function(){
  $('.layer_login').show();
});

$('#close').on('click', function(){
  $('.layer_login').hide('fast');
});
$(function() {
    $("#layer_password_lost").click(function(){
        win_password_lost(this.href);
        return false;
    });
    
	var input = document.createElement("input");
	if(('placeholder' in input)==false) { 
		$('[placeholder]').focus(function() {
			var i = $(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					this.type='password';
				}			
			}
		}).blur(function() {
			var i = $(this);	
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					this.type='text';
				}
				i.addClass('placeholder').val(i.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var i = $(this);
				if(i.val() == i.attr('placeholder'))
					i.val('');
			})
		});
	}
});
</script>