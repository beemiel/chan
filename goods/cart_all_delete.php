<?php
include '../main/db.php';
session_start();

$uuid = $_SESSION['uuid'];



$delete = "DELETE FROM cart WHERE user='$uuid'";


if(mysqli_query($conn, $delete)){
    echo '<script> history.back();  </script>';
} else {
    echo '<script> alert("삭제 실패"); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}




?>
