<?php
include '../main/db.php';

session_start();
?>

<?php

if($_SESSION['uuid'] != null){
$user = $_SESSION['uuid'];
} else if ($_COOKIE['uuid'] != null){
    $user = $_COOKIE['uuid'];
}

//장바구니 테이블에 저장된 아이템들 불러옴
$get ="SELECT * FROM cart WHERE user='$user'";

$result = mysqli_query($conn,$get);
 //mysql_num_rows() 함수 : 행의 개수를 세는 함수.
 $count=mysqli_num_rows($result);    

//상품합계 담을 변수
$product_amount = 0;












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


    <title>Title</title>
</head>


<style>
</style>

<body onload="init();">

<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>

<hr>

<div class="text-center" style="margin-top: 80px;" >
<h2>장바구니<?php echo $_COOKIE['name'].$_COOKIE['email'] ?></h2>
<p>주문하실 상품명 및 수량을 정확하게 확인해 주세요.</p>
</div>


<!-- 체크박스 jsp -->
<script>

function init () {

    var count = <?php echo $count; ?>

    if(count > 0) {
    var checkbox = $('input:checkbox[id="checkbox"]').prop("checked", true);


    
	//체크박스 배열
    var ch = document.getElementsByName("item_check[]");
    //전체 해제
    for(var i=0; i<ch.length; i++){
            ch[i].checked = true;



        }

    } else {
        $('input:checkbox[id="checkbox"]').prop("checked", false);
    }

}



function check(){

    //선택했을때의 상태를 가져와서 조건문으로 모두 선택 모두 해제 처리
    var check = $('input:checkbox[id="checkbox"]').is(":checked");

    //체크박스 배열?
    var ch = document.getElementsByName("item_check[]");

    // alert(length);

    if(check == true){
        //전체 선택
        for(var i=0; i<ch.length; i++){
            ch[i].checked = true;
            // alert(ch[i].value);
        }

    } else {
        //전체 해제
        for(var i=0; i<ch.length; i++){
            ch[i].checked = false;
        }
    }

    // //선택된 카트의 id값으로 json생성
    // //먼저 리스트 생성
    // var idList = new Array();

    // for(var i=0; i<ch.length; i++){

    //     //객체 생성
    //     var check = new Object();
    //     //데이터 넣어줌
    //     check.id = ch[i].value;
    //     // 리스트에 생성된 객체 삽입
    //     idList.push(check);

    // }

    // //String 형태로 변환
    // var jsonData = JSON.stringify(idList);
    // // alert(jsonData);


}



</script>


<!-- 장바구니 -->

<div class="container" style="margin-top:70px;">
<table class="table table-md">

    <thead class="thead-light">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th style="width: 10%">
        <div class="checkbox">
            <label><input type="checkbox" id="checkbox" name="item_checkbox" onclick="check();"></label>
        </div>
        </th>
        <th style="width: 10%">대표이미지</th>
        <th style="width: 50%">상품 정보</th>
        <th style="width: 10%">수량</th>
        <th style="width: 10%">상품금액</th>
        <th style="width: 10%">삭제</th>
    </tr>
    </thead>
    <tbody>

    <?php
    if($_SESSION['name'] != null){ //회원의 장바구니
        if($count > 0){

            for($i=0; $i<$count; $i++){
                $row =  mysqli_fetch_array($result);
                $id = $row['item'];

                $get_item = "SELECT * FROM items WHERE id=$id";
                $query = mysqli_query($conn, $get_item);
                $item =  mysqli_fetch_array($query);

                $product_amount += $row['count'] * $item['price'];
                ?>

                <tr>
                    <td>
                    <div class="checkbox">
                        <label><input type="checkbox" name="item_check[]"  value=<?php echo $row['id']; ?>></label>
                    </div>
                    </td>
                    <td>
                        <a class="thumbnail pull-left" href="#"> <img class="media-object"  src=<?php echo $item['imgpath']; ?> style="max-width: 72px; max-height: 72px;"> </a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-lg-12"><?php echo $item['name'] ?></div>
                            <div class="col-lg-12"><?php echo $item['subtitle'] ?></div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <form action="./cart_count_update.php" method="post">
                                <input type="number" class="form-control" name="count" value=<?php echo $row['count']; ?>>
                                <input type="hidden"  name="cart_id" value=<?php echo $row['id']; ?>>
                                <button class="btn btn-outline-primary">수량 변경</button>
                            </form>
                        </div>
                    </td>
                    <td><?php echo number_Format($row['count'] * $item['price']); ?>원</td>
                    <td>
                        <form action="./cart_delete.php" method="post" id="del">
                            <!-- <i class="fas fa-times"><a  href="javascript:del.submit();"></a></i> -->
                            <button class="btn btn-outline-danger">삭제</button>
                            <input type="hidden" name="cart_id" value=<?php echo $row['id']; ?>>
                        </form>
                    </td>
                </tr>



        





                <?php
            }
            ?>

                    <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>상품합계</td>
                    <td><?php echo number_Format($product_amount); ?>원</td>
                    </tr>



                    <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>배송비</td>
                    <td>2,500원</td>
                    </tr>

                    <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>총합</td>
                    <td><?php echo number_Format($product_amount + 2500); ?>원</td>
                    </tr>



            <?php
        } else {
            ?>

            <tr>
            <td> </td>
            <td> </td>
            <td class="text-center"> 장바구니가 비었습니다 </td>
            <td> </td>
            <td></td>
            <td></td>
            </tr>

            <?php
        }

    } else { //비회원의 장바구니

        if($_COOKIE['cart']){ //쿠키가 있을때

            //쿠키가 갖고 있는 배열 가져옴
            $array = unserialize($_COOKIE['cart']); 
            //배열 크기를 담는 변수
            $count = count($array);

            for($i=0; $i<$count; $i++){

                // echo "상품번호 : " . $array[$i][0] . ", 수량 : " . $array[$i][1] . "<br>";

                //상품번호를 기준으로 디비에서 상품 정보 가져옴
                //상품번호
                $item_id = $array[$i][0];
                //상품번호의 수량
                $item_count = $array[$i][1];
                //상품 정보 가져오는 쿼리문
                $get_item = "SELECT * FROM items WHERE id=$item_id";
                $item_result = mysqli_query($conn, $get_item);
                $item_row = mysqli_fetch_array($item_result);

                //상품의 총 합계를 구함((수량 * 가격)을 반복문 횟수만큼 계속 추가적으로 더해줌)
                $product_amount += $item_count * $item_row['price'];
                ?>

                <tr>
                    <td>
                    <div class="checkbox">
                        <label><input type="checkbox" name="item_check[]"  value=<?php echo $item_row['id']; ?>></label>
                    </div>
                    </td>
                    <td>
                        <a class="thumbnail pull-left" href="#"> <img class="media-object"  src=<?php echo $item_row['imgpath']; ?> style="max-width: 72px; max-height: 72px;"> </a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-lg-12"><?php echo $item_row['name'] ?></div>
                            <div class="col-lg-12"><?php echo $item_row['subtitle'] ?></div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <form  method="post">
                                <input type="number" class="form-control" name="count" value=<?php echo $item_count; ?>>
                                <input type="hidden"  name="item_id" value=<?php echo $item_id; ?>>
                                <input type="hidden"  name="array_id" value=<?php echo $i; ?>>
                                <button class="btn btn-outline-primary">수량 변경</button>
                            </form>
                        </div>
                    </td>
                    <td><?php echo number_Format($item_count * $item_row['price']); ?>원</td>
                    <td>
                        <form action="" method="post" id="del">
                            <!-- <i class="fas fa-times"><a  href="javascript:del.submit();"></a></i> -->
                            <button class="btn btn-outline-danger">삭제</button>
                            <input type="hidden" name="" value=<?php echo $item_id; ?>>
                        </form>
                    </td>
                </tr>

                <?php
            } //반복문 끝
            ?>

            
                    <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>상품합계</td>
                    <td><?php echo number_Format($product_amount); ?>원</td>
                    </tr>



                    <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>배송비</td>
                    <td>2,500원</td>
                    </tr>

                    <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>총합</td>
                    <td><?php echo number_Format($product_amount + 2500); ?>원</td>
                    </tr>




            <?php
        } else { //쿠키가 없을때
            ?>



            <tr>
            <td> </td>
            <td> </td>
            <td class="text-center"> 장바구니가 비었습니다 </td>
            <td> </td>
            <td></td>
            <td></td>
            </tr>



            <?php
        }

    }

    ?>




        <!-- <script>
        function price(id){
$.ajax({

url: "./get_item_price.php", // 클라이언트가 요청을 보낼 서버의 URL 주소

data: { name: "홍길동" },                // HTTP 요청과 함께 서버로 보낼 데이터

type: "GET",                             // HTTP 요청 방식(GET, POST)

dataType: "json"                         // 서버에서 보내줄 데이터의 타입

})

// HTTP 요청이 성공하면 요청한 데이터가 done() 메소드로 전달됨.

.done(function(json) {

$("<h1>").text(json.title).appendTo("body");

$("<div class=\"content\">").html(json.html).appendTo("body");

})

// HTTP 요청이 실패하면 오류와 상태에 관한 정보가 fail() 메소드로 전달됨.

.fail(function(xhr, status, errorThrown) {

$("#text").html("오류가 발생했습니다.<br>")

.append("오류명: " + errorThrown + "<br>")

.append("상태: " + status);

})

// HTTP 요청이 성공하거나 실패하는 것에 상관없이 언제나 always() 메소드가 실행됨.

.always(function(xhr, status) {

$("#text").html("요청이 완료되었습니다!");

});
        }
        </script> -->



                    <!-- <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>상품합계</td>
                    <td><?php echo $product_amount; ?>원</td>
                    </tr>



                    <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>배송비</td>
                    <td>2,500원</td>
                    </tr>

                    <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>총합</td>
                    <td><?php echo $product_amount + 2500; ?>원</td>
                    </tr> -->

                


            </tbody>

        </table>

        <hr>

        <div class="row">
        <!-- <form style="margin-right:10px;" method="post" action="./cart_all_delete.php"> -->
            <!-- <button class="btn btn-sm btn-outline-secondary" style="margin-right:10px;">전체 삭제</button> -->
            <input style="margin-right:10px;" type='button' onclick="all_delete();" value='전체 삭제'/>
            <!-- <input type="hidden" id="gameToken" name="" value="001"> -->
        <!-- </form> -->

        <script>
                            
            function all_delete(){
                if(confirm("장바구니를 비울까요?")){

                    location.href="./cart_all_delete.php";
                                    
                } else {
                                    
                }
            }
        </script>




        <form>
            <input type='button' value='선택한 제품 삭제' onclick="check_delete();"/>
        </form>
        </div>


        <script>
            function check_delete(){
                //체크박스 배열
                var ch = document.getElementsByName("item_check[]");

                //get으로 보낼 문자열
                var ch_string = "";


                if(confirm("상품을 삭제할까요?")){

                    if(ch.length > 0){

                        // location.href="./item_delete.php?id="+id;
                        for(var i=0; i<ch.length; i++){
                        // alert(ch[i].checked);
                            if(ch[i].checked==true){
                                //concat();은 문자열을 붙이는 함수
                                ch_string = ch_string.concat(ch[i].value,"/");
                            }
                        }

                        // alert(ch_string);
                        location.href="./item_check_delete.php?cart_id="+ch_string;

                    } else {
                        alert("선택된 상품이 없습니다.");
                    }

                    
                } else {

                }
                


                
            }
        </script>



        <div class="text-center" style="margin-top:50px; margin-bottom:15%;">

        <!-- <form method="post" action="../pay/pay.php"> -->
            <button style="width:300px; border-radius:0px;" type="submit" class="btn btn-info btn-lg"  onclick="check_order();">주문하기</button>
        <!-- </form> -->
        </div>


        <script>
            function check_order(){
                //체크박스 배열
                var ch = document.getElementsByName("item_check[]");

                //post으로 보낼 체크박스 id 문자열
                var ch_string = "";

                //post으로 보낼 체크박스 id 문자열
                var price = <?php echo $product_amount; ?>;

                        // location.href="./item_delete.php?id="+id;
                        for(var i=0; i<ch.length; i++){
                        // alert(ch[i].checked);
                            if(ch[i].checked==true){
                                //concat();은 문자열을 붙이는 함수
                                ch_string = ch_string.concat(ch[i].value,"/");
                            }
                        }

                        // alert(ch_string);
                        // location.href="./item_check_delete.php?cart_id="+ch_string;

                        // alert("선택된 상품이 없습니다.");

                        //form이 없으므로 여기서 생성해줌
                        var form = document.createElement("form");
                        form.setAttribute("charset", "UTF-8");
                        form.setAttribute("method", "Post"); // Get 또는 Post 입력
                        form.setAttribute("action", "../pay/pay.php");
                    
                        //같이 보낼 필드 생성하고 값 넣어줌
                        //id문자열 넣을 필드
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "cart_id");
                        hiddenField.setAttribute("value", ch_string);
                        form.appendChild(hiddenField);

                        //총 가격 넣을 필드
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "price");
                        hiddenField.setAttribute("value", price);
                        form.appendChild(hiddenField);


                        // var url ="target.jsp"
                        // var title = "testpop"
                        // var status = "toolbar=no,directories=no,scrollbars=no,resizable=no,status=no,menubar=no,width=1240, height=1200, top=0,left=20" 
                        // window.open("", title,status); //팝업 창으로 띄우기. 원치 않으면 주석.

                        // form.target = title; 
                        
                        //hthml의 body에 붙여주는 듯
                        document.body.appendChild(form); 

                        //submit
                        form.submit();

                


                
            }
        </script>


<!-- 컨테이너 끝 -->
</div>




<!-- 장바구니 -->













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
