<?php
// if ( ! session_id() ) {

//   session_start();
//   // $_SESSION['name'];
//   if($_SESSION['name'] != null){
//     echo '<script> document.getElementById("tel1").style.display = "block"; </script>';
//   }

  
// }
  session_start();


?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">



  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css부터 시작하는 이유는 해당 파일이 있는 위치에서 경로가 시작하기 때문에 -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">  -->


    <title>Title</title>
</head>


<style>
body {
  padding-top: 56px;
}

.dropdown:hover>.dropdown-menu {
  display: block;
}

.portfolio-item {
  margin-bottom: 30px;
}

.navbar-default .navbar-nav > li > a { /* 네비게이션 리스트 글씨 색상 */
    color: blueviolet;
}

.navbar-default { /* 배경색상 */
    background-color: #ffffff;
    border-color: #000000;
}



#main_contents4 li { float:left; width:550px; height:130px; padding-top:20px; background:#eee; padding-left:50px;}
#main_contents4 li a { color:#1c130c; }
#main_contents4 li .img { width:92px; height:92px; float:left;}
#main_contents4 li .img img { width:92px; height:92px;  }
#main_contents4 li .info { float:left; width:350px; margin-left:50px; color:#555;}
#main_contents4 li .info .goods_name { display:block; font-size:1.2em; font-weight: bold; }
#main_contents4 li .info .content { display:block; margin-top:5px; margin-bottom:8px; }
#main_contents4 li .info .name { font-size:1.1em; }
#main_contents4 li .info .split { padding:0 10px; }
#main_contents4 li .info .star { color:#744134; }
</style>

<body>


      <!-- Navigation -->
  <!-- <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light fixed-top"> -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-default fixed-top">
    <div class="container">

      <!-- <a class="navbar-brand " href="market_index.html">웹</a> -->
      <h1>
        <a class="navbar-brand" href="../market_index.php">
          <img src="images/logo.png" alt="로고"/>
        </a>
      </h1>

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" >

            <?php 
              if($_SESSION['name'] != null){ //세션에 저장된 정보가 있으면 안보이게 처리
                // echo $_SESSION["name"];
                // echo '<a class="nav-link" style="display:none" href="logout.php">ㅁㅁㅁ<span></span></a>';
              } else if($_SESSION['name'] == null){
                echo '<a class="nav-link" href="market_sign_up.html"><span>회원가입</span></a>';
              }
            ?>



            <!-- <a class="nav-link" href="market_sign_up.html">회원가입</a> -->
          </li>
          <li class="nav-item">

            <?php 
              if($_SESSION['name'] != null){ //세션에 저장된 정보가 있으면 안보이게 처리
              } else if($_SESSION['name'] == null){
                echo '<a class="nav-link" href="market_sign_in.html"><span>로그인</span></a>';
              }
            ?>





            <!-- <a class="nav-link" href="market_sign_in.html">로그인</a> -->
          </li>

          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              고객센터
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href="portfolio-1-col.html">공지사항</a>
              <a class="dropdown-item" href="portfolio-2-col.html">자주 하는 질문</a>
              <a class="dropdown-item" href="portfolio-3-col.html">1:1 문의</a>
              <a class="dropdown-item" href="portfolio-4-col.html">상품제안</a>
            </div>
          </li> -->


          <li class="nav-item dropdown" id="mypage">
            <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ㅇㅇㅇ님
            </a> -->

            <?php 
              if($_SESSION['name'] != null){ //세션에 저장된 정보가 있으면 보이게 처리
                echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$_SESSION['name'].'님</a>';
              } else if($_SESSION['name'] == null){
              }
            ?>
              

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="blog-home-1.html">주문내역</a>
              <a class="dropdown-item" href="blog-home-2.html">늘 사는 것</a>
              <a class="dropdown-item" href="blog-home-2.html">관심 상품</a>
              <a class="dropdown-item" href="blog-home-2.html">개인 정보 수정</a>
              <a class="dropdown-item" href="logout.php">로그아웃</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              고객센터
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href="portfolio-1-col.html">공지사항</a>
              <a class="dropdown-item" href="portfolio-2-col.html">자주 하는 질문</a>
              <a class="dropdown-item" href="portfolio-3-col.html">1:1 문의</a>
              <a class="dropdown-item" href="portfolio-4-col.html">상품제안</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="get_post_test.php">장바구니&nbsp;<span class="badge badge-pill badge-warning">0</span></a>
          </li>

         
          
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Other Pages
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="full-width.html">Full Width Page</a>
              <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
              <a class="dropdown-item" href="faq.html">FAQ</a>
              <a class="dropdown-item" href="404.html">404</a>
              <a class="dropdown-item" href="pricing.html">Pricing Table</a>
            </div>
          </li> -->


        </ul>
      </div>
    </div>
  </nav>


<!-- 검색 -->
<!-- <button type="submit" ~ 이란 이 번튼을 눌렀을때 폼태그에 저장된 내용들이 서버로 보내진다는 말 -->
<!-- <div class="rightdiv"> 
    <form class="form-inline my-2 my-lg-0" >
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>  
</div> -->

<br>

<!-- <nav class="navbar navbar-expand-sm navbar-light bg-light nav-justified"> -->
    <div class="container">
    <ul class="nav nav-justified navbar-default">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle border-right" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              전체 카테고리
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">

              <!-- <a class="dropdown-item" name="category" value="국/찌개/탕" href="./goods/goods__list.php">국/찌개/탕</a> -->

              
              <!-- 제품 리스트로 가는 get에서 값을 넣어주기 위해 자바 스크립트 사용 -->
              <form method="get" action="./goods/goods__list.php" id="myForm">
                <a  class="dropdown-item" href="javascript:myForm.submit();">국/찌개/탕</a>
                <input type="hidden" id="gameToken" name="category" value="001">
              </form>

              <form method="get" action="./goods/goods__list.php" id="myForm2">
                <a  class="dropdown-item" href="javascript:myForm.submit();">마른반찬</a>
                <input type="hidden" id="gameToken" name="category" value="002">
              </form>

              <form method="get" action="./goods/goods__list.php" id="myForm3">
                <a  class="dropdown-item" href="javascript:myForm3.submit();">무침</a>
                <input type="hidden" id="gameToken" name="category" value="003">
              </form>

              <form method="get" action="./goods/goods__list.php" id="myForm4">
                <a  class="dropdown-item" href="javascript:myForm4.submit();">볶음</a>
                <input type="hidden" id="gameToken" name="category" value="004">
              </form>

              <form method="get" action="./goods/goods__list.php" id="myForm5">
                <a  class="dropdown-item" href="javascript:myForm5.submit();">조림</a>
                <input type="hidden" id="gameToken" name="category" value="005">
              </form>

              <form method="get" action="./goods/goods__list.php" id="myForm6">
                <a  class="dropdown-item" href="javascript:myForm6.submit();">전/생선</a>
                <input type="hidden" id="gameToken" name="category" value="006">
              </form>

              <form method="get" action="./goods/goods__list.php" id="myForm7">
                <a  class="dropdown-item" href="javascript:myForm7.submit();">김치/절임/젓갈</a>
                <input type="hidden" id="gameToken" name="category" value="007">
              </form>
              
              
              
              <!-- <a class="dropdown-item" href="./goods/goods__list.php">김치/절임/젓갈</a>
              <a class="dropdown-item" href="./goods/goods__list.php">마른반찬</a>
              <a class="dropdown-item" href="./goods/goods__list.php">무침</a>
              <a class="dropdown-item" href="./goods/goods__list.php">볶음</a>
              <a class="dropdown-item" href="./goods/goods__list.php">조림</a>
              <a class="dropdown-item" href="./goods/goods__list.php">전/생선</a> -->
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link border-right" href="#">신상품&nbsp;<span class="badge badge-primary">New</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-right" href="#">베스트</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">알뜰쇼핑 or 이벤트</a>
        </li>
        <!-- <button type="submit" ~ 이란 이 번튼을 눌렀을때 폼태그에 저장된 내용들이 서버로 보내진다는 말 -->
         <form class="form-inline my-2 my-lg-0" role="form" action="search.php" method="get">
             <input class="form-control mr-sm-2" name="product" type="search" placeholder="내용을 입력하세요" aria-label="Search">
             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">검색</button>
          </form>
     </ul>

    </div>
<!-- </nav> -->

    <hr>



  <div class="container" style="margin-top:50px;">            
    <div class="row">

      <!-- 사진 -->
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://zipbanchan.godohosting.com/800X800px/moochim/chamnamul_tufu.jpg" alt=""></a>         
        </div>
      </div>

      <!-- 정보 -->
      <div class="col-lg-6 col-md-6 mb-4">
        <!-- <h6>sdg</h6> -->
        <div class="card h-100">
            <div class="card-body">


              <h4 class="card-title">참나물 두부무침</h4>
              <p class="card-text">잎이 부드러워 소화가 잘 돼요</p>
              <hr>
              
              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>가격</h6>
              <h6 class=col-lg-9>5,000원</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>중량</h6>
              <h6 class=col-lg-9>200g</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>원산지</h6>
              <h6 class=col-lg-9>국산</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>유통기한</h6>
              <h6 class=col-lg-9>일주일</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>배송</h6>
              <h6 class=col-lg-9>택배배송</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>구매 수량</h6>
              <input type="number" class="text-center" value="1">
              </div>

              <hr>

              <div class="row" style="margin-bottom:10px; margin-left:10px;">
              <h6 class=col-lg-9>총 상품 금액</h6>
              <h6 class=col-lg-3>5,000원</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px; margin-top:10px;">
              <button class="btn btn-primary btn-block btn-lg">장바구니 담기</button>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px; margin-top:10px;">
              <button class="btn btn-warning btn-block btn-lg">관심 상품 등록</button>
              </div>



            </div>
        </div>
      </div>


    </div>
    <!-- /.row -->
  </div>











    




  <!-- 네브바 -> 탭을 클릭했을때 하위에 컨텐츠가 나타나토록-->
  <!-- http://blog.naver.com/PostView.nhn?blogId=pjh445&logNo=221159818328&parentCategoryNo=&categoryNo=41&viewDate=&isShowPopularPosts=true&from=search -->
  <!-- toggleable tabs -->



  <!-- <nav class="navbar navbar-expand-sm navbar-light bg-light nav-justified"> -->
    <div class="container" style="margin-top:50px;">
      <ul class="nav nav-justified nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#product">상품설명</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#review">상품후기</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#qu">문의사항</a>
        </li>
      </ul>


    </div>
<!-- </nav> -->

 


     <!-- 탭 컨텐츠 Tab panes -->
     <div class="tab-content col-12">
    
    <div id="product" class="container tab-pane active" style="text-align: center;"><br>
    
      <h3>detail</h3>
      <p>상품정보</p>
      <img src="http://zipbanchan.godohosting.com/pub/detail/moochim/505/505_1.jpg">
      <h1 style="text-align: left;">참나물 두부무침<h1>
      <p>채소 중에 베타카로틴이 풍부한 참나물은 특유의 향을 가지고 있어요. 
      참나물의 향과 부드러운 두부가 만나 씹을 때마다 고소하고 향긋해요. 
      참나물은 잎이 부드럽고 소화가 잘 돼요. 섬유질이 많아서 변비에도 좋답니다. 
      두부와 함께 먹으면 더 좋은 참나물을 맛있게 무쳐서 아이들도 어른들도 먹기 좋아요.</p>








        



    </div>








    <!-- <div id="review" class="container tab-pane"><br>
      <h3>review</h3>
      <p>상품후기</p>
    </div> -->

















    <!-- <div id="qu" class="container tab-pane"><br>
      <h3>qu</h3>
      <p>문의사항</p>
    </div> -->

  </div>















  <!-- <nav class="navbar navbar-expand-sm navbar-light bg-light nav-justified"> -->
  <div class="container" style="margin-top:50px;">
      <ul class="nav nav-justified nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link " data-toggle="tab" href="#product">상품설명</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#review">상품후기</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#qu">문의사항</a>
        </li>
      </ul>


    </div>
<!-- </nav> -->


<div id="review" class="container tab-pane"><br>
      <h3>review</h3>
      <p>상품후기</p>
    </div>








 <!-- <nav class="navbar navbar-expand-sm navbar-light bg-light nav-justified"> -->
 <div class="container" style="margin-top:50px;">
      <ul class="nav nav-justified nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link " data-toggle="tab" href="#product">상품설명</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#review">상품후기</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#qu">문의사항</a>
        </li>
      </ul>


  </div>
<!-- </nav> -->



   <!-- <div id="#qu" class="container tab-pane "><br> -->
   <div id="#qu" class="container tab-pane scrollto"><br>
      <h3>qu</h3>
      <p>문의사항</p>
    </div>
















  <!-- <footer style="background-color: #2e2bdf73; color: #ffffff" class="margin-top: 30px;">
    <div class="container">
      <br>
      <div class="row">
        <div class="col-sm-2" style="text-align:center">
          <h5>Copyright&copy;2017</h5> 
          <h5>이유림</h5>
        </div>
        <div class="col-sm-4">
          <h4>대표자 소개</h4>
          <p>저는 코딩부스터의 대표 이유림입ㄴ디ㅏd입니다 입니다 margin-bottom: 100px; margin-bottom: 100px;웹개발하는중이며 존나 모르겠다 진짜루</p>
        </div>
        <div class="col-sm-2">
          <h4 style="text-align:center;">네비게이션</h4>
          <ul class="list-unstyled"> 
            <li> 
              <a href="#">Link 1</a> 
            </li> 
            <li> 
              <a href="#">Link 2</a> 
            </li> 
            <li> 
              <a href="#">Link 3</a> 
            </li> 
            <li> 
              <a href="#">Link 4</a> 
            </li> 
          </ul>

        </div>
        <div class="col-sm-2">
          <h4 style="text-align:center;">SNS</h4>
            <div class="list-group">
              <a href="#" class="list-group-item">페이스북</a>
              <a href="#" class="list-group-item">유튜브</a>
              <a href="#" class="list-group-item">네이버</a>
            </div>
        </div>
        <div class="col-sm-2">
          <h4 style="text-align:center;"><i class="fas fa-user"></i>&nbsp;by 이유림</h4>
          <h4 style="text-align:center;"><i class="fas fa-thumbs-up"></i>&nbsp;by 이유림</h4>
        </div>
      </div>
    </div>
  </footer> -->


  <!-- footer --> 
  <hr style="margin-top: 100px;">
  <footer class="page-footer font-small stylish-color-dark pt-4"> 
    <!-- Footer Links --> 
    <div class="container text-center text-md-left"> 
      <!-- Grid row --> 
      <div class="row"> 
        <!-- Grid column --> 
        <div class="col-md-4 mx-auto"> 
          <!-- Content --> 
          <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Footer Content</h5> 
          <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> 
        </div> 
        <!-- Grid column --> 
        <hr class="clearfix w-100 d-md-none"> 
        <!-- Grid column --> 
        <div class="col-md-2 mx-auto"> 
          <!-- Links --> 
          <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5> 
          <ul class="list-unstyled"> 
            <li> 
              <a href="#">Link 1</a> 
            </li> 
            <li> 
              <a href="#">Link 2</a> 
            </li> 
            <li> 
              <a href="#">Link 3</a> 
            </li> 
            <li> 
              <a href="#">Link 4</a> 
            </li> 
          </ul> 
        </div> 
        <!-- Grid column --> 
        <hr class="clearfix w-100 d-md-none"> 
        <!-- Grid column --> 
        <div class="col-md-2 mx-auto"> 
          <!-- Links --> 
          <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5> 
          <ul class="list-unstyled"> 
            <li> 
              <a href="#">Link 1</a> 
            </li> 
            <li> 
              <a href="#">Link 2</a> 
            </li> 
            <li> 
              <a href="#">Link 3</a> 
            </li> 
            <li> 
              <a href="#">Link 4</a> 
            </li> 
          </ul> 
        </div> 
        <!-- Grid column --> 
        <hr class="clearfix w-100 d-md-none"> 
        <!-- Grid column --> 
        <div class="col-md-2 mx-auto"> 
          <!-- Links --> 
          <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5> 
          <ul class="list-unstyled"> 
            <li> 
              <a href="#">Link 1</a> 
            </li> 
            <li> 
              <a href="#">Link 2</a> 
            </li> 
            <li> 
              <a href="#">Link 3</a> 
            </li> 
            <li> 
              <a href="#">Link 4</a> 
            </li> 
          </ul> 
        </div> 
        <!-- Grid column --> 
      </div> 
      <!-- Grid row --> 
    </div> 
    <!-- Footer Links --> 
    <!-- Copyright --> 
    <div class="footer-copyright text-center py-3">© 2018 Copyright: 
      <a href="#"> cupjoo.tistory.com</a> 
    </div> 
    <!-- Copyright --> 
  </footer>




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
