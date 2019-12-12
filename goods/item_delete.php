<?php
include '../main/db.php';

$id = $_GET['id'];

$delete = "DELETE FROM items WHERE id=$id";


if(mysqli_query($conn, $delete)){
    echo '<script> alert("삭제 완료"); history.back();  </script>';
} else {
    echo '<script> alert("삭제 실패"); history.back(); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}




?>
