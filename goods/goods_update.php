<?php
  session_start();
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

</style>

<body>


<!-- 상단 네비게이션 두 개 -->
<?php include '../main/top_navbar.php';?>

<h2 class="text-center" style="margin-top:100px; margin-bottom:50px;">상품 등록</h2>


<div class="container">
<form role="form" action="./goods_save.php" onsubmit="return postForm()" method="post" enctype='multipart/form-data'>

    <div class="form-group">
    <label>카테고리</label>
    <!-- <input type="text" name="title" class="form-control" placeholder="제목을 입력하세요."> -->
    <select name='category'>
        <option value='001' selected>국/찌개/탕</option>
        <option value='002'>마른반찬</option>
        <option value='003'>무침</option>
        <option value='004'>볶음</option>
        <option value='005'>조림</option>
        <option value='006'>전/생선</option>
        <option value='007'>김치/절임/젓갈</option>
    </select>

    </div>
    

  <div class="form-group">
    <label>제목</label>
    <input type="text" name="title" class="form-control" placeholder="제목">
  </div>

  <div class="form-group">
    <label>설명</label>
    <input type="text" name="subtitle" class="form-control" placeholder="간단한 설명">
  </div>

  <div class="form-group">
    <label >가격</label>
    <input type="number" class="form-control" name="price" placeholder="가격">
  </div>

  <div class="form-group">
    <label>중량</label>
    <input type="number" name="weight" class="form-control" placeholder="중량">
  </div>

  <div class="form-group">
    <label>재고</label>
    <input type="number" name="stock" class="form-control" placeholder="재고">
  </div>

  <div class="form-group">
    <label>원재료 및 함량</label>
    <br>
    <!-- <input type="text" name="title" class="form-control" placeholder="원재료 및 함량"> -->
    <p><textarea name="rawmaterials" placeholder="원재료 및 함량"  rows="5" cols="150" ></textarea></p>
  </div>


  <div class="form-group" id="htmlimg">
    <label>메인 이미지</label>
    <br>
    <input type='file' name='myfile' onchange='readURL(this);' >
    <!-- 선택한 이미지 미리보기 -->
    <img id="blah" src=""  style="max-weight:200px; max-height:200px;"/>
  </div>


    <!-- 이미지 미리보기
  https://kindtis.tistory.com/514
  ㄴ>이 블로그 참고 -->
  <script type="text/javascript"> 

    function readURL(input) { 
      if (input.files && input.files[0]) { 
        var reader = new FileReader(); 
        reader.onload = function (e) { 
          $('#blah').attr('src', e.target.result); 
          } 
          reader.readAsDataURL(input.files[0]); 
      } 
      
    } 

  </script>

  

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
        // focus: true                  // set focus to editable area after initializing summernote
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
