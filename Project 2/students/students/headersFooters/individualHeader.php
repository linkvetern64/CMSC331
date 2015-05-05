<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// individualHeader.php: Header and action file for individual.php
//
//start the session
session_start();

//include global variables => full name, id, and major
include('globals/globalVariables.php');

//validation
$error = false;
$error_msg = '';

if(isset($_POST['continue']))
{
  if(!isset($_POST['advisor']))
  {
     $error = true;
     $error_msg = "Please choose one of the following advisors.";
  }
  else
  {
  
    //get the value for appointment type
    $advisor = $_POST['advisor'];

    //set the value for appointment type
    $_SESSION['advisor'] = $advisor;
  
    header('Location: showIndividualDate.php');
  }
}
elseif(isset($_POST['go_back']))
{
   header('Location: studentLoggedIn.php');
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
	    <h2>Welcome to Individual Advising</h2>
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