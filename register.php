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
    <link rel="stylesheet" type="text/css" href="./assets/css/login.css">
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
  <div id="content">

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
 </div>
        </ul><br><br><br><br><br>

     <div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
    <div class="login-form">
      <form class="sign-in-htm" action="./api/user/login.php" method="GET">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="username" name="username" type="text" class="input">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="password" name="password" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <input id="check" type="checkbox" class="check" checked>
          <label for="check"><span class="icon"></span> Keep me Signed in</label>
        </div>
        <div class="group">
          <input type="submit" class="button" value="Sign In">
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <a href="#forgot">Forgot Password?</a>
        </div>
      </form>
      <form class="sign-up-htm" action="./api/user/signup.php" method="POST">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="username" name="username" type="text" class="input">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="password" name="password" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="pass" class="label">Confirm Password</label>
          <input id="pass" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <input type="submit" class="button" value="Sign Up">
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <label for="tab-1">Already Member?</label>
        </div>
      </form>
    </div>
  </div>
</div>
    <br><br><br><br><br><br><br><br><br><br>
   <footer class="foter">
    
</footer>
    </body>
    </html>
