<?php
include '../main/db.php';

$id = $_POST['order_number'];
$invoice = $_POST['invoice'];
$progress_status = "배송중";

$invoice_string = (string)$invoice;


//송장과 진행 상태 저장
$update = "UPDATE order_info SET progress_status='$progress_status', invoice='$invoice_string' WHERE id=$id";
$result = mysqli_query($conn, $update);

if (!$result) {
    echo "송장 업데이트 : ".mysqli_error($conn);
}

echo '<script> history.back(); </script>';



?>