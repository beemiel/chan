<?php
include '../main/db.php';
session_start();




$cart_id = $_GET['cart_id'];

// echo $cart_id;

//가져온 문자열 /를 기준으로 잘라서 배열에 넣음
$id_array = explode( '/', $cart_id );
//배열의 크기 반환받아서 변수에 저장
$count = sizeof($id_array);

// echo $count;

//마지막 배열의 값은 없으므로 사이즈를 -1해준다
for($i=0; $i<$count-1; $i++){

    // echo var_dump((int)$id_array[$i]);
    // echo "<br>";
    //가져온 id값을 기준으로 cart테이블에서 삭제해줌
    $id = (int)$id_array[$i];

    $delete = "DELETE FROM cart WHERE id=$id";
    if(mysqli_query($conn, $delete)){
        
    } else {
        echo '<script> alert("삭제 실패"); </script>';
        echo("쿼리오류 발생: " . mysqli_error($conn));
    }


}

echo '<script>  history.back();  </script>';



?>
