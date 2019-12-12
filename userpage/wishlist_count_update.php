<?php
include '../main/db.php'
?>

<?php

$count = $_POST['count'];
$wish_id = $_POST['wish_id'];



$update = "UPDATE wishlist SET count=$count WHERE id=$wish_id";

if(mysqli_query($conn, $update)){
    // echo '<script> alert("수량 수정 완료"); history.back(); </script>';
    echo '<script> history.back(); </script>';
} else {
    echo '<script> alert("수량 수정 실패"); history.back(); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}




?>