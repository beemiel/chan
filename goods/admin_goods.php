<?php
include '../main/db.php';
session_start();
?>
<?php


//기본적인 페이징
// 페이지 설정
$page = ($_GET['page'])?$_GET['page']:1; // 현재페이지(넘어온값)
$page_set = 5; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

// 컬럼 데이터 갯수 가져오기
// SELECT COUNT(컬럼) FROM 테이블;
// "SELECT count(no) as total FROM board";
//테이블에 저장된 데이터의 개수 가져옴
$get_total = "SELECT COUNT(id) as total FROM items";
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



//테이블에 저장된 데이터 불러옴
//역순으로 불러옴
$get = "SELECT * FROM items order by id desc LIMIT $limit_index, $page_set";
$result = mysqli_query($conn, $get);
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

<div class="text-center" style="margin-top: 80px;" >
<h2>상품관리</h2>
</div>


<!-- 장바구니 -->



<!-- <div class="container-fluid" style="margin-top:70px;"> -->
<div class="container" style="margin-top:70px;">
<table class="table table-md">

    <thead class="thead-light">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th style="width: 5%">상품번호</th>
        <th style="width: 10%">카테고리</th>
        <th style="width: 15%">메인이미지</th>
        <th style="width: 15%">제품 이름</th>
        <th style="width: 10%">재고</th>
        <th style="width: 10%">판매량</th>
        <th style="width: 10%">금액</th>
        <th style="width: 10%"></th>
    </tr>
    </thead>
    <tbody>



    <?php

    if($count>0){

        for($i=0; $i<$count; $i++){

            $row =  mysqli_fetch_array($result);
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td>
                <img src=<?php echo $row['imgpath']; ?>  style="max-weight:100px; max-height:150px;"/>     
            </td>
            <td><?php echo $row['name']; ?></td>
            <td> 
                <form role="form" action="./admin_stock_update.php" method="post">
                    <input type="number" name="stock" class="form-control" value=<?php echo $row['stock']; ?>>
                    <input type="hidden" name="id" value=<?php echo $row['id']; ?>>
                    <Button class="btn btn-outline-primary col-lg-12">재고 수정</Button>
                </form>
            </td>
            <td> 
                <form role="form" action="" method="post">
                    <input type="number" name="sales" class="form-control" readonly value=<?php echo $row['sales']; ?>>
                </form>
            </td>
            <td><?php echo $row['price']; ?></td>
            <td> 
                <div class="row">

                    <form method="post" action="./goods_modify.php">
                        <input type="hidden"  name="id" value=<?php echo $row['id'] ?>>
                        <Button class="btn btn-outline-warning col-lg-12">상품 수정</Button>
                    </form>
                        
                        <!-- 파라미터로 넘겨주면 됨  -->
                        <Button class="btn btn-outline-danger " onclick=confirmter(<?php echo $row['id'] ?>)>상품 삭제</Button>
                        <script>
                            
                            function confirmter(id){
                                if(confirm("상품을 삭제할까요?")){

                                    location.href="./item_delete.php?id="+id;
                                    
                                } else {
                                    
                                }
                            }
                        </script>
                    

                </div>
            </td>
        </tr>




    <?php
        }
    } else {
        ?>

        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> 등록된 제품이 없습니다.</td>
            <td> </td>
            <td></td>
            <td></td>
        </tr>


    <?php
    }
    ?>


      




    </tbody>

</table>

        <hr>





        <div style="margin-left:40%;">
    <!-- Declare the pagination class -->
    <ul class="pagination"> 

<?php
if($block > 1){ // 첫번째 블럭 이전 버튼 예외처리 
?>
    <li class="page-item"> 
        <!-- Declare the link of the item -->
        <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$s_page-1?>">이전</a>
    </li> 
<?php
}
?>

<?php

for ($p=$s_page; $p<=$e_page; $p++) {

    if($p==$page){
?>
<li class="page-item active"> 
    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$p?>"><?=$p?></a>
</li> 
<?php
    } else {
        ?>
<li class="page-item"> 
    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$p?>"><?=$p?></a>
</li> 
<?php
    }

}


if($block < $total_block){ //마지막 블럭 다음 버튼 예외처리 
?>
            <li class="page-item"> 
            <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$e_page+1?>">다음</a>
            </li> 
    <?php
    }
    ?>
        </ul>
</div>
<!-- 컨테이너 끝 -->
</div>


<!-- 장바구니 -->













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
