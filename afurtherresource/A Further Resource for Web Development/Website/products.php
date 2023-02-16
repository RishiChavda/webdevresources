<?php
include("php/main.php");
// Include the main.php functions
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
    <div id="products"><div id="title">Products</div>
        <?php
        if(isset($_SESSION['basketError']) && $_SESSION['basketError']=="1"){
            echo "<div class='error'>The cart request did not work. Please make sure the item exists or try again laters.</div>"; 
            unset($_SESSION['basketError']);
            // If there is any basketError session variable then display an error saying that the request failed. Usually this would be due to adding an item that doesn't exist (inserting an id which doesn't correspond to any product).
        }

        getProducts(); // Get all the products from the database.

        ?>
    </div>
</div>
<div id="footer">"Moore's Saw" created by Rishi Chavda <a href="mailto:rishi.d.chavda@gmail.com">Rishi.D.Chavda@Gmail.com</a></div>
<div id="logout"><a href="php/logout.php">Log out</a></div>
</div></body>
</html>