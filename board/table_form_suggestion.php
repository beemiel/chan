<?php
include '../main/db.php';
?>

<?php

//기본적인 페이징
// 페이지 설정
$page = ($_GET['page'])?$_GET['page']:1; // 현재페이지(넘어온값)
$page_set = 10; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

// 컬럼 데이터 갯수 가져오기
// SELECT COUNT(컬럼) FROM 테이블;
// "SELECT count(no) as total FROM board";
//테이블에 저장된 데이터의 개수 가져옴
$get_total = "SELECT COUNT(id) as total FROM suggestion";
$total_result = mysqli_query($conn, $get_total);
$total_row = mysqli_fetch_array($total_result);
$total = $total_row['total']; // 전체글수


// $get = "SELECT * FROM suggestion order by id desc";
// $result = mysqli_query($conn, $get);
// //mysql_num_rows() 함수 : 행의 개수를 세는 함수.
// $count=mysqli_num_rows($result);    



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






$limit_index = ($page - 1) * $page_set; // limit시작위치(sql)

//현재페이지 쿼리
$get = "SELECT * FROM suggestion order by id DESC LIMIT $limit_index, $page_set";
$result = mysqli_query($conn, $get);
$rows = mysqli_num_rows($result);



?>
<!DOCTYPE html> 
<html> 
<head> 
</head>   



<body> 

<h4 style="margin-bottom:20px;">상품제안<?php echo $total; ?></h4>
<table class="table table-hover table-md">

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

            //for문이 순환하는 횟수보다 데이터의 양이 적을 때 순환을 멈추게 해주는 명령
            if($row == false){
                break;
            }


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


?>




<?php  

// 페이지번호 & 블럭 설정

//테스트
echo "현재 페이지는".$page."<br/>";
echo "현재 블록은".$block."<br/>";

echo "현재 블록의 시작 페이지는".$s_page."<br/>";
echo "현재 블록의 끝 페이지는".$e_page."<br/>";

echo "총 페이지는".$total_page."<br/>";
echo "총 블록은".$total_block."<br/>";
//테스트


for($p = $s_page; $p <= $e_page; $p++){

    ?>


<div style="margin-left:40%;">


        <!-- Declare the pagination class -->
        <ul class="pagination"> 
  

  
            <!-- Rest of the pagination items -->
            <li class="page-item"> 
                <a class="page-link" href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $p; ?>"><?= $p; ?></a> 
            </li> 



        </ul>
</div>




<?php
}

?>

            <!-- Declare the item in the group -->
            <li class="page-item"> 
                <!-- Declare the link of the item -->
                <a class="page-link" href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $s_page-1 ?>">이전</a> 
            </li> 

            <li class="page-item"> 
                <a class="page-link" href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $s_page+1 ?>">다음</a> 
            </li> 



</body> 
</html> 