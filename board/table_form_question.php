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
<html> 
<head> 
</head>   



<body> 

<h4 style="margin-bottom:20px;">1:1 문의</h4>
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

    <tr>
        <td>163</td>


        <form method="get" action="./view.php" id="post1">
            <td><a href="javascript:post1.submit();">환불문의</a></td>
            <input type="hidden" id="gameToken" name="board" value=<?php echo $_GET['board'] ?>>
            <input type="hidden" id="gameToken" name="no" value="163">
        </form>
        
        <!-- <td><a href="./view.php">Lorem ipsum dolor sit amet consectetur adipisicing</a></td> -->




        <td>뚱이</td>
        <td>2016.11.30</td>
        <td>2</td>
    </tr>


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