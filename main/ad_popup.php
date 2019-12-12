<!DOCTYPE html>
<html lang= "ko">
<head>
<meta charset="utf-8">
<title>제목</title>
</head>
<body>

<h1 style="margin-left:40%; margin-top:40px;">공지</h1>

<h2 style="margin-left:30%; margin-top:30px;">배송 지연 안내</h2>

<div style=" margin-top:20px;">
<p>11월 1일부터 사무실 이전으로 인해 배송이 지연될 수 있습니다. </p>
<p style=" margin-left:20%;">자세한 사항은 공지를 참고해 주세요. </p>
<!-- <a style="margin-left:40%;" onclick="move_page()" >상세보기</a> -->
</div>

<br>
<br>
<br>

<!-- <div class="checkbox">
    <label><input type="checkbox" id="checkbox" name="cookie_checkbox" onclick="set_cookie();"></label>하루동안 보지 않기
</div> -->

<input style=" margin-left:30%;" type="checkbox" name="checkbox" id="checkbox" class="custom-control-input">24시간동안 보지 않기
<button onclick="set_cookie()">닫기</button>

<script>

//쿠키저장 함수
function setCookie( name, value, expiredays ) { 
		var todayDate = new Date(); 
		todayDate.setDate( todayDate.getDate() + expiredays ); 
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
	}


function set_cookie(){

    var check = $('input:checkbox[id="checkbox"]').is(":checked");

    if(check == true){
        //쿠키에 만료시간을 24시간으로 하고 저장한다
        setCookie( "popup", "done" , 1 );
        // alert(document.cookie);
        // var noticeCookie = getCookie("popup");
        // alert(noticeCookie);
    }

    close();


}



</script>






















  <!-- 아이콘 -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>