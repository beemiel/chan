<?php

// echo "인클루드/리콰이어";
    // function welcome(){
    //     return 'Hello world'
    // }
 $conn=mysqli_connect('127.0.0.1', 'root', 'sql2');

 $db=mysqli_select_db($conn, "chanchan") or die ('db select fail');

//  if($db){
//      echo "db 연결성공";
//  } else{
//      echo "db 연결 실패";
//  }

//mysqli_error($mysqli) -> 무슨 에러인지 알 수 있음

?>