<?php
include '../main/db.php';
session_start();
?>

<?php
$amount = $_POST['amount'];

// if($_SESSION['uuid'] != null){
// $useruuid = $_SESSION['uuid'];
// } else if ($_COOKIE['uuid'] != null){
//     $useruuid = $_COOKIE['uuid'];
// }

// if ($_COOKIE['uuid'] != null){
//     $useruuid = $_COOKIE['uuid'];
// }

    $useruuid = $_SESSION['uuid'];


$product = $_POST['id'];



//해당 아이템이 이미 담겨있는지 확인하기 위해서 db에서 불러옴
$get_wish = "SELECT id FROM wishlist WHERE user='$useruuid' AND item='$product'";
$result = mysqli_query($conn, $get_wish);
$row =  mysqli_fetch_array($result);




if($row['id']){
    //이미 존재할 경우 이미 있다고 알려줌
        echo '<script> alert("이미 등록된 상품입니다.");  history.back(); </script>';
        // echo '<script> alert('.$useruuid.');  history.back(); </script>';
} else {
    //장바구니에 없는 상품이므로 추가해줌
    $sql="insert into wishlist(user, item, count)
    values('".$useruuid."','".$product."','".$amount."')";

    if($conn->query($sql) == true){
        echo '<script> 
            if(confirm("자주 사는 상품에 등록 되었습니다. 해당 페이지로 이동할까요?")){
                location.href="../userpage/wishlist.php";  
            } else {
                history.back();
            }
        
            </script>';
    } else {
        echo '<script> alert("자주 사는 상품에 추가되지 않았습니다.");  </script>';
        echo("쿼리오류 발생: " . mysqli_error($conn));
    }



}







?>