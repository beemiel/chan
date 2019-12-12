<?php
include '../main/db.php';

session_start();
?>

<?php
// if ( ! session_id() ) {

//   session_start();
//   // $_SESSION['name'];
//   if($_SESSION['name'] != null){
//     echo '<script> document.getElementById("tel1").style.display = "block"; </script>';
//   }

  
// }


  if($_GET['category'] == 001){
    $get = "SELECT * FROM items WHERE category='001'";
  } else if($_GET['category'] == 002){
    $get = "SELECT * FROM items WHERE category='002'";
  } else if($_GET['category'] == 003){
    $get = "SELECT * FROM items WHERE category='003'";
  } else if($_GET['category'] == 004){
    $get = "SELECT * FROM items WHERE category='004'";
  } else if($_GET['category'] == 005){
    $get = "SELECT * FROM items WHERE category='005'";
  } else if($_GET['category'] == 006){
    $get = "SELECT * FROM items WHERE category='006'";
  } else if($_GET['category'] == 007){
    $get = "SELECT * FROM items WHERE category='007'";
  } else {
    echo '<script> alert("존재하지 않는 페이지 입니다."); history.back(); </script>';
  }

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

    <p>
    <?php
        for($i=0; $i<$count; $i++){
            $result_array=mysqli_fetch_array($result);
            echo "이름 :".$result_array['name']."<br>";
            // echo "$result_array[num] : $result_array[name]";

        }

    ?>
    </p>



    <div class="text-center" style="margin-top: 50px; margin-bottom:100px;">

        <h2 style="margin-top:80px;">
            <?php 

                if($_GET['category'] == 001){
                    // echo $category = $_GET['category'];
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
        
    
        <!-- <h2>마른반찬</h2> -->
    
    
    
    </div>

    <div class="container">

        <div class="row">
            <div class="col-9">
                <p>총 <?php echo $count; ?> 개의 상품이 검색되었습니다.</p>
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

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                  
                    <a href="#"><img class="card-img-top" src="http://zipbanchan.godohosting.com/800X800px/moochim/chamnamul_tufu.jpg" alt=""></a>


                    <div class="card-body">
                        <h4 class="card-title">




                  <!-- 이거 이렇게 하면 form마다 id값이 다 달라야 실행이 되는데..어떻게 하지.. -->
                  <!-- 카테고리 번호와 제품 번호를 같이 보내줌 근데 제품번호는 어떻게 알아오지ㅋ -->
                  <!-- @@@@@ -->
                  <!-- href에 링크에 get을 넣어주고 변수는 php로 넣어주면 될듯 -->
                  <!-- @@@@@ -->
                        <form method="get" action="./goods_view.php" id="a1">
                            <a href="javascript:a1.submit();">
                              <?php echo $name ?>
                            </a>
                            <input type="hidden"  name="category" value=<?php echo $_GET['category'] ?>>
                            <input type="hidden" name="product" value=<?php echo $name ?>>
                        </form>








                        </h4>
                        <p class="card-text">잎이 부드러워 소화가 잘 돼요</p>
                        <h5>5,000원</h5>
                        <form role="form">
                            <input type="number" min="0" max="100" value="1"/>
                            <!-- <input class="form-control mr-sm-2" name="product" type="search" placeholder="내용을 입력하세요" aria-label="Search"> -->
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">장바구니 담기</button>
                        </form>
                    </div>
      <!-- <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div> -->
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="http://zipbanchan.godohosting.com/800X800px/moochim/chamnamul_tufu.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">참나물 두부무침</a>
                        </h4>
                        <p class="card-text">잎이 부드러워 소화가 잘 돼요</p>
                        <h5>5,000원</h5>
                        <form role="form">
                            <input type="number" min="0" max="100" value="1"/>
                            <!-- <input class="form-control mr-sm-2" name="product" type="search" placeholder="내용을 입력하세요" aria-label="Search"> -->
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">장바구니 담기</button>
                        </form>
                    </div>
      <!-- <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div> -->
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="http://zipbanchan.godohosting.com/800X800px/moochim/chamnamul_tufu.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">참나물 두부무침</a>
                        </h4>
                        <p class="card-text">잎이 부드러워 소화가 잘 돼요</p>
                        <h5>5,000원</h5>
                        <form role="form">
                            <input type="number" min="0" max="100" value="1"/>
                            <!-- <input class="form-control mr-sm-2" name="product" type="search" placeholder="내용을 입력하세요" aria-label="Search"> -->
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">장바구니 담기</button>
                        </form>
                    </div>
                </div>
            </div>

                








        </div>
        <!-- /.row -->













    </div>
    <!-- 컨테이너 끝 -->





























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
