<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">

  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>회원가입aa</title>
</head>


<style type="text/css">
body {
    margin-top: 60px;
    margin-bottom: 60px;
    /* margin: 40px; */
    /* padding: 15px; */
    background-color: #f5f5f5;
}

</style>



<body>

    <article class="container col-md-6 col-md-offset-3">

    

        <div class="page-header">
            <h3>회원가입</h3>
        </div>


            <form role="form">
                    <div class="form-group">
                        <label for="inputName">이름</label>
                        <input type="text" class="form-control" id="inputName" placeholder="이름을 입력해 주세요">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">이메일</label>
                        <input type="email" class="form-control" id="InputEmail" placeholder="이메일 주소를 입력해주세요">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">비밀번호</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="비밀번호를 입력해주세요">
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordCheck">비밀번호 확인</label>
                        <input type="password" class="form-control" id="inputPasswordCheck" placeholder="비밀번호 확인을 위해 한번 더 입력 해 주세요">
                    </div>
                    <div class="form-group">
                        <label for="inputMobile">휴대폰 번호</label>
                        <input type="tel" class="form-control" id="inputMobile" placeholder="휴대폰번호를 입력해 주세요">
                    </div>
                    <div class="form-group">
                        <label for="inputtelNO">주소</label>
                        <input type="text" class="form-control" id="inputtelNO" placeholder="주소를 입력해 주세요">
                    </div>
                    <div class="form-group">
                        <label for="inputtelNO">상세 주소</label>
                        <input type="text" class="form-control" id="inputtelNO" placeholder="상세 주소를 입력해 주세요">
                    </div>

                    <div class="form-group">
                        <label>약관 동의</label>


                        <div class="custom-control custom-checkbox">
						    <input type="checkbox" id="jb-checkbox" class="custom-control-input">
						    <label class="custom-control-label" for="jb-checkbox">
                                <a href="#">이용약관</a>에 동의합니다.
                            </label>
					    </div>


                    </div>

                    <div class="form-group text-center">
                        <button type="submit" id="join-submit" class="btn btn-primary btn-block">
                            회원가입<i class="fa fa-check spaceLeft"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-block" onclick="location.href='sign_in.php'">
                            가입취소<i class="fa fa-times spaceLeft"></i>
                        </button>
                    </div>



                </form>

<!-- TODO: 
dfdf
dfd
fdf
df
-->







        <!-- <button type="button" class="btn btn-primary btn-block">벝은</button> -->


	<!-- <h2>input 태그</h2>
	<form class="form-inline" role="form">
	  <input type="text" class="form-control" placeholder="Text input">
	  <input type="password" class="form-control" placeholder="password input">
	  <input type="datetime" class="form-control" placeholder="datetime input">
	  <input type="datetime-local" class="form-control" placeholder="datetime-local input">
	  <input type="date" class="form-control" placeholder="date input">
	  <input type="month" class="form-control" placeholder="month input">
	  <input type="time" class="form-control" placeholder="time input">
	  <input type="week" class="form-control" placeholder="week input">
	  <input type="number" class="form-control" placeholder="number input">
	  <input type="url" class="form-control" placeholder="url input">
	  <input type="search" class="form-control" placeholder="search input">
	  <input type="tel" class="form-control" placeholder="tel input">
	  <input type="color" class="form-control" placeholder="color input">
	</form> -->



    </article>












    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>