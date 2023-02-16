<?php
include("php/main.php"); // Include the main.php functions
if(isset($_REQUEST['clear'])){
    clearBasket();
    // If there is a page requre to 'clear' (basket.php?clear) the function will be called to unset the basket.
}

if(isset($_REQUEST['order'])){
    orderBasket();
    // If there is a page requre to 'order' (basket.php?order) the function will be called to complete the order of items in the basket.
}
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
    <div id="basket"><div id="title">Shopping Cart</div>
        <?php
        if(isset($_SESSION['basketError']) && $_SESSION['basketError']=="1"){
            echo "<div class='error'>The cart request did not work. Please make sure the item exists or try again later.</div>"; 
            unset($_SESSION['basketError']);
            // If there is any problems with adding/changing quantity of an item or completing the order of item, the functions in main.php will redirect the user to this page with a session variable to display the error message. Then unset the session variable so the user can continue using the website without seeing the error message.
        }
        ?>
        <div id="basketitems"><div id="title">Order Summary</div>
        <?php
        if(isset($_SESSION['permitError'])){
            echo "<div class='error'>You must have a Moores Saw account complete an order. Please login/register <a href='./register.php'>here</a></div>";
            unset($_SESSION['permitError']);
        }
        // If a user is not logged in and thus does not have a session variable holding their userid then display an error message ($_SESSION['permitError'] is set in main.php and redirects to this page).

            getBasket();
            // Calling the getBasket() method to display all of the items in the basket.
            ?>
        </div>
    </div>
</div>
<div id="footer">"Moore's Saw" created by Rishi Chavda <a href="mailto:rishi.d.chavda@gmail.com">Rishi.D.Chavda@Gmail.com</a></div>
<div id="logout"><a href="php/logout.php">Log out</a></div>
</div></body>
</html>