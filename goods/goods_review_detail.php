<?php
include '../main/db.php';
session_start();


$id = $_GET['review_id'];

$get_review = "SELECT * FROM review WHERE id=$id";
$review_result = mysqli_query($conn,$get_review);
$review_row = mysqli_fetch_array($review_result);

$uuid = $review_row['writer_uuid'];
$get_name = "SELECT * FROM member WHERE uuid='$uuid'";
$name_result = mysqli_query($conn,$get_name);
$name_row = mysqli_fetch_array($name_result);

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

<!-- 상단 네비게이션 -->
<?php include '../main/top_navbar.php';?>


<hr>

<h5 style="margin-top:50px; margin-left:200px;">후기 상세보기</h5> 


<div class="container" style="margin-top:30px; border-bottom:1px solid #ccc; border-color:blue; ">

<!-- 게시글 상단 정보 -->
<div class="row">
    <div class="col-2 text-center" style="height:40px; padding: 10px 0px; border-top:1px solid #ccc; border-color:blue; background-color: #D9E5FF;">
        제목
    </div>
    <div class="col-10" style="padding-top:8px; border-top:1px solid #ccc; border-color:blue;">
        <?php echo $review_row['title']; ?>
    </div>
</div>

<div class="row">
    <div class="col col-lg-2 text-center" style="height:40px; padding: 10px 0px; border-top:1px solid #ccc; background-color: #D9E5FF; ">
        작성자
    </div>
    <div class="col col-lg-10" style="padding-top:8px; border-top:1px solid #ccc;">
        <?php echo $name_row['name']; ?>
    </div>
</div>

<div class="row" style="border-bottom:1px solid #ccc;">
    <div class="col col-lg-2 text-center" style="height:40px; padding: 10px 0px;border-top:1px solid #ccc; background-color: #D9E5FF;">
        작성일
    </div>
    <div class="col col-lg-4" style="padding-top:8px; border-top:1px solid #ccc;">
        <?php echo $review_row['write_date']; ?>
    </div>

    <div class="col col-lg-2 text-center" style="height:40px; padding: 10px 0px; border-top:1px solid #ccc; background-color: #D9E5FF;">
        평점
    </div>
    <div class="col col-lg-4" style="padding-top:8px; border-top:1px solid #ccc;">
    <?php echo $rating = rating($review_row['rating']); ?>
    </div>
</div>

<!-- 게시글 상단 정보 -->



<!-- 게시글 내용 -->

<div style="margin-top:20px;">
<?php echo $review_row['contents']; ?>
</div>


<!-- 게시글 내용 -->






<!-- <div class="row justify-content-md-center">
    <div class="col col-lg-2" style="border:1px solid #ccc;">
      1 of 3
    </div>
    <div class="col-md-auto" style="border:1px solid #ccc;">
      Variable width content
    </div>
    <div class="col col-lg-2" style="border:1px solid #ccc;">
      3 of 3
    </div>
  </div>
  <div class="row">
    <div class="col" style="border:1px solid #ccc;">
      1 of 3
    </div>
    <div class="col-md-auto" style="border:1px solid #ccc;">
      Variable width content
    </div>
    <div class="col col-lg-2" style="border:1px solid #ccc;">
      3 of 3
    </div>
  </div>
</div> -->


</div>
<!-- 컨테이너 끝 -->



<!-- 목록 / 수정 / 삭제 버튼 -->
<!-- 글쓴이와 로그인 멤버 대조해서 수정/삭제 보이게 혹은 안보이게 처리 -->
<div class="container">

<div class="row" style="margin-top:10px;">

    <a class="btn btn-primary col-1" style="color:white;" href="./list.php?board=<?php echo $table; ?>">목록</a>
    <a class="btn btn-default col-9" style="color:white;">aa</a>


    <?php 

        if($row['user_id'] == $_SESSION['uuid'] || $row['user_id'] == $_COOKIE['uuid']){
            ?>

            <form role="form" method="post" action="./modify.php">
                <input type="hidden"  name="board" value=<?php echo $table; ?>>
                <input type="hidden"  name="id" value=<?php echo $id; ?>>
                <input type="hidden"  name="title" value=<?php echo $row['title']; ?>>

                <!-- 글내용은 왜 안들어가는거임 -->
                <!-- <input type="hidden"  name="contents" value=<?php echo $row['contents']; ?>> -->
                <Button type="submit" class="btn btn-warning" >수정</Button>
            </form>

            <!-- <a class="btn btn-warning col-1" style="color:white;"  href="./modify_notice.php">수정</a> -->


            <a style="visibility:hidden;">aaaa</a>

            <Button type="button" class="btn btn-danger" onclick=confirmter()>삭제</Button>

            <script>
                function confirmter(){

                    if(confirm("삭제할까요?")){

                        location.href="./delete.php?board=<?php echo $table; ?>&id=<?php echo $id; ?>";

                    } else {

                    }


                }
            </script>


            <!-- <form role="form" method="post" action="./delete.php">
                <input type="hidden"  name="board" value=<?php echo $table; ?>>
                <input type="hidden"  name="id" value=<?php echo $id; ?>>
                <Button type="submit" class="btn btn-danger" >삭제</Button>
            </form> -->
            <!-- <a class="btn btn-danger col-1" style="color:white;"  href="">삭제</a> -->

            <?php
        }

    ?>
    



</div>

</div>
<!-- 목록 / 수정 / 삭제 버튼 -->

































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
