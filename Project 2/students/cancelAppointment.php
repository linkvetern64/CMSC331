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

$counter = 0;

$sql = "SELECT `advisor`, `appt_type`, `appt_date`, `appt_time` FROM `appointments` WHERE `student_id` = '$student_id'";

$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


if(isset($_POST['continue']))
{
   if(!isset($_POST['tags']))
   {
      $error = true;
      $error_msg = "Please select an appointment to cancel.";
   }
   else
   {
      //set the selected tags;
      $_SESSION['tags[]'] = $_POST['tags'];

      header('Location: confirmCancel.php');
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
   <link rel="icon" type="image/png" href="images/icon.png" />
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
    <img src = "images/campus" alt = "campus view" style="width: 100%; height: 160px; position: fixed top center;" />

    <?php include('navigation/navigationBar.php'); ?>
  
    <form action = "logout.php" id = "logout" method="POST">
        <div class = "loggedPromt">
	You are now logged in as <?php echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?>
	<input type="submit" name="submit" id="submit" value="Logout" />
	</div>
    </form>

    <div id="section">
    	<div id="advisorBox">
		    <form action="?" name="cancel Appointment" id="cancel Appointment" method="POST">
                <div class="student_info">
                    <fieldset>
                        <div class="center"><div class="legendFont">Which appointment would you like to cancel?</div></div>
                        <br>
                        <table>
					    	<span class="error"><font color="red" size="2"><?php echo $error_msg; ?></font></span>
							<div id="radio">
								<!-- loop through the `appointment_list` table to output the previous appointments-->
								<?php while($row = mysql_fetch_array($result)) {
									$adv = $row['advisor'];
			     						$appt_type = $row['appt_type'];
			    						$appt_date = $row['appt_date'];
			     						$appt_time = $row['appt_time'];
									$str = $appt_type." appointment on "; ?>

									<input type="checkbox" name="tags[]" value="<?php echo $counter; ?>" />
									<?php $counter = $counter + 1; ?>
								
									<!-- format the date from 2015-03-22 to 03/22/2015 -->
									<!-- format the time from 10:00:00 to 10:00 AM or 12:00:00 to 12:00 PM -->			
									<?php 
									      echo $str; 
									      echo formatDate($appt_date); 
									      echo " at "; 
									      echo formatTime($appt_time);

									      if($adv != "All") {
									      echo " with "; 
									      echo $adv;
									      } ?> <br>
								<?php } ?>
							</div>
	      			    </table>
	      			</fieldset>
			    </div>
			    <div id="advisorButton">
					<input type="submit" name="continue" id="continue" value="Continue" />
					<input type="submit" name="go_back" id="go_back" value="Go Back" />
			    </div>
			</form>
		</div>
	</div>
</body>
</html>