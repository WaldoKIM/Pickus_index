<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5['title'] = '견적신청';

if ($member['mb_level'] == '2') {
	alert('업체회원은 이용하실 수 없습니다.');
}
$readonly = "";
if ($is_member) {
	$readonly = "readonly";
}
$maxstep = 6; //견적 스텝의 총 개수 입니다. ex)스텝이 4개라면 4로 변경
?>

<div id="estimate_signup">
	<div class="signup_info">
		<div class="info_position">
			<div class="signup_progress">
				중고판매
				<ol class="ProgressBar">
					<?php for ($i = 1; $i <= $maxstep-1; $i++){ ?>
						<li class="ProgressBar-step"><svg class="ProgressBar-icon"></svg></li>
					<?php } ?>
				</ol>
			</div>
			<div class="info_section step01">
				<div class="step_info">
					<h2>판매하실 품목을 알려주세요!</h2>
					<p>
						어떤 품목을 판매하고 싶으신가요?<br>
						피커스와 함께하면 쉽고 빠르게 전문가의 견적을 <br>
						받으실 수 있어요 😊
					</p>
				</div>
			</div>
			<div class="info_section step02" style="display: none;">
				<div class="step_info">
					<h2>판매하실 제품에 대해 알려주세요!</h2>
					<p>
						정확하게 입력해주셔야<br>
						전문가님의 견적을 빠르게 받아보실 수 있어요!<br>
						연식에 따라 매입이 불가능한 품목도 있어요 😢
					</p>
				</div>
			</div>
			<div class="info_section step03" style="display: none;">
				<div class="step_info">
					<h2>제품의 사진과 참고사항을 알려주세요!</h2>
					<p>
						제품의 상태를 한눈에 알아볼 수 있는 사진이 필요해요!<br>
						스크래치, 문콕 등 특이사항이 있을 경우 해당 내용의 사진도 보여주세요!<br>
						전문가님이 참고하셔야 하는 내용도 알려주세요 😊
					</p>
				</div>
			</div>
			<div class="info_section step04" style="display: none;">
				<div class="step_info">
					<h2>픽업 주소를 알려주세요!</h2>
					<p>
						전문가님이 직접 물건을 수거해 가시기 때문에<br>
						주소를 정확히 입력해주세요!<br>
						엘리베이터가 없거나 사다리차를 이용해서 물건을 수거해야할 경우<br>
						요금이 발생할 수 있어요 😢
					</p>
				</div>
			</div>
			<div class="info_section step05" style="display: none;">
				<div class="step_info">
					<h2>언제까지 견적을 받고 싶으세요?</h2>
					<p>
						희망하시는 견적 마감일자와<br>
						수거일자를 알려주세요!<br>
						상황에 따라서 전문가님과 수거일자를 조율할수도 있답니다<br>
						<span>거의 다왔어요!</span>
					</p>
				</div>
			</div>
			<div class="info_section step06" style="display: none;">
				<div class="step_info">
					<h2>고객님의 정보를 알려주세요!</h2>
					<p>
						고객님의 소중한 정보는 견적 진행을 위해<br>
						활용되며, 안전하게 보관돼요!<br>
						채택된 견적에 한에서만 전문가님의 연락이 가게 돼요😊<br>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="signup_form">
		<div class="middle_position">
			<form class="form_order" name="frmregister" action="<?php echo G5_URL; ?>/estimate/estimate_single_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="sub_key" value="0">
				<input type="hidden" name="e_type" value="0">
				<input type="hidden" name="simple_yn" value="0">
				<input type="hidden" name="test_type" value="A">
				<input type="hidden" name="type" value="B">
				<input type="hidden" name="title">
				<!--step1-->
				<div class="form_section step01">
					<div class="step_value">
						<div class="btn_cate">
							<ul>
								<li>
									<input class="signup-input-radio-checkbox" type="radio" name="item_cat" id="item_cat1" value="가전" checked="checked" />
									<label for="item_cat1" class="signup-input-radio-checkbox-label">가전</label>
								</li>
								<li>
									<input class="signup-input-radio-checkbox" type="radio" name="item_cat" id="item_cat4" value="가구" />
									<label for="item_cat4" class="signup-input-radio-checkbox-label">가구</label>
								</li>
								<li>
									<input class="signup-input-radio-checkbox" type="radio" name="item_cat" id="item_cat2" value="주방집기" />
									<label for="item_cat2" class="signup-input-radio-checkbox-label">주방집기</label>
								</li>
								<li>
									<input class="signup-input-radio-checkbox" type="radio" name="item_cat" id="item_cat3" value="헬스용품" />
									<label for="item_cat3" class="signup-input-radio-checkbox-label">헬스용품</label>
								</li>
								<li>
									<input class="signup-input-radio-checkbox" type="radio" name="item_cat" id="item_cat5" value="기타" />
									<label for="item_cat5" class="signup-input-radio-checkbox-label">기타</label>
								</li>
							</ul>
						</div>
						<input type="button" class="advance" id="form_next01">
						<label for="form_next01" class="form_next">다음</label>
					</div>
				</div>

				<!--step2-->
				<div class="form_section step02" style="display: none;">
					<div class="step_value">
						<li>
							<input type="hidden" name="item_cat_dtl" id="item_cat_dtl">
							<select name="item_cat_dtl_s" id="item_cat_dtl_s"></select>
							<input type="text" id="item_cat_dtl_etc" name="item_cat_dtl_etc" placeholder="세부카테고리를 입력해주세요.">
						</li>

						<li>
							<input type="hidden" name="manufacturer" id="manufacturer">
							<select name="manufacturer_s" id="manufacturer_s"></select>
							<input type="text" id="manufacturer_etc" name="manufacturer_etc" placeholder="제조사를 입력해주세요.">
						</li>
						
						<li>
							<input type="text" id="medel_name" name="medel_name" aria-describedby="ex) 가전 모델명 " placeholder="모델명을 입력해주세요.">
						</li>

						<li class="col-md-9 col-xs-6">
							<input type="hidden" id="year" name="year" />
							<select id="use_year" name="use_year"></select>
						</li>

						<input type="button" class="previous" id="form_prev02">
						<label for="form_prev02" class="form_prev">이전</label>

						<input type="button" class="advance" id="form_next02">
						<label for="form_next02" class="form_next">다음</label>


					</div>
				</div>
			
				<!--step3-->
				<div class="form_section step03" style="display: none;">
					<div class="step_value">
					
					
						<li>
							<textarea id="content" name="content" placeholder="EX. 스크래치, 문콕 등&#13;&#10;물품상태에 대해 상세히 적어주세요&#13;&#10;물품에 대해 상세히 작성해 주시면 좀 더 정확한 견적이 가능합니다. "></textarea>
						</li>
						<input type="button" class="previous" id="form_prev03">
						<label for="form_prev03" class="form_prev">이전</label>

						<input type="button" class="advance" id="form_next03">
						<label for="form_next03" class="form_next">다음</label>
					</div>
				</div>
				
				<!--step4-->
				<div class="form_section step04" style="display: none;">
					<div class="step_value">
						<li>
							<select id="area1" name="area1">
								<option value="" selected="selected">선택</option>
							</select>
						</li>

						<li>
							<select id="area2" name="area2">
								<option value="" selected="selected">선택</option>
							</select>
						</li>

						<li>
							<input type="text" id="area3" name="area3" aria-describedby="읍.면.동을 입력해 주세요" placeholder="읍.면.동을 입력해 주세요">
						</li>
						
						<ul style="justify-content: center;">
							<li>
								<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn1" onchange="setDisplay()" value="엘리베이터 있음" checked /><i>유</i></label>
							</li>
							<li>
								<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn2" onchange="setDisplay()" value="엘리베이터 없음" /><i>무</i></label>
							</li>
						</ul>
						<div style="display:none;" id="noneDiv">
							<div>층수를 알려주세요!</div>
							<li>
								<input type="text" id="floor" name="floor" aria-describedby="ex) 아파트 8층" placeholder="ex) 아파트 8층">
							</li>
						</div>
						<input type="button" class="previous" id="form_prev04">
						<label for="form_prev04" class="form_prev">이전</label>

						<input type="button" class="advance" id="form_next04">
						<label for="form_next04" class="form_next">다음</label>
					</div>
				</div>

				<!--step5-->
				<div class="form_section step05" style="display: none;">
					<div class="step_value">
						<li>
							<input type="text" readonly="" id="pickup_date_magam" name="pickup_date_magam" aria-describedby="희망 마감날짜를 입력해 주세요" placeholder="희망 마감날짜를 입력해 주세요">
						</li>
						<li class="col-md-9">
							<input type="text" readonly="" id="pickup_date" name="pickup_date" aria-describedby="희망 수거날짜를 입력해 주세요" placeholder="희망 수거날짜를 입력해 주세요">
						</li>
						<input type="button" class="previous" id="form_prev05">
						<label for="form_prev05" class="form_prev">이전</label>

						<input type="button" class="advance" id="form_next05">
						<label for="form_next05" class="form_next">다음</label>		
					</div>
				</div>

				<!--step6-->
				<div class="form_section step06" style="display: none;">
					<div class="step_value">
						<li>
							<input type="text" name="nickname" id="nickname" aria-describedby="이름" placeholder="이름" value="<?php echo $member['mb_name'] ?>" <?php echo $readonly ?>>
						</li>

						<li>
							<input type="text" name="email" id="email" aria-describedby="이메일" placeholder="이메일" value="<?php echo $member['mb_email'] ?>" <?php echo $readonly ?>>
						</li>
						<li>
							<input placeholder="숫자만 입력해주세요" type="number" name="phone" id="phone" min="0" step="1" aria-describedby="휴대폰 번호" value="<?php echo $member['mb_hp'] ?>">
						</li>
						<input type="checkbox" id="pbAgree" checked >
						<label for="pbAgree">
							<span>본인은 이용약관과 개인정보처리방침에 동의합니다.</span>
						</label>

						<input type="button" class="previous" id="form_prev06">
						<label for="form_prev06" class="form_prev">이전</label>

						<input type="button" id ="sign_submit" onclick="doRegistEstimate()">
						<label for="sign_submit" class="form_next">견적신청하기</label>	
						</div>	
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
			
<script type="text/javascript">
	var imageMaxCnt = 6;

	var request_parner = 0;

	var request_parner_cnt = 0;
	var current_fs,
		next_fs,
		previous_fs;
	var left,
		opacity,
		scale;
	var animating;


	$(".advance").on("click", function() {
  		var $bar = $(".ProgressBar");
  		if ($bar.children(".is-current").length > 0) {
    		$bar.children(".is-current").removeClass("is-current").addClass("is-complete").next().addClass("is-current");
  		} else {
    		$bar.children().first().addClass("is-current");
  		}
	});

	$(".previous").on("click", function() {
  		var $bar = $(".ProgressBar");
  		if ($bar.children(".is-current").length > 0) {
    		$bar.children(".is-current").removeClass("is-current").prev().removeClass("is-complete").addClass("is-current");
  		} else {
    		$bar.children(".is-complete").last().removeClass("is-complete").addClass("is-current");
  		}
	});
	
	$(function(){
    	$('#form_next01').click(function(){ 	
          	$('.step01').hide(200);
			$('.step02').show(200);
    	});
		$('#form_next02').click(function(){ 
			if (!doCheckForm(2)){
				var $bar = $(".ProgressBar");
				$bar.children(".is-current").removeClass("is-current").prev().removeClass("is-complete").addClass("is-current");
				return;
			}
          	$('.step02').hide(200);
			$('.step03').show(200);
    	});
		$('#form_next03').click(function(){ 	
			if (!doCheckForm(3)){
				var $bar = $(".ProgressBar");
				$bar.children(".is-current").removeClass("is-current").prev().removeClass("is-complete").addClass("is-current");
				return;
			}
          	$('.step03').hide(200);
			$('.step04').show(200);
    	});
		$('#form_next04').click(function(){
			if (!doCheckForm(4)){
				var $bar = $(".ProgressBar");
				$bar.children(".is-current").removeClass("is-current").prev().removeClass("is-complete").addClass("is-current");
				return;
			}
          	$('.step04').hide(200);
			$('.step05').show(200);
    	});
		$('#form_next05').click(function(){ 	
			if (!doCheckForm(5)){
				var $bar = $(".ProgressBar");
				$bar.children(".is-current").removeClass("is-current").prev().removeClass("is-complete").addClass("is-current");
				return;
			}
          	$('.step05').hide(200);
			$('.step06').show(200);
    	});

		$('#form_prev02').click(function(){ 
          	  $('.step02').hide(200);
			  $('.step01').show(200);
    	});
		$('#form_prev03').click(function(){ 	
          	  $('.step03').hide(200);
			  $('.step02').show(200);
    	});
		$('#form_prev04').click(function(){ 	
          	  $('.step04').hide(200);
			  $('.step03').show(200);
    	});
		$('#form_prev05').click(function(){ 	
          	  $('.step05').hide(200);
			  $('.step04').show(200);
    	});
		$('#form_prev06').click(function(){ 	
          	  $('.step06').hide(200);
			  $('.step05').show(200);
    	});
	});
	
	jQuery(document).ready(function() {
		var now = new Date();

var Year = now.getFullYear();

var Month = now.getMonth() + 1;
if (Month < 10)
	Month = "0" + Month

var Day = now.getDate();
if (Day < 10)
	Day = "0" + Day

var toDate = Year + "-" + Month + "-" + Day;

var date = $
	.datepicker
	.parseDate("yy-mm-dd", toDate);

$
	.datepicker
	.setDefaults({
		dateFormat: 'yymmdd',
		prevText: '이전 달',
		nextText: '다음 달',
		monthNames: [
			'1월',
			'2월',
			'3월',
			'4월',
			'5월',
			'6월',
			'7월',
			'8월',
			'9월',
			'10월',
			'11월',
			'12월'
		],
		monthNamesShort: [
			'1월',
			'2월',
			'3월',
			'4월',
			'5월',
			'6월',
			'7월',
			'8월',
			'9월',
			'10월',
			'11월',
			'12월'
		],
		dayNames: [
			'일',
			'월',
			'화',
			'수',
			'목',
			'금',
			'토'
		],
		dayNamesShort: [
			'일',
			'월',
			'화',
			'수',
			'목',
			'금',
			'토'
		],
		dayNamesMin: [
			'일',
			'월',
			'화',
			'수',
			'목',
			'금',
			'토'
		],
		showMonthAfterYear: true,
		yearSuffix: '년'
	});

$("#pickup_date")
	.datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		minDate: date
	})
	.change(function() {

		var t1 = $('#pickup_date')
			.val()
			.split("-");
		var t2 = toDate.split("-"); // 오늘

		var t1_date = new Date(t1[0], t1[1], t1[2]);
		var t2_date = new Date(t2[0], t2[1], t2[2]);

		var diff = t1_date - t2_date;
		var currDay = 24 * 60 * 60 * 1000;

		if (parseInt(diff / currDay) > 29) {
			alert('견적변동이 가능하여 업체견적이 늦을 수도 있습니다.');
		}

	});

$("#pickup_date_magam")
	.datepicker({
		dateFormat: "yy-mm-dd",
		language: "kr",
		minDate: date
	})
	.change(function() {

		var t1 = $('#pickup_date_magam')
			.val()
			.split("-");
		var t2 = toDate.split("-"); // 오늘

		var t1_date = new Date(t1[0], t1[1], t1[2]);
		var t2_date = new Date(t2[0], t2[1], t2[2]);

		var diff = t1_date - t2_date;
		var currDay = 24 * 60 * 60 * 1000;

		if (parseInt(diff / currDay) > 29) {
			alert('견적변동이 가능하여 업체견적이 늦을 수도 있습니다.');
		}

	});

$("#use_year").html(cfnEstimateYearsCombo("선택"));

$('#use_year').change(function() {
	$('#year').val($("#use_year option:selected").text());
	var itemCat = $('input[name="item_cat"]:checked').val();
	if (itemCat) {
		var vYear = $("#use_year").val();
		if (itemCat == "가구") {
			if (vYear >= 5) {
				alert("년식이 오래되어 무료수거 또는 폐기로 처분이 가능할 수 있습니다. ");
			}
		} else {
			if (vYear >= 10) {
				alert("년식이 오래되어 무료수거 또는 폐기로 처분이 가능할 수 있습니다. ");
			}
		}

	}
});


		doInitImage2("165");

		doSelectArea1();

		$('input[name="item_cat"]').change(function() {
			doSelectCategory2();

		});

		$('#item_cat_dtl_s').change(function() {
			doSelectCategory3();
		});

		doSelectCategory2();
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
				"e_type": "0"
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

	function doSelectCategory2() {
		var itemCat = $('input[name="item_cat"]:checked').val();
		if (itemCat == "가구") {
			$("#divModelName").hide();
			$('#noneGuide').hide();
		} else {
			$("#divModelName").show();
			$('#noneGuide').show();
		}
		if (itemCat == "가전") {
			$("#spanYear").html("생산년도");
		} else if (itemCat == "가구") {
			$("#spanYear").html("생산년도");
		} else {
			//$("#spanYear").html("");
			$("#spanYear").html("생산년도");
			$("#spanYear").show();
		}

		$("#manufacturer_s").val("");
		$("#medel_name").val("");
		$("#year").val("");
		$("#use_year").val("");

		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
			data: {
				category1: $('input[name="item_cat"]:checked').val()
			},
			cache: false,
			success: function(data) {
				$('#item_cat_dtl_etc').hide();
				$('#manufacturer_etc').hide();
				$("#item_cat_dtl_s").html("");
				var fvHtml = "<option value=\"\" selected>선택</option>";
				$("#manufacturer_s").html(fvHtml);
				if ($('input[name="item_cat"]:checked').val()) {
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
				category1: $('input[name="item_cat"]:checked').val(),
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

	function doCheckForm(vGubun) {
		if (vGubun == "2") {
			var itemCatDtl = $("#item_cat_dtl_s").val();
			if (itemCatDtl == "직접입력") {
				itemCatDtl = $("#item_cat_dtl_etc").val();
			}

			var manufacturer = $("#manufacturer_s").val();
			if (manufacturer == "직접입력") {
				manufacturer = $("#manufacturer_etc").val();
			}

			if (!cfnNullCheckSelect(itemCatDtl, "세부카테고리"))
				return false;
			if (!cfnNullCheckInput(manufacturer, "제조사"))
				return false;
			var itemCat = $('input[name="item_cat"]:checked').val();
			if (itemCat != "가구") {
				if (!cfnNullCheckInput($("#medel_name").val(), "모델명"))
					return false;
			}

			if (!cfnNullCheckSelect($("#use_year").val(), "년식"))
				return false;

		} else if (vGubun == "3") {
			if (!cfnNullCheckInput($("#content").val(), "참고사항"))
				return false;



		} else if (vGubun == "4") {
			if (!cfnNullCheckSelect($("#area1").val(), "시.도"))
				return false;
			if (!cfnNullCheckSelect($("#area2").val(), "구.군"))
				return false;
			if (!cfnNullCheckInput($("#area3").val(), "읍.면.동"))
				return false;

			if ($('input:radio[id=elevator_yn2]').is(':checked')) {
				if (!cfnNullCheckInput($("#floor").val(), "층수"))
					return false;
			}

		} else if (vGubun == "5") {
			if (!cfnNullCheckInput($("#pickup_date_magam").val(), "견적마감일"))
				return false;
			if (!cfnNullCheckInput($("#pickup_date").val(), "수거요청일"))
				return false;
			var req_Array = $('#pickup_date')
				.val()
				.split('-');
			var close_Array = $('#pickup_date_magam')
				.val()
				.split('-');

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
		var f = document.frmregister;
		if (!cfnNullCheckSelect($("#area1").val(), "기본주소"))
			return;
		if (!cfnNullCheckSelect($("#area2").val(), "기본주소"))
			return;
		if (!cfnNullCheckInput($("#area3").val(), "상세주소"))
			return;
		if ($('input:radio[id=elevator_yn2]').is(':checked')) {
			if (!cfnNullCheckInput($("#floor").val(), "층수"))
				return false;
		}
		if (!cfnNullCheckInput($("#pickup_date").val(), "수거요청일"))
			return;

		var itemCatDtl = $("#item_cat_dtl_s").val();
		if (itemCatDtl == "직접입력") {
			itemCatDtl = $("#item_cat_dtl_etc").val();
		}

		var manufacturer = $("#manufacturer_s").val();
		if (manufacturer == "직접입력") {
			manufacturer = $("#manufacturer_etc").val();
		}

		if (!cfnNullCheckSelect(itemCatDtl, "세부카테고리"))
			return;
		if (!cfnNullCheckInput(manufacturer, "제조사"))
			return;
		f.manufacturer.value = manufacturer;
		f.item_cat_dtl.value = itemCatDtl;
		var itemCat = $('input[name="item_cat"]:checked').val();
		if (itemCat != "가구") {
			if (!cfnNullCheckInput($("#medel_name").val(), "모델명"))
				return;
		}
		f.title.value = itemCat + " " + manufacturer + " " + itemCatDtl;

		if (!cfnNullCheckSelect($("#use_year").val(), "년식"))
			return;
		if (!cfnNullCheckInput($("#content").val(), "참고사항"))
			return;





		if (!cfnNullCheckInput($("#nickname").val(), "이름"))
			return;
		if (!cfnNullCheckInput($("#email").val(), "이메일"))
			return;
		if (!cfnNullCheckInput($("#phone").val(), "연락처"))
			return;


		<?php
		if (!$is_member) {
		?>
			if (!cfnNullCheckInput($("#nickname").val(), "이름"))
			return 
			if (!cfnNullCheckInput($("#email").val(), "이메일"))
			return;

			if (!validateEmail($("#email").val())) {
				alert("이메일 형식이 잘못되었습니다.");
				return false;
			}

			if (!cfnNullCheckInput($("#phone").val(), "연락처"))
			return;

			if (!$("#pbAgree").prop("checked")) {
				alert("이용약관에 동의해주세요!");
				return false;
			}

			
		<?php
		}
		?>

		$(".layer").removeClass("hidden");
		$('#load').show();
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

	function doReview(rcEmail, score) {
		$.ajax({
			type: "POST",
			url: "<?php echo G5_URL ?>/estimate/ajax.review.modal.php",
			data: {
				rc_email: rcEmail
			},
			cache: false,
			success: function(data) {
				$("#modal_review_content").html(data);

				$("#modal_review").modal();
			}
		});
	}

	function goMove() {
		location.href = "<?php echo G5_URL; ?>/estimate/estimate_register.php";
	}
</script>

<!-- AUTO COMPLETE -->
<script type="text/javascript">
	$(function() {
		var ga_availableTags = [
			"TV",
			"냉장고",
			"세탁기",
			"김치냉장고",
			"에어컨",
			"냉동고",
			"냉온풍기",
			"전기밥솥",
			"가스레인지"
		];
		var ma_availableTags = [
			"삼성전자",
			"LG전자",
			"대우전자",
			"대우루컴즈",
			"스타리온",
			"캐리어",
			"유니크",
			"우성",
			"라셀르",
			"휘센",
			"센추리"
		];

		var gu_availableTags = [
			"책상",
			"침대",
			"쇼파",
			"장롱",
			"식탁",
			"피아노",
			"책장",
			"의자",
			"사무용의자",
			"서랍장",
			"화장대",
			"장식장"
		];

		$("#item_cat_dtl_s").autocomplete({
			source: ga_availableTags
		});
		$("#manufacturer_s").autocomplete({
			source: ma_availableTags
		});
		$('input[type=radio][name="item_cat"]').change(function() {
			var itemCat = $('input[name="item_cat"]:checked').val();
			if (itemCat == "가구") {
				$("#item_cat_dtl_s").autocomplete({
					source: gu_availableTags
				});
				$("#manufacturer_s").autocomplete({
					source: ""
				});
			} else if (itemCat == "가전") {
				$("#item_cat_dtl_s").autocomplete({
					source: ga_availableTags
				});
				$("#manufacturer_s").autocomplete({
					source: ma_availableTags
				});
			}
		});
	});

	function setDisplay() {
		if ($('input:radio[id=elevator_yn1]').is(':checked')) {
			$('#noneDiv').hide();
		} else {
			$('#noneDiv').show();
		}
	}

</script>