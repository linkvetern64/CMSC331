<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// showGroupTimeHeader.php: Header and action file for showGroupTime.php
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

//default times for group appointments
$time_arr = array('12:00:00','12:30:00');
$arr_len = 1;


if((!isset($_SESSION['date'])) || (!isset($_SESSION['appointment'])))
{
   header('Location: index.php');
   die();
}
else 
{
   $appointment = $_SESSION['appointment'];
   $date = $_SESSION['date'];

   $sql = "SELECT `appt_time` FROM `appointment_list` WHERE `appt_type` = '$appointment'
                                            AND `appt_date` = '$date'";
	
   $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

   $count = 1;
   $counter = 1;
 
   while($row = mysql_fetch_array($result))
   {
	if($row['appt_time'] == "12:00:00")
	{
	    if($count == 10)
	    {
		setTime($time_arr, $arr_len, $row['appt_time']);
	    }
	    else
	    {
		$count = $count + 1;
	    }
	}
        elseif($row['appt_time'] == "12:30:00")
	{
	    if($counter == 10)
	    {
		setTime($time_arr, $arr_len, $row['appt_time']);
	    }
	    else
	    {
		$counter = $counter + 1;
	    }
	}
   }
}

if(isset($_POST['continue']))
{
  
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
  header('Location: showGroupDate.php');
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
	    <h2>Group Advising Appointment Time</h2>
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