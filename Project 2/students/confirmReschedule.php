<?php

//start the session
 session_start();

include('../advisors/libs.php');

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
   $appt_date2 = $appt_date;


   $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


   //Code to modify the data in the advisor DB, first cancels original appointment
   
   $conn = connect();

   //Determine advisor id
   $advisorName = explode(" ", $adviser);
   $results = mysql_fetch_array(mysql_query("SELECT `id` FROM `Advisors` WHERE firstName = '$advisorName[0]' AND lastName = '$advisorName[1]'"));
   $advisor_id = $results[0];

   $results1 = mysql_fetch_array(mysql_query("SELECT `Calendar_Key` FROM `Calendar` WHERE id = '$advisor_id' AND Date_ID = '$dt'"));
   $appt_Key = $results1[0];

   //Match Time Column label
   $tempAppt_time = ltrim (substr($t,0,5), '0');
    //Update entry with "NULL"
   mysql_query("UPDATE `Calendar` SET `$tempAppt_time` = NULL WHERE `Calendar_Key` = '$appt_Key'");
   disconnect($conn);



   //Now adds new appointment
   //Code to update the advisor side DBs

   //First, check if the new calendar key already exists. If it does not, create it
   //and insert new row into the calendar table
   $newAdvisorName = explode(" ", $advisor);
   $conn = connect();
   	 $results2 = mysql_fetch_array(mysql_query("SELECT `id` FROM `Advisors` WHERE firstName = '$newAdvisorName[0]' AND lastName = '$newAdvisorName[1]'"));
   disconnect($conn); 
   $advisor_id2 = $results2[0];

   $appt_Key2 = $advisor_id2."/".$appt_date2;

 
   if(!createCalendarKey($appt_date2,$advisor_id2)) {
   	//Create boolean for group appointment
	if($appt_type == "Group"){
		$Group = 1;	
	}
	else{
		$Group = 0;
	}

	//Connect to advisor DB
   	$conn = connect();

	//Create the new row
	mysql_query("INSERT INTO `jstand1`.`Calendar` (`id`,`Date_ID`,`Calendar_Key`,`isGroup`)
			    VALUES ('$advisor_id2','$appt_date2','$appt_Key2','$Group')");
	disconnect($conn);
   }

   //Now that the appointment row already exists, simply update the existing row
    $tempAppt_time = ltrim (substr($appt_time,0,5), '0');
 
   $conn = connect();
   mysql_query("UPDATE `Calendar` SET `$tempAppt_time` = '$student_id' WHERE `Calendar_Key` = '$appt_Key2'");
   disconnect($conn);

 
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