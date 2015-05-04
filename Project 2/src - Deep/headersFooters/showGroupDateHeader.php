<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// showGroupDateHeader.php: Header and action file for showGroupDate.php
//
//start the session
session_start();

//include global variables => full name, id, and major
include('globals/globalVariables.php');

//validation
$error = false;
$error_msg = '';

if(isset($_POST['continue'])){
  
  if(empty($_POST['date']))
  {
     $error = true;
     $error_msg = "Please choose a date.";
  }
  else
  {
     //get the value for the appointment date
     $date = $_POST['date'];

     //set the value for appointment date
     $_SESSION['date'] = $date;

     //set the advisor field to NULL
     $_SESSION['advisor'] = NULL;

     //show the available times on next page
     header('Location: showGroupTime.php');
     
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

   <link rel="stylesheet" type="text/css" href="css/mystyle.css">
   <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.css"></link>	
   <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.min.css"></link>
</head>
 
<body>
    <div class = "fixed">
      <div class="transbox">
        <div class = "header">
	    <h2>Group Advising Appointment Date</h2>
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