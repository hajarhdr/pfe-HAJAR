<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
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
        </ul>
        <br><br><br><br><br>
       
	  <div id="slogan"> <center><em><h1>Lux gifts can offer you a wide high-end range of untarnishable jewelery and customisable gift boxes for you or for your loved ones.</h1><h2>Lux gifts, luxury at your fingertips.</h2></em></center></div>

    
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
      <a href="#shopl">Shop</a>
      <a href="register.php">Account</a>
      <a href="customize.php">Customize</a>
    </div>
 </div>
 <br>
<center><video id ="frameimj" width="880" height="400" autoplay muted loop>
  <source src="./assets/media/adfinal.mp4" type="video/mp4">
 
Your browser does not support the video tag.
</video></center>
<br><br><br><br><br><br><br><br><br><br>

    <div class="warpper" id="shopl">
  <input class="radio" id="one" name="group" type="radio" checked>
  <input class="radio" id="two" name="group" type="radio">
  <input class="radio" id="three" name="group" type="radio">
<input class="radio" id="four" name="group" type="radio">
  <div class="tabs">
  <label class="tab" id="one-tab" for="one">All</label>
  <label class="tab" id="two-tab" for="two">Jewlery Boxes</label>
  <label class="tab" id="three-tab" for="three">Flower Boxes</label>
  <label class="tab" id="four-tab" for="four">Choclate Boxes</label>
    </div>
  <div class="panels">
  <div class="panel" id="one-panel">
         <div class="row">
  <div class="column" >
<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?></div>
<?php
$result = mysqli_query($con,"SELECT * FROM `products` WHERE id=1 || id=2 || id=3");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
</div>
  <div class="column">
    <?php  $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=4 || id=5 || id=6");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
  <div class="column">
   <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=7 || id=8 || id=9");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
    </div>
      </div>
     
  <div class="panel" id="two-panel">
      <div class="row">
  <div class="column">
       <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=10 || id=11 || id=12");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>

  </div>
  <div class="column">
     <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=13 || id=5 || id=14");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
  <div class="column">
     <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=7 || id=8 || id=15");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
    </div>
</div>
  <div class="panel" id="three-panel">
   <div class="row">
  <div class="column">
     <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=16 || id=17 || id=2");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
  <div class="column">
      <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=4 || id=18 || id=19");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
  <div class="column">
    <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=20 || id=21 || id=9");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
    </div>
  </div>
      <div class="panel" id="four-panel">
      <div class="row">
  <div class="column">

 <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=1 || id=22 || id=3");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
  <div class="column">
      <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=24 || id=25 || id=6");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
  <div class="column">
   <?php $result = mysqli_query($con,"SELECT * FROM `products` WHERE id=26 || id=27 || id=28");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='./assets/".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }

?>
  </div>
    </div>
  </div>
  </div>
        <br><br><br><br><br>
</div> 
    
</body>
  
<footer class="foter">

</footer>
</html>
