<?php
include '../main/db.php';
// session_start();
?>
<?php
//비로그인일때 장바구니를 누르면 쿠키에 저장해줌(쿠키에 저장->로그인하면 카트 디비에 저장하고 쿠키 삭제)

$amount = $_POST['amount'];
$product = $_POST['id'];

//해당 아이템의 재고 가져옴
$get_stock = "SELECT stock FROM items WHERE id=$product";
$g_s = mysqli_query($conn, $get_stock);
$stock = mysqli_fetch_array($g_s);

//선택한 수량이 재고보다 많으면 담을 수 없음
if($amount > $stock['stock']){
    echo '<script> alert("재고가 부족합니다."); history.back(); </script>';
    exit;
}

//비회원 장바구니
if($_COOKIE['cart']){ //쿠키가 존재할 경우

    //쿠키가 갖고 있는 배열 가져옴
    $array = unserialize($_COOKIE['cart']); 

    //중복된 제품 번호가 있는지 확인할 변수
    $id_check = false;
    //배열의 키와 값을 분리해 낼 때 사용하는 함수
    foreach ($array as $key => $val) {
        if ($val[0] == $product) { 

            //중복된 값이 있으므로 id_check의 값을 true로 변경해줌
            $id_check = true;

            echo '<script> alert("이미 장바구니에 추가된 상품입니다."); history.back(); </script>';
            exit;

        }
    }

    if($id_check == false){ //중복된 값이 없으므로 배열에 새로 추가해준다

        //item배열에 담을 배열
        $pro = [$product, $amount];
        //배열의 맨 앞에 추가해줌
        array_unshift($array, $pro);
        //배열을 다시 serialize해줌
        $item_array = serialize($array);
        //동일한 이름을 가진 쿠키에 저장해줌(덮어씌워지는듯 새롭게 갱신되나??)
        setcookie('cart',$item_array,time()+86400,'/');

        //쿠키에 저장했으면 confirm띄워줌
        echo '<script> 
        if(confirm("장바구니에 추가되었습니다. 장바구니로 이동할까요?")){
            location.href="./goods_cart.php";  
        } else {
            history.back();
        }

        </script>';

    }


} else { //쿠키가 존재하지 않을 경우

    //상품의 id값을 담을 배열 선언
    $item = []; 
    //item배열에 담을 배열
    $pro = [$product, $amount];
    //item배열에 제품 배열 추가
    array_push($item, $pro);
    //쿠키에 담기위해서 serialize해줌
    $item_array = serialize($item);
    //배열을 담는 쿠키 생성
    setcookie('cart',$item_array,time()+86400,'/');

    //쿠키에 저장했으면 confirm띄워줌
    echo '<script> 
    if(confirm("장바구니에 추가되었습니다. 장바구니로 이동할까요?")){
        location.href="./goods_cart.php";  
    } else {
        history.back();
    }

    </script>';

}



?>

