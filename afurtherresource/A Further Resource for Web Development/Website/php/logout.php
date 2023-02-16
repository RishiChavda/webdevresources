<?php
include("main.php");
if(isset($_SESSION['uid'])){
    unset($_SESSION['uid']);
    header("location: ../");
}
?>