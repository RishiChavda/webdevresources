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
    <div id="account">
        <div id="login">
            <div class="title">Login</div>
            <div>Use "john@gmail.com"/"password" for testing purposes</div>
            <?php
                if(isset($_SESSION['logError'])){
                    echo "<div class='error'>Username/Password combination invalid. Please try again.</div>";
                    unset($_SESSION['logError']);
                    // If there is no user record in the database which matches the email address and password that the user provided then main.php will redirect them to this page with a session variable which will trigger an error message.
                }
                if(isset($_SESSION['logSuccess'])){
                    echo "<div class='success'>Logged in successfully.</div>";
                    unset($_SESSION['logSuccess']);
                    // If there is a match to the user account's login details then display a message.
                }
            ?>
            <form action="php/userLogin.php" method="post">
            <label for="loginEmail">Email</label><input type="email" id="loginEmail" name="loginEmail" class="accountfield"/><br>
            <label for="loginPass">Password</label><input type="password" id="loginPass" name="loginPass" class="accountfield"/><br>
            <input type="submit" class="accountsubmit" value="Login"/>
            </form>
        </div><div id="register">
            <div class="title">Register</div>
            <?php
                if(isset($_SESSION['regError'])){
                    echo "<div class='error'>Registration failed. Please complete ALL fields or try again later.</div>";
                    unset($_SESSION['regError']);
                    // If, for any reason during the registration process, a user account cannot be created then the user will be redirected to this page with an error message.
                }
                if(isset($_SESSION['regSuccess'])){
                    echo "<div class='success'>Registration successful. Login to use your account.</div>";
                    unset($_SESSION['regSuccess']);
                    // If the user successfully creates an account then display a message.
                }
            ?>
            <form action="php/userRegister.php" method="post">
            <label for="regFullname">Full Name</label><input type="text" id="regFullname" class="accountfield" name="regFullname"/><br>
            <label for="regEmail">Email</label><input type="email" id="regEmail" class="accountfield" name="regEmail"/><br>
            <label for="regPass">Password</label><input type="password" id="regPass" class="accountfield" name="regPass"/><br>
            <label for="regPostcode">Postcode</label><input type="text" id="regPostcode" class="accountfield" name="regPostcode"/><br>
            <input type="submit" class="accountsubmit" value="Register Account"/>
            </form>
        </div>
    </div>
</div>
<div id="footer">"Moore's Saw" created by Rishi Chavda <a href="mailto:rishi.d.chavda@gmail.com">Rishi.D.Chavda@Gmail.com</a></div>
<div id="logout"><a href="php/logout.php">Log out</a></div>
</div></body>
</html>