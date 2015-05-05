<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
//
// globalVariables.php : includes first, middle and last name, major, and student's UMBC ID
//			 after successful login.

//start the session
session_start();

//global variables
$fname = $_SESSION['fname'];
$mname = $_SESSION['mname'];
$lname = $_SESSION['lname'];
$major = $_SESSION['major'];
$student_id = $_SESSION['student_id'];

?>