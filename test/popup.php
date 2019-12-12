<!DOCTYPE HTML>
<html>
<head><title>레이어 팝업창 연습</title>
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<style type="text/css">

	body {font-size:11pt; padding:0; margin:0;}
	h3 {color: #85144b; font-size: 14pt;}

	#promotionBanner {width: 100%; height: 110px; background-color:#990000; color: #f1f1f1; overflow: hidden;}
	.popContents {width: 1100px; margin: 0 auto; padding: 0; overflow: hidden; text-align: center;}
	.popClose {width: 1100px; marign: 0 auto; text-align: right; font-size: 9pt; padding: 0;}
	#chkday {color: #5a5a5a;}
	label[for=chkday] { cursor: pointer; color: #d8d8d8; padding-right: 10px;}

	.contents {width: 1100px; margin: 0 auto; height: 900px; background-color: #e0e0e0; overflow: hidden; padding: 20px;}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script language="JavaScript">

	//쿠키저장 함수
	function setCookie( name, value, expiredays ) { 
		var todayDate = new Date(); 
		todayDate.setDate( todayDate.getDate() + expiredays ); 
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
	}

	$(document).ready(function(){
		$("#promotionBanner .btnClose").click(function(){
			//오늘만 보기 체크박스의 체크 여부를 확인 해서 체크되어 있으면 쿠키를 생성한다.
			if($("#chkday").is(':checked')){
				setCookie( "topPop", "done" , 1 ); 
				//alert("쿠키를 생성하였습니다.");
			}
			//팝업창을 위로 애니메이트 시킨다. 혹은 slideUp()
			//$('#promotionBanner').animate({height: 0}, 500);
			$('#promotionBanner').slideUp(500); 
		});
	});


</script>

</head>
<body>

<!-- Layer POPUP -->
<div id="promotionBanner">
	<div class="popContents">
		<img src="/img/banner/top_pop_banner.png" height="80">
		<div class="popClose">
		<input type="checkbox" value="checkbox" name="chkbox" id="chkday"/><label for="chkday">오늘 하루 그만보기 </label> 
        <a href="#none" class="btnClose"><img src="/img/guide/tip/btn_close.png" alt="배너 닫기" width="15" /></a></div>
	</div>
</div>  

<script language="Javascript">
	//저장된 해당 쿠키가 있으면 창을 안 띄운다 없으면 뛰운다.
	cookiedata = document.cookie;    
	if ( cookiedata.indexOf("topPop=done") < 0 ){      
		document.all['promotionBanner'].style.display = "block";
		} 
	else {
		document.all['promotionBanner'].style.display = "none"; 
	}
</script>
<!-- Layer Popup END -->


<div id="" class="contents">
	페이지 본문 출력
</div>


</body>
</html>