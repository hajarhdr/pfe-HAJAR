<?php

session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }     
}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break;
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
  background-image: url('./assets/media/imageback.jpg');
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
	
    <header style="background-image: url('./assets/media/backgoundhead.gif'); background-size: contain; opacity: 1;">
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
         <li><a href="cart.php"><?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?><img src="./assets/media/cart.png" class="carti">
<div class="numbercart"><?php echo $cart_count; ?></div><?php
}
?>
</a></li>
        </ul>
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
    <br><br><br><br><br><br><br><br><br><br>
    <form method='post'>
<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td>ITEM NAME</td>
<td>QUANTITY</td>
<td>UNIT PRICE</td>
<td>ITEMS TOTAL</td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td><img src='./assets/<?php echo $product["image"]; ?>' width="50" height="40" /></td>
<td><?php echo $product["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["price"]; ?></td>
<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>


<br /><br />
 
    </form>
 <a href="checkout.php"><input type="button" value="Proceed To Order" class="submita" action="remove"><br> <br> <br><br> <br> <br>
   <br> <br> <br>
   <br> 
   
   
</body><br> <br> <br>
   
</html>
