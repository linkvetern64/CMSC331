<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// cancelAppointmentHeader.php: Header and action file for cancelAppointment.php
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

//validation
$error = false;
$error_msg = '';

$id = strtolower($student_id);
$counter = 0;

$sql = "SELECT `advisor`, `appt_type`, `appt_date`, `appt_time` FROM `appointment_list` WHERE `student_id` = '$id'";

$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


if(isset($_POST['continue']))
{
   if(!isset($_POST['tags']))
   {
      $error = true;
      $error_msg = "Please select an appointment to cancel.";
   }
   else
   {
      //set the selected tags;
      $_SESSION['tags[]'] = $_POST['tags'];

      header('Location: confirmCancel.php');
   }
}
elseif(isset($_POST['go_back']))
{
    header('Location: loggedIn.php');
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
	    <h2>Cancel Advising Appointment</h2>
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