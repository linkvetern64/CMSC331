<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// loggedInHeader.php: Header and action file for loggedIn.php
//
//start the session
 session_start();

//include global variables => full name, id, and major
include('globals/globalVariables.php');

//include common methods to connect to database
include('CommonMethods.php');

//default debug
$debug = false;
$COMMON = new Common($debug);

//validation
$error = false;
$error_msg = '';

//to look for the student id in database
$id = strtolower($student_id);
$previous_appt = false;

$sql = "SELECT * FROM `appointment_list` WHERE `student_id` = '$id'";

$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

while($row = mysql_fetch_array($result))
{
   $previous_appt = true;
}

if(isset($_POST['continue']))
{
  if(!isset($_POST['appointment']))
  {
     $error = true;
     $error_msg = "Please choose one of the following options.";
  }
  else
  {
    //get the value for appointment type
    $appointment = $_POST['appointment'];
    
    if($appointment == "Cancel")
    {
	header('Location: cancelAppointment.php');
    }
    else
    {
       $sql = "SELECT * FROM `appointment_list` WHERE `student_id` = '$id'
  					      AND `appt_type` = '$appointment'";
	
       $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

       while($row = mysql_fetch_array($result))
       {
          $error = true;
       } 

       if ($error == true)
       {
	  $type = strtolower($appointment);
	  $error_msg = "You may not have more than one $type appointment.";
       }
       else
       {  
	  //set the value for appointment type
	  $_SESSION['appointment'] = $appointment;
  
	  if($appointment == "Individual")
	  {
	     header('Location: individual.php');
	  }
	  else
    	  {
             header('Location: showGroupDate.php');
    	  }
       }
    }
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
	    <h2>Welcome to COEIT Academic Advising</h2>
	    <div class = "h1">UMBC</div>
	    <div class = "h3">AN HONORS UNIVERSITY IN MARYLAND</div>
        </div>
      </div>
    </div>
    <img src = "images/campus" alt = "campus view" style="width: 100%; height: 160px; position: fixed top center;" />
  
    <form action = "logout.php" id = "logout" method="POST">
        <div class = "loggedPromt">
	You are now logged in as <?php echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?>
	<input type="submit" name="submit" id="submit" value="Logout" />
	</div>
    </form>