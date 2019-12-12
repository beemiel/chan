<?php
include '../main/db.php'
?>

<?php

$id = $_POST['id'];
$stock = $_POST['stock'];



$update = "UPDATE items SET stock='$stock' WHERE id=$id";

if(mysqli_query($conn, $update)){
    // echo '<script> alert("재고 수정 완료"); history.back(); </script>';
    echo '<script> history.back(); </script>';
} else {
    echo '<script> alert("재고 수정 실패"); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}




?>



