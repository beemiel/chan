<?php
include '../main/db.php';
?>

<?php

$board = $_GET['board'];
$id = $_GET['id'];

// echo $board;
// echo $id;


$delete = "DELETE FROM $board WHERE id=$id";

if(mysqli_query($conn, $delete)){
    echo '<script> alert("삭제 완료");  location.href="../board/list.php?board='.$board.'";  </script>';
} else {
    echo '<script> alert("삭제 실패"); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}



?>
