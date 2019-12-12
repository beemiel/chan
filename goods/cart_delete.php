<?php
include '../main/db.php';

$id = $_POST['cart_id'];

$delete = "DELETE FROM cart WHERE id=$id";


if(mysqli_query($conn, $delete)){
    // echo '<script> alert("삭제 완료"); history.back();  </script>';
    echo '<script> history.back();  </script>';
} else {
    echo '<script> alert("삭제 실패"); history.back(); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}




?>
