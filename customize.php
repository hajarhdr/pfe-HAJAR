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
        <meta charset="UTF-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
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
      <a href="customize.php">Customize</a>
    </div>
 </div>
 
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
        </ul><br><br><br><br><br><br>
        
        <div class="container">
        
            <?php if (isset($_SESSION['success'])): ?>
                <div class="message animated bounceIn" style="width: 600px;margin: 100px auto;display: block;background: #000000;padding: 20px;">
                    <h3 style="color: #fff;">LuxGifts always at you service. Thank you for choosing us. </h3>
                    <p style="color: #fff;">Your customised order will be ready in the next 15 days and sent to the location attached with your email in the following days. Lux Gifts,Luxary at your fingertips.</p>

                    <a href="customize.php"> &leftarrow; go back <?php  $_SESSION['success'] = NULL; ?></a>

                </div><br><br>

                <style>
                    #contact-form{
                        display: none;
                    }
                </style>
            <?php endif; ?>

            <form role="form" id="contact-form" class="contact-form" action="data.php" method="post">
                <center><h3 style="color:gold;">Customize your order in seconds</h3></center><br><br><br><br>


                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-warning"><?php echo $_SESSION['error']; ?></div>
                <?php endif; ?>




                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <input type="text" class="form-control" name="name" autocomplete="off" id="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <input type="email" class="form-control" name="contact-email" autocomplete="off" id="contact-email" placeholder="E-mail">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" autocomplete="off" id="subject" placeholder="Your request">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <textarea class="form-control textarea" rows="3" name="msg" id="msg" placeholder="Your Order details"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn main-btn pull-right">Send your order</button>
                    </div>
                </div>
            </form>
        </div>

    </body>
        <br><br><br><br><br><br><br><br><br><br>
    <footer class="foter">

</footer>
</html>
