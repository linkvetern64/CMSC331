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
$advisor = $_SESSION['advisor'];
$advisor_id = $_SESSION['advisor_id'];
$previous_appt = $_SESSION['previous_appt'];
$appt_type = $_SESSION['appt_type'];
$appt_date = $_SESSION['appt_date'];
$appt_time = $_SESSION['appt_time'];
$appt_Key = $_SESSION['appt_Key'];
$day = $_SESSION['day'];
?>