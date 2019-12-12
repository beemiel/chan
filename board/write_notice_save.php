<?php
include '../main/db.php';
session_start();
?>

<?php

$title = $_POST['title'];
$contents = $_POST['contents'];
$category = "notice";

// echo "제목".$title;
// echo "내용".$contents;
// echo "비번".$password;


// CREATE TABLE notice ( 
//     id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
//     user_id varchar(100) NOT NULL,
//     user_name varchar(32) NOT NULL,
//     contents mediumtext NOT NULL,
//     date datetime NOT NULL,
//     PRIMARY KEY (id)
//   );



date_default_timezone_set('Asia/Seoul');
//date()얘는 문자열로 반환되는듯
$date = date("Y-m-d h:i:s"); 
$dateString = substr($date, 0, 10);
//날짜만 넣으려고 시간은 잘랐음


// //db에 저장
if($_SESSION['name'] !=null){
$sql="insert into notice(user_id, user_name, title, contents, date, category) 
values('".$_SESSION['uuid']."','".$_SESSION['name']."','".$title."','".$contents."','".$dateString."','".$category."')";
} else if ($_COOKIE['name'] != null){
$sql="insert into notice(user_id, user_name, title, contents, date, category) 
values('".$_COOKIE['uuid']."','".$_COOKIE['name']."','".$title."','".$contents."','".$dateString."','".$category."')";
}

if($conn->query($sql) == true){
    echo '<script> alert("등록 완료");  location.href="../board/list.php?board=notice";  </script>';
} else {
    echo '<script> alert("등록 실패"); </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}








?>

