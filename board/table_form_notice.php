<?php
include '../main/db.php';
?>

<?php

    //session_start();

  //noticd 테이블에 저장된 데이터 불러옴
  //역순으로 불러옴
  $get = "SELECT * FROM notice order by id desc";
//   $get = "SELECT * FROM notice";
  $result = mysqli_query($conn, $get);

  //mysql_num_rows() 함수 : 행의 개수를 세는 함수.

    $count=mysqli_num_rows($result);       






?>
<!DOCTYPE html> 
<html> 
<head> 
</head>   



<body> 

<h4 style="margin-bottom:20px;">공지사항</h4>

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

    if($count>0){

        for($i=0; $i<$count; $i++){

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


?>









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



</body> 
</html> 