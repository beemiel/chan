<?php
include '../main/db.php';
  session_start();


$search = $_GET['product'];


//기본적인 페이징
// 페이지 설정
$page = ($_GET['page'])?$_GET['page']:1; // 현재페이지(넘어온값)
$page_set = 1; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

// 컬럼 데이터 갯수 가져오기
// SELECT COUNT(컬럼) FROM 테이블;
// "SELECT count(no) as total FROM board";
//테이블에 저장된 데이터의 개수 가져옴
$get_total = "SELECT COUNT(id) as total FROM items WHERE name like '%$search%'";
$total_result = mysqli_query($conn, $get_total);

if($total_result){$total_row = mysqli_fetch_array($total_result);}

$total = $total_row['total']; // 전체글수


$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil($total_page / $block_set); //총 블럭 수(올림함수)

// $page = ($_GET['page'])?$_GET['page']:1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)

//시작페이지(현재 블럭의 시작페이지)
$s_page = ($block * $block_set) - 4; //현재블럭 * 한 페이지 블럭수 
if ($s_page <= 1) { //예외처리
    $s_page = 1;
}
//끝 페이지(현재 블럭의 끝페이지)
$e_page = $block * $block_set;
if ($total_page <= $e_page) { //예외처리
    $e_page = $total_page;
}

$limit_index = ($page - 1) * $page_set; // limit시작위치(sql)
















//제품 이름을 기준으로 검색
// $get = "SELECT * FROM items WHERE name='$search'";
$get = "SELECT * FROM items WHERE name like '%$search%' order by id desc LIMIT $limit_index, $page_set";

$result = mysqli_query($conn, $get);
$count=mysqli_num_rows($result);    

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

<body>

    <!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>

  <hr>
  

  <div class="text-center" style="margin-top: 50px; margin-bottom:100px;">
    <h2>
      '
      <?php
        echo $_GET['product'];
      ?>
      '
      상품검색
    </h2>   
    <h6>신선한 상품을 검색해보세요.</h6> 
  </div>

  <div class="container">

    <h6>총 <?php echo $count; ?>개의 상품이 검색되었습니다.</h6>
    <hr>

        <!-- 카드 -->
        <div class="row">
            <!-- 이 row안에서 반복문으로 계속 보내주면 될듯 -->


    <?php

    if($count>0){
        //검색 상품이 있는 경우 



        for($i=0; $i<$count; $i++){

            $row =  mysqli_fetch_array($result);

            echo "
            

            
                
            <div class=\"col-lg-4 col-md-6 mb-4\">
            <div class=\"card h-100\">
                <a href=\"./goods_view.php?category=".$row['category']."&product=".$row['id']."\"><img class=\"card-img-top\" src=\"".$row['imgpath']."\"></a>
                <div class=\"card-body\">
                    <h4 class=\"card-title\">
                        <a>". $row['name'] ."</a>
                    </h4>
                    <p class=\"card-text\">".$row['subtitle']."</p>
                    <h5>".$row['price']."원</h5>
                    <form role=\"form\">
                        <input type=\"number\" min=\"0\" max=\"100\" value=\"1\"/>
                        
                        <button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">장바구니 담기</button>
                    </form>
                </div>
            </div>
            </div>




            
            
            
            ";





        }


    } else {
        //검색 상품이 없는 경우

        echo "
        
        <h3 class=col-lg-4></h3>
        <h3 class=col-lg-4 style=margin-top:100px;> 검색 상품이 없습니다. </h3>
        <h3 class=col-lg-4></h3>
        
        ";

    }

    ?>


           

                








        </div>
        <!-- /.row -->


        <!-- 페이지네이션 -->
        <!-- 페이지 -->
<div style="margin-left:45%; margin-top:50px;">
        <!-- Declare the pagination class -->
        <ul class="pagination"> 
  
<?php
if($block > 1){ // 첫번째 블럭 이전 버튼 예외처리 
?>
            <!-- Declare the item in the group -->
            <li class="page-item"> 
                <!-- Declare the link of the item -->
                <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?product=<?=$_GET['product']?>&page=<?=$s_page-1?>">이전</a>
            </li> 
<?php
}
?>
  
<?php
for ($p=$s_page; $p<=$e_page; $p++){

    if($p==$page){
        ?>

        <!-- Rest of the pagination items -->
        <li class="page-item active"> 
            <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?product=<?=$_GET['product']?>&page=<?=$p?>"><?=$p?></a>
        </li> 


<?php
    } else {
?>

        <!-- Rest of the pagination items -->
        <li class="page-item"> 
            <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?product=<?=$_GET['product']?>&page=<?=$p?>"><?=$p?></a>
        </li> 


<?php
    }

}

if($block < $total_block){ //마지막 블럭 다음 버튼 예외처리 
?>

            <li class="page-item"> 
                <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?product=<?=$_GET['product']?>&page=<?=$s_page+1?>">이전</a>
            </li> 

<?php
}
?>

        </ul>
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
