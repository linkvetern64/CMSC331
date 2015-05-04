<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// header.php: header and action file for index.php
//
//start the session
session_start();

//validation
$error = false;
$error_msg = "";

//string length for UMBC ID#
$strlength = 0;

//first two chars are alpha
$firstTwo = "";

//5 chars are numbers
$lastFive = "";


//if submitted then check for valid info
//first name, last name, student id, major are required fields
//name fields must be all alphabets
//student id is 7 characters long, first two are alpha followed by 5 digits
//if everything is correct then store the info and move on to next page
if(isset($_POST['submitted'])){

  //get the values
  $fname = trim($_POST['fname']);		//get the first name
  $mname = trim($_POST['mname']);		//get the middle name
  $lname = trim($_POST['lname']);		//get the last name
  $student_id = trim($_POST['student_id']);	//get the student_id
  $major = trim($_POST['major']);		//get the major
  $strlength = strlen($student_id);		//get the length of student_id
  $firstTwo = substr($student_id, 0, -5);	//get the first two chars of student_id
  $lastFive = substr($student_id, 2);		//get the last five chars of student_id
  
  //if any of the field is left blank, except for middle name then show error message
  if(empty($fname) || empty($lname) || empty($student_id) || empty($major)) 
  {	
    $error = true; 
    $error_msg = "Missing a field. Please enter all required fields.";
  }

  //is first name all alpha?
  elseif(!ctype_alpha($fname)) {
    $error = true;
    $error_msg = "Please enter your valid first name.";     
  }

  //is middle name all alpha?
  elseif(!ctype_alpha($mname)) {
    $error = true;
    $error_msg = "Please enter your valid middle name.";     
  }

  //is last name all alpha?
  elseif(!ctype_alpha($lname)) {
    $error = true;
    $error_msg = "Please enter your valid last name.";     
  }

  //is ID AADDDDD? A for alpha and D for digits, case-insensitive!
  elseif(($strlength != 7) || (!ctype_alpha($firstTwo)) || (!(is_numeric($lastFive)))) 
  {
    $error = true;
    $error_msg = "Please enter your valid UMBC ID#.";
  }

  //ALL GOOD! move on to next page!
  else
  {
    $_SESSION['fname'] = $fname;
    $_SESSION['mname'] = $mname;
    $_SESSION['lname'] = $lname;
    $_SESSION['student_id'] = $student_id;
    $_SESSION['major'] = $major;
    header('Location: loggedIn.php');
  }	
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Welcome to Academic Advising - COEIT Undergraduate Student Services - UMBC</title>
   <link rel="icon" type="image/png" href="images//icon.png" />
   <link rel="stylesheet" type="text/css" href="css/myStyle.css" />
</head>
<body>
    <div class = "fixed">
      <div class="transbox">
        <div class = "header">
	    <h2>Welcome to COEIT Academic Advising</h2>
	    <div class = "h1">UMBC</div>
	    <div class = "h3">AN HONORS UNIVERSITY IN MARYLAND</div>
        </div>
      </div>
    </div>

    <img src = "images/campus.jpg" alt = "campus view" style="width: 100%; height: 160px; position: fixed top center;" /><br><br>