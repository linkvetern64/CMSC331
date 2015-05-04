<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// showIndividualTimeHeader.php: Header and action file for showIndividualTime.php
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

$time_arr = array('10:00:00','10:30:00','11:00:00','11:30:00','02:30:00','03:00:00');
$arr_len = 5;

//to show for logged in purpose
 $fname = $_SESSION['fname'];
 $mname = $_SESSION['mname'];
 $lname = $_SESSION['lname'];
 $advisor = $_SESSION['advisor'];

if((!isset($_SESSION['advisor'])) || (!isset($_SESSION['date'])) || (!isset($_SESSION['appointment'])))
{
   header('Location: index.php');
   die();
}
else 
{
   $advisor = $_SESSION['advisor'];
   $appointment = $_SESSION['appointment'];
   $date = $_SESSION['date'];

   $sql = "SELECT * FROM `appointment_list` WHERE `appt_type` = '$appointment'
                                            AND `advisor` = '$advisor' AND `appt_date` = '$date'";
	
   $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

   while($row = mysql_fetch_array($result))
   {
	setTime($time_arr, $arr_len, $row['appt_time']);
   }
}

if(isset($_POST['continue'])){
  
  if(empty($_POST['time']))
  {
     $error = true;
     $error_msg = "Please choose a time.";
  }
  else
  {
  	//get the value for the appointment time
  	$time = $_POST['time'];

  	//set the value for appointment type
  	$_SESSION['time'] = $time;

  	header('Location: confirm.php');
   }
}
elseif(isset($_POST['go_back']))
{
  header('Location: showIndividualDate.php');
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
	    <h2>Individual Advising Appointment Time</h2>
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