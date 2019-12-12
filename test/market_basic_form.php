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
        <a class="navbar-brand" href="market_index.php">
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
              <a class="dropdown-item" href="portfolio-1-col.html">국/찌개/탕</a>
              <a class="dropdown-item" href="portfolio-2-col.html">김치/절임/젓갈</a>
              <a class="dropdown-item" href="portfolio-3-col.html">마른반찬</a>
              <a class="dropdown-item" href="portfolio-4-col.html">무침</a>
              <a class="dropdown-item" href="portfolio-4-col.html">볶음</a>
              <a class="dropdown-item" href="portfolio-4-col.html">조림</a>
              <a class="dropdown-item" href="portfolio-4-col.html">전/생선</a>
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
