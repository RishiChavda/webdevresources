<?php
include("main.php");
basketRemove($_REQUEST['pid']);
header("location: ../basket.php");
?>