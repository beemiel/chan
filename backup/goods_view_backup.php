<?php
include '../main/db.php';

session_start();
?>

<?php

//제품고유 id(인덱스)
$product = $_GET['product'];

//쿼리문
$get = "SELECT * FROM items WHERE id='$product'";

$result = mysqli_query($conn, $get);

$row =  mysqli_fetch_array($result);



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
</style>

<body onload="init();">
<!-- 장바구니 관련 -->
<script language="JavaScript">

//document.forms는 현재 document에 존재하는 <form> element 들이 담긴 collection (an HTMLCollection)을 반환합니다.
//-------------------------------------
// document.form은 HTML에서 form안의 element를 name기반으로 찾아가고
// document.getElementById는 HTML안의 모든 element를 id기반으로 찾아갑니다.
// ==================================
// <form name=xxx>
// <input name="aaa" ...>
// </form>
// ==================================
// <input id="aaa" ...>
// ==================================
// 전,후자 로aaa의 element를 찾아가는조건입니다.
//-------------------------------------

var sell_price;
var amount;

function init () {
	sell_price = document.form.sell_price.value;
	amount = document.form.amount.value;
	document.form.sum.value = sell_price;
	change();
}

function add () {
	hm = document.form.amount;
	sum = document.form.sum;
	hm.value ++ ;

	sum.value = parseInt(hm.value) * sell_price;
}

function del () {
	hm = document.form.amount;
	sum = document.form.sum;
		if (hm.value > 1) {
			hm.value -- ;
			sum.value = parseInt(hm.value) * sell_price;
		}
}

function change () {
	hm = document.form.amount;
	sum = document.form.sum;

		if (hm.value < 0) {
			hm.value = 0;
		}
	sum.value = parseInt(hm.value) * sell_price;
}  
</script>

























<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>

    <hr>



  <div class="container" style="margin-top:50px;">            
    <div class="row">

      <!-- 사진 -->
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src=<?php echo $row['imgpath']; ?> alt=""></a>         
        </div>
      </div>

      <!-- 정보 -->
      <div class="col-lg-6 col-md-6 mb-4">
        <!-- <h6>sdg</h6> -->
        <div class="card h-100">
            <div class="card-body">


              <h4 class="card-title">
                <?php
                  echo $row['name'];
                ?>
              </h4>
              <p class="card-text"> <?php echo $row['subtitle'];  ?> </p>
              <hr>
              
              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>가격</h6>
              <h6 class=col-lg-9> <?php echo $row['price'];  ?> 원</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>중량</h6>
              <h6 class=col-lg-9> <?php echo $row['weight'];  ?>  g</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>원재료/함량</h6>
              <h6 class=col-lg-9>하단 참고</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>유통기한</h6>
              <h6 class=col-lg-9>제품 별도 표기일까지</h6>
              </div>

              <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
              <h6 class=col-lg-3>배송</h6>
              <h6 class=col-lg-9>택배 배송 (월~금) 매일 조리 후, 당일 발송</h6>
              </div>

            <div class="row" style="margin-bottom:10px; margin-left:10px; margin-right:10px;">
            <form name="form" method="post" action="./cart_save.php">
            
                수량 : <input type=hidden name="sell_price" value=<?php echo $row['price']; ?>>
                <input type="button" value=" - " onclick="del();">
                <input type="text" name="amount" value="1" size="3" onchange="change();">
                <input type="button" value=" + " onclick="add();">
                <br>

                금액 : <input type="text" name="sum" size="11" readonly>원
                <input type="hidden"  name="id" value=<?php echo $row['id']; ?>>
                <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top:10px;">장바구니 담기</button>
            </form>     
            </div>
            

            <div class="row" style="margin-bottom:10px; margin-left:20px; margin-right:20px; margin-top:10px;">
                <form method="post" action="./wishlist_save.php">
                    <button class="btn btn-warning btn-block btn-lg">자주 사는 상품 등록</button>
                    <input type="hidden"  name="id" value=<?php echo $row['id']; ?>>
                    

                </form>
            </div>



            </div>
        </div>
      </div>


    </div>
    <!-- /.row -->
  </div>





<!-- <nav class="navbar navbar-expand-sm navbar-light bg-light nav-justified"> -->
<div class="container" style="margin-top:50px;">
    <ul class="nav nav-justified nav-tabs">
        <li class="nav-item">
            <a class="nav-link border-right active">상품설명</a>
        </li>
        <li class="nav-item">
            <!-- <a class="nav-link border-right" href="#review">베스트</a> -->
            <p><a class="nav-link border-right" href="#review">상품후기</a></p>
        </li>
        <li class="nav-item">
            <!-- <a class="nav-link disabled" href="#qu">알뜰쇼핑 or 이벤트</a> -->
            <p><a class="nav-link border-right" href="#qu">문의사항</a></p>
        </li>
     </ul>

    </div>
<!-- </nav> -->



     
    <div id="product" class="container" style="text-align: center;"><br>
    
    

    <?php

    echo $row['contents'];

    ?>



    </div>
    

    

    <br>
    <br>
    <div class="container">
    <h3>상품필수정보</h3>
    <table class="table table-sm">

    <thead>
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th style="width: 20%"></th>
        <th style="width: 80%"></th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>제품명</td>
        <td><?php echo $row['name'];  ?></td>
    </tr>

    <tr>
        <td>용량</td>
        <td><?php echo $row['weight'];  ?>g</td>
    </tr>

    <tr>
        <td>유통기한</td>
        <td>제품 별도 표기일까지</td>
    </tr>

    <tr>
        <td>원재료명 및 함량</td>
        <td><?php echo $row['raw_materials'];  ?></td>
    </tr>

    <tr>
        <td>보관방법(취급방법)	</td>
        <td>제품 별도 표기</td>
    </tr>

    <tr>
        <td>식품의 유형	</td>
        <td>반찬</td>
    </tr>

    <tr>
        <td>제조원 및 판매원</td>
        <td>찬 / 부산광역시 해운대</td>
    </tr>

    
    <tr>
        <td>알레르기식품</td>
        <td><p>본 제품은 게,새우,고등어,난류,땅콩,대두,우유,밀,메밀,돼지고기,복숭아,토마토,호두,잣,키위,닭고기,조개,굴,전복,홍합,오징어,쇠고기,참깨를 사용하거나 앞의 재료를 사용한 제품과 같은 제조시설에서 제조하고 있습니다.</p></td>
    </tr>
    





    </tbody>

</table>
    </div>



<!-- <nav class="navbar navbar-expand-sm navbar-light bg-light nav-justified"> -->
<div class="container" style="margin-top:50px;">
    <ul class="nav nav-justified nav-tabs">
        <li class="nav-item">
            <a class="nav-link border-right" href="#product">상품설명</a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-righ active">상품후기</a>
        </li>
        <li class="nav-item">
            <p><a class="nav-link border-right" href="#qu">문의사항</a></p>
        </li>
     </ul>

    </div>
<!-- </nav> -->




<div id="review" class="container" style="text-align: center;"><br>
    
<h4>후기</h4>

<div class="container" style="margin-top:70px;">
<table class="table table-hover table-sm">

    <thead class="thead-light">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>날짜</th>
        <th>조회수</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>162</td>
        <td>11</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>

    <tr>
        <td>161</td>
        <td>aa</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>

    <tr>
        <td>160</td>
        <td>zz</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>

    <tr>
        <td>159</td>
        <td>df</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>

    <tr>
        <td>158</td>
        <td>xcv</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>

    </tbody>

</table>
<hr/>


    <div style="margin-left:40%;">
        <!-- Declare the pagination class -->
        <ul class="pagination"> 
  
            <!-- Declare the item in the group -->
            <li class="page-item"> 
                <!-- Declare the link of the item -->
                <a class="page-link" href="#">이전</a> 
            </li> 
  
            <!-- Rest of the pagination items -->
            <li class="page-item"> 
                <a class="page-link" href="#">1</a> 
            </li> 
            <li class="page-item"> 
                <a class="page-link" href="#">2</a> 
            </li> 
            <li class="page-item"> 
                <a class="page-link" href="#">3</a> 
            </li> 
            <li class="page-item"> 
                <a class="page-link" href="#">다음</a> 
            </li> 
        </ul>
    </div>


</div>










  </div>





<!-- <nav class="navbar navbar-expand-sm navbar-light bg-light nav-justified"> -->
<div class="container" style="margin-top:50px;">
    <ul class="nav nav-justified nav-tabs">
        <li class="nav-item">
            <a class="nav-link border-right" href="#product">상품설명</a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-right" href="#review">상품후기</a>
        </li>
        <li class="nav-item">
            <p><a class="nav-link border-right active">문의사항</a></p>
        </li>
     </ul>

    </div>
<!-- </nav> -->



<div id="qu" class="container" style="text-align: center;"><br>

    <h4>문의</h4>
    

<div class="container" style="margin-top:70px;">
<table class="table table-hover table-sm">

    <thead class="thead-light">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>날짜</th>
        <th>조회수</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>160</td>
        <td>zz</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>

    <tr>
        <td>159</td>
        <td>df</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>

    <tr>
        <td>158</td>
        <td>xcv</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>

    </tbody>

</table>
<hr/>

<!-- <button class="btn btn-ouline-primary">글쓰기</button> -->
<a class="btn btn-info" style="float:right; color:white;">글쓰기</a><br>

    <div style="margin-left:40%;">
        <!-- Declare the pagination class -->
        <ul class="pagination"> 
  
            <!-- Declare the item in the group -->
            <li class="page-item"> 
                <!-- Declare the link of the item -->
                <a class="page-link" href="#">이전</a> 
            </li> 
  
            <!-- Rest of the pagination items -->
            <li class="page-item"> 
                <a class="page-link" href="#">1</a> 
            </li> 
            <li class="page-item"> 
                <a class="page-link" href="#">2</a> 
            </li> 
            <li class="page-item"> 
                <a class="page-link" href="#">3</a> 
            </li> 
            <li class="page-item"> 
                <a class="page-link" href="#">다음</a> 
            </li> 
        </ul>
    </div>


</div>



    </div>





<!-- footer -->
<?php include '../main/footer.php';?>




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
