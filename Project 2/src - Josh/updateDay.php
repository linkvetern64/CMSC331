<?php
session_start();
$_SESSION["DATE"] = $_POST["dayPicker"];

$_SESSION["YEAR"] = substr($_SESSION["DATE"],0,4) ;
$_SESSION["MONTH"] = substr($_SESSION["DATE"],5,7) ;
$_SESSION["DAY"] = substr($_SESSION["DATE"],7,8) ;
$_SESSION["theDay"] =  $_SESSION["MONTH"] . "-" . $_SESSION["YEAR"]; 

header("Location:granted.php");
