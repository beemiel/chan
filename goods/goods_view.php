<?php
include '../main/db.php';

session_start();
?>
<?php
    $rating = "";
    function rating($a){
        if($a==1){
            $rating = "★☆☆☆☆";
        } else if ($a==2){
            $rating = "★★☆☆☆";
        } else if ($a==3){
            $rating = "★★★☆☆";
        } else if ($a==4){
            $rating = "★★★★☆";
        } else if ($a==5){
            $rating = "★★★★★";
        }

        return $rating;
    }

//제품고유 id(인덱스)
$product = $_GET['product'];


//쿼리문
$get = "SELECT * FROM items WHERE id='$product'";

$result = mysqli_query($conn, $get);
$row =  mysqli_fetch_array($result);


//오늘 본 상품
if($_COOKIE['todayview']){ //쿠키가 존재할 경우

    //쿠키가 갖고 있는 배열 가져옴
    $array = unserialize($_COOKIE['todayview']); 
    //배열의 크기가 3을 초과할 경우 앞의 3개만 남기고 뒤는 자름
    //ㄴ> 이렇게 자르지 않으면 a,b,c,d가 있을때 중복검사 때문에 d를 봐도 d가 추가되지 않아서 최신에 보이지 않음
    $array_count = count($array);
    if($array_count > 3){
        $temp =  array_slice($array, 0, 3); //0번째 인덱스부터 3개만 자름(2번째 인덱스까지)
        $array = $temp;
    }



    if(!in_array($product, $array)){
        //상품의 id가 쿠키에 저장된 배열의 요소가 아니면 해당 배열의 맨 앞에 추가해서 다시 쿠키에 저장해줌
        array_unshift($array, $product);
        //배열을 다시 serialize해줌
        $today_array = serialize($array);
        //동일한 이름을 가진 쿠키에 저장해줌(덮어씌워지는듯)
        setcookie('todayview',$today_array,time()+86400,'/');
    }


} else { //쿠키가 존재하지 않을 경우

    //상품의 id값을 담을 배열 선언
    $today = []; 
    //배열에 상품의 id값을 추가해줌
    array_push($today, $product);
    //쿠키에 담기위해서 serialize해줌
    $today_array = serialize($today);
    //배열을 담는 쿠키 생성
    setcookie('todayview',$today_array,time()+86400,'/');

}

//console.log는 자바스크립트에서 사용가능하므로 함수를 통해 자바스크립트를 호출해줌
function Console_log($data){
    echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
}

//로그에 출력해보기
$retrive_date = unserialize($_COOKIE['todayview']); 
//배열 크기만큼
// count() 함수는, "요소 개수가 0인 배열"과 "존재하지 않는 배열" 모두 0을 반환하기에 혼란스러운 점이 있습니다. 
// 이때는 isset() 함수를 사용하여 그 배열이 실재하는지 우선 체크하는 것이 좋습니다.
//ㄴ>isset말고 그냥 $retrive_date의 값이 불린이라서 저걸로 체크함
if($retrive_date == true){
    $count = count($retrive_date); //
    for($i=0; $i<$count; $i++){
        Console_log($retrive_date[$i]);
    }
}
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

<style type="text/css"> 
    table {width:500px;}
    table th {height:50px; background-color:#FCC;}
    table td {padding-left:5px;} 
    .hide {display:none;} 
    .show {display:table-row; height:80px; font-size:12px; background-color:#FFF;}
    .title td {cursor:pointer; height:30px; font-size:12px; background-color:#FFC;} 
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
              <h6 class=col-lg-9> <?php echo number_Format($row['price']);  ?> 원</h6>
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
            <!-- <form name="form" method="post" action="./cart_save.php"> -->
            <form name="form" method="post">
            
                수량 : <input type=hidden name="sell_price" value=<?php echo $row['price']; ?>>
                <input type="button" value=" - " onclick="del();">
                <input type="text" name="amount" value="1" size="3" onchange="change();">
                <input type="button" value=" + " onclick="add();">
                <br>

                금액 : <input type="text" name="sum" size="11" readonly>원
                <input type="hidden"  name="id" value=<?php echo $row['id']; ?>>

                <button class="btn btn-primary btn-block btn-lg" style="margin-top:10px;" onClick="mysubmit(1);">장바구니 담기</button>
                
                <button class="btn btn-warning btn-block btn-lg" onClick="mysubmit(2);">자주 사는 상품 등록</button>
            </form>     
            </div>

            <!-- 자바스크립트로 넘겨줄 세션값 -->
            <input type="hidden" id="hdnSession" data-value=<?php  echo $_SESSION['name'];  ?> />
            <script>

                function mysubmit(index){
                    if(index == 1){

                        //세션 값 가져옴
                        var sessionValue= $("#hdnSession").data('value');
                        if(sessionValue != "/"){ //로그인
                            // alert(sessionValue);
                            document.form.action='./cart_save.php';
                        } else { //비로그인 

                            //비로그인일때는 쿠키에 상품의 id를 담아줌
                            document.form.action='./nonmember_cart_cookie_save.php';
                            
                        }

                        
                    } else if (index == 2){
                        
                        //세션 값 가져옴
                        var sessionValue= $("#hdnSession").data('value');
                        if(sessionValue != "/"){ //로그인
                            // alert(sessionValue);
                            document.form.action='./wishlist_save.php';
                        } else { //비로그인 
                            alert("로그인이 필요합니다.");
                        }


                    }
                    document.form.submit();

                }

            </script>
            

            <!-- <div class="row" style="margin-bottom:10px; margin-left:20px; margin-right:20px; margin-top:10px;">
                <form method="post" action="./wishlist_save.php">
                    <button class="btn btn-warning btn-block btn-lg">자주 사는 상품 등록</button>
                    <input type="hidden"  name="id" value=<?php echo $row['id']; ?>>


                </form>
            </div> -->



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
        <th style="width: 10%">번호</th>
        <th style="width: 50%">제목</th>
        <th style="width: 10%">작성자</th>
        <th style="width: 10%">날짜</th>
        <th style="width: 10%">별점</th>
    </tr>
    </thead>
    <tbody>

        <?php  
        $get_review = "SELECT * FROM review WHERE item_id=$product";
        $get_review_result = mysqli_query($conn,$get_review);
        $review_count=mysqli_num_rows($get_review_result);  

        if($review_count > 0){ 

        for($i=0; $i<$review_count; $i++){
            $review_row = mysqli_fetch_array($get_review_result);

            $uuid = $review_row['writer_uuid'];

            //작성자 이름 가져옴
            $get_name = "SELECT * FROM member WHERE uuid='$uuid'";
            $get_name_result = mysqli_query($conn,$get_name);
            $name_row = mysqli_fetch_array($get_name_result);



            ?>

            <tr>
                <td><?php echo $review_row['id']; ?></td>
                <td><a style="color:black; text-decoration:none;" href="./goods_review_detail.php?review_id=<?php echo $review_row['id']; ?>"><?php echo $review_row['title']; ?></a></td>
                <td><?php echo $name_row['name']; ?></td>
                <td><?php echo $review_row['write_date']; ?></td>
                <td><?php echo $rating = rating($review_row['rating']); ?></td>
                
            </tr>


            <?php
        }

        } else {
            ?>


            <tr>
                <td></td>
                <td class="text-center">작성된 후기가 없습니다.</td>
                <td class="text-center"></td>
                <td></td>
                <td></td>
                
            </tr>


            <?php
        }
        ?>



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


<!-- <table class="table table-hover table-sm">

    <thead class="thead-light">
    <tr>
        <th style="width: 10%" class="text-center">문의유형</th>
        <th style="width: 70%" class="text-center">문의/답변</th>
        <th style="width: 10%" class="text-center">작성자</th>
        <th style="width: 10%" class="text-center">작성일</th>
    </tr>
    </thead>
    <tbody>

    <tr data-toggle="collapse" data-target="#accordion" class="clickable">
        <td>160</td>
        <td>zz</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
    </tr>

    <tr>
        <td colspan="4" id="accordion" class="collapse">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus molestiae quos earum rerum, eaque fugiat vero porro quidem, nemo libero quasi similique magni deleniti commodi unde, totam cupiditate soluta. Ad.
        </td>
    </tr>



    <tr data-toggle="collapse" data-target="#accordion2" class="clickable">
        <td>159</td>
        <td>df</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
    </tr>
    <tr>
        <td >
            <div id="accordion2" class="collapse">
                aaaHidden by default
            </div>
        </td>
    </tr>

    <tr data-toggle="collapse" data-target="#accordion3" class="clickable">
        <td>158</td>
        <td>xcv</td>
        <td>뚱이</td>
        <td>2016.11.30</td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="accordion3" class="collapse">dasgasdgidden by default</div>
        </td>
    </tr>

    </tbody>

</table> -->

<hr/>


<!-- <div id="accordion">
    <div class="card">
        <div class="card-header">
            <a data-toggle="collapse" data-parent="#accordion" href ="#collapseOne">
                Collapsible Group Item #1
            </a>
        </div>
        <div id="collapseOne" class="collapse show">
            <div class="card-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, ipsam accusamus deleniti 
                omnis minima at aliquam quisquam dignissimos modi voluptatem sapiente illo placeat aut, harum ea quos velit sit saepe!
            </div>
        </div>
    </div>
</div> -->





<!-- <table class="table table-hover">
<thead>
  <tr>
  <th style="width: 10%" class="text-center">문의유형</th>
        <th style="width: 70%" class="text-center">문의/답변</th>
        <th style="width: 10%" class="text-center">작성자</th>
        <th style="width: 10%" class="text-center">작성일</th>
  </tr>
</thead>

<tbody>
    <tr data-toggle="collapse" data-target="#accordion" class="clickable">
        <td>Some Stuff</td>
        <td>Some more stuff</td>
        <td>And some more</td>
        <td>And some more</td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="accordion" class="collapse">Hidden by default</div>
        </td>
    </tr>

</tbody>
</table> -->




<div id="accordion">
<table  class="table table-hover table-sm">
    <thead>
    <tr>
        <th style="width: 10%" class="text-center">문의유형</th>
        <th style="width: 70%" class="text-center">문의/답변</th>
        <th style="width: 10%" class="text-center">작성자</th>
        <th style="width: 10%" class="text-center">작성일</th>
    </tr>
    </thead>

    <tbody>
        <tr data-toggle="collapse" data-parent="#accordion"  href="#collapseOne">
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
        </tr>
        <tr>
            <td id="collapseOne" colspan="4" class="collapse">
                Lorem, ipsum dolor sit amet consectetur 
                adipisicing elit. Iste non autem illum, itaque tenetur quibusdam eius vel! 
                Ipsam molestias officiis odio perferendis eveniet quae deserunt quas, 
                maiores, fugiat enim error.
            </td>
        </tr>

        <tr>
            <td>5</td>
            <td class="more"><a href="#" class="showmsg1" data-sound="bark">dog</a></td>
            <td>7</td>
            <td>8</td>
        </tr>
        <tr>
            <td id="moreRegion" colspan="4">
                Lorem, ipsum dolor sit amet consectetur
                Lorem, ipsum dolor sit amet consectetur
                Lorem, ipsum dolor sit amet consectetur
            </td>
        </tr>

        <tr>
            <td>9</td>
            <td class="more2"><a href="#" class="showmsg2" data-sound="meow">cat</a></td>
            <td>11</td>
            <td>12</td>
        </tr>
        <tr>
            <td id="moreRegion2" colspan="4">
            adipisicing elit. Iste non autem illum
            adipisicing elit. Iste non autem illum
            adipisicing elit. Iste non autem illum
            </td>
        </tr>

        


    </tbody>

</table>
</div>


<script>


    $( document ).ready( function() {

        $("a.showmsg1").click(function() {
            alert("aa");
        // alert($(this).attr("data-sound"));
        });

        // $( "td.more" ).click( function() {
        //     alert("aa");
        //     // $("#moreRegion").hide();
        // } );


        // $( "td.more2" ).click( function() {
        //     alert("bb");
        //     // $("#moreRegion2").hide();
        // } );


    } );


</script>













<!-- <button class="btn btn-ouline-primary">글쓰기</button> -->
<form method="post" action="./goods_question.php" >
    <button type="submit" class="btn btn-primary" style="float:right;">글쓰기</button>
    <input type="hidden"  name="product_id" value=<?php echo $_GET['product']; ?>>
</form>

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
