<?php
include '../main/db.php';

session_start();
?>

<?php


$cart_id = $_POST['cart_id'];
$price = $_POST['price'];

//가져온 문자열 /를 기준으로 잘라서 배열에 넣음
$id_array = explode( '/', $cart_id );
//배열의 크기 반환받아서 변수에 저장
$count = sizeof($id_array);
//첫번째 상품, 첫번째 상품의 이름은 따로 저장함(결제시 정보를 보여주기 위해서)
$first_product = "";


if($count <= 1){
    echo '<script> alert("상품을 선택해주세요"); history.back(); </script>';
    exit;
}


//상품의 총 합계
$amount = 0;


//로그인한 사람의 정보 디비에서 가져옴
$login_uuid = $_SESSION['uuid'];

$get_member = "SELECT * FROM member WHERE uuid='$login_uuid'";
$member_result = mysqli_query($conn, $get_member);
$member_row = mysqli_fetch_array($member_result);



?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">



  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css부터 시작하는 이유는 해당 파일이 있는 위치에서 경로가 시작하기 때문에 -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">  -->

    <!--  script를 부트페이에서 제공하는 CDN에서 불러옴 -->
    <script src="https://cdn.bootpay.co.kr/js/bootpay-3.0.6.min.js" type="application/javascript"></script>

    <title>Title</title>
</head>


<style>
</style>

<body onload="init();">



<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>
    <hr>



<!--     
<input type = "radio" name="bgColor" value = "blue" onclick="changeBg(this.value)" checked>파란색<br>
    <input type = "radio" name="bgColor" value = "red" onclick="changeBg(this.value)">빨간색<br> -->




<!-- 배송정보 라디오 버든 선택 분기 자바스크립트 -->
<script>

function init () {

    //input에 name으로 접근해서 값 세팅(배송 정보 초기화)
    $('input[name=postcode]').val("<?php echo $member_row['postcode']  ?>");
    $('input[name=address]').val("<?php echo $member_row['address']  ?>");
    $('input[name=addressdetail]').val("<?php echo $member_row['addressdetail']  ?>");
    $('input[name=recipient_name]').val("<?php echo $member_row['name']  ?>");
    $('input[name=phonenumber]').val("<?php echo $member_row['phone']  ?>");
    document.getElementById("find_addr").style.visibility = "hidden";

}







function changeBg(value){
    // alert(value);

    if(value == "new"){

        //input에 name으로 접근해서 값 세팅 ())
        $('input[name=postcode]').val("");
        $('input[name=address]').val("");
        $('input[name=addressdetail]').val("");
        $('input[name=recipient_name]').val("");
        $('input[name=phonenumber]').val("");
        document.getElementById("find_addr").style.visibility = "visible";
        
    } else {

        //input에 name으로 접근해서 값 세팅
        $('input[name=postcode]').val("<?php echo $member_row['postcode']  ?>");
        $('input[name=address]').val("<?php echo $member_row['address']  ?>");
        $('input[name=addressdetail]').val("<?php echo $member_row['addressdetail']  ?>");
        $('input[name=recipient_name]').val("<?php echo $member_row['name']  ?>");
        $('input[name=phonenumber]').val("<?php echo $member_row['phone']  ?>");
        document.getElementById("find_addr").style.visibility = "hidden";
        
    }

}
    
</script>





<!-- <h2 class="text-center" style="margin-top:80px;">주문서<?php echo $cart_id; ?></h2> -->
<h2 class="text-center" style="margin-top:80px;">주문서</h2>
<p class="text-center" style="margin-bottom:50px;">주문하실 상품명 및 수량을 정확하게 확인해 주세요.</p>


<!-- 상품 정보 -->

<div class="container" style="margin-top:70px;">

    <h5>상품 정보</h5>

<table class="table table-md">

    <thead class="thead-light">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th style="width: 20%">상품</th>
        <th style="width: 60%">상품 정보</th>
        <th style="width: 10%">수량</th>
        <th style="width: 10%">상품금액</th>
    </tr>
    </thead>
    <tbody>

        <!--이 아래에 반복문 -->
    <?php

        //마지막 배열의 값은 없으므로 사이즈를 -1해준다
        for($i=0; $i<$count-1; $i++){

        //가져온 id값을 기준으로 items테이블에서 가져와서 상품 정보를 뿌려줌
        //post로 넘어온 데이터가 문자열이고 id는 int타입이므로 문자열을 int 변환해서 쿼리문 작성
        $id = (int)$id_array[$i];


         //카트 테이블에서 해당 로우의 값 가져옴(아이템의 id와 수량을 알기 위해서)
         $get_cart = "SELECT * FROM cart WHERE id=$id";
         $cart_result = mysqli_query($conn,$get_cart);
         $cart_row =  mysqli_fetch_array($cart_result);

         //인덱스 값에 해당하는 아이템의 인덱스 값 가져와서 변수에 저장
         $item_id = $cart_row['item'];

       

        //위에서 가져온 인덱스 값을 기준으로 상품 정보 가져옴
        $get_item = "SELECT * FROM items WHERE id=$item_id";
        $item_result = mysqli_query($conn,$get_item);

       


        if($item_result == true){
            $item_row =  mysqli_fetch_array($item_result);


            //첫번째 상품의 이름은 따로 저장함(결제시 정보를 보여주기 위해서)
            if($i==0){
                $first_product = $item_row['name'];
            }


            //상품의 총 합계를 구함((수량 * 가격)을 반복문 횟수만큼 계속 추가적으로 더해줌)
            $amount += $cart_row['count'] * $item_row['price'];

            ?>
            <!-- html에 뿌려줌 -->
            <tr>
                <td>
                    <a class="thumbnail pull-left" href="#"> <img class="media-object"  src=<?php echo $item_row['imgpath'] ?> style="max-width: 72px; max-height: 72px;"> </a>
                </td>
                <td><?php echo $item_row['name']; ?></td>
                <td><?php echo $cart_row['count']; ?>개</td>
                <td><?php echo number_Format($cart_row['count'] * $item_row['price']); ?>원</td>
            </tr>



            <?php
        
        } else {
            echo '<script> alert("상품 정보를 가져오는데 실패했습니다."); </script>';
            echo("쿼리오류 발생: " . mysqli_error($conn));
        }


        }




    ?>




















            <tr>
                <td> </td>
                <td> </td>
                <td>상품합계</td>
                <td><?php echo number_Format($amount); ?>원</td>
            </tr>

            <tr>
                <td> </td>
                <td> </td>
                <td>배송비</td>
                <td>2,500원</td>
            </tr>

            <tr>
                <td> </td>
                <td> </td>
                <td>총합</td>
                <td><?php echo number_Format($amount + 2500); ?>원</td>
            </tr>
   


            </tbody>

        </table>

        <hr>

<!-- 컨테이너 끝 -->
</div>


<!-- 주문자 정보 -->

<div class="container" style="margin-top:70px;">
<h5>주문자 정보</h5>

<hr>

    <div class="row">
        <p class="col-lg-3">보내는 분</p>
        <p class="col-lg-9"><?php echo $member_row['name'];  ?></p>
    </div>
    

    <div class="row">
        <p class="col-lg-3">휴대폰</p>
        <p class="col-lg-9"><?php echo $member_row['phone'];  ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3">이메일</p>
        <p class="col-lg-9"><?php echo $member_row['email'];  ?></p>
    </div>

    <div class="row">
        <p class="col-lg-3"></p>
        <p class="col-lg-9">정보 변경은 개인정보 수정 메뉴에서 가능합니다.</p>
    </div>

<hr>
</div>



<!-- 배송 정보 -->

<div class="container" style="margin-top:70px;">
<h5>배송 정보</h5>

<hr>



<!-- 배송정보 라디오 버튼 -->
<div class="row" style="margin-top:20px; margin-bottom:30px; margin-left:10px;">
    <input type = "radio" name="bgColor" value = "existing" onclick="changeBg(this.value)" checked>기존 배송지
    <input type = "radio" name="bgColor" value = "new" onclick="changeBg(this.value)">새로운 배송지
</div>

<!-- 주소 -->
<div class="row">
        <p class="col-lg-3">주소</p>
        <div class="row" >
       
        <input type="text" id="postcode" name="postcode" placeholder="우편번호" value="">
        <button style="border-radius:0px;" id="find_addr" type="button" onclick="findaddress();" name="address_btn">주소찾기</button>
        <input type="text" class="form-control" class="form-control"  id="roadAddress" name="address"  placeholder="주소를 입력해 주세요"  value="">
        </div>
</div>

<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
    function findaddress() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('postcode').value = data.zonecode;
                document.getElementById("roadAddress").value = roadAddr;
                // document.getElementById("sample4_jibunAddress").value = data.jibunAddress;
                
                // // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                // if(roadAddr !== ''){
                //     document.getElementById("sample4_extraAddress").value = extraRoadAddr;
                // } else {
                //     document.getElementById("sample4_extraAddress").value = '';
                // }

                // var guideTextBox = document.getElementById("guide");
                // // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                // if(data.autoRoadAddress) {
                //     var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                //     guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
                //     guideTextBox.style.display = 'block';

                // } else if(data.autoJibunAddress) {
                //     var expJibunAddr = data.autoJibunAddress;
                //     guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
                //     guideTextBox.style.display = 'block';
                // } else {
                //     guideTextBox.innerHTML = '';
                //     guideTextBox.style.display = 'none';
                // }
            }
        }).open();
    }
</script>


<!-- 상세 주소 -->
<div class="row" style="margin-top:20px;">
        <p class="col-lg-3">상세 주소</p>
        <input type="text" name="addressdetail" class="col-lg-9" id="inputName" placeholder="상세 주소를 입력해 주세요">
</div>





<div class="row" style="margin-top:20px;">
        <p class="col-lg-3">수령인 이름</p>
        <input type="text" name="recipient_name" class="col-lg-9" id="inputName" placeholder="이름을 입력해 주세요">
</div>

<div class="row" style="margin-top:20px;">
        <p class="col-lg-3">휴대폰</p>
        <input type="tel" name="phonenumber" class="col-lg-9" id="inputMobile" placeholder="휴대폰번호를 입력해 주세요">
</div>

<div class="row" style="margin-top:20px;">
        <p class="col-lg-3">배송 요청사항</p>
        <input type="text" name="delivery_msg" class="col-lg-9" placeholder="요청사항을 입력해 주세요">
</div>



<hr>
</div>









<!-- 결제 수단 -->

<div class="container" style="margin-top:70px;">
<h5>결제 정보</h5>
<hr>
<div class="row" style="margin-top:20px;">
    <p class="col-lg-3">결제 선택</p>
    <input type="radio" name="c" value="d" checked="checked">카드 결제
    <br>
    <!-- <input type="radio" name="d" value="c">휴대폰 결제 -->
</div>
<hr>

</div>


<!-- <div class="container" style="margin-top:70px;">
<h5>개인정보 수집/제공</h5>


</div> -->



<div class="text-center" style="margin-top:80px; margin-bottom:10%;">
    <button style="width:300px; border-radius:0px;" type="button" class="btn btn-info btn-lg" onclick="pay();">결제하기</button>
</div>




<!-- 결제(부트페이) 사용하는 자바스크립트 함수 -->
<script>

    function pay(){

        //실제 복사하여 사용시에는 모든 주석을 지운 후 사용하세요
    BootPay.request({
	price: '<?php echo $amount+2500; ?>', //실제 결제되는 가격
    // price: '1000', //실제 결제되는 가격
	application_id: "5da6d6274f74b40025c5eeea",
	name: '<?php echo $first_product;  ?>', //결제창에서 보여질 이름
	pg: 'lgup',
	method: '', //결제수단, 입력하지 않으면 결제수단 선택부터 화면이 시작합니다.
	show_agree_window: 0, // 부트페이 정보 동의 창 보이기 여부
	items: [
		{
			item_name:  '아이템', //상품명
			qty: 1, //수량
			unique: '123', //해당 상품을 구분짓는 primary key
			price: <?php echo $price; ?>, //상품 단가
			cat1: 'TOP', // 대표 상품의 카테고리 상, 50글자 이내
			cat2: '티셔츠', // 대표 상품의 카테고리 중, 50글자 이내
			cat3: '라운드 티', // 대표상품의 카테고리 하, 50글자 이내
		}
	],
	user_info: {
        username: '유저이름',
		email: '이메일',
		addr: '사용자 주소',
		phone: '010-1234-4567'
	},
	order_id: '고유order_id_1234', //고유 주문번호로, 생성하신 값을 보내주셔야 합니다.
	params: {callback1: '그대로 콜백받을 변수 1', callback2: '그대로 콜백받을 변수 2', customvar1234: '변수명도 마음대로'},
	account_expire_at: '2018-05-25', // 가상계좌 입금기간 제한 ( yyyy-mm-dd 포멧으로 입력해주세요. 가상계좌만 적용됩니다. )
	extra: {
	    start_at: '2019-05-10', // 정기 결제 시작일 - 시작일을 지정하지 않으면 그 날 당일로부터 결제가 가능한 Billing key 지급
		end_at: '2022-05-10', // 정기결제 만료일 -  기간 없음 - 무제한
        vbank_result: 1, // 가상계좌 사용시 사용, 가상계좌 결과창을 볼지(1), 말지(0), 미설정시 봄(1)
        quota: '0,2,3' // 결제금액이 5만원 이상시 할부개월 허용범위를 설정할 수 있음, [0(일시불), 2개월, 3개월] 허용, 미설정시 12개월까지 허용
	}
}).error(function (data) {
	//결제 진행시 에러가 발생하면 수행됩니다.
    alert("결제에 실패했습니다");
	console.log(data);
}).cancel(function (data) {
	//결제가 취소되면 수행됩니다.
    alert("결제를 취소했습니다");
	console.log(data);
}).ready(function (data) {
	// 가상계좌 입금 계좌번호가 발급되면 호출되는 함수입니다.
	console.log(data);
}).confirm(function (data) {
	//결제가 실행되기 전에 수행되며, 주로 재고를 확인하는 로직이 들어갑니다.
	//주의 - 카드 수기결제일 경우 이 부분이 실행되지 않습니다.
	console.log(data);
	var enable = true; // 재고 수량 관리 로직 혹은 다른 처리
	if (enable) {
		BootPay.transactionConfirm(data); // 조건이 맞으면 승인 처리를 한다.
	} else {
		BootPay.removePaymentWindow(); // 조건이 맞지 않으면 결제 창을 닫고 결제를 승인하지 않는다.
	}
}).close(function (data) {
    // 결제창이 닫힐때 수행됩니다. (성공,실패,취소에 상관없이 모두 수행됨)
    console.log(data);
}).done(function (data) {
	//결제가 정상적으로 완료되면 수행됩니다
	//비즈니스 로직을 수행하기 전에 결제 유효성 검증을 하시길 추천합니다.

    //지금 data는 json객체 형태?

    // location.href="./pay_check.php";



                        //form이 없으므로 여기서 생성해줌
                        var form = document.createElement("form");
                        form.setAttribute("charset", "UTF-8");
                        form.setAttribute("method", "Post"); // Get 또는 Post 입력
                        form.setAttribute("action", "../pay/pay_check.php");
                    
                        //같이 보낼 필드 생성하고 값 넣어줌
                        //id문자열 넣을 필드
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "card_name");
                        hiddenField.setAttribute("value", data['card_name']);
                        form.appendChild(hiddenField);

                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "card_no");
                        hiddenField.setAttribute("value", data['card_no']);
                        form.appendChild(hiddenField);

                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "method_name");
                        hiddenField.setAttribute("value", data['method_name']);
                        form.appendChild(hiddenField);

                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "purchased_at");
                        hiddenField.setAttribute("value", data['purchased_at']);
                        form.appendChild(hiddenField);

                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "purchased_at");
                        hiddenField.setAttribute("value", data['card_quota']);
                        form.appendChild(hiddenField);

                        //주소값(input) 가져와서 넘겨봄
                        var test = $('input[name=addressdetail]').val();
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "test");
                        hiddenField.setAttribute("value", test);
                        form.appendChild(hiddenField);


                        //결제하고 반환받은 json데이터 string으로 변환해서 post로 넘김
                        var pay_json = JSON.stringify(data);
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "pay_info");
                        hiddenField.setAttribute("value", pay_json);
                        form.appendChild(hiddenField);

                        //입력받은 배송 정보 json으로 만들고 string으로 변환해서 post로 넘김
                        //객체생성
                        var input_info = new Object();
                        input_info.postcode = $('input[name=postcode]').val();
                        input_info.address = $('input[name=address]').val();
                        input_info.address_detail = $('input[name=addressdetail]').val();
                        input_info.recipient_name = $('input[name=recipient_name]').val();
                        input_info.recipient_phone = $('input[name=phonenumber]').val();
                        input_info.delivery_msg = $('input[name=delivery_msg]').val();
                        //String형태로 변환
                        var input_json = JSON.stringify(input_info)
                        //히튼 필드 생성
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "input_info");
                        hiddenField.setAttribute("value", input_json);
                        form.appendChild(hiddenField);
                        

                        //결제 후 장바구니db에서 삭제하기 위해서 cart_id도 같이 넘겨줌 
                        var id = "<?php echo $cart_id; ?>";
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "cart_id");
                        hiddenField.setAttribute("value", id);
                        form.appendChild(hiddenField);

                        
                        //hthml의 body에 붙여주는 듯
                        document.body.appendChild(form); 

                        //submit
                        form.submit();





	console.log(data);
});



    }


</script>







<!-- footer -->
<?php include '../main/footer.php';?>




    <!-- 아이콘 -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
