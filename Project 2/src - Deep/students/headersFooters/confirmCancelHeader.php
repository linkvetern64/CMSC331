<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// confirmCancelHeader.php: Header and action file for confirmCancel.php
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
$tags_arr = $_SESSION['tags[]'];
$counter = 0;

$sql = "SELECT `advisor`, `appt_type`, `appt_date`, `appt_time` FROM `appointment_list` WHERE `student_id` = '$id'";

$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


if(isset($_POST['confirm']))
{
   $counter = 0;

   while($row = mysql_fetch_array($result)) 
   {
	$len = sizeof($tags_arr);
	$len = $len - 1;
				    
	while($len >= 0) 
        {
	  if($tags_arr[$len] == $counter)
	  {
	     $adviser = $row['advisor'];
     	     $apt = $row['appt_type'];
    	     $dt = $row['appt_date'];
     	     $t = $row['appt_time'];

	     $q = "DELETE FROM `appointment_list` WHERE `student_id` = '$id'
						    AND `advisor` = '$adviser'
						    AND `appt_type` = '$apt'
						    AND `appt_date` = '$dt'
						    AND `appt_time` = '$t'";
	
	     $rs = $COMMON->executeQuery($q, $_SERVER["SCRIPT_NAME"]);
	  }

          $len = $len - 1; 
        }

        $counter = $counter + 1; 
   }
 
   header('Location: deletedAppointment.php');

}

elseif(isset($_POST['go_back']))
{
   header('Location: cancelAppointment.php');
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