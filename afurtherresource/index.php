<?php
include("php/main.php"); // Include the main.php functions
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
<body>
<div id="page">
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
<div id="main"><div id="title">Welcome to Moore's Saws!</div>
<?php    
    if(isset($_SESSION['orderconfirmed'])){
        echo "<div class='success'>Purchase complete!</div>";
        unset($_SESSION['orderconfirmed']);
    }
   // If a user has confirmed their order correctly, the orderconf.php/main.php function will be called to confirm the basket and add a order record for each item. After that, the user will be redirected to this page.
?>
    
    <div id="about">
        <div id="text">
            <div id="title">What we do</div>
            <div id="description">Moore's Saw&trade; has been providing powerful, precise cutting tools for over 50 years. All drills and saws are carefully manufactured to last long and prove to be a useful tool to have for any of your cutting needs. One of the things that makes Moore's Saw really stand out is a innovative and eco-friendly ways of engineering cutting tools for both general purpose and industry-specific use. This has also allowed many people to save money as, after buying a Moore's saw, they'll never need another one again.<br><br>We, at MS, strive to create powerful, versatile, and most importantly everlasting razor blades, dremels, power saws and all kinds of accessories that can be used for domestic use as well as being an industry-standard tool supplier. We like to think of ourselves as the benchmark for good quality precision tools of which all other tools are measured against, and we try our very best to be in the Top 5 best electrical applicance manufacturers, if not the best.<br><br>As of 2011, we have ensured that all of our power saws and impact tools come with full instructions, spare parts (especially parts of which are known to wear out) and full service guarantee. This is the reason why ScrewFix Monthly have chosen us as their "Most Consumer-Friendly Organisation" for the last two years. All of our tools are RoHS-compliant and checked in accordance with IEEE standards. So feel free to look through our <a href="products.php">products</a> and get the right tool for the job!</div>
        </div>
    </div>
    <div id="intro"><video preload="auto" loop muted controls><source src="media/intro.mp4" type="video/mp4"></video></div>
</div>
<div id="footer">"Moore's Saw" created by Rishi Chavda <a href="mailto:rishi.d.chavda@gmail.com">Rishi.D.Chavda@Gmail.com</a></div>
<div id="logout"><a href="php/logout.php">Log out</a></div>
</div>
</body>
</html>