<?php

//start the session
session_start();

//include global variables
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

if(!$_SESSION["auth"])
{
    header('Location:../index.php');
}

$time_arr = array('09:00:00','09:30:00','10:00:00','10:30:00','11:00:00','11:30:00','12:00:00','12:30:00','01:00:00','01:30:00','02:00:00','02:30:00','03:00:00','03:30:00');
$arr_len = 14;

setMajorTimes($major, $advisor_id, $time_arr);

setAvailableTimes($day, $advisor_id, $time_arr);



$appointment = "Individual";

$sql = "SELECT * FROM `appointments` WHERE `appt_type` = '$appt_type'
                                         AND `advisor` = '$advisor' AND `appt_date` = '$appt_date'";
	
$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


while($row = mysql_fetch_array($result))
{
   setTime($time_arr, $arr_len, $row['appt_time']);
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
  	$_SESSION['appt_time'] = $time;

	//Updates the advisor side Table as appropriate
	if(createCalendarKey($appt_date,$advisor_id)){

	//Insert Code to create new row in 'Calendar' Table
	//Default Settings will be a 9-4 shift if Advisor had
	//Availability for that day
	

	}
	else{
	//Code to update an already existing row in 'Calendar' Table
	}
	
	if($_SESSION['reschedule'] == true)
        {
		header('Location: confirmReschedule.php');
	}
	else
	{
  		header('Location: confirmAppointment.php');
   	}
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
   <link rel="shortcut icon" href="Pictures/favicon.ico" />
   <link rel="icon" type="image/png" href="images/icon.png" />
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
    <img src = "images/campus" alt = "campus view" style="width: 100%; height: 160px; position: fixed top center;" />

    <?php include('navigation/navigationBar.php'); ?>
  
    <form action = "logout.php" id = "logout" method="POST">
        <div class = "loggedPromt">
	You are now logged in as <?php echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?>
	<input type="submit" name="submit" id="submit" value="Logout" />
	</div>
    </form>
	<div id="section">
		<form action="?" id="showDate" method="POST">
			<div class="student_info">

				<div class="center"><div class="legendFont">Please choose an available appointment time.</div></div>
				<br>
				<table>
				<span class="error"><font color="red" size="2"><?php echo $error_msg; ?></font></span>
				<br>
				Enter Time:
				<select name="time">
				<option selected="selected" disabled="disabled">Select</option>

				<?php foreach($time_arr as $available_times) { ?>
				<?php if($available_times != "") { ?>
				<option value="<?php echo $available_times ?>" ><?php echo formatTime($available_times) ?></option>
				<?php } ?>	
				<?php } ?>

				</select>
				</table>

			</div>    
			<div id="showDateButton">
				<input type="submit" name="continue" id="continue" value="Continue" />
				<input type="submit" name="go_back" id="go_back" value="Go Back" />
			</div>
		</form>
	</div>
</body>
</html>