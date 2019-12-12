<?php
include '../main/db.php';
session_start();


$product_id = $_POST['product_id'];

if($_POST['title'] == ""){
    echo '<script> alert("제목을 입력해주세요"); history.back(); </script>';
    exit;
}

if($_POST['contents'] == ""){
    echo '<script> alert("내용을 입력해주세요"); history.back(); </script>';
    exit;
}

$checkbox = 0;
if($_POST['secret_check'] != null){
    $checkbox = 1;
}


$writer_uuid = $_SESSION['uuid'];

date_default_timezone_set('Asia/Seoul');
//date()얘는 문자열로 반환되는듯
$date = date("Y-m-d h:i:s"); 
$dateString = substr($date, 0, 10);
//날짜만 넣으려고 시간은 잘랐음

$sql="insert into goods_question (writer_uuid, secret, date, title, contents, category, item_id) 
values('".$writer_uuid."','".$checkbox."','".$dateString."','".$_POST['title']."','".$_POST['contents']."','".$_POST['category']."','".$product_id."')";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo mysqli_error($conn);
}



echo '<script> location.href = "../goods/goods_view.php?product='.$product_id.'"; </script>';


?>