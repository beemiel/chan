<?php
include '../main/db.php';

session_start();
?>
<?php

$order_no = $_GET['order_no'];

//주문 정보 불러옴
$get_orderinfo = "SELECT * FROM order_info WHERE order_no='$order_no'";
$get_orderinfo_result = mysqli_query($conn,$get_orderinfo);
$orderinfo =  mysqli_fetch_array($get_orderinfo_result);



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



<h2 class="text-center" style="margin-top:80px;">주문번호 <?php echo $order_no; ?></h2>


<!-- 상품 정보 -->

<div class="container" style="margin-top:70px;">

    <h5>상품 정보</h5>

<table class="table table-md">

    <thead class="thead-light">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th style="width: 20%">상품 사진</th>
        <th style="width: 60%">상품 정보</th>
        <th style="width: 10%">수량</th>
        <th style="width: 10%">상품금액</th>
    </tr>
    </thead>
    <tbody>

    <?php 

    //주문 상품 불러옴
    $get_ordered_item = "SELECT * FROM ordered_product WHERE order_no='$order_no'";
    $get_orderinfo_result = mysqli_query($conn,$get_ordered_item);
    $order_count=mysqli_num_rows($get_orderinfo_result);  

    // if (!$get_orderinfo_result) {
    //     echo mysqli_error($conn);
    // }

    //상품 합계
    $product_amount=0;

    for($i=0; $i<$order_count; $i++){
        $orderinfo_row =  mysqli_fetch_array($get_orderinfo_result);
        // $item_id = $orderinfo_row['product_uuid'];

        //상품 정보 불러옴
        $get_item = "SELECT * FROM items WHERE id={$orderinfo_row['product_uuid']}";
        // $get_item = "SELECT * FROM items WHERE id='$item_id'";
        $get_item_result = mysqli_query($conn,$get_item);
        $item_row = mysqli_fetch_array($get_item_result);

        $product_amount += $orderinfo_row['amount']*$item_row['price'];
        ?>

        <tr>
            <td>
                <a style="color:black; text-decoration:none;" class="thumbnail pull-left" href="../goods/goods_view.php?category=<?php echo $item_row['category']; ?>&product=<?php echo $item_row['id']; ?>"> <img class="media-object" src=<?php echo $item_row['imgpath']; ?> style="max-width: 72px; max-height: 72px;"> </a>
            </td>
            <td><a style="color:black; text-decoration:none;" href="../goods/goods_view.php?category=<?php echo $item_row['category']; ?>&product=<?php echo $item_row['id']; ?>"><?php echo $item_row['name']; ?></a></td>
            <td><?php echo $orderinfo_row['amount']; ?></td>
            <td>
                <div class="row">
                    <?php echo number_Format($orderinfo_row['amount']*$item_row['price']); ?>원

                        

                    <?php 

                        if($orderinfo_row['is_review']==0){
                            ?>


                        <br>
                        <form method="post" action="../goods/goods_review.php">
                        <button type="submit" class="btn btn-outline-info btn-sm">리뷰쓰기</button>
                        <input type="hidden" id="gameToken" name="item_id" value=<?php echo $item_row['id'] ?>>
                        <input type="hidden"  name="ordered_product_id" value=<?php echo $orderinfo_row['id']; ?>>
                        <input type="hidden"  name="order_no" value=<?php echo $order_no; ?>>
                        </form>


                            <?php
                        }

                    ?>




                </div>
            </td>

        </tr>




        <?php
    }

    ?>



            <!-- <tr>
                <td> </td>
                <td> </td>
                <td>상품합계</td>
                <td><?php echo number_Format($product_amount); ?>원</td>
            </tr>

            <tr>
                <td> </td>
                <td> </td>
                <td>배송비</td>
                <td>2,500원</td>
            </tr>

            <tr>
                <td> </td>
                <td> </td>
                <td>총합</td>
                <td><?php echo number_Format($product_amount+2500); ?>원</td>
            </tr> -->
   


            </tbody>

        </table>

        <hr>

<!-- 컨테이너 끝 -->
</div>


<!-- 주문자 정보 -->

<div class="container" style="margin-top:70px;">
<h5>주문 정보</h5>

<hr>

    <div class="row">
        <p class="col-lg-3">보내는 분</p>
        <p class="col-lg-9"><?php echo $_SESSION['name'];  ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3">수령인</p>
        <p class="col-lg-9"><?php echo $orderinfo['recipient_name']; ?></p>
    </div>
    

    <div class="row">
        <p class="col-lg-3">휴대폰</p>
        <p class="col-lg-9"><?php echo $orderinfo['recipient_phone']; ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3">주소</p>
        <p class="col-lg-9"><?php echo $orderinfo['postcode']." ".$orderinfo['address']; ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3"></p>
        <p class="col-lg-9"><?php echo $orderinfo['address_detail']; ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3">배송 요청사항</p>
        <p class="col-lg-9"><?php echo $orderinfo['delivery_msg']; ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3">주문 상태</p>
        <p class="col-lg-9"><?php echo $orderinfo['progress_status']." ".$orderinfo['invoice']; ?></p>
    </div>



<hr>
</div>




<!-- 결제 정보 -->

<div class="container" style="margin-top:70px;">
<h5>결제 정보</h5>
<hr>
<div class="row">
        <p class="col-lg-3">결제 수단</p>
        <p class="col-lg-9"><?php echo $orderinfo['payment_info']; ?></p>
</div>
<hr>

</div>


<!-- <div class="container" style="margin-top:70px;">
<h5>개인정보 수집/제공</h5>


</div> -->



<div class="text-center" style="margin-top:80px; margin-bottom:10%;">
    <button style="width:300px; border-radius:0px;" type="button" class="btn btn-info btn-lg" onclick="back()">뒤로가기</button>
</div>

<script>

function back(){
    history.back();

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
