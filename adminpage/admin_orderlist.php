<?php
include '../main/db.php';

session_start();
?>
<?php






//기본적인 페이징
// 페이지 설정
$page = ($_GET['page'])?$_GET['page']:1; // 현재페이지(넘어온값)
$page_set = 2; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

// 컬럼 데이터 갯수 가져오기
// SELECT COUNT(컬럼) FROM 테이블;
// "SELECT count(no) as total FROM board";
//테이블에 저장된 데이터의 개수 가져옴
$get_total = "SELECT COUNT(id) as total FROM order_info";
$total_result = mysqli_query($conn, $get_total);

if($total_result){$total_row = mysqli_fetch_array($total_result);}

$total = $total_row['total']; // 전체글수


$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil($total_page / $block_set); //총 블럭 수(올림함수)

// $page = ($_GET['page'])?$_GET['page']:1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)

//시작페이지(현재 블럭의 시작페이지)
$s_page = ($block * $block_set) - 4; //현재블럭 * 한 페이지 블럭수 
if ($s_page <= 1) { //예외처리
    $s_page = 1;
}
//끝 페이지(현재 블럭의 끝페이지)
$e_page = $block * $block_set;
if ($total_page <= $e_page) { //예외처리
    $e_page = $total_page;
}

$limit_index = ($page - 1) * $page_set; // limit시작위치(sql)








$get_orderlist = "SELECT * FROM order_info order by id desc LIMIT $limit_index, $page_set";
$get_orderlist_result = mysqli_query($conn,$get_orderlist);
$order_count=mysqli_num_rows($get_orderlist_result);  

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

<body>


<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>
    <hr>









<div class="container" style="margin-top:80px;">



<!-- 최상단 -->
<div class="row">
    <h4 class="col-md-10">주문 내역</h4>
    <select name="date" class="col-md-1">
        <option value="">기간</option>
        <option value="학생">어케</option>
        <option value="회사원">얼마나</option>
        <option value="기타">하지</option>
    </select>
    <select name="date" class="col-md-1">
        <option value="">상태</option>
        <option value="학생">결제완료</option>
        <option value="회사원">배송중</option>
        <option value="기타">배송완료</option>
        <option value="기타">취소/환불</option>
    </select>
</div>

<hr>

<?php 

for($i=0; $i<$order_count; $i++){
    $orderlist_row =  mysqli_fetch_array($get_orderlist_result);
    
    $order_no = $orderlist_row['order_no'];
    //해당 주문번호의 상품id가져옴
    $get_item_id = "SELECT * FROM ordered_product WHERE order_no='$order_no'";
    $get_item_id_result =  mysqli_query($conn,$get_item_id);
    $get_item_id_row = mysqli_fetch_array($get_item_id_result);
    $item_id_count = mysqli_num_rows($get_item_id_result);  

    $item_id = $get_item_id_row['product_uuid'];
    //상품id로 상품정보 가져옴
    $get_item_info = "SELECT * FROM items WHERE id='$item_id'";
    $get_item_info_result = mysqli_query($conn,$get_item_info);
    $get_item_info_row = mysqli_fetch_array($get_item_info_result);


        //상품 이름(들)
        $order_product_name = "";
        $another_order_count = $item_id_count-1;
        if($item_id_count <= 1){
            $order_product_name = $get_item_info_row['name'];
        } else {
            $order_product_name = $get_item_info_row['name']." "."외"." "."$another_order_count"."개";
        }
    ?>


<!-- 주문 내용 -->
<h5 style="margin-top:20px;"><?php echo $orderlist_row['order_date']; ?></h5>
<!-- 해당 날짜의 주문 내용 -->
<div class="border" style="border-width : 1px; padding:20px;" >
    <!-- 제품 이름 / 송장 입력 -->
    <div class="row">
        <p class="col-md-10"><a  style="color:black; text-decoration:none;" href="./admin_order_detail.php?order_no=<?php echo $order_no; ?>"><?php echo $order_product_name; ?></a></p>
        <?php 
            if($orderlist_row['progress_status']=="결제완료"){
                ?>
            
                <!-- 주문상태가 결제완료일때 송장입력이 뜨도록? -->
                <p style="visibility:hidden;">aaㅁㅁa</p>
                <button  onclick="order(<?php echo $orderlist_row['id']; ?>);" data-toggle="modal" data-target="#insertBlack" data-notifyid=<?php echo $orderlist_row['order_no']; ?> data-nonnotifyid="${list.NONNOTIFYID }" data-ncontent="${list.NCONTENT }"  class="btn btn-outline-primary">송장 입력</button>
                <?php
            }
        ?>


    </div>
    <hr>
    <!-- 이미지랑 정보 넣을 row -->
    <div class="row">
        <img class="col-md-2" src=<?php echo $get_item_info_row['imgpath']; ?> style="max-width:auto; max-height:110px;">
        <div class="col-md-10">
            <div class="row">
                <p class="col-md-2">주문번호</p>
                <p id="order_number" class="col-md-10"><?php echo $orderlist_row['order_no']; ?></p>
            </div>
            <div class="row">
                <p class="col-md-2">결제금액</p>
                <p class="col-md-10"><?php echo number_Format($orderlist_row['payment_total']); ?>원</p>
            </div>
            <div class="row">
                <p class="col-md-2">주문상태</p>
                <p class="col-md-10"><?php echo $orderlist_row['progress_status']; ?></p>
            </div>
        </div>
    </div>  


</div>

<!-- Modal -->
<div class="modal fade" id="insertBlack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">송장을 입력해주세요.</h5>
      </div>
      <div class="modal-body">
        <input type="text" id="post_number">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="delete_contents();">닫기</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insertPost(<?php echo $i; ?>);">확인</button>
      </div>
    </div>
  </div>
</div>


<?php
}
?>




<script>

    var order_no = "aa";
    function order(number){
        order_no = number;
    }

    // var NOTIFYID="";
    // var NONNOTIFYID="";
    // var NCONTENT="";


    // $(document).ready(function() {     
    //     $('#insertBlack').on('show.bs.modal', function(event) {          
    //         NOTIFYID = $(event.relatedTarget).data('notifyid');
    //         NONNOTIFYID = $(event.relatedTarget).data('nonnotifyid');
    //         NCONTENT = $(event.relatedTarget).data('ncontent');
    //     });
    // });


    function insertPost(){

        //order_info index
        var order_number = order_no;
        //input value
        var invoice=$('#post_number').val();

        //form이 없으므로 여기서 생성해줌
        var form = document.createElement("form");
        form.setAttribute("charset", "UTF-8");
        form.setAttribute("method", "Post"); // Get 또는 Post 입력
        form.setAttribute("action", "./update_invoice.php");

        //같이 보낼 필드 생성하고 값 넣어줌
        //id문자열 넣을 필드
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "order_number");
        hiddenField.setAttribute("value", order_number);
        form.appendChild(hiddenField);

        //같이 보낼 필드 생성하고 값 넣어줌
        //id문자열 넣을 필드
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "invoice");
        hiddenField.setAttribute("value", invoice);
        form.appendChild(hiddenField);

        //hthml의 body에 붙여주는 듯
        document.body.appendChild(form); 

        //submit
        form.submit();



        //input 초기화
        $('#post_number').val("");
    }


    function delete_contents(){
        //input 초기화
        $('#post_number').val("");

    }

</script>



<hr>






<!-- 페이지네이션 -->
<div style="margin-left:45%;">
    <!-- Declare the pagination class -->
    <ul class="pagination"> 

<?php
if($block > 1){ // 첫번째 블럭 이전 버튼 예외처리 
?>
    <li class="page-item"> 
        <!-- Declare the link of the item -->
        <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$s_page-1?>">이전</a>
    </li> 
<?php
}
?>

<?php

for ($p=$s_page; $p<=$e_page; $p++) {

    if($p==$page){
?>
<!-- <a href="<?=$_SERVER['PHP_SELF']?>?board=<?=$_GET['board']?>&page=<?=$p?>"><?=$p?></a> -->
<li class="page-item active"> 
    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$p?>"><?=$p?></a>
</li> 
<?php
    } else {
        ?>
<li class="page-item"> 
    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$p?>"><?=$p?></a>
</li> 
<?php
    }

}


if($block < $total_block){ //마지막 블럭 다음 버튼 예외처리 
?>
            <li class="page-item"> 
            <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$e_page+1?>">다음</a>
            </li> 
    <?php
    }
    ?>
        </ul>
</div>














</div>
<!-- ㄴ>container끝 -->
    













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
