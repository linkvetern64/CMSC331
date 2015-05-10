<?php

//start the session
session_start();

//include common methods to connect to database
include('students/CommonMethods.php');

//default debug
$debug = false;
$COMMON = new Common($debug);

//validation
$error = false;
$error_msg = "";

//string length for UMBC ID#
$strlength = 0;

//first two chars are alpha
$firstTwo = "";

//5 chars are numbers
$lastFive = "";

//to look for previous appointment
$previous_appt = false;

//if submitted then check for valid info
//first name, last name, student id, major are required fields
//name fields must be all alphabets
//student id is 7 characters long, first two are alpha followed by 5 digits
//if everything is correct then store the info and move on to next page

if(isset($_POST['student_login'])){

  //get the values

  $fname = trim($_POST['fname']);		// get the first name
  $fname = strtolower($fname);			// lower the letters
  $fname = ucfirst($fname);			// capitalize the first letter

  $mname = trim($_POST['mname']);		//get the middle name
  $mname = strtolower($mname);			// lower the letters
  $mname = ucfirst($mname);			// capitalize the first letter
	
  $lname = trim($_POST['lname']);		//get the last name
  $lname = strtolower($lname);			// lower the letters	
  $lname = ucfirst($lname);			// capitalize the first letter

  $student_id = trim($_POST['student_id']);	//get the student_id
  $student_id = strtolower($student_id);	//lower the ID characters
  $student_id[0] = strtoupper($student_id[0]);	//first letter upper case
  $student_id[1] = strtoupper($student_id[1]);	//second letter upper case

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

  //else check if user match database
  else
  {

    $sql = "SELECT * FROM `students` WHERE `student_id` = '$student_id'";
    $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    while($row = mysql_fetch_array($result))
    {
	$previous_appt = true;
	$check_fname = $row['fname'];
	$check_lname = $row['lname'];
	$check_major = $row['major'];
    }

    if($previous_appt == true)
    {
	if(($check_fname != $fname) || ($check_lname != $lname) || ($check_major != $major))
	{
	   $error = true;
	   $error_msg = "Your information do not match our records.";
	}
	else
	{
	   $_SESSION['fname'] = $fname;
           $_SESSION['mname'] = $mname;
           $_SESSION['lname'] = $lname;
           $_SESSION['student_id'] = $student_id;
           $_SESSION['major'] = $major;
	   $_SESSION['previous_appt'] = $previous_appt;
	   $_SESSION["auth"] = true;
           header('Location: students/studentLoggedIn.php');
	}
    }
    else
    {
	$_SESSION['fname'] = $fname;
        $_SESSION['mname'] = $mname;
        $_SESSION['lname'] = $lname;
        $_SESSION['student_id'] = $student_id;
        $_SESSION['major'] = $major;
 	$_SESSION['previous_appt'] = $previous_appt;
	$_SESSION["auth"] = true;
        header('Location: students/studentLoggedIn.php');
    }
  }
}
?>