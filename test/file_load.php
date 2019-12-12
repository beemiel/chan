<!DOCTYPE html>
<html lang= "ko">
<head>
<meta charset="utf-8">
<title>제목</title>
</head>
<body>


<h3>이미지 파일 업로드 연습</h3>



<?php

echo '<img src='.$_POST['path1'].' width=200><br>';
echo '<img src='.$_POST['path2'].' width=200><br>';
echo $_POST['name'];


?>








</body>
</html>