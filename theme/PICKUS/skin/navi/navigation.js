$(document).ready(function(){
/* 하단으로 펼쳐지는 메뉴 */		
		$(".gnb_1dli").mouseover(function(){

			$(".category_submenu_box li").each(function(i){
				 $(this).data("index", i);
			});
			
			$("#gnb_1dul li").each(function(i){
				 $(this).data("index", i);
			});

			$(".category_submenu_box").show();
			$(".category_submenu_box").stop().animate({"height":"280px"},500);
		});

		$(".category_submenu_box").mouseleave(function(){
			
			SubCategoryOut();

		});

		$(".category_submenu_box li").mouseover(function(){
			var inx = $(this).data("index") ;
			$("#gnb_1dul li").removeClass("gnb1_dli_over");
			$("#gnb_1dul li").removeClass("gnb_1dli_on");
			$("#gnb_1dul li").each(function(i){
			
				if( inx ==  i){
					$(this).addClass("gnb1_dli_over ");
					$(this).addClass("gnb_1dli_on ");
				}
			});
		});

		$("#gnb").mouseleave(function(){
			//SubCategoryOut();
		});

		function SubCategoryOut(){
			$(".gnb_1dli").removeClass("gnb_1dli_over gnb_1dli_over2 gnb_1dli_on");

			$(".category_submenu_box").stop().animate({"height":"0px"},500,null,function(){$(".category_submenu_box").hide();});
		}
});