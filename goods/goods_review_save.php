<?php
include '../main/db.php';
session_start();

$writer_uuid = $_SESSION['uuid'];
$ordered_product_id = $_POST['ordered_product_id'];
$order_no = $_POST['order_no'];

date_default_timezone_set('Asia/Seoul');
//date()얘는 문자열로 반환되는듯
$date = date("Y-m-d h:i:s"); 
$dateString = substr($date, 0, 10);
//날짜만 넣으려고 시간은 잘랐음


$sql="insert into review (item_id, writer_uuid, write_date, title, contents, rating) 
values('".$_POST['item_id']."','".$writer_uuid."','".$dateString."','".$_POST['title']."','".$_POST['contents']."','".$_POST['rating']."')";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo mysqli_error($conn);
}

//리뷰 상태 업데이트
$update = "UPDATE ordered_product SET is_review=1 WHERE id=$ordered_product_id";
$update_result = mysqli_query($conn, $update);

if (!$update_result) {
    echo mysqli_error($conn);
}

//주문번호에 해당하는 모든 아이템에 대해 리뷰가 작성이 되어 있으면 order_info의 리뷰상태 업데이트 해줌
$get = "SELECT * FROM ordered_product WHERE order_no='$order_no'";
$get_result = mysqli_query($conn, $get);
$order_count = mysqli_num_rows($get_result);  

if (!$get_result) {
    echo mysqli_error($conn);
}

$all_review_status = 0;
for($i=0; $i<$order_count; $i++){
    $get_order_row =  mysqli_fetch_array($get_result);

    if($get_order_row['is_review']==1){
        $all_review_status++;
    }

}


if($order_count == $all_review_status){


    $update_order_info = "UPDATE order_info SET is_review=1 WHERE order_no='$order_no'";
    $update_order_info_result = mysqli_query($conn, $update_order_info);

    if (!$update_order_info_result) {
        echo mysqli_error($conn);
    }

}






echo '<script> location.href = "../userpage/order_detail.php?order_no='.$order_no.'"; </script>';


?>