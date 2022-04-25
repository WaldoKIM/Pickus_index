/*mobile navi*/

$(function(){
	$(window).scroll(function(){  // 화면 스크롤시 아래코드실행....
		var num = $(this).scrollTop();  // 스크롤값을 가져온다.
		if( num > 0 ){  // 스크롤을 200 이상했을시 보이고 이하는 감추기
			$("#mobile_hd_wrapper").addClass("mobile-header");
		}else{
			$("#mobile_hd_wrapper").removeClass("mobile-header");
		}
	});
});



function mobileHeader() {
    var btnMobilenav = $(".btnMobileNav");



    $(".btnMobileNav").on("click", function() {
        var $this = $(this);
        if ($this.hasClass("close")) {
            slideUp();
            $this.removeClass("close");
        } else {
            slideDown();
            $this.addClass("close");
        }

    });

	function slideDown() {
		$(".nav-bg").stop().slideDown(300);
        $(".gnb_wrap #gnb_1dul").stop().slideDown(300);
    }

    function slideUp() {
        $(".gnb_wrap #gnb_1dul").stop().slideUp(300);
    }



}
mobileHeader();





/*PC navi*/

$(function(){
	$(window).scroll(function(){  // 화면 스크롤시 아래코드실행....
		var num = $(this).scrollTop();  // 스크롤값을 가져온다.
		if( num > 0 ){  // 스크롤을 200 이상했을시 보이고 이하는 감추기
			$("#pc_hd_wrapper").addClass("pc-header");
		}else{
			$("#pc_hd_wrapper").removeClass("pc-header");
		}
	});
});


function pcHeader() {
    var $body = $("body");

	$("#gnb_1dul, .nav-bg ").on("mouseenter", function() {
        if ($body.hasClass("nav-open") === false) {
            slideDown();
        }
    });
    $("#gnb_1dul, .nav-bg").on("mouseleave", function() {
        if ($body.hasClass("nav-open") === false) {
            slideUp();
        }
    });


    $(".btnPcNav").on("click", function() {
        var $this = $(this);
        if ($this.hasClass("close")) {
            slideUp();
            $("body").removeClass("nav-open");
            $this.removeClass("close");
        } else {
            slideDown();
            $this.addClass("close");
            $body.addClass("nav-open");
        }

    });


	function slideDown() {
        $(".nav-bg").stop().slideDown(300);
        $("#gnb_1dul .gnb_2dul").stop().slideDown(300);
    }

    function slideUp() {
        $(".nav-bg").stop().slideUp(300);
        $("#gnb_1dul .gnb_2dul").stop().slideUp(300);
    }

}
pcHeader();