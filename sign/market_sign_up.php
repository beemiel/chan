<?php
    // include "./db.php";
    $conn=mysqli_connect('127.0.0.1', 'root', 'sql2');

    $db=mysqli_select_db($conn, "chanchan") or die ('db select fail');

    if($db){
        // echo "db 연결성공";
        // echo '<script> alert("연결 성공"); history.back(); </script>';
    } else{
        // echo "db 연결 실패";
        // echo '<script> alert("연결 실패"); history.back(); </script>';
    }
    //html에서 form/input에 작성된 내용은 그 변수명을 가져오면 값을 받아올 수 있음. 아래 처럼
    // echo "<p>tilte : ".$_POST['name']."</p>";
    // echo "<p>emial : ".$_POST['email']."</p>";

   //var_dump(값); -> 값의 타입과 개수(문자열일때) 출력해줌
    // var_dump($_POST['checkbox']);

    // if($_POST['checkbox'] == null){
    //     echo '<script> alert("약관에 동의해주셈"); history.back(); </script>';
    // } else if ($_POST['checkbox'] != ""){
    //     echo '<script> alert("약관 동읠의함"); history.back(); </script>';
    // }

    
    // if($_POST['name'] == "" || $_POST['email'] == ""){
    //      //POST로 받아온 아이다와 비밀번호가 비었다면 알림창을 띄우고 전 페이지로 돌아갑니다.
    //     echo '<script> alert("아이디나 패스워드를 입력하세요"); history.back(); </script>';
    // } else {
    //     $username = $_POST['name'];
    //     $useremail = $_POST['email'];
    
    //     echo $username."   ";
    //     echo $useremail;

    //     // echo "<p>tilte : ".$_POST['name']."</p>";
    //     // echo "<p>emial : ".$_POST['email']."</p>";
    // }

    //post로 넘겨 받은 값 변수에 담기
    $username = $_POST['name'];
    $useremail = $_POST['email'];
    // $userpassword = $_POST['password'];
    // $userpasswordcheck = $_POST['passwordcheck'];
    $userphonenumber = $_POST['phonenumber'];
    $useraddress = $_POST['address'];
    $useraddressdetail = $_POST['addressdetail'];
    $userpostcode = $_POST['postcode'];
    $usercheckbox = $_POST['checkbox']; //체크박스는 체크가 안되어있으면 null임, 스트링은 "" 임


    //회원가입 
    if($username == ""){ //이름 예외처리
        echo '<script> alert("이름을 입력해주세요"); history.back(); </script>';
    } else if($useremail == ""){ //이메일 예외처리
        echo '<script> alert("이메일을 입력해주세요"); history.back(); </script>';
    } else if($_POST['password'] == ""){ //비밀번호 예외처리
        echo '<script> alert("비밀번호를 입력해주세요"); history.back(); </script>';
    } else if($_POST['passwordcheck'] == ""){ //비밀번호 확인 예외처리
        echo '<script> alert("비밀번호를 확인해주세요"); history.back(); </script>';
    } else if($userphonenumber == ""){ //휴대폰 예외처리
        echo '<script> alert("휴대폰 번호를 입력해주세요"); history.back(); </script>';
    } else if($useraddress == ""){ //주소 예외처리
        echo '<script> alert("주소를 입력해주세요"); history.back(); </script>';
    } else if($useraddressdetail == ""){ //상세주소 예외처리
        echo '<script> alert("주소를 입력해주세요"); history.back(); </script>';
    } else if($usercheckbox == null){ //약관 동의 예외처리
        echo '<script> alert("약관에 동의해주세요"); history.back(); </script>';
    } else if($_POST['password'] != $_POST['passwordcheck']){ //비밀번호 일치 예외처리
        echo '<script> alert("비밀번호가 틀렸습니다"); history.back(); </script>';
    } else { //회원가입 
        //비밀번호는 보안상 처리
        $userpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //회원의 고유 번호 생성
        function uuidgen4() {
            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
               mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
               mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
               mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
             );
        }
        $useruuid = uuidgen4();



        // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
        // VALUES ('John', 'Doe', 'john@example.com')";
        // 출처: https://xeros.dev/65 [Xeros Security Lab]
        // $sql = mq("insert into member (id,pw,name,adress,sex,email) values('".$userid."','".$userpw."','".$username."','".$adress."','".$sex."','".$email."')");

        //mysql에 저장
        $sql="insert into member(uuid, name, email, password, phone, address, addressdetail, postcode) 
        values('".$useruuid."','".$username."','".$useremail."','".$userpassword."','".$userphonenumber."','".$useraddress."','".$useraddressdetail."','".$userpostcode."')";
        // mysqli_query($conn, $sql); 이걸로 안하고 아래껄로 하는 중

        if ($conn->query($sql) === TRUE) {
            // echo '<script> alert("New record created successfully"); history.back(); </script>';
            echo '<script> alert("가입 완료"); location.href="market_sign_in.html"; </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
         
        $conn->close();



    }





?>