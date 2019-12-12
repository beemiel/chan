<?php
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];

$file_path = '../uploads/'.$file_name;

$r = move_uploaded_file($tmp_file, $file_path);

if($r == true){
    echo "됐당^^";
} else {
    echo "안됨ㅅㅂ";
}

echo "<h2>파일 정보</h2>
<ul>
	<li>파일형식: {$_FILES['myfile']['type']}</li>
	<li>파일크기: {$_FILES['myfile']['size']} 바이트</li>
</ul>";
?> 
