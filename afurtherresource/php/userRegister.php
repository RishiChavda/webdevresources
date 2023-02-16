<?php
session_start(); // Start session.
include("main.php"); // Import PHP functions.
userRegister($_POST['regFullname'],$_POST['regEmail'],md5($_POST['regPass']),$_POST['regPostcode']); // Call method and include POST data from HTML register form.
?>