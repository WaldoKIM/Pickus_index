<style>

  /* popup */
  #popup_layer {position:fixed;top:0;left:0;z-index: 10000; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.2);
  }

.iafraidicannotdavid{
-moz-animation-delay: 2s;
-o-animation-delay: 2s;
-webkit-animation-delay: 2s; /* Safari 4.0 - 8.0 */
animation-delay: 2s;
animation: fadein 3s, fadein1 3s, fadein2 3s ;
-moz-animation: fadein 3s, fadein1 3s, fadein2 3s; /* Firefox */
-webkit-animation: fadein 3s, fadein1 3s, fadein2 3s; /* Safari and Chrome */
-o-animation: fadein 3s, fadein1 3s, fadein2 3s; /* Opera */}

@keyframes fadein {  from {      opacity: 0;  }  to {      opacity: 1;  }; }
@-moz-keyframes fadein { /* Firefox */  from {      opacity: 0;  }  to {      opacity: 1;  }}
@-webkit-keyframes fadein { /* Safari and Chrome */  from {      opacity: 0;  }  to {      opacity: 1;  }}
@-o-keyframes fadein { /* Opera */  from {      opacity: 0;  }  to {      opacity: 1;  }}

@keyframes fadein1 {  from {      height: 0;  }  to {     height: 100%;  }; }
@-moz-keyframes fadein1 { /* Firefox */  from {      height: 0;  }  to {      height: 100%;  }}
@-webkit-keyframes fadein1 { /* Safari and Chrome */  from {      height: 0;  }  to {      height: 100%;  }}
@-o-keyframes fadein1 { /* Opera */  from {      height: 0;  }  to {      height: 100%;  }}

@keyframes fadein2 {  from {      top: 50%;  }  to {     top:0;  }; }
@-moz-keyframes fadein2 { /* Firefox */  from {     top: 50%;  }  to {     top:0;  }}
@-webkit-keyframes fadein2 { /* Safari and Chrome */  from {      top: 50%;  }  to {     top:0;  }}
@-o-keyframes fadein2 { /* Opera */  from {      top: 50%;  }  to {      top:0;  }}


/*팝업 박스*/
.popup_box{position: relative;top:50%;left:50%; width:550px;transform:translate(-50%, -50%);z-index:1002;box-sizing:border-box;background:#fff;box-shadow: 2px 5px 10px 0px rgba(0,0,0,0.35);-webkit-box-shadow: 2px 5px 10px 0px rgba(0,0,0,0.35);-moz-box-shadow: 2px 5px 10px 0px rgba(0,0,0,0.35);}
/*컨텐츠 영역*/
.popup_box .popup_cont {padding:50px;line-height:1.4rem;font-size:14px;word-break: break-word;}
.popup_box .popup_cont h2 {padding:15px 0; margin:0; height: 90px; line-height: 5rem;}
.popup_box .popup_cont p{ border-top: 1px solid #666;padding-top: 30px;}
/*버튼영역*/
.popup_box .popup_btn {display:table;table-layout: fixed;width:100%;height:10vh;background:#5d5d5d;word-break: break-word;}
.popup_box .popup_btn a {position: relative; display: table-cell; height:70px; color:#fff !important; font-size:17px;text-align:center;vertical-align:middle;text-decoration:none; background:#1379cd;
font-weight: 700;}
.popup_box .popup_btn a:before{content:'';display:block;position:absolute;top:26px;right:29px;width:1px;height:21px;background:#fff;-moz-transform: rotate(-45deg); -webkit-transform: rotate(-45deg); -ms-transform: rotate(-45deg); -o-transform: rotate(-45deg); transform: rotate(-45deg);}
.popup_box .popup_btn a:after{content:'';display:block;position:absolute;top:26px;right:29px;width:1px;height:21px;background:#fff;-moz-transform: rotate(45deg); -webkit-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg); transform: rotate(45deg);}
.popup_box .popup_btn a.close_day {background:#ff6f0f;}
.popup_box .popup_btn a.close_day:before, .popup_box .popup_btn a.close_day:after{display:none;}
/*오버레이 뒷배경*/
.popup_overlay{position:fixed;top:0px;right:0;left:0;bottom:0;z-index:1001;;background:rgba(0,0,0,0.5);}    


.scroll-container {
  display: flex;
  flex-wrap: no-wrap;
  overflow-x: hidden;
  overflow-y: hidden;
  background-color: transparent; 
}
.scroll-container  .card {
  width: 100%;
  height: 80vh;
  flex: 0 0 auto;
  background-color: transparent;
  border: none;
  
}

.card .ovv {
  width: 100%;
  height: 330px;    
  background-color: transparent;
  border:4px solid #ff6f0f; 
  box-sizing: border-box;
}

@media(max-width:399px){
  .card .ovv {
    width: 100%;
    height: 350px;    
    background-color: transparent;
    border:4px solid #ff6f0f; 
    box-sizing: border-box;
  }
}

.card .mnn {
  width: 100%;
  height: 60%;
  background-color: rgba(0, 0, 0, 0.750);    
  box-sizing: border-box;
}

.card .mnn0 {
  width: 100%;
  height: 60%;
  background-color: rgba(0, 0, 0, 0.750);    
  box-sizing: border-box;
}

.card .ovv2 {
  width: 100%;
  height: 330px;    
  background-color: rgba(0, 0, 0, 0.750);    
  box-sizing: border-box;
}

.card .ovv3 {
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: rgba(0, 0, 0, 0.750);    
  box-sizing: border-box;
  position: relative;
  display: block;
  
}
.card .ovv3a {
  width: 100%;
  height: 100%;
  overflow: hidden;
  
  box-sizing: border-box;
  position: relative;
  display: block;
  
}
.card .ovv4 {
  width: 100%;
  height: 20vh;    
  background-color: rgba(0, 0, 0, 0.750);    
  box-sizing: border-box;
  position: relative;
  
}

.card .mnn2 {
  width: 100%;
  height: 60%;
  background-color: transparent;
  border:4px solid #ff6f0f;     
  box-sizing: border-box;
}

.card .mnn3 {
  width: 100%;
  height: 120px !important;
  background-color: transparent;
  border:4px solid #ff6f0f;     
  box-sizing: border-box;
  display: block;
}

.card .mnna {
  width: 100%;
  height: 120px !important;
  background-color: rgba(0, 0, 0, 0.750);  
  border: none;
  box-sizing: border-box;
  display: block;
}
@media(max-width:399px){
  .card .mnna {
    width: 100%;
    height: 120px !important;
    background-color: rgba(0, 0, 0, 0.750);  
    border: none;
    box-sizing: border-box;
    display: block;
  }
}

.ovv3a .mnna span {font-size: 1.6rem; color: #ff6f0f; font-weight: 700; text-align: center; position: relative; bottom: 0%;  height: 100%; padding: 0;
  display: inline; line-height: 200px!important; border: none;}

@media(max-width:380px){
 .ovv3a .mnna span {font-size: 1.6rem; color: #ff6f0f; font-weight: 700; text-align: center; position: relative; bottom: 0%;  height: 100%; padding: 0;
  display: inline; line-height: 200px!important; border: none;}
  }





.card .mnnb {
  width: 100%;
  height: 100px !important;
  background-color: transparent;
  border:4px solid #ff6f0f;     
  box-sizing: border-box;
  display: block;
}

.card .mnn1 {font-size: 1.6rem; color: #fff; text-align: center; line-height: 2rem;}

.card .nexthelp{font-size: 1.2rem; color: rgba(255, 255, 255, 0.562)!important; text-align: center; line-height: 2rem; z-index: 99999!important;}

.popup_box .popup_cont .card p {padding-top: 0; border-top: none; color: #fff;}

.card .wtf{height: 100%;}    

.ovv3 span {font-size: 1.6rem; color: #ff6f0f; font-weight: 700; text-align: center; margin-top: 5px;}

@media(max-width:399px){
  .card .mnn {
    height: 60%;
  }
}


.popup_cont .poptit{font-size: 1.6rem; font-weight: 700; font-family: GoyangDeogyang; color: #ffffff; text-align: center; background-color: #1379cd;
line-height: 2.5rem;}



@media(max-width:768px){
  .popup_box{width:100%; height: 100%; 
    z-index:1002;box-sizing:border-box;background-color: transparent;      
    box-shadow: 2px 5px 10px 0px rgba(0,0,0,0.35);
    -webkit-box-shadow: 2px 5px 10px 0px rgba(0,0,0,0.35);-moz-box-shadow: 2px 5px 10px 0px rgba(0,0,0,0.35);    
  border: 5px solid black;
  box-sizing: border-box;
  }
  .popup_box .popup_btn {display:table;table-layout: fixed;
    position: absolute; bottom: 0px;
    width:100%;height:10vh;background:#5d5d5d;word-break: break-word;}


  .popup_box .popup_cont {height: 90vh; padding:0px;}  



  }    
</style>




<div class="popup_box">
    <!--팝업 컨텐츠 영역-->
    <div class="popup_cont">
        <h2 class="poptit">피커스 파트너스 페이지 개선 안내</h2>

        <div class="scroll-container">
        <div id="card1" class="card">
           <div class="ovv2">
             <div class="mnn1">
                <br>                
                <br>
                피커스가 버전 1.9로</br>업그레이드 되었습니다.
                <br>                 
                <br>              
                이제 더 편리하게</br>피커스 서비스를 사용하세요!
                <br>                 
                <br>
                <a class="nexthelp" href="javascript:rscr(1);"> 터치해서 화면 설명 보기</a>                  
              </div>
            </div>
          <div class="mnn0">
          </div>
        </div>

        <div class="card">
          <div class="ovv"></div>
          <div class="mnn">

            <div class="mnn1">
              <br>                                
            나의 정보를 한 눈에 </br>확인 및 수정하실 수 있습니다.
            <br>
            <br>              
            <a class="nexthelp" href="javascript:rscr(2);"> 터치해서 다음 설명 보기</a>
              </div>
          </div>
        </div>

        <div class="card">
         <div class="ovv2">
          <div class="mnn1">
                <br>                                
              메인 화면 바로가기 안내1
              <br>
              <br>
              <p>1. 매입/철거 견적을 확인 및 참여 할 수 있습니다.</p>
              <p>2. 바로 판매 견적을 확인 및 참여 할 수 있습니다.</p>
              <p>3. 고객과 연결내역을 확인 할 수 있습니다.</p>
              <p>4. 고객의 문의 및 후기글을 관리할 수 있습니다.</p>           
              <br>
              <a class="nexthelp" href="javascript:rscr(3);"> 터치해서 다음 설명 보기</a>
              <br>
              <br>
          </div>
         </div>           
          <div class="wtf"> 
           <div class="mnn3"></div>
            <div class="ovv3">
            <span class="col-xs-3">1</span>
            <span class="col-xs-3">2</span>
            <span class="col-xs-3">3</span>
            <span class="col-xs-3">4</span>
          </div>
       </div>         
      </div>

      <div class="card">
         <div class="ovv2">
          <div class="mnn1">
                <br>                                
              메인 화면 바로가기 안내2
              <br>
              <br>
              <p>5. 피커스 마켓에 판매할 상품을 등록할 수 있습니다.</p>
              <p>6. 피커스 마켓에 등록한 상품을 관리 할 수 있습니다</p>
              <p>7. 내 정산내역 확인 및 출금 신청을 할 수 있습니다.</p>
              <p>8. 내 출금신청 현황을 확인할 수 있습니다.</p>           
              <br>
              <a class="nexthelp" href="javascript:rscr(-3);"> 터치해서 처음으로 가기</a>
              <br>
              <br>
          </div>
         </div>           
          <div class="wtf"> 
           
            <div class="ovv3a">
            <div class="mnna">
            <span class="col-xs-3">5</span>
            <span class="col-xs-3">6</span>
            <span class="col-xs-3">7</span>
            <span class="col-xs-3">8</span>
            </div>
            <div class="mnnb"></div>
            <div class="ovv3"></div>
            
          </div>
       </div>         
      </div>


  
       

        <!--
        <p class="popovv">내 정보를 한 눈에 볼 수 있습니다</p>
        <p class="popmn1">매입/철거 견적 목록을 확인 할 수 있습니다.</p>
        <p class="popmn2">바로 판매 견적 목록을 확인 할 수 있습니다.</p>
        <p class="popmn3">고객과 연결된 내역을 확인할 수 있습니다. </p>
        <p class="popmn4">고객들의 문의나 후기글을 관리할 수 있습니다.</p>
        <p class="popmn5">피커스 마켓에 내 상품을 등록할 수 있습니다.</p>
        <p class="popmn6">피커스 마켓에 등록된 상품을 관리할 수 있습니다.</p>
        <p class="popmn7">내 정산 내역을 확인하고 수익금 출금 신청을 할 수 있습니다.</p>
        <p class="popmn8">내 수익금 신청 현황을 확인할 수 있습니다.</p>
        -->

    </div>
    <!--팝업 버튼 영역-->
    <div class="popup_btn">
        <!--하루동안 보지않기-->
        <a id="chk_today" href="closeToday()" class="close_day">오늘 하루 보지 않기</a> 
        <!--7일간 보지않기-->
        <!-- <a id="chk_today" href="javascript:closeToday();" class="close_day">Do not open for 7 days</a>-->
        <a href="javascript:closePop();">도움말 닫기</a>
    </div>
</div>
</div>


<script>
  function setCookie( name, value, expiredays ) {  // 쿠키저장
	var todayDate = new Date();  //date객체 생성 후 변수에 저장
	todayDate.setDate( todayDate.getDate() + expiredays ); 
   	 // 시간지정(현재시간 + 지정시간)
	document.cookie = name + "=" + value + "; path=/; expires=" + todayDate.toUTCString() + ";"
	//위 정보를 쿠키에 굽는다
} 

$(function(){
	$(".popup_box").draggable({containment:'parent', scroll:false}); // 레이어 팝업 창 드래그 가능
	//{containment:'parent', scroll:false} 화면 영역 밖으로 드래그 안됌.
  var windowWidth = $( window ).width();


	if(document.cookie.indexOf("popToday=close") < 0 ){      // 쿠키 저장여부 체크
		document.getElementById("popup_layer").style.display = "block";
		}else {
		document.getElementById("popup_layer").style.display = "none"; 
		}
    if(windowWidth > 768) {  
      document.getElementById("popup_layer").style.display = "none"; }

	});
             
//오늘하루만보기 닫기버튼 스크립트
function closeToday() { 
	setCookie( "popToday", "close" , 1  ); 
	$("#popup_layer").css("display", "none");
	document.getElementById("popup_layer").style.display = "none";
}
//그냥 닫기버튼 스크립트
function closePop() { 
	document.getElementById("popup_layer").style.display = "none";
}


          function rscr(n){
            var nx = n            
            var vw = parseInt($(window).width() * 1);
            var vwx = vw - 10
            console.log (vwx);            
            var vwxx = vwx * nx
            console.log (vwxx);

            var cdw = document.querySelector('.scroll-container');            
            var _scrollX = $('.scroll-container').scrollLeft();
            $('.scroll-container').animate({ scrollLeft: vwxx}, 500);
            
          }

         

        </script>