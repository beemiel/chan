<?php
// 설정
$uploads_dir = '../uploads';
$allowed_ext = array('jpg','jpeg','png','gif');



// $target_dir = '../uploads/';
 
// 변수 정리
$error = $_FILES['myfile']['error'];
//파일 이름
$name = $_FILES['myfile']['name'];
//파일url
// $imgurl = "http://192.168.44.141/web/uploads/". $_FILES['myfile']['name'];
//뭔..경로긴한데...
// $target_file = $target_dir . basename($_FILES['myfile']['name']);
$target_file = $uploads_dir."/" . basename($_FILES['myfile']['name']);




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
 
// 파일 이동
//move_uploaded_file()은 서버로 전송된 파일을 저장할 때 사용하는 함수입니다.
move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");

// 파일 정보 출력
echo "<h2>파일 정보</h2>
<ul>
	<li>파일명: $name</li>
	<li>확장자: $ext</li>
	<li>파일형식: {$_FILES['myfile']['type']}</li>
    <li>파일크기: {$_FILES['myfile']['size']} 바이트</li>
    <li>임시파일명?: {$_FILES['myfile']['tmp_name']}</li>
</ul>";
?>

<!DOCTYPE html>
<html lang= "ko">
<head>
<meta charset="utf-8">
<title>제목</title>
</head>
<body>

<form method="post" action="./file_load.php">
<button class="btn btn-lg btn-outline-primary btn-block" type="submit" style="margin-top: 30px;">이미지 불러오기</button>
<input type="hidden"  name="name" value=<?php echo $name; ?>>
<input type="hidden"  name="path1" value=<?php echo $imgurl; ?>>
<input type="hidden"  name="path2" value=<?php echo $target_file; ?>>
</form>

</body>
</html>