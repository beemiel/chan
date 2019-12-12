<?php
include '../main/db.php'
?>

<?php

$count = $_POST['count'];
$cart_id = $_POST['cart_id'];



$update = "UPDATE cart SET count=$count WHERE id=$cart_id";

if(mysqli_query($conn, $update)){
    // echo '<script> alert("수량 수정 완료"); history.back(); </script>';
    echo '<script> history.back(); </script>';
} else {
    echo '<script> alert("수량 수정 실패"); history.back(); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}




?>