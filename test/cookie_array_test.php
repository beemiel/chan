<?php


//쿠키 배열 테스트
//쿠키가 갖고 있는 배열 가져옴
$array = unserialize($_COOKIE['cart']); 
$count = count($array);

var_dump($array);

for($i=0; $i<$count; $i++){

    echo "상품번호 : " . $array[$i][0] . ", 수량 : " . $array[$i][1] . "<br>";


}



?>