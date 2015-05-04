<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// confirmHeader.php: Header and action file for confirm.php
//
//start the session
session_start();

//include global variables => full name, id, and major
include('globals/globalVariables.php');

//include global functions
include('globals/myFunctions.php');

//include common methods to connect to database
include('CommonMethods.php');

//default debug
$debug = false;
$COMMON = new Common($debug);

$id = strtolower($student_id);
$advisor = $_SESSION['advisor'];
$appt_type = $_SESSION['appointment'];
$appt_date = $_SESSION['date'];
$appt_time = $_SESSION['time'];

if(isset($_POST['confirm']))
{

	if((!isset($_SESSION['fname'])) || (!isset($_SESSION['lname'])) || (!isset($_SESSION['student_id'])) 
	    || (!isset($_SESSION['major'])) || (!isset($_SESSION['appointment'])) || (!isset($_SESSION['date']))
										  || (!isset($_SESSION['time'])))
	{
   		header('Location: index.php');
   		die();
	}
	else 
	{
	   $sql = "INSERT INTO `appointment_list` (`student_id`, `fname`, `mname`, `lname`, `major`, `advisor`, `appt_type`, `appt_date`, `appt_time`)
				VALUES ('$id', '$fname', '$mname', '$lname', '$major', '$advisor', '$appt_type', '$appt_date', '$appt_time')";


	   $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	   
           header('Location: ThankYou.php');
	}
}
elseif(isset($_POST['go_back']))
{
	if($appt_type == "Group")
	{
	   header('Location: showGroupTime.php');
	}
	else
	{
	   header('Location: showIndividualTime.php');
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
   <title>Academic Advising Appointment</title>
   <link rel="icon" type="image/png" href="images//icon.png" />
   <link rel="stylesheet" type="text/css" href="css/myStyle.css">
</head>
 
<body>
    <div class = "fixed">
      <div class="transbox">
        <div class = "header">
	    <h2>Advising Appointment Confirmation</h2>
	    <div class = "h1">UMBC</div>
	    <div class = "h3">AN HONORS UNIVERSITY IN MARYLAND</div>
        </div>
      </div>
    </div>
    <img src = "images/blackBackground" alt = "campus view" style="width: 100%; height: 160px; position: fixed top center;" />
  
    <form action = "logout.php" id = "logout" method="POST">
        <div class = "loggedPromt">
	You are now logged in as <?php echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?>
	<input type="submit" name="submit" id="submit" value="Logout" />
	</div>
    </form>