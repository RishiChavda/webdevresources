<?php
include("php/main.php");
// Include the main.php functions

if(!isset($_SESSION['order']) && !isset($_SESSION['orderconfirmed'])){header("location: basket.php");}
// If there is no session variable for a confirmed order, then redirect the user to basket.php where they can confirm and be redirected to this page. This will prevent users from ordering no items and/or adding inadequate records in the database.

if(isset($_REQUEST['confirm'])){completeOrder();}
// If there is a page request for 'confirm' within this page, then call the completeOrder() method to add the items to the the orders table in the database.
?>
<!DOCTYPE html>
<html>
<head>
<title>Moore's Saw</title>
<meta name="description" content="Moore's Saws"/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/sawiconb.png' type='image/png' rel='icon'>
<link href="css/AssignFonts.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,1000|Bad+Script|Ubuntu|Lato:100,200,300,400|Tauri|Exo+2:100,200,300,400|Alegreya+Sans:400,300' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/effects.js"></script>
</head>
<body><div id="page">
<div id="topbar">
    <?php
        getUser();
        // Calling the user picture to display an icon if users are logged in

        itemCounter();
        // Calling the item counter to display the cart image and how many items are in the cart
    ?>
    <div id="logo"><a href="index.php">Moore's Saws</a></div>
</div>
<div id="navbar">
	<div id="menu">
        <a href="index.php" class="link">Home</a>
       	<a href="products.php" class="link">Products</a>
       	<a href="register.php" class="link">Register</a>
       	<a href="basket.php" class="link">Basket</a>
	</div>
</div>
<div id="main">
    <?php
    getConfirmedBasket();
    // Get all items in the basket once it is confirmed.
    ?>
</div>
<div id="footer">"Moore's Saw" created by Rishi Chavda <a href="mailto:rishi.d.chavda@gmail.com">Rishi.D.Chavda@Gmail.com</a></div>
<div id="logout"><a href="php/logout.php">Log out</a></div>
</div></body>
</html>