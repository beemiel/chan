<?php

include '../main/db.php';


?>
<!DOCTYPE html> 
<html> 
<head> 
</head>   



<body> 

<div class="col-lg-1" style="margin-right:2%;" >
<!-- 사이드 바 메뉴-->
  <!-- 패널 타이틀1 -->
<div class="panel panel-info" style="position:fixed;">
    <div class="panel-heading">
      <h6 class="panel-title text-center">오늘 본 상품</h6>
    </div>
    <!-- 사이드바 메뉴목록1 -->
    <ul class="list-group">

        <?php

        if($_COOKIE['todayview']){ //쿠키가 존재할 경우

            $retrive_data = unserialize($_COOKIE['todayview']);//unserialize array

            $count = count($retrive_data);

            //반복문으로 배열의 앞쪽에 3개의 값까지만 가져옴
            //배열의 크기가 3보다 크면 count변수를 3로 고정해서 3개만 가져오도록 함
            if($count >= 3){
                $count = 3;
            }

            
            for($i=0; $i<$count; $i++){

                $id = $retrive_data[$i];
                //디비에서 상품의 아이디를 기준으로 이미지를 가져옴

                $get_item_img = "SELECT * FROM items WHERE id=$id";
                $item_img_result = mysqli_query($conn, $get_item_img);
                $img = mysqli_fetch_array($item_img_result);
                
                ?>

                    <li class="list-group-item text-center">
                        <a href="../goods/goods_view.php?category=<?php echo $img['category'] ?>&product=<?php echo $id ?>">
                            <img style="max-width:70px; max-height:80px;" src=<?php echo $img['imgpath']; ?> >
                        </a>
                        <br>
                        <?php echo $img['name']; ?>
                    </li>

                <?php
            }

        } else { //쿠키가 존재하지 않을 경우

            ?>
                    <li class="list-group-item">
                        <a >오늘 본 상품이 없습니다.</a>
                    </li>

            <?php
        }
        ?>



    </ul>
</div>
</div> 

</body> 
</html> 