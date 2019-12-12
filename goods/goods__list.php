<?php
include '../main/db.php';

session_start();



//   if($_GET['category'] == 001){
//     $get = "SELECT * FROM items WHERE category='001' order by id desc";
//   } else if($_GET['category'] == 002){
//     $get = "SELECT * FROM items WHERE category='002' order by id desc";
//   } else if($_GET['category'] == 003){
//     $get = "SELECT * FROM items WHERE category='003' order by id desc";
//   } else if($_GET['category'] == 004){
//     $get = "SELECT * FROM items WHERE category='004' order by id desc";
//   } else if($_GET['category'] == 005){
//     $get = "SELECT * FROM items WHERE category='005' order by id desc";
//   } else if($_GET['category'] == 006){
//     $get = "SELECT * FROM items WHERE category='006' order by id desc";
//   } else if($_GET['category'] == 007){
//     $get = "SELECT * FROM items WHERE category='007' order by id desc";
//   } else {
//     echo '<script> alert("존재하지 않는 페이지 입니다."); history.back(); </script>';
//   }
  



//기본적인 페이징
// 페이지 설정
$page = ($_GET['page'])?$_GET['page']:1; // 현재페이지(넘어온값)
$page_set = 9; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

// 컬럼 데이터 갯수 가져오기
// SELECT COUNT(컬럼) FROM 테이블;
// "SELECT count(no) as total FROM board";
//테이블에 저장된 데이터의 개수 가져옴
$get_total = "SELECT COUNT(id) as total FROM items WHERE category={$_GET['category']}";
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




$get = "SELECT * FROM items WHERE category={$_GET['category']} order by id DESC LIMIT $limit_index, $page_set";
//   echo("쿼리오류 발생: " . mysqli_error($conn));
//   $get = "SELECT * FROM items WHERE category='002'";
$result = mysqli_query($conn, $get);
// $row =  mysqli_fetch_array($result);
       
// echo count($row);
// echo $row['name'];

//개수
//mysql_num_rows() 함수 : 행의 개수를 세는 함수.
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

        <h2 style="margin-top:80px;">
            <?php 

                if($_GET['category'] == 001){
                    echo "국/찌개/탕";
                } else if ($_GET['category'] == 002){
                    echo "마른반찬";
                } else if ($_GET['category'] == 003){
                    echo "무침";
                } else if ($_GET['category'] == 004){
                    echo "볶음";
                } else if ($_GET['category'] == 005){
                    echo "조림";
                } else if ($_GET['category'] == 006){
                    echo "전/생선";
                } else if ($_GET['category'] == 007){
                    echo "김치/절임/젓갈";
                }
               
            ?>
        </h2>
        
    
    
    
    </div>



    
<div class="row">


    <div class="container">

    

        <div class="row">
            <div class="col-9">
                <p>총 <?php echo $total; ?> 개의 상품이 검색되었습니다.</p>
            </div>
            
            <div class="row col-3">
                <a href="portfolio-4-col.html">낮은 가격순&nbsp</a>
                <h6>|</h6>
                <a href="portfolio-4-col.html">&nbsp높은 가격순&nbsp</a>
                <h6>|</h6>
                <a href="portfolio-4-col.html">&nbsp최신순&nbsp</a>
            </div>

            
        </div>
        
        <hr>



        <!-- 카드 -->
        <div class="row">
            <!-- 이 row안에서 반복문으로 계속 보내주면 될듯 -->


    <?php

    if($count>0){
        //등록된 상품이 있는 경우 



        for($i=0; $i<$count; $i++){

            $row =  mysqli_fetch_array($result);

            echo "
            

            
                
            <div class=\"col-lg-4 col-md-6 mb-4\">
            <div class=\"card h-100\">
                <a href=\"./goods_view.php?product=".$row['id']."\">
                    <img  style=\"max-width:auto; max-height:250px;\" class=\"card-img-top\" src=\"".$row['imgpath']."\">
                </a>
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
        //등록된 상품이 없는 경우

        echo "
        
        <h3 class=col-lg-4></h3>
        <h3 class=col-lg-4 style=margin-top:100px;> 등록된 상품이 없습니다 </h3>
        <h3 class=col-lg-4></h3>
        
        ";

    }

    ?>


           

                








        </div>
        <!-- /.row -->




<!-- 페이지네이션 -->

<div style="margin-left:45%;">
    <!-- Declare the pagination class -->
    <ul class="pagination"> 

<?php
if($block > 1){ // 첫번째 블럭 이전 버튼 예외처리 
?>
    <li class="page-item"> 
        <!-- Declare the link of the item -->
        <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?category=<?=$_GET['category']?>&page=<?=$s_page-1?>">이전</a>
    </li> 
<?php
}
?>

<?php

for ($p=$s_page; $p<=$e_page; $p++) {

    if($p==$page){
?>
<li class="page-item active"> 
    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?category=<?=$_GET['category']?>&page=<?=$p?>"><?=$p?></a>
</li> 
<?php
    } else {
        ?>
<li class="page-item"> 
    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?category=<?=$_GET['category']?>&page=<?=$p?>"><?=$p?></a>
</li> 
<?php
    }

}


if($block < $total_block){ //마지막 블럭 다음 버튼 예외처리 
?>
            <li class="page-item"> 
            <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?category=<?=$_GET['category']?>&page=<?=$e_page+1?>">다음</a>
            </li> 
    <?php
    }
    ?>
        </ul>
</div>









    </div>
    <!-- 컨테이너 끝 -->

    <!-- 오늘 본 상품 사이드바 -->
    <?php include '../main/today_item_sidebar.php';?>

</div>
<!-- 컨테이너 감싸는 row끝 -->




























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
