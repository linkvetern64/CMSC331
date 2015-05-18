<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// deletedAppointmentHeader.php: Header and action file for deletedAppointment.php
//
//start the session
session_start();

//include global variables => full name, id, and major
include('globals/globalVariables.php');

?>

<!DOCTYPE HTML>
<html>
<head>
   <title>Academic Advising Appointment</title>
   <link rel="shortcut icon" href="Pictures/favicon.ico" />
   <link rel="icon" type="image/png" href="images/icon.png" />
   <link rel="stylesheet" type="text/css" href="css/myStyle.css">
</head>
 
<body>
    <div class = "fixed">
      <div class="transbox">
        <div class = "header">
	    <h2>Advising Appointment Cancelled!</h2>
	    <div class = "h1">UMBC</div>
	    <div class = "h3">AN HONORS UNIVERSITY IN MARYLAND</div>
        </div>
      </div>
    </div>
    <img src = "images/campus" alt = "campus view" style="width: 100%; height: 160px; position: fixed top center;" />

    <?php include('navigation/navigationBar.php'); ?>

  <!-- prompt for remember to logout! -->
  <div id="thankYouMsg">
    <?php echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?> , 
  	always remember to logout before you leave!

    <form action="logout.php" id="logout" method="POST">
      <div id="taskButton">
        <input type="submit" name="logout" id="logout" value="Logout" />
      </div>
    </form>
  </div>
</body>
</html>