<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">

  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Title</title>
</head>


<style>
body,div{
  margin:0;
  padding:0;
}
div{
  display: flex;
  align-items: center;
  justify-content: center;
}
.box1{background-color:red;}
.box2{background-color:orange;}
.box3{background-color:yellow;}
.box4{background-color:green;}
.box5{background-color:blue;}
.box6{background-color:navy;}
.box7{background-color:purple;}
</style>

<body>




<p>
  클릭하세요
  <button id="box1" type="button">box1</button>
  <button id="box2" type="button">box2</button>
  <button id="box3" type="button">box3</button>
  <button id="box4" type="button">box4</button>
  <button id="box5" type="button">box5</button>
  <button id="box6" type="button">box6</button>
  <button id="box7" type="button">box7</button>
</p>
<div class="box1">박스1입니다.</div>
<div class="box2">박스2입니다.</div>
<div class="box3">박스3입니다.</div>
<div class="box4">박스4입니다.</div>
<div class="box5">박스5입니다.</div>
<div class="box6">박스6입니다.</div>
<div class="box7">박스7입니다.</div>



<script>
const buttonArr = document.getElementsByTagName('button');

for(let i = 0; i < buttonArr.length; i++){
  buttonArr[i].addEventListener('click',function(e){
    e.preventDefault();
    document.querySelector('.box' + (i + 1)).scrollIntoView(true);
  });
}
</script>







<button type="button">기본 버튼</button>

<button type="button" class="btn">BS 버튼1</button>

<button type="button" class="btn btn-primary">BS primary 버튼</button>

<div class="col-sm-3 text-center">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</div>

<div class="col-sm-12 text-center">
    <button class="btn btn-lg btn-outline-primary" type="submit">Sign in</button>
</div>

<!-- <button type="button" class="btn btn-danger center-block">Button Block</button> -->












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