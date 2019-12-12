<?php
//변경할 수량
$count = (int)$_POST['count'];
//수량이 변경될 아이템의 아이디 번호
$item_id = (int)$_POST['item_id'];
//배열의 인덱스
$array_id = (int)$_POST['array_id'];

var_dump($count);
var_dump($item_id);
var_dump($array_id);


//아이템 번호를 기준으로 하나의 배열을 둘로 나눈 후 post로 가져온 아이템의 번호가 같은 요소를 삭제하고 새 배열을 추가해서 두 배열을 붙여서 하나의 배열로 만들어줌
$start_array = unserialize($_COOKIE['cart']); 
$end_array  = unserialize($_COOKIE['cart']);



// 배열의 크기
$array_count = count($end_array);

echo "<br>";
for($i=0; $i<$array_count; $i++){
    echo "자르기 전 시작 아이디 : ".$end_array[$i][0];
    echo "자르기 전 시작 수량 : ".$end_array[$i][1];
}

echo "<br>";
$array_count13 = count($start_array);
for($i=0; $i<$array_count13; $i++){
    echo "자르기 전 끝 아이디 : ".$start_array[$i][0];
    echo "자르기 전 끝  수량 : ".$start_array[$i][1];
}


$slice = $array_count-$array_id;
$add = $array_id+1;
$start_array_temp = array_slice($start_array, $array_id, $slice);
$end_array_temp =  array_slice($end_array, $array_id, $slice+1);
$array_temp_count = count($end_array_temp);
$end_array_temp_temp = array_slice($end_array_temp, 1, $array_temp_count-1);

echo "<br>";
// $array_count2 = count($start_array_temp);
// for($i=0; $i<$array_count2; $i++){
//     echo "자르고 시작 아이디 : ".$start_array_temp[$i][0];
//     echo "자르고 시작 수량 : ".$start_array_temp[$i][1];
// }

echo "<br>";
$array_count111 = count($end_array_temp);
for($i=0; $i<$array_count111; $i++){
    echo "자르고 끝 아이디 : ".$end_array_temp[$i][0];
    echo "자르고 끝 수량 : ".$end_array_temp[$i][1];
}

// a/b/c/d/e/
// 0/1/2/3/4

// if id=3('d')
if($slice == $array_count){
    $start_array_temp = [];
}



$start_array = $start_array_temp;
$end_array = $end_array_temp_temp; 

//item배열에 담을 배열
$pro = [$item_id, $count];

//$start_array에 수정된 것 붙여줌
array_push( $start_array, $pro);

echo "<br>";
$array_count12 = count($start_array);
for($i=0; $i<$array_count12; $i++){
    echo "자르고 시작 추가 아이디 : ".$start_array[$i][0];
    echo "자르고 시작 추가 수량 : ".$start_array[$i][1];
}



$merge_array = array_merge($start_array, $end_array);

echo "<br>";
$array_count1112 = count($merge_array);
for($i=0; $i<$array_count1112; $i++){
    echo " merge 아이디 : ".$merge_array[$i][0];
    echo " merge 수량 : ".$merge_array[$i][1];
}

$item_array = serialize($merge_array);

//쿠키에 저장
// setcookie('cart',$item_array,time()+86400,'/');



// echo '<script> history.back(); </script>';



// $cut = count($item_array);


//로그에 출력해보기
// $retrive_date = unserialize($_COOKIE['todayview']); 
//배열 크기만큼
// count() 함수는, "요소 개수가 0인 배열"과 "존재하지 않는 배열" 모두 0을 반환하기에 혼란스러운 점이 있습니다. 
// 이때는 isset() 함수를 사용하여 그 배열이 실재하는지 우선 체크하는 것이 좋습니다.
//ㄴ>isset말고 그냥 $retrive_date의 값이 불린이라서 저걸로 체크함
// if($retrive_date == true){
//     $count = count($merge_array); //
//     for($i=0; $i<$count; $i++){
//         Console_log($merge_array[$i]);
//     }
// // }


// //console.log는 자바스크립트에서 사용가능하므로 함수를 통해 자바스크립트를 호출해줌
// function Console_log($data){
//     echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
// }
// ---------
// $temp =  array_slice($array, 0, 3); //0번째 인덱스부터 3개만 자름(2번째 인덱스까지)
// $array = $temp;

// string(1) "3" string(2) "12" string(1) "0"
// string(1) "7" string(2) "14" string(1) "1"


//         //item배열에 담을 배열
//         $pro = [$product, $amount];
//         //배열의 맨 앞에 추가해줌
//         array_unshift($array, $pro);
//         //배열을 다시 serialize해줌
//         $item_array = serialize($array);
//         //동일한 이름을 가진 쿠키에 저장해줌(덮어씌워지는듯 새롭게 갱신되나??)
//         setcookie('cart',$item_array,time()+86400,'/');






?>