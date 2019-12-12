


<!DOCTYPE html> 
<html> 
<head> 
        
</head>   
<body> 

<style>
.starR{
  background: url('http://miuu227.godohosting.com/images/icon/ico_review.png') no-repeat right 0;
  background-size: auto 100%;
  width: 30px;
  height: 30px;
  display: inline-block;
  text-indent: -9999px;
  cursor: pointer;
}
.starR.on{background-position:0 0;}

</style>

<div class="starRev">
  <span class="starR on">별1</span>
  <span class="starR">별2</span>
  <span class="starR">별3</span>
  <span class="starR">별4</span>
  <span class="starR">별5</span>
  <span class="starR">별6</span>
  <span class="starR">별7</span>
  <span class="starR">별8</span>
  <span class="starR">별9</span>
  <span class="starR">별10</span>
</div>

<script> 
$('.starRev span').click(function(){
  $(this).parent().children('span').removeClass('on');
  $(this).addClass('on').prevAll('span').addClass('on');
  return false;
});
</script>

</body> 
</html> 