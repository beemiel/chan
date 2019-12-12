<?php
include '../main/db.php';
session_start();


//저장된 쿠키가 있으면 세션에 저장해줌(세션으로 로그인 유지를 해서..)
if($_COOKIE['uuid'] != null){
  $uuid = $_COOKIE['uuid'];

  $get_member = "SELECT * FROM member WHERE uuid='$uuid'";
  $member_result = mysqli_query($conn,$get_member);
  $member_row =  mysqli_fetch_array($member_result);
  
  $_SESSION['name'] = $member_row['name'];
  $_SESSION['email'] = $member_row['email'];
  $_SESSION['uuid'] = $member_row['uuid'];
}



?>
<!DOCTYPE html> 
<html> 
<head> 
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
  <!-- <nav class="navbar fixed-top navbar-expand-lg navbar-default fixed-top"> -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-default fixed-top">
    <div class="container">

      <!-- <a class="navbar-brand " href="market_index.html">웹</a> -->
      <h1>
        
        <a class="navbar-brand" href="../main/market_index.php">
          <!-- <img src="https://i.postimg.cc/SKZ5CbKQ/logo.png" alt="찬" style="max-width:50px; max-height:50px;"/> -->
          <img src="https://i.postimg.cc/9MLNBgqc/logo3.png" alt="찬" style="max-width:auto; max-height:40px;"/>

        </a>
      </h1>

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" >

            <?php 
              if($_SESSION['name'] != null || $_COOKIE['name'] != null){ //세션에 저장된 정보가 있으면 안보이게 처리
                // echo $_SESSION["name"];
                // echo '<a class="nav-link" style="display:none" href="logout.php">ㅁㅁㅁ<span></span></a>';
              } else if($_SESSION['name'] == null || $_COOKIE['name'] == null){
                echo '<a class="nav-link" href="../sign/market_sign_up.html"><span>회원가입</span></a>';
              }
            ?>



            <!-- <a class="nav-link" href="market_sign_up.html">회원가입</a> -->
          </li>
          <li class="nav-item">

            <?php 
              if($_SESSION['name'] != null  || $_COOKIE['name'] != null){ //세션에 저장된 정보가 있으면 안보이게 처리
              } else if($_SESSION['name'] == null  || $_COOKIE['name'] == null){
                echo '<a class="nav-link" href="../sign/market_sign_in.html"><span>로그인</span></a>';
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

              if($_SESSION['name'] != null){
                echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$_SESSION['name'].'님</a>';
              } else if ($_COOKIE['name'] != null){
                echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$_COOKIE['name'].'님</a>';
              }

            ?>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

              <!-- 관리자의 경우 관리자 페이지가 보이도록 -->
              <?php 
              //관리자
                 if($_SESSION['name'] == "admin"){
                  ?>
                  
              <a class="dropdown-item" href="../goods/goods_update.php">상품 등록</a>
              <a class="dropdown-item" href="../goods/admin_goods.php">등록 상품 관리</a>
              <a class="dropdown-item" href="../adminpage/admin_orderlist.php">주문 내역 관리</a>
              <a class="dropdown-item" href="blog-home-2.html">문의 내역 관리</a>

              <?php
                 } else {
                  //일반 사용자
                  ?>
              <a class="dropdown-item" href="../userpage/orderlist.php">주문내역</a>
              <a class="dropdown-item" href="../userpage/wishlist.php">늘 사는 것</a>
              <a class="dropdown-item" href="../userpage/user_info_modify_check.php">개인 정보 수정</a>

              <?php
                 }
              ?>


              <a class="dropdown-item" href="../main/logout.php">로그아웃</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              고객센터
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">


              <form method="get" action="../board/list.php" id="sc1">
                <a  class="dropdown-item" href="javascript:sc1.submit();">공지사항</a>
                <input type="hidden"  name="board" value="notice">
              </form>

              <form method="get" action="../board/list.php" id="sc2">
                <a  class="dropdown-item" href="javascript:sc2.submit();">1:1 문의</a>
                <input type="hidden"  name="board" value="question">
              </form>

              <form method="get" action="../board/list.php" id="sc3">
                <a  class="dropdown-item" href="javascript:sc3.submit();">상품제안</a>
                <input type="hidden"  name="board" value="suggestion">
              </form>
              <!-- <a class="dropdown-item" href="./board/list.php">공지사항</a> -->






              <!-- <a class="dropdown-item" href="portfolio-3-col.html">1:1 문의</a>
              <a class="dropdown-item" href="portfolio-4-col.html">상품제안</a> -->
            </div>
          </li>

          <li class="nav-item">
            <!-- <a class="nav-link" href="../goods/goods_cart.php">장바구니&nbsp;<span class="badge badge-pill badge-warning">0</span></a> -->
            <a class="nav-link" href="../goods/goods_cart.php">장바구니</a>
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
              <form method="get" action="../goods/goods__list.php" id="myForm">
                <a  class="dropdown-item" href="javascript:myForm.submit();">국/찌개/탕</a>
                <input type="hidden" id="gameToken" name="category" value="001">
              </form>

              <form method="get" action="../goods/goods__list.php" id="myForm2">
                <a  class="dropdown-item" href="javascript:myForm2.submit();">마른반찬</a>
                <input type="hidden" id="gameToken" name="category" value="002">
              </form>

              <form method="get" action="../goods/goods__list.php" id="myForm3">
                <a  class="dropdown-item" href="javascript:myForm3.submit();">무침</a>
                <input type="hidden" id="gameToken" name="category" value="003">
              </form>

              <form method="get" action="../goods/goods__list.php" id="myForm4">
                <a  class="dropdown-item" href="javascript:myForm4.submit();">볶음</a>
                <input type="hidden" id="gameToken" name="category" value="004">
              </form>

              <form method="get" action="../goods/goods__list.php" id="myForm5">
                <a  class="dropdown-item" href="javascript:myForm5.submit();">조림</a>
                <input type="hidden" id="gameToken" name="category" value="005">
              </form>

              <form method="get" action="../goods/goods__list.php" id="myForm6">
                <a  class="dropdown-item" href="javascript:myForm6.submit();">전/생선</a>
                <input type="hidden" id="gameToken" name="category" value="006">
              </form>

              <form method="get" action="../goods/goods__list.php" id="myForm7">
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
            <a class="nav-link border-right" href="#">베스트&nbsp;<span class="badge badge-warning">Best</span></a>
        </li>
        <!-- <button type="submit" ~ 이란 이 번튼을 눌렀을때 폼태그에 저장된 내용들이 서버로 보내진다는 말 -->
         <form class="form-inline my-2 my-lg-0" role="form" action="../goods/search.php" method="get">
             <input class="form-control mr-sm-2" name="product" type="search" placeholder="내용을 입력하세요" aria-label="Search">
             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">검색</button>
          </form>
     </ul>

    </div>
<!-- </nav> -->

</body> 
</html> 