<?php
session_start(); // Start session.
include("main.php"); // Import PHP functions.
userLogin($_POST['loginEmail'],$_POST['loginPass']); // Call method and include POST data from HTML login form.
?>