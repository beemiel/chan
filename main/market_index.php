<?php
include './db.php';
session_start();






//인기 반찬
$get_best = "SELECT * FROM items order by sales desc";
$best_result = mysqli_query($conn,$get_best);
$best_count=mysqli_num_rows($best_result); 


//새반찬
$get_new = "SELECT * FROM items order by id desc";
$new_result = mysqli_query($conn,$get_new);





?>

<!-- 광고 팝업 -->
<script>
// popup //              
    //팝업창 띄우기
    //팝업 속성 
    // - status=yes|no|1|0 : 상태바를 보여줄지 지정합니다.
    // - scrollbars=yes|no|1|0 : 스크롤바 사용여부를 지정합니다. IE, Firefox, Opera에서 동작합니다.
    // toolbar=yes|no|1|0 : 툴바를 보여줄지 지정합니다. IE, Firefox에서 동작합니다.
    // menubar=yes|no|1|0 : 메뉴바 사용여부를 지정합니다.

    //쿠키 가져오기
    var getCookie = function(name) {
      var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
      return value? value[2] : null;
    };


    //저장된 쿠키를 가져옴
    var cookie = getCookie("popup");

    if(cookie == null){ //쿠키에 저장된 값이 없으면 팝업을 띄워줌
      window.open('./ad_popup.php', 'pop01', 'width=480, height=370, status=no, scrollbars= 0, toolbar=0, menubar=no');
    }


</script>

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

.carousel-item {
  height: 50vh;
  min-height: 300px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  margin-top: 10px;
}

.effect {
  position: relative;
  display: inline-block;
  overflow: hidden; /* 불필요한 부분 가리기 */
  padding: 1px;
}
.effect:after {
  content: "";
  position: absolute;
  /* position: inherit; */
  z-index: 1;
  width: 100px;
  height: auto;
  background:rgb(8, 67, 228);
  content: "best";  /* 보여주는 텍스트 */
  text-align: center;
  color: #fff;
  font-family: 'Arial';
  font-weight: bold;
  /* padding: 5px 10px; */
  padding: 2px 10px;
  left: -30px;
  top: 3px;
  transform: rotate(-35deg);
  box-shadow: 0 1px 3px rgba(129, 126, 126, 0.3);
}
.effect2 {
  position: relative;
  display: inline-block;
  overflow: hidden; /* 불필요한 부분 가리기 */
  padding: 1px;
}
.effect2:after {
  content: "";
  position: absolute;
  /* position: inherit; */
  z-index: 1;
  width: 100px;
  height: auto;
  background:rgb(103, 8, 228);
  content: "best";  /* 보여주는 텍스트 */
  text-align: center;
  color: #fff;
  font-family: 'Arial';
  font-weight: bold;
  /* padding: 5px 10px; */
  padding: 2px 10px;
  left: -30px;
  top: 3px;
  transform: rotate(-35deg);
  box-shadow: 0 1px 3px rgba(129, 126, 126, 0.3);
}
.effect3 {
  position: relative;
  display: inline-block;
  overflow: hidden; /* 불필요한 부분 가리기 */
  padding: 1px;
}
.effect3:after {
  content: "";
  position: absolute;
  /* position: inherit; */
  z-index: 1;
  width: 100px;
  height: auto;
  background:rgb(4, 70, 9);
  content: "best";  /* 보여주는 텍스트 */
  text-align: center;
  color: #fff;
  font-family: 'Arial';
  font-weight: bold;
  /* padding: 5px 10px; */
  padding: 2px 10px;
  left: -30px;
  top: 3px;
  transform: rotate(-35deg);
  box-shadow: 0 1px 3px rgba(129, 126, 126, 0.3);
}





</style>

<body>

<!-- 상단 네비게이션 두 개 -->
<?php include './top_navbar.php';?>






<!-- 메인 이미지 슬라이더 carousel slide -->
  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>First Slide</h3>
            <p>This is a description for the first slide.</p>
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Second Slide</h3>
            <p>This is a description for the second slide.</p>
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Third Slide</h3>
            <p>This is a description for the third slide.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>





  <!-- 추천메뉴 -->
  <div class="container">
    <div style="margin-top: 100px; ">
      <!-- 이 반찬 어때요? -->
      <div style="height:80px;"><h4 class="text-center" style="font-weight: bold;">새로 나왔어요!</h4></div>
      <!-- 카드 -->
      <div class="row">


        <?php 
          for($i=0; $i<3; $i++){
            $new_row = mysqli_fetch_array($new_result);
            ?>


            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="../goods/goods_view.php?category=<?php echo $new_row['category']; ?>&product=<?php echo $new_row['id']; ?>">
                  <img style="max-width:auto; max-height:250px;" class="card-img-top" src=<?php echo $new_row['imgpath']; ?> alt="">
                </a>
                <div class="card-body">
                <h4 class="card-title">
                  <a><?php echo $new_row['name']; ?></a>
                </h4>
                <p class="card-text"><?php echo $new_row['subtitle']; ?></p>
                <h5><?php echo number_Format($new_row['price']); ?>원</h5>
              </div>
              </div>
            </div>



            <?php
          }
        
        ?>


        </div>
        <!-- /.row -->
    </div>
  </div>


  <!-- 인기메뉴 -->
  <div class="container">
      <div style="margin-top: 100px;  ">
        <!-- 인기반찬 -->
        <div style="height:80px;"><h4 class="text-center" style="font-weight: bold;">인기 반찬</h4></div>
        <!-- 카드 -->
        <div class="row">
  
          <!-- <div class="col-3"> <div class="card"> 
            <img src="https://images.unsplash.com/photo-1563725911583-7d108f720483" class="card-img-top" alt="..."> 
              <div class="card-body"> 
                <h5 class="card-title">Card title</h5> 
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> 
              </div> 
            </div> 
          </div> -->

          <?php 
          
          for($i=0; $i<3; $i++){
            $best_row = mysqli_fetch_array($best_result);
            ?>


              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 effect2">
                  <a href="../goods/goods_view.php?category=<?php echo $best_row['category']; ?>&product=<?php echo $best_row['id']; ?>">
                    <img style="max-width:auto; max-height:250px;" class="card-img-top" src=<?php echo $best_row['imgpath']; ?> alt="">
                  </a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a><?php echo $best_row['name']; ?></a>
                    </h4>
                    <p class="card-text"><?php echo $best_row['subtitle']; ?></p>
                    <h5><?php echo number_Format($best_row['price']); ?>원</h5>
                  </div>
                </div>
              </div>



            <?php
          }
          ?>

  
          </div>
          <!-- /.row -->
      </div>
    </div>



  <!-- 고객 후기 -->
  <div class="container">
      <div style="margin-top: 100px; ">
        <div style="height:80px;"><h4 class="text-center" style="font-weight: bold;">고객 후기</h4></div>

      
        <div class="row">
          


            <div id="main_contents4">
                <ul style="list-style: none;">
                    <li>
                    <a href="/shop/goods/goods_view.php?goodsno=31">
                      <div class="img"><img src="http://zipbanchan.godohosting.com/500x500px/moochim/spinach_namul.jpg"></div>

                      <div class="info" style="margin-top:10px;">
                        <h6 >시금치나물 - 180g</h6>
                        <h6 >맛있어요</h6>
                        <div class="row" style="margin-left: 0px;">
                          <h6 >이유*</h6>
                          <h6 >&nbsp;|</h6>
                          <h6 >★★★★★</h6>
                        </div>
                      </div>

                      <!-- <div class="info">
                        <span class="goods_name">시금치나물 - 180g</span>
                        <span class="content">맛있어용</span>
                        <span class="name">이O희</span>
                        <span class="split">|</span>
                        <span class="star">★★★★★</span>
                      </div> -->
                    </a>
                    </li> 
                    <li>
                    <a href="/shop/goods/goods_view.php?goodsno=505">
                      <div class="img"><img src="http://zipbanchan.godohosting.com/800X800px/moochim/chamnamul_tufu.jpg"></div>

                      <div class="info" style="margin-top:10px;">
                          <h6 >참나물 두부무침 - 200g</h6>
                          <h6 >정말 이건 최애반찬이에요♡</h6>
                          <div class="row" style="margin-left: 0px;">
                            <h6 >박연*</h6>
                            <h6 >&nbsp;|</h6>
                            <h6 >★★★★★</h6>
                          </div>
                        </div>
                      <!-- <div class="info">
                        <span class="goods_name">참나물 두부무침 - 200g</span>
                        <span class="content">정말 이건 최애반찬이에요♡</span>
                        <span class="name">박O연</span>
                        <span class="split">|</span>
                        <span class="star">★★★★★</span>
                      </div> -->
                    </a>
                    </li> 
                    <li>
                    <a href="/shop/goods/goods_view.php?goodsno=19">
                      <div class="img"><img src="http://zipbanchan.godohosting.com/800X800px/marun/hodoo_mulchi_big.jpg"></div>

                      <div class="info" style="margin-top:10px;">
                          <h6 >호두 멸치볶음 - 대용량 200g</h6>
                          <h6 >자주 사먹는 맛있는 기본반찬</h6>
                          <div class="row" style="margin-left: 0px;">
                            <h6 >이경*</h6>
                            <h6 >&nbsp;|</h6>
                            <h6 >★★★★★</h6>
                          </div>
                        </div>
                      <!-- <div class="info">
                        <span class="goods_name">호두 멸치볶음 - 대용량 200g</span>
                        <span class="content">자주사먹는 맛있는 기본반찬</span>
                        <span class="name">이O경</span>
                        <span class="split">|</span>
                        <span class="star">★★★★★</span>
                      </div> -->
                    </a>
                    </li> 
                    <li>
                    <a href="/shop/goods/goods_view.php?goodsno=209">
                      <div class="img"><img src="http://zipbanchan.godohosting.com/800X800px/bockum/kogumajoolgi.jpg"></div>

                      <div class="info" style="margin-top:10px;">
                          <h6 >들깨고구마 줄기볶음 - 150g</h6>
                          <h6 >맛있고 부드러워요. 재구매 하고 싶네요</h6>
                          <div class="row" style="margin-left: 0px;">
                            <h6 >안이*</h6>
                            <h6 >&nbsp;|</h6>
                            <h6 >★★★★★</h6>
                          </div>
                        </div>
                      <!-- <div class="info">
                        <span class="goods_name">들깨고구마 줄기볶음 - 150g</span>
                        <span class="content">맛있고 부드러워요. 재구매 하고 싶네요 </span>
                        <span class="name">안O이</span>
                        <span class="split">|</span>
                        <span class="star">★★★★★</span>
                      </div> -->
                    </a>
                    </li> 
                    <li>
                    <a href="/shop/goods/goods_view.php?goodsno=21">
                      <div class="img"><img src="http://zipbanchan.godohosting.com/800X800px/marun/hot_mulchi_big.jpg"></div>

                      <div class="info" style="margin-top:10px;">
                          <h6 >고추장 멸치볶음 - 대용량 200g</h6>
                          <h6 >위생,맛 모두 굿입니다</h6>
                          <div class="row" style="margin-left: 0px;">
                            <h6 >현자*</h6>
                            <h6 >&nbsp;|</h6>
                            <h6 >★★★★★</h6>
                          </div>
                        </div>
                      <!-- <div class="info">
                        <span class="goods_name">고추장 멸치볶음 - 대용량 200g</span>
                        <span class="content">위생,맛 모두 굿입니다</span>
                        <span class="name">현O자</span>
                        <span class="split">|</span>
                        <span class="star">★★★★★</span>
                      </div> -->
                    </a>
                    </li> 
                    <li>
                    <a href="/shop/goods/goods_view.php?goodsno=298">
                      <div class="img"><img src="http://zipbanchan.godohosting.com/800X800px/jeon/dongtaejeon.jpg"></div>

                      <div class="info" style="margin-top:10px;">
                          <h6 >동태전 - 250g</h6>
                          <h6 >계란맛이 아주 좋아요</h6>
                          <div class="row" style="margin-left: 0px;">
                            <h6 >박영*</h6>
                            <h6 >&nbsp;|</h6>
                            <h6 >★★★★★</h6>
                          </div>
                        </div>
                      <!-- <div class="info">
                        <span class="goods_name">동태전 - 250g</span>
                        <span class="content">계란맛이 아주 좋아요</span>
                        <span class="name">박O영</span>
                        <span class="split">|</span>
                        <span class="star">★★★★★</span>
                      </div> -->
                    </a>
                    </li> 
                  
                </ul>
              </div>
              
              



        </div>




      </div>
    </div>



















<!-- footer -->
<?php include './footer.php';?>





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
