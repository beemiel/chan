<?php
include '../main/db.php';



//주문날짜 구해줌
date_default_timezone_set('Asia/Seoul');
//date()얘는 문자열로 반환되는듯
$date = date("Ymd h:i:s"); 
$dateString = substr($date, 0, 8);
//날짜만 넣으려고 시간은 잘랐음

//주문번호 구해줌(날짜+주문정보db의 row 수)
$order_no = "";
$get_order_info = "SELECT * FROM order_info";
$order_info_result = mysqli_query($conn,$get_order_info);
$row_count=mysqli_num_rows($order_info_result); 
$row_count_six = sprintf("%06d",$row_count);


$test = $dateString."-".$row_count_six;
if($row_count > 0){ //저장된 정보가 있음

    $order_no = $dateString."-".$row_count_six;

} else { //저장된 정보가 없음

    $num = 1;
    $new_count = sprintf("%06d",$num);
    $order_no = $dateString."-".$new_count;


}

echo $row_count_six;
echo "<br>";
echo $new_count;
echo "<br>";
var_dump($row_count_six);
echo "<br>";
var_dump($new_count);
echo "<br>";
echo $test;
echo "<br>";
echo $order_no;


?>