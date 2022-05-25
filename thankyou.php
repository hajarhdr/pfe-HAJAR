<?php
session_start();
include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
    
$row = mysqli_fetch_assoc($result);

$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>
<html>
<head>
<title>LUXGIFTS</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width-device-width,initial-scale=1.0">
<link rel='stylesheet' type='text/css' href='./assets/css/app-style.css' media='all' />
<link rel='stylesheet' href='./assets/css/style.css' type='text/css' media='all' />
<style>
body {
  background-image: url('./assets/media/backgroundimage.jpg');
  background-size: cover;
  background-position: center;
  position: absolute;
  top: 0;
  width: 100%;   
  height: 100vh;
}

</style>
         <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
<script>
  function openSlideMenu(){
    document.getElementById('menu').style.width = '250px';
    document.getElementById('content').style.marginLeft = '250px';
  }
  function closeSlideMenu(){
    document.getElementById('menu').style.width = '0';
    document.getElementById('content').style.marginLeft = '0';
  }
</script>
</head>
<body>
	
    <header style="background-image: url('./assets/media/backgoundhead.gif'); background-size: contain; opacity: 0.75;">
        <img src="./assets/media/logo.png" class="logo">
</header>
<img src="./assets/media/transbarrr.png" style="width:100%; margin-left: -30px; opacity: 0.65;">

     <ul class="list">
    <li>
    <form class="search" action="." method="get">
      <input type="text" name="q" placeholder="Search">
      <button type="button" name="button">
        <img src="./assets/media/search.svg" height="20" alt="">
        </button> </form></li>
         <li><a href="register.php"><img src="./assets/media/user.png" class="user"></a></li>
         <li><a href="cart.php"><img src="./assets/media/cart.png" class="carti"><?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="numbercart"><?php echo $cart_count; ?></div><?php
}
?>
</a></li>
        </ul><br><br>
    <br>
   <center> <em><h2 class="slogan" style="color:gold; font-size: 22px; margin-left:30px;">
      We Heard you, and your order has been placed.<br> Your package will reach you in less then 15 days, 
      so enjoy your time until then. <br>LuxGifts, Luxary at your fingertips </h2></em></center> <br><br>  <div id="content">

    <span class="slide">
      <a href="#" onclick="openSlideMenu()">
        <i class="fas fa-bars"></i>
      </a>
    </span>

    <div id="menu" class="nav">
      <a href="#" class="close" onclick="closeSlideMenu()">
        <i class="fas fa-times"></i>
      </a>
      <a href="index.php">Home</a>
      <a href="index.php#shopl">Shop</a>
      <a href="register.php">Account</a>
      <a href="Customize.php">Customize</a>
    </div>
 </div> <br>
       <br><br><br><br><br><br>
</body>
<footer class="foter">
</footer>
</html>
