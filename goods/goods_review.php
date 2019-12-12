<?php
include '../main/db.php';
  session_start();



  $id = $_POST['item_id'];


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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>


    <title>Title</title>
</head>


<style>
          table.table2{
                border-collapse: separate;
                border-spacing: 1px;
                text-align: left;
                line-height: 1.5;
                border-top: 1px solid #ccc;
                margin : 20px 10px;
        }
        table.table2 tr {
                 width: 50px;
                 padding: 10px;
                font-weight: bold;
                vertical-align: top;
                border-bottom: 1px solid #ccc;
        }
        table.table2 td {
                 width: 100px;
                 padding: 10px;
                 vertical-align: top;
                 border-bottom: 1px solid #ccc;
        }

</style>

<body>


<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>


<h3 class="text-center"  style="margin-top:80px; margin-bottom:50px;">리뷰 작성</h3>


<table class="table table-md" style="width:500px; margin-left:35%;"  >

    <thead class="thead-light">
        <!-- tr태그는 한 줄을 뜻함 -->
    <tr>
        <th style="width: 30%">상품 사진</th>
        <th style="width: 40%">상품 정보</th>
        <th style="width: 30%">상품금액</th>
    </tr>
    </thead>
    <tbody>

    <?php 
    $get_item = "SELECT * FROM items WHERE id=$id";
    $result = mysqli_query($conn,$get_item);
    $item_row = mysqli_fetch_array($result);  

    ?>

    <tr>
        <td><img style="max-width: 100px; max-height: 100px;" src=<?php echo $item_row['imgpath']; ?>></td>
        <td><?php echo $item_row['name']; ?></td>
        <td><?php echo number_Format($item_row['price']); ?>원</td>
    </tr>

    </tbody>

</table>

<div class="container">
<form role="form" action="./goods_review_save.php" onsubmit="return postForm()" method="post">

<input type="hidden"  name="item_id" value=<?php echo $id; ?>>
<input type="hidden"  name="ordered_product_id" value=<?php echo $_POST['ordered_product_id']; ?>>
<input type="hidden"  name="order_no" value=<?php echo $_POST['order_no']; ?>>


<div class="form-group">
<label for="InputEmail">별점</label>
<select name="rating" >
    <option value="5" selected="selected">★★★★★</option>
    <option value="4">★★★★☆</option>
    <option value="3">★★★☆☆</option>
    <option value="2">★★☆☆☆</option>
    <option value="1">★☆☆☆☆</option>
</select>
</div>

  <div class="form-group">
    <label for="InputEmail">제목</label>
    <input type="text" name="title" class="form-control" placeholder="제목을 입력하세요.">
  </div>

  <div class="form-group">
    <label>내용</label>
    <!-- <div id="summernote"></div> -->
    <textarea id="summernote" name="contents"></textarea>

    <script>
      $('#summernote').summernote({
        placeholder: '내용을 입력하세요.',
        tabsize: 2,
        height: 500,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                  // set focus to editable area after initializing summernote
      });


      var postForm = function() {
        var contents =  $('textarea[name="contents"]').html($('#summernote').code());
      }
    </script>

  </div>



  <button type="submit" class="btn btn-primary" style="float:right;">작성</button>


</form>
</div>

























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
