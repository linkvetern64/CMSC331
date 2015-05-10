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


if(!$_SESSION["auth"])
{
    header('Location:../index.php');
}
else 
{

   $sql = "SELECT `appt_time` FROM `appointments` WHERE `appt_type` = '$appt_type'
                                            AND `appt_date` = '$appt_date'";
	
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

  	//set the value for appointment time
  	$_SESSION['appt_time'] = $time;

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

				
				<!-- if the available appointment array is empty, then error is displayed that appointments are full -->
				<?php if(ifempty($time_arr)==1) { ?>
					<font color="red" size="5"><center>Group appointments are full!</center><br>
					<font color="red" size="3">Note: Please go back and select a different date.</font></font>

				<?php } else { ?>
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
				<?php } ?></br>
		   </div>    
		   <div id="showDateButton">
                <input type="submit" name="continue" id="continue" value="Continue" />
			    <input type="submit" name="go_back" id="go_back" value="Go Back" />
			</div>
		</form>
	</div>
</body>
</html>