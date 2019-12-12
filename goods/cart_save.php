<?php
include '../main/db.php';
session_start();
?>

<?php
// $price = $_POST['sell_price'];
$amount = $_POST['amount'];

$useruuid = $_SESSION['uuid'];


$product = $_POST['id'];
date_default_timezone_set('Asia/Seoul');
//date()얘는 문자열로 반환되는듯
$date = date("Y-m-d h:i:s"); 
$dateString = substr($date, 0, 10);
//날짜만 넣으려고 시간은 잘랐음


//해당 아이템의 재고 가져옴
$get_stock = "SELECT stock FROM items WHERE id=$product";
$g_s = mysqli_query($conn, $get_stock);
$stock = mysqli_fetch_array($g_s);



//선택한 수량이 재고보다 많으면 담을 수 없음
if($amount > $stock['stock']){
    echo '<script> alert("재고가 부족합니다."); history.back(); </script>';
    exit;
}




//장바구니에 이미 있는 상품인지 확인하기 위해서 db에서 불러옴
$get = "SELECT count FROM cart WHERE user='$useruuid' AND item='$product'";
$result = mysqli_query($conn, $get);
$row =  mysqli_fetch_array($result);

if($row['count']){
    $update_caount = $row['count'] + $amount;
    //이미 존재할 경우 count만 업데이트 해줌
    $update = "UPDATE cart SET count=$update_caount WHERE user='$useruuid' AND item='$product'";    

    if(mysqli_query($conn, $update)){
        echo '<script> 
            if(confirm("장바구니에 추가되었습니다. 장바구니로 이동할까요?")){
                location.href="./goods_cart.php";  
            } else {
                history.back();
            }
        
            </script>';
    } else {
        echo '<script> alert("장바구니에 추가되지 않았습니다.");  </script>';
        echo("쿼리오류 발생: " . mysqli_error($conn));
    }

} else {
    //장바구니에 없는 상품이므로 추가해줌
    $sql="insert into cart(user, item, date, count) 
    values('".$useruuid."','".$product."','".$dateString."','".$amount."')";

    if($conn->query($sql) == true){
        echo '<script> 
            if(confirm("장바구니에 추가되었습니다. 장바구니로 이동할까요?")){
                location.href="./goods_cart.php";  
            } else {
                history.back();
            }
        
            </script>';
    } else {
        echo '<script> alert("장바구니에 추가되지 않았습니다.");  </script>';
        echo("쿼리오류 발생: " . mysqli_error($conn));
    }



}







?>

