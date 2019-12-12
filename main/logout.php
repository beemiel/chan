<?php
    session_start();
    session_destroy();
    // echo "<script> alert('".$member['name']."님 환영합니다');location.href='./market_index.php';</script>";
    // echo '<script> alert("로그아웃 성공"); history.back(); </script>';

    //쿠키도 없앰
    // setcookie("name", "", time() - 99999999, "/");
    // setcookie("email", "", time() - 99999999, "/");
    setcookie("uuid", "", time() - 99999999, "/");
    // setcookie("cookie_name", "", time() - 99999999, "/"); 

    //경고창 없이 하려면 아래처럼 그냥 경고창만 없애주면 됨 
    echo '<script> location.href = "../main/market_index.php"; </script>';
    // echo '<script> history.back(); </script>';
?>