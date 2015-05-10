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

if(!$_SESSION["auth"])
{
    header('Location:../index.php');
}

elseif(isset($_POST['continue'])){
  
  if(empty($_POST['date']))
  {
     $error = true;
     $error_msg = "Please choose a date.";
  }
  else
  {
     $_SESSION['appt_type'] = "Group";

     //get the value for the appointment date
     $date = $_POST['date'];

     //set the value for appointment date
     $_SESSION['appt_date'] = $date;

     //set the advisor field to All
     $_SESSION['advisor'] = All;

     //show the available times on next page
     header('Location: showGroupTime.php');
     
  }
}
elseif(isset($_POST['go_back']))
{
   if($_SESSION['reschedule'] == true)
   {
	header('Location: rescheduleAppointment.php');
   }
   else
   {
   	header('Location: studentLoggedIn.php');
   }
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
    <img src = "images/campus" alt = "campus view" style="width: 100%; height: 160px; position: fixed top center;" />

    <?php include('navigation/navigationBar.php'); ?>
  
    <form action = "logout.php" id = "logout" method="POST">
        <div class = "loggedPromt">
	You are now logged in as <?php echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?>
	<input type="submit" name="submit" id="submit" value="Logout" />
	</div>
    </form>
	<div id="section">
		<form action="?" name="showDate" id="showDate" method="POST">
			<div class="student_info">
				<div class="center"><div class="legendFont">Please choose an appointment date.</div></div>
				<br>
				<table>
					<span class="error"><font color="red" size="2"><?php echo $error_msg; ?></font></span>
					<br>
					Enter Date: <input type="text" id="date" name="date" size="8">
      	        </table>
      	        <!-- using jQuery to display a very nice calendar that matches the webpage as well -->
      	        <!-- highly recommend trying this out! my first time trying and really liked it! -->
				<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
				<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
				<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
				<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/ui.js"></script>
				</br>
			</div>    
			<div id="showDateButton">
				<input type="submit" name="continue" id="continue" value="Continue" />
				<input type="submit" name="go_back" id="go_back" value="Go Back" />
			</div>
		</form>
	</div>
</body>
</html>