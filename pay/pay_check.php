<?php
include '../main/db.php';

session_start();
?>
<?php

//멤버 정보 가져옴 
$member_uuid = $_SESSION['uuid'];
$get_member = "SELECT * FROM member WHERE uuid='$member_uuid'";
$member_result = mysqli_query($conn,$get_member);
$member_row =  mysqli_fetch_array($member_result);


$card_name = $_POST['card_name'];
$card_no = $_POST['card_no'];
$method_name = $_POST['method_name'];
$purchased_at = $_POST['purchased_at'];
$card_quota = $_POST['card_quota']; //할부 개월수





$jsonnn = $_POST['pay_info'];
// var_dump($jsonnn);
$pay_info = json_decode($jsonnn);
// var_dump($pay_info->pg_name);



//카트 인덱스(주문하면 카트테이블에 저장된 값을 삭제하기 위해서 받음)
$cart_id = $_POST['cart_id'];
//가져온 문자열 /를 기준으로 잘라서 배열에 넣음
$id_array = explode( '/', $cart_id );
//배열의 크기 반환받아서 변수에 저장
$count = sizeof($id_array);




$input_info_json = $_POST['input_info'];
// var_dump($input_info_json);
// echo "<br>";
$input_info = json_decode($input_info_json);
// var_dump($input_info->postcode);
// echo "<br>";
// var_dump($input_info->address);
// echo "<br>";
// var_dump($input_info->address_detail);
// echo "<br>";
// var_dump($input_info->recipient_name);
// echo "<br>";
// var_dump($input_info->recipient_phone);
// echo "<br>";
// var_dump($input_info->delivery_msg);

//상품총합
$product_amount = 0;



//주문정보와 주문상품 테이블에 저장하고 카트db 지워줌



//주문날짜 구해줌
date_default_timezone_set('Asia/Seoul');
//date()얘는 문자열로 반환되는듯
//주문번호에 쓸 변수
$date = date("Ymd h:i:s"); 
$dateString = substr($date, 0, 8);
//날짜만 넣으려고 시간은 잘랐음
//주문날짜에 쓸 변수
$order_date = date("Y-m-d h:i:s"); 
$order_dateString = substr($order_date, 0, 10);


//주문번호 구해줌(날짜+주문정보db의 row 수)
$order_no = "";
$get_order_info = "SELECT * FROM order_info";
$order_info_result = mysqli_query($conn,$get_order_info);
$row_count=mysqli_num_rows($order_info_result); 
$row_count_six = sprintf("%06d",$row_count);



if($row_count > 0){ //저장된 정보가 있음

    $order_no = $dateString."-".$row_count_six;

} else { //저장된 정보가 없음

    $num = 0;
    $new_count = sprintf("%06d",$num);
    $order_no = $dateString."-".$row_count_six;


}

//결제 정보는 한 줄에 다 붙여서 저장해준다
$payment_info = $pay_info->method_name." ".$pay_info->card_name." ".$pay_info->card_no;
$payment_total = $pay_info->amount;

//주소 정보
$postcode = $input_info->postcode;
$address = $input_info->address;
$addressdetail = $input_info->address_detail;

//배송 요청사항
$delivery_msg = $input_info->delivery_msg;

//수령인 이름, 폰번호
$recipient_name = $input_info->recipient_name;
$recipient_phone = $input_info->recipient_phone;



//주문정보 저장
$order_info_sql="insert into order_info(order_no, purchaser_uuid, order_date, payment_info, payment_total  ,postcode, address, address_detail, delivery_msg, recipient_name, recipient_phone) 
values('".$order_no."','".$member_uuid."','".$order_dateString."','".$payment_info."','".$payment_total."','".$postcode."','".$address."','".$addressdetail."','".$delivery_msg."','".$recipient_name."','".$recipient_phone."')";
// $conn->query($order_info_sql);

$order_info_result = mysqli_query($conn, $order_info_sql);

if (!$order_info_result) {
    echo mysqli_error($conn);
}


//주문상품 저장
for($i=0; $i<$count-1; $i++){ //cart_id 배열의 갯수만큼 반복문 돌림

    // id는 int타입이므로 문자열을 int로 변환
    $id_for_ordered_product = (int)$id_array[$i];

    //상품db에서 아이템 id 가져옴
    $get_item_for_product = "SELECT * FROM cart WHERE id=$id_for_ordered_product";
    $get_item_result_for_product = mysqli_query($conn,$get_item_for_product);
    $cart_item_row =  mysqli_fetch_array($get_item_result_for_product);

    //아이템 id를 변수에 저장
    $item_id = $cart_item_row['item'];
    $amount = $cart_item_row['count'];

    //주문상품 테이블에 저장하는 sql문 작성
    $ordered_product_sql="insert into ordered_product(order_no, product_uuid, amount) 
    values('".$order_no."','".$item_id."','".$amount."')";  

    $ordered_product_result = mysqli_query($conn, $ordered_product_sql);

    if (!$ordered_product_result) {
        echo "ordered_product_result :".mysqli_error($conn);
    }


}


//카트 db에서 주문한 아이템 삭제
// for($i=0; $i<$count-1; $i++){
//     //카트의 id
//     $id_for_delete_cart = (int)$id_array[$i];

//     //db에서 삭제하는 sql문 작성
//     $delete_cart = "DELETE FROM cart WHERE id=$id_for_delete_cart";
//     $delete_cart_result = mysqli_query($conn, $delete_cart);

//     if (!$get_cart_result) {
//         echo mysqli_error($conn);
//     }

// }


//item 판매량 업데이트
for($i=0; $i<$count-1; $i++){

    // id는 int타입이므로 문자열을 int로 변환
    $id_for_update_sales = (int)$id_array[$i];

    //상품db에서 아이템 id 가져옴
    $get_item = "SELECT * FROM cart WHERE id=$id_for_update_sales";
    $get_item_result = mysqli_query($conn,$get_item);
    $cart_item_row =  mysqli_fetch_array($get_item_result);

    if (!$get_item_result) {
        echo mysqli_error($conn);
    }

    //아이템 id를 변수에 저장
    $item_id_for_update = (int)$cart_item_row['item'];
    $amount_for_update = (int)$cart_item_row['count'];

    $get_sales = "SELECT * FROM items WHERE id=$item_id_for_update";
    $get_sales_result = mysqli_query($conn, $get_sales);
    $get_sales_row =  mysqli_fetch_array($get_sales_result);
    if (!$get_sales_result) {
        echo "get_sales_result : ".mysqli_error($conn);
    }

    //기존의 sales에 주문 수량 더해서 업데이트
    $update_sales_amount = $get_sales_row['sales'] + $amount_for_update;

    //items 테이블에 업데이트
    $update_sales = "UPDATE items SET sales=$update_sales_amount WHERE id=$item_id_for_update";
    $update_sales_result = mysqli_query($conn, $update_sales);

    if (!$update_sales_result) {
        echo mysqli_error($conn);
    }


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
</style>

<body>


<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>
    <hr>



<h2 class="text-center" style="margin-top:80px;">결제 완료</h2>
<!-- <h2 class="text-center" style="margin-top:80px;">결제 완료<?php echo $cart_id; ?></h2> -->

<!-- 상품 정보 -->

<div class="container" style="margin-top:70px;">

    <h5>상품 정보</h5>

<table class="table table-md">

    <thead class="thead-light">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th style="width: 20%">상품</th>
        <th style="width: 60%">상품 정보</th>
        <th style="width: 10%">수량</th>
        <th style="width: 10%">상품금액</th>
    </tr>
    </thead>
    <tbody>

        <!--이 아래에 반복문 -->
    <?php 


    //마지막 배열의 값은 없으므로 사이즈를 -1해준다
    for($i=0; $i<$count-1; $i++){

        //가져온 id값을 기준으로 items테이블에서 가져와서 상품 정보를 뿌려줄 것

        //post로 넘어온 데이터가 문자열이고 id는 int타입이므로 문자열을 int 변환
        $id_for_get_item = (int)$id_array[$i];

        //카트 테이블에서 해당 로우의 값 가져옴(아이템의 id와 수량을 알기 위해서)
        $get_cart = "SELECT * FROM cart WHERE id=$id_for_get_item";
        $cart_result = mysqli_query($conn,$get_cart);
        $cart_row =  mysqli_fetch_array($cart_result);

        
        if($cart_result) {
            // echo "겟카트id: " . $id_for_get_item;
            // echo "아이템id: " . $cart_row['item'];
        } else {
            echo("겟카트오류 발생: " . mysqli_error($conn));
        }

        // 인덱스 값에 해당하는 아이템의 인덱스 값 가져와서 변수에 저장
        $item_id_for_save = $cart_row['item'];

        //위에서 가져온 인덱스 값을 기준으로 상품 정보 가져옴
        $get_item_info = "SELECT * FROM items WHERE id=$item_id_for_save";
        $item_result = mysqli_query($conn,$get_item_info);


        if($item_result == true){
            $item_row =  mysqli_fetch_array($item_result);

            //상품의 총 합계를 구함((수량 * 가격)을 반복문 횟수만큼 계속 추가적으로 더해줌)
            $product_amount += $cart_row['count'] * $item_row['price'];
            ?>


            <tr>
                <td>
                    <a class="thumbnail pull-left" href=""> <img class="media-object"  src=<?php echo $item_row['imgpath']; ?> style="max-width: 72px; max-height: 72px;"> </a>
                </td>
                <td><?php echo $item_row['name']; ?></td>
                <td><?php echo $cart_row['count']; ?></td>
                <td><?php echo $cart_row['count'] * $item_row['price']; ?></td>
            </tr>


            <?php

        } else {
            echo '<script> alert("상품 정보를 가져오는데 실패했습니다."); </script>';
            echo("쿼리오류 발생: " . mysqli_error($conn));
        }

    }

    ?>



            <tr>
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
                <td><?php echo number_Format($product_amount + 2500); ?>원</td>
            </tr>
   


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
        <p class="col-lg-9"><?php echo $member_row['name']; ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3">수령인</p>
        <p class="col-lg-9"><?php echo $input_info->recipient_name; ?></p>
    </div>
    

    <div class="row">
        <p class="col-lg-3">휴대폰</p>
        <p class="col-lg-9"><?php echo $input_info->recipient_phone; ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3">주소</p>
        <p class="col-lg-9"><?php echo $input_info->postcode.$input_info->address; ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3"></p>
        <p class="col-lg-9"><?php echo $input_info->address_detail; ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3">배송 요청사항</p>
        <p class="col-lg-9"><?php echo $input_info->delivery_msg; ?></p>
    </div>



<hr>
</div>




<!-- 결제 정보 -->

<div class="container" style="margin-top:70px;">
<h5>결제 정보</h5>
<hr>
<div class="row">
        <p class="col-lg-3">결제 수단</p>
        <p class="col-lg-9"><?php echo $method_name; ?></p>
</div>
<div class="row">
        <p class="col-lg-3"></p>
        <p class="col-lg-9"><?php echo $card_name . " / " . $card_no;  ?></p>
</div>
<div class="row">
        <p class="col-lg-3">결제 시간</p>
        <p class="col-lg-9"><?php echo $pay_info->purchased_at; ?></p>
</div>
<hr>

</div>


<!-- <div class="container" style="margin-top:70px;">
<h5>개인정보 수집/제공</h5>


</div> -->



<div class="text-center" style="margin-top:80px; margin-bottom:10%;">
    <button style="width:300px; border-radius:0px;" type="button" class="btn btn-info btn-lg" onclick="main()">확인</button>
</div>

<script>

function main(){
    location.href="../main/market_index.php";

}


</script>

<?php

//카트 db에서 주문한 아이템 삭제
for($i=0; $i<$count-1; $i++){
    //카트의 id
    $id_for_delete_cart = (int)$id_array[$i];

    //db에서 삭제하는 sql문 작성
    $delete_cart = "DELETE FROM cart WHERE id=$id_for_delete_cart";
    $delete_cart_result = mysqli_query($conn, $delete_cart);

    if (!$get_cart_result) {
        echo mysqli_error($conn);
    }

}



?>






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
