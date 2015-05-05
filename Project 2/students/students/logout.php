<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// logout.php: - to erase the user information for privacy!
//		 	   - destroy the session, clear the cookies, and automatically redirect back to index.php
//		 
//			   - provides logout anytime feature for a student				    
//		    
// File Header!
//
// Web Page header is not required since automatically redirects to the main page!
//
//start the session!
session_start();

//destroy the session!
$_SESSION = array();

//get rid off all the cookies!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie($name, $value, $expire, $params['path'], $params['domain'], $params['secure']);
}

//MUST DESTROY!
session_destroy();

//Finally Cleared! then redirect back to main page
header('Location: ../index.php');
die();

?>