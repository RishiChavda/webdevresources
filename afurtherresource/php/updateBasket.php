<?php
session_start(); // Start session.
include("main.php"); // Import PHP functions
updateQuantity($_REQUEST['pid'],$_POST['newQuantity']); // Call the method to update the quantity of them itemid "pid".
?>