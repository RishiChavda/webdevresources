<?php
session_start(); // Start session.
include("main.php"); // Include PHP functions.
basketAppend($_REQUEST['productid']); // Call method to add product to the basket session array using the product's ID as the key.
header("location: ../products.php"); // Redirect (back) to products.php
?>