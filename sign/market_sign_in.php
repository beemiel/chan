<?php
    // include 'db.php';
    $conn=mysqli_connect('127.0.0.1', 'root', 'sql2');

    $db=mysqli_select_db($conn, "chanchan") or die ('db select fail');

    if($db){
        // echo "db 연결성공";
        // echo '<script> alert("연결 성공"); history.back(); </script>';
    } else{
        // echo "db 연결 실패";
        // echo '<script> alert("연결 실패"); history.back(); </script>';
    }

    //post로 받은  로그인 유지 체크박스 값
    $checkbox = $_POST['autoLogin']; //체크박스는 체크가 안되어있으면 null임, 스트링은 "" 임

    //POST로 받아온 아이다와 비밀번호가 비었다면 알림창을 띄우고 전 페이지로 돌아갑니다.
	if($_POST["email"] == "" || $_POST["password"] == ""){
		echo '<script> alert("아이디나 패스워드 입력하세요"); history.back(); </script>';
	} else {

        //password변수에 POST로 받아온 값을 저장하고 sql문으로 POST로 받아온 아이디값을 찾습니다.
        $password = $_POST['password'];

        $sql = "SELECT * FROM member WHERE email ='".$_POST['email']."'";
        $result = mysqli_query($conn, $sql);
        $member = mysqli_fetch_array($result);
        // echo '<h1>'.$member['uuid'].'</h1>'; //이때 일치하는 아이디가 없으면 null을 반환함 
        

        //만약 일치하는 아이디가 없으면 경고창 띄워줌
        if($member['uuid'] == null){
            echo '<script> alert("회원정보가 존재하지 않습니다"); history.back(); </script>';
        } else {
            //$hash_pw에 db에서 받아온 아이디열의 비밀번호를 저장합니다.  
            $hash_pw = $member['password'];

            //입력된 비밀번호와 db에 저장된 비밀번호 일치 조건문
            if(password_verify($password, $hash_pw)){
                //만약 password변수와 hash_pw변수가 같다면 세션값을 저장하고 알림창을 띄운후 main.php파일로 넘어갑니다.


                session_start();
                $_SESSION['name'] = $member['name'];
                $_SESSION['email'] = $member['email'];
                $_SESSION['password'] = $member['password'];

                //세션에 uuid값을 저장하기 위해서 db에서 가져옴
                $get="SELECT uuid FROM member WHERE name='".$member['name']."'";
                $result = mysqli_query($conn, $get);
                $row =  mysqli_fetch_array($result);

                //가져온 uuid를 세션에 저장
                $_SESSION['uuid'] = $row['uuid'];


                //로그인 유지에 체크가 되어있으면 쿠키에 아이디와 비밀번호 uuid를 저장함
                if($checkbox != null){
                    // setcookie('name',$member['name'],time()+(86400*30),'/');
                    // setcookie('email',$member['email'],time()+(86400*30),'/');
                    setcookie('uuid',$row['uuid'],time()+(86400*30),'/');
                }




                //쿠키에 저장된 장바구니 정보가 있다면 로그인 한 회원의 장바구니 디비에 추가해준다
                if($_COOKIE['cart']){ //장바구니 쿠키가 있다면 
                    
                    //쿠키가 갖고 있는 배열 가져옴
                    $array = unserialize($_COOKIE['cart']); 
                    //배열 크기를 담는 변수
                    $count = count($array);
                    //로그인 유저의 uuid
                    $useruuid = $row['uuid'];

                    //저장할때 시간도 저장해서 시간 계산해줌
                    date_default_timezone_set('Asia/Seoul');
                    //date()얘는 문자열로 반환되는듯
                    $date = date("Y-m-d h:i:s"); 
                    $dateString = substr($date, 0, 10);
                    //날짜만 넣으려고 시간은 잘랐음

                    for($i=0; $i<$count; $i++){ 

                        //상품번호
                        $item_id = $array[$i][0];
                        //상품번호의 수량
                        $item_count = $array[$i][1];

                        //중복검사 후 담아야함
                        //장바구니에 이미 있는 상품인지 확인하기 위해서 db에서 불러옴
                        $get_cart = "SELECT count FROM cart WHERE user='$useruuid' AND item='$item_id'";
                        $cart_result = mysqli_query($conn, $get_cart);
                        $cart_row =  mysqli_fetch_array($cart_result);

                        if($cart_row['count']){ //존재할 경우

                            //업데이트 할 수량(기존 수량+추가할 수량)
                            $update_caount = $cart_row['count'] + $item_count;
                            //이미 존재할 경우 count만 업데이트 해줌
                            $update = "UPDATE cart SET count=$update_caount WHERE user='$useruuid' AND item='$item_id'";  
                            mysqli_query($conn, $update);


                        } else { //존재하지 않는 경우

                            $sql="insert into cart(user, item, date, count) 
                            values('".$useruuid."','".$item_id."','".$dateString."','".$item_count."')";
                            $conn->query($sql);

                        }

                    }


                    //장바구니 디비에 저장했으므로 쿠키 삭제해줌 
                    setcookie("cart", "", time() - 99999999, "/");



                }



                echo "<script> location.href='../main/market_index.php';</script>";



            } else {
                //비밀번호가 일치하지 않을 경우
                echo '<script> alert("아이디 혹은 비밀번호를 확인하세요"); history.back(); </script>';
            }



        }



    }



?>