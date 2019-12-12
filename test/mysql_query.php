<?php
include '../main/db.php';
?>

<?php

$get = "SELECT * FROM items WHERE category='001'";
$result = mysqli_query($conn, $get);
$row =  mysqli_fetch_array($result);

echo "id : ".$row['id'];
echo "<br>";
echo "uuid : ".$row['uuid'];
echo "<br>";
echo "category   : ".$row['category'];
echo "<br>";
echo "name  : ".$row['name'];
echo "<br>";
echo "subtitle  : ".$row['subtitle'];
echo "<br>";
echo "price  : ".$row['price'];
echo "<br>";
echo "weight  : ".$row['weight'];
echo "<br>";
echo "stock  : ".$row['stock'];
echo "<br>";
echo "raw_materials  : ".$row['raw_materials'];
echo "<br>";
echo "contents  : ".$row['contents'];
echo "<br>";
echo "sales  : ".$row['sales'];
echo "<br>";
echo "imgname  : ".$row['imgname'];
echo "<br>";
echo "imgpath  : ";
echo '<img src='.$row['imgpath'].' width=200><br>';
echo "<br>";
echo "uploaddate  : ".$row['uploaddate'];

?>