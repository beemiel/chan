<?php
include '../main/db.php';
session_start();


  //1:1문의 게시판인데 세션에 저장된 정보가 없으면(로그인이 되어있지 않으면) 뒤로 돌려보냄
    if($_GET['board'] == "question"){

        if($_SESSION['name'] == ""){
            echo '<script> alert("로그인이 필요한 페이지입니다"); history.back(); </script>';
        }

    }

    //get으로 받은 게시판 종류
    if($_GET['board'] == "notice"){
        $board = "공지사항";
        //공지 가져오는 쿼리
        $sql = "SELECT * FROM notice";
    } else if($_GET['board'] == "question"){
        $board = "1:1 문의";
        //1:1문의글 가져오는 쿼리
        $sql = "SELECT * FROM 1:1문의";
    } else if($_GET['board'] == "suggestion"){
        $board = "상품제안";
        //제안 가져오는 쿼리
        $sql = "SELECT * FROM suggestion";
    }



//기본적인 페이징
// 페이지 설정
$page = ($_GET['page'])?$_GET['page']:1; // 현재페이지(넘어온값)
$page_set = 10; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

// 컬럼 데이터 갯수 가져오기
// SELECT COUNT(컬럼) FROM 테이블;
// "SELECT count(no) as total FROM board";
//테이블에 저장된 데이터의 개수 가져옴
$get_total = "SELECT COUNT(id) as total FROM {$_GET['board']}";
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

//현재페이지 쿼리
$get = "SELECT * FROM {$_GET['board']} order by id DESC LIMIT $limit_index, $page_set";
$result = mysqli_query($conn, $get);
if($result){$rows = mysqli_num_rows($result);}



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

a:link { color: black; text-decoration: none;}
 a:visited { color: black; text-decoration: none;}
 a:hover { color: black; text-decoration: underline;}


</style>

<body>

<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>

<hr>

<h2 class="text-center" style="margin-top:50px; ">
    <?php
        echo $category;
    ?>
    
</h2>


<div class="container" style="margin-top:70px;">

    <div class="row">

        <!-- 사이드바 -->
        <?php include './board_sidebar.php';?>

        <!-- 테이블 -->
        <div class="col-lg-10">
        <!-- 카테고리별로 가져오는 테이블 다르도록 -->
        <!-- 테이블 -->
        <h4 style="margin-bottom:20px;"><?= $board; ?></h4>

<table class="table table-hover table-md ">

    <thead class="thead-light text-center">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th style="width: 10%">번호</th>
        <th style="width: 55%">제목</th>
        <th style="width: 10%">작성자</th>
        <th style="width: 15%">날짜</th>
        <th style="width: 10%">조회수</th>
    </tr>
    </thead>
    <tbody>

    <?php

    if($rows>0){

        for($i=0; $i<$rows; $i++){

            $row =  mysqli_fetch_array($result);
            ?>

            <tr>
            <td class="text-center"><?php echo $row['id']; ?></td>
            <td><a href="./view.php?board=<?php echo $row['category']; ?>&id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
            <td class="text-center"><?php echo $row['user_name']; ?></td>
            <td class="text-center"><?php echo $row['date']; ?></td>
            <td class="text-center"><?php echo $row['count']; ?></td>
            </tr>




        <?php
        }

    } else {
        ?>



        <tr>
        <td></td>
        <td class="text-center">작성된 글이 없습니다.</a></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>



    <?php
    }
    ?>

    



    


    </tbody>

</table>



<hr/>



<?php

if($_GET['board'] == "notice"){
    //admin한테만 버튼 보이게
    if($_SESSION['name'] == "admin" || $_COOKIE['name'] == "admin"){
        //공지 글쓰기버튼~
        ?>
        <form method="get" action="./write_notice.php" id="write">
        <a class="btn btn-info" style="float:right; color:white;" href="javascript:write.submit();">글쓰기</a>
        <input type="hidden" id="gameToken" name="board" value=<?php echo $_GET['board'] ?>>
        </form>


        <?php
    }

} else {
    //버튼 보이게
    //버튼~
    ?>

        <form method="get" action="./write.php" id="write">
        <a class="btn btn-info" style="float:right; color:white;" href="javascript:write.submit();">글쓰기</a>
        <input type="hidden" id="gameToken" name="board" value=<?php echo $_GET['board'] ?>>
        </form>

    <?php
}


// echo "현재 페이지는".$page."<br/>";
// echo "현재 블록은".$block."<br/>";

// echo "현재 블록의 시작 페이지는".$s_page."<br/>";
// echo "현재 블록의 끝 페이지는".$e_page."<br/>";

// echo "총 페이지는".$total_page."<br/>";
// echo "총 블록은".$total_block."<br/>";


?>


<div style="margin-left:40%;">
    <!-- Declare the pagination class -->
    <ul class="pagination"> 

<?php
if($block > 1){ // 첫번째 블럭 이전 버튼 예외처리 
?>
    <li class="page-item"> 
        <!-- Declare the link of the item -->
        <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?board=<?=$_GET['board']?>&page=<?=$s_page-1?>">이전</a>
    </li> 
<?php
}
?>

<?php

for ($p=$s_page; $p<=$e_page; $p++) {

    if($p==$page){
?>
<!-- <a href="<?=$_SERVER['PHP_SELF']?>?board=<?=$_GET['board']?>&page=<?=$p?>"><?=$p?></a> -->
<li class="page-item active"> 
    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?board=<?=$_GET['board']?>&page=<?=$p?>"><?=$p?></a>
</li> 
<?php
    } else {
        ?>
<li class="page-item"> 
    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?board=<?=$_GET['board']?>&page=<?=$p?>"><?=$p?></a>
</li> 
<?php
    }

}


if($block < $total_block){ //마지막 블럭 다음 버튼 예외처리 
?>
            <li class="page-item"> 
            <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?board=<?=$_GET['board']?>&page=<?=$e_page+1?>">다음</a>
            </li> 
    <?php
    }
    ?>
        </ul>
</div>


        

        </div>
        <!-- 테이블 -->



    </div>
    <!-- ㄴ>row끝 -->

</div>
<!-- ㄴ>container 끝  -->






































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
