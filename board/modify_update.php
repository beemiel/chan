<?php
include '../main/db.php';
session_start();
?>

<?php

$title = $_POST['title'];
$contents = $_POST['contents'];
$board = $_POST['board'];
$id = $_POST['id'];




//db에 업데이트
// $count_update = "UPDATE $table SET count=$count WHERE id=$id";
// $update = "UPDATE $board SET title=$title, contents=$contents WHERE id=$id";
$update = "UPDATE $board SET title='$title', contents='$contents' WHERE id=$id";
// mysqli_query($conn, $update);

if(mysqli_query($conn, $update)){
    echo '<script> alert("수정 완료");  location.href="../board/list.php?board='.$board.'";  </script>';
} else {
    echo '<script> alert("수정 실패"); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}


// // //db에 저장
// $sql="insert into notice(user_id, user_name, title, contents, date, category) 
// values('".$_SESSION['uuid']."','".$_SESSION['name']."','".$title."','".$contents."','".$dateString."','".$category."')";

// if($conn->query($sql) == true){
//     echo '<script> alert("등록 완료");  location.href="../board/list.php?board=notice";  </script>';
// } else {
//     echo '<script> alert("등록 실패"); </script>';
//     echo("쿼리오류 발생: " . mysqli_error($conn));
// }








?>

