<?php
include '../main/db.php';
// session_start();


//db에 저장할 변수들
$category = $_POST['category'];
$title = $_POST['title'];
$sub_title = $_POST['subtitle'];
$price = $_POST['price'];
$weight = $_POST['weight'];
$stock = $_POST['stock'];
$raw_materials = $_POST['rawmaterials'];
$contents = $_POST['contents'];
$ex_img = $_POST['ex_img'];
$id = $_POST['id'];


//이미지 업로드 먼저 처리
//이미지 업로드 관련 변수(uploads_dir는 이미지를 업로드할 폴더)
$uploads_dir = '../uploads';
$allowed_ext = array('jpg','jpeg','png','gif');

//이미지 업로드시 에러가 나면 어떤 에러가 났는지 알려주기 위함
$error = $_FILES['myfile']['error'];

if($error != UPLOAD_ERR_NO_FILE){
    //이미지를 첨부 했을 경우 메인이미지를 새로 업데이트


//업로드할 파일의 이름(db에 저장)
$name = $_FILES['myfile']['name'];
//업로드된 이미지가 있는 경로(db에 저장)
$target_file = $uploads_dir."/" . basename($_FILES['myfile']['name']);

//뭔지 모르겠음
$ext = array_pop(explode('.', $name));
 
// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "파일이 너무 큽니다. ($error)";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "파일이 첨부되지 않았습니다. ($error)";
			break;
		default:
			echo "파일이 제대로 업로드되지 않았습니다. ($error)";
	}
	exit;
}
 
// 확장자 확인
if( !in_array($ext, $allowed_ext) ) {
	echo "허용되지 않는 확장자입니다.";
	exit;
}

// 파일 업로드
//move_uploaded_file()은 서버로 전송된 파일을 저장할 때 사용하는 함수입니다.
move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");






$update = "UPDATE items 
SET category='$category', 
name='$title', 
subtitle='$sub_title', 
price=$price, 
weight=$weight, 
stock=$stock, 
raw_materials='$raw_materials', 
contents='$contents', 
imgname='$name', 
imgpath='$target_file' 
WHERE id=$id"; 

if(mysqli_query($conn, $update)){
    echo '<script> alert("수정 완료"); location.href="./admin_goods.php"; </script>';
} else {
    echo '<script> alert("수정 실패"); location.href="./admin_goods.php"; </script>';
    echo("쿼리오류 발생: " . mysqli_error($conn));
}




} else {
    //이미지를 첨부하지 않은 경우 메인 이미지를 업데이트하지 않음



    $update = "UPDATE items 
    SET category='$category', 
    name='$title', 
    subtitle='$sub_title', 
    price=$price, 
    weight=$weight, 
    stock=$stock, 
    raw_materials='$raw_materials', 
    contents='$contents' 
    WHERE id=$id"; 

    if(mysqli_query($conn, $update)){
        echo '<script> alert("수정 완료"); location.href="./admin_goods.php"; </script>';
    } else {
        echo '<script> alert("수정 실패"); location.href="./admin_goods.php"; </script>';
        echo("쿼리오류 발생: " . mysqli_error($conn));
    }





}








?>