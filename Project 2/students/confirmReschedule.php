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

$tags_arr = $_SESSION['tags[]'];
$counter = 0;

$sql = "SELECT `advisor`, `appt_type`, `appt_date`, `appt_time` FROM `appointments` WHERE `student_id` = '$student_id'";

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

	     $q = "DELETE FROM `appointments` WHERE `student_id` = '$student_id'
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

   $sql = "INSERT INTO `appointments` (`student_id`, `advisor`, `appt_type`, `appt_date`, `appt_time`)
				VALUES ('$student_id', '$advisor', '$appt_type', '$appt_date', '$appt_time')";


   $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
 
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
   <link rel="shortcut icon" href="Pictures/favicon.ico" />
   <link rel="icon" type="image/png" href="images/icon.png" />
   <link rel="stylesheet" type="text/css" href="css/myStyle.css">
</head>
 
<body>
    <div class = "fixed">
      <div class="transbox">
        <div class = "header">
	    <h2>Confirm To Reschedule Advising Appointment</h2>
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
    	<div id="rescheduleBox">
            <form action="?" name="cancel Appointment" id="cancel Appointment" method="POST">
                <div class="student_info">
                    <fieldset>
                        <div class="center"><div class="legendFont">Please confirm to reschedule the following appointment.</div></div>
                        <br>
					    <table>
							<div id="radio">
					    	<!-- print out the student and appointment info for confirmation -->
					    	<!-- format the date and time to 03/22/2015 and 12:00 PM accordingly. -->
							<?php echo "Your Name: "; echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?><br>
							<?php echo "UMBC ID#: "; echo $student_id; ?></br>
							<?php echo "Major: "; echo $major; ?><br>
							<?php echo "Type: "; echo $appt_type; ?> appointment</br>
							<?php if($appt_type == "Individual") { echo "Advisor: "; echo $advisor; echo "</br>";} ?>
							<?php echo "Date: "; echo formatDate($appt_date); ?></br>
							<?php echo "Time: "; echo formatTime($appt_time); ?>
							</br>
								<!-- compare the `appointment_list` values to user selected values  -->
								<!-- if they match then print out the appointment info to be confirmed -->
								<?php while($row = mysql_fetch_array($result)) {
								    $len = sizeof($tags_arr);
								    $len = $len - 1;
								    
								    while($len >= 0) {
										if($tags_arr[$len] == $counter)
										{
										   $adviser = $row['advisor'];
				     					 	   $apt = $row['appt_type'];
				    					   	   $dt = $row['appt_date'];
				     					   	   $t = $row['appt_time'];
										   echo "Previous: ";
										   $format_str = $apt." appointment on ";				
										   echo $format_str; echo formatDate($dt); echo " at "; echo formatTime($t);					   
									   
										   if($adviser != "All") {
										      echo " with "; echo $adviser;
										   }
										   echo "<br>";
								        }
				  				        $len = $len - 1; }
								    $counter = $counter + 1; } ?>

							</div>
	      			    </table>
	      			</fieldset>
	      		</div>
			    <div id="rescheduleButton">
					<input type="submit" name="confirm" id="confirm" value="Confirm" />
					<input type="submit" name="go_back" id="go_back" value="Go Back" />
				</div>
			</form>
		</div>
	</div>
</body>
</html>