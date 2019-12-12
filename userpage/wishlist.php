<?php
include '../main/db.php';
session_start();


//post 방식으로  웹서버가 호출 되는 경우 발생하는 호출에 대한 보장이 없기 때문에 발생하는 상황 예외처리
header("Pragma: no-cache");
header("Cache-Control: no-cache,must-revalidate");


$user = $_SESSION['uuid'];













//기본적인 페이징
// 페이지 설정
$page = ($_POST['page'])?$_POST['page']:1; // 현재페이지(넘어온값)
$page_set = 3; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

// 컬럼 데이터 갯수 가져오기
// SELECT COUNT(컬럼) FROM 테이블;
// "SELECT count(no) as total FROM board";
//테이블에 저장된 데이터의 개수 가져옴
$get_total = "SELECT COUNT(id) as total FROM wishlist";
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





















//디비에 저장된 리스트 불러옴
$get = "SELECT * FROM wishlist WHERE user='$user' order by id DESC LIMIT $limit_index, $page_set";
$result = mysqli_query($conn,$get);
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

a:link { color: black; text-decoration: none;}
 a:visited { color: black; text-decoration: none;}
 a:hover { color: black; text-decoration: underline;}


</style>

<body>

<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>

<hr>



<div class="container" style="margin-top:70px;">

    <div class="row">

        <!-- 사이드바 -->
        <?php include './userpage_sidebar.php';?>


        <div class="col-lg-10">
        
        <h3 style="margin-bottom:30px;">늘 사는 것</h3>

        <table class="table table-md">

            <thead class="thead-light">
            <!-- tr태그는 한 줄을 뜻함 -->
            <tr>
                <th class="text-center" style="width: 20%"></th>
                <th class="text-center" style="width: 50%">상품정보</th>
                <th class="text-center" style="width: 10%">수량</th>
                <th  style="width: 5%"></th>
                <th class="text-center" style="width: 15%">선택</th>
            </tr>
            </thead>
            <tbody>


            <?php

            if($count > 0){
                //저장된 것이 있을때
                for($i=0; $i<$count; $i++){
                    $row =  mysqli_fetch_array($result);
                    $id = $row['item'];
    
                    $get_item = "SELECT * FROM items WHERE id=$id";
                    $query = mysqli_query($conn, $get_item);
                    $item =  mysqli_fetch_array($query);
    
                    ?>




            <tr>
            <td>
                <a class="thumbnail pull-left" href="#"> <img class="media-object"  src=<?php echo $item['imgpath']; ?> style="max-width: 130px; max-height: 150px;"> </a>     
            </td>
            <td> 
                <div class="row">
                    <div class="col-lg-12"><?php echo $item['name']; ?></div>
                    <div class="col-lg-12"><?php echo $item['subtitle']; ?></div>
                </div>
            </td>
            <td> 
                <div class="row">
                    <form action="./wishlist_count_update.php" method="post">
                        <input type="number" class="form-control" name="count" value=<?php echo $row['count']; ?> size="1">
                        <input type="hidden"  name="wish_id" value=<?php echo $row['id']; ?>>
                        <button class="btn btn-outline-primary">수량 변경</button>
                    </form>
                </div>
            </td>
            <td></td>
            <td> 
                <div class="row">
                    <form action="../goods/cart_save.php" method="post">
                        <button class="btn btn-outline-warning btn-block">장바구니 담기</button>
                        <input type="hidden"  name="id" value=<?php echo $item['id']; ?>>
                        <input type="hidden"  name="amount" value=<?php echo $row['count']; ?>>
                    </form>
                    
                    <button class="btn btn-outline-danger btn-block" onclick=confirmter(<?php echo $row['id'] ?>)>삭제</button>

                    <script>
                            function confirmter(id){
                                if(confirm("상품을 삭제할까요?")){
                                    location.href="./wishlist_delete.php?id="+id;
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
                //저장된 것이 없을 때
            ?>  

            <tr>
            <td> </td>
            <td> </td>
            <td class="text-center"> 자주 사는 상품을 담아보세요! </td>
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
            <!-- Declare the item in the group -->
            <li class="page-item"> 
                <!-- Declare the link of the item -->
                <a class="page-link" href="#" onclick="page_change(<?=$s_page-1?>)">이전</a> 
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
            <a class="page-link" href="#" onclick="page_change(<?=$p?>)"><?= $p ?></a> 
            </li> 

<?php
    } else {
?>

            <!-- Rest of the pagination items -->
            <li class="page-item"> 
            <a class="page-link" href="#" onclick="page_change(<?=$p?>)"><?= $p ?></a> 
            </li> 


<?php
    }

}

if($block < $total_block){ //마지막 블럭 다음 버튼 예외처리 
?>


            <li class="page-item"> 
            <a class="page-link" href="#" onclick="page_change(<?=$e_page+1?>)">다음</a> 
            </li> 
<?php
}
?>



        </ul>
        </div>

        

        </div>



    </div>
    <!-- ㄴ>row끝 -->

</div>
<!-- ㄴ>container 끝  -->



<script>

function page_change(now_page){

    //form이 없으므로 여기서 생성해줌
    var form = document.createElement("form");
    form.setAttribute("charset", "UTF-8");
    form.setAttribute("method", "Post"); // Get 또는 Post 입력
    form.setAttribute("action", "<?=$_SERVER['PHP_SELF']?>");

    //같이 보낼 필드 생성하고 값 넣어줌
    //id문자열 넣을 필드
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "page");
    hiddenField.setAttribute("value", now_page);
    form.appendChild(hiddenField);

    //hthml의 body에 붙여주는 듯
    document.body.appendChild(form); 

    //submit
    form.submit();

}


</script>




































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
