<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//        or cancel any or all of the previous appointments
// 
// confirmHeader.php: Header and action file for confirm.php
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

if(!$_SESSION["auth"])
{
    header('Location:../index.php');
}

	$newGroupId = 0;

        //connect to advisor's DB
        $conn = connect();

	$appt_key = setApptKey($advisor_id, $appt_date, $appt_time);

        $result = mysql_fetch_array(mysql_query("SELECT * FROM `Appointments` WHERE `appointmentKey` = '$appt_key'"));

	$group_result = mysql_fetch_array(mysql_query("SELECT * FROM `Calendar` WHERE `Calendar_Key` = '$calendar_key'"));
	
	if(empty($group_result))
	{
	    $newGroupId = 1;
	}
	
	$counter = 0;

	while($counter < 10)
	{
	   if($result[$counter] == NULL)
	   {
		break;
	   }
	   $counter++;
	}

	$id = "id".$counter;

        disconnect($conn);


if(isset($_POST['confirm']))
{

   $sql = "INSERT INTO `students` (`student_id`, `fname`, `mname`, `lname`, `major`)
				VALUES ('$student_id', '$fname', '$mname', '$lname', '$major')";

   $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
   

   $sql = "INSERT INTO `appointments` (`student_id`, `advisor`, `appt_type`, `appt_date`, `appt_time`)
				VALUES ('$student_id', '$advisor', '$appt_type', '$appt_date', '$appt_time')";


   $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

   //Code to update the advisor side DBs

   //set the appointmentKey first
   $appt_key = setApptKey($advisor_id, $appt_date, $appt_time);
   $_SESSION['appt_key'] = $appt_key;
  

   if($appt_type == "Group")
   {
	$Group = 1;

        //connect to advisor's DB
        $conn = connect();

        if($id == "id0")
	{
           //add the student id and appointmentKey for appointment to advisor's end
           mysql_query("INSERT INTO `Appointments` (`id0`,`appointmentKey`)
	   		       VALUES ('$student_id', '$appt_key')");
	}
	else
	{
	   mysql_query("UPDATE `Appointments` SET `".$id."` = '$student_id' WHERE `appointmentKey` = '$appt_key'");
	}

	if($newGroupId == 1)
	{
	   //add to calendar since it doesn't exist
	   mysql_query("INSERT INTO `Calendar` (`".$newTime."`, `id`, `Date_ID`, `Calendar_Key`, `isGroup`)
				VALUES ('$appt_key', '$advisor_id', '$appt_date', '$calendar_key', '$Group')");
	}
	else
	{
	   mysql_query("UPDATE `Calendar` SET `".$newTime."` = '$appt_key' WHERE `Calendar_Key` = '$calendar_key'");
	}
   
        //disconnect
        disconnect($conn);
	
   }
   else
   {
	$Group = 0;

        //connect to advisor's DB
        $conn = connect();

        //add the student id and appointmentKey for appointment to advisor's end
        mysql_query("INSERT INTO `Appointments` (`id0`,`appointmentKey`)
	   		       VALUES ('$student_id', '$appt_key')");

	if($newGroupId == 1)
	{
	   //add to calendar since it doesn't exist
	   mysql_query("INSERT INTO `Calendar` (`".$newTime."`, `id`, `Date_ID`, `Calendar_Key`, `isGroup`)
				VALUES ('$appt_key', '$advisor_id', '$appt_date', '$calendar_key', '$Group')");
	}
	else
	{
	   mysql_query("UPDATE `Calendar` SET `".$newTime."` = '$appt_key' WHERE `Calendar_Key` = '$calendar_key'");
	}
   
        //disconnect
        disconnect($conn);
	
   }
   
   header('Location: ThankYou.php');
 
}
	   
elseif(isset($_POST['go_back']))
{
	if($appt_type == "Group")
	{
	   header('Location: showGroupTime.php');
	}
	else
	{
	   header('Location: showIndividualTime.php');
	}
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
	    <h2>Advising Appointment Confirmation</h2>
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
                        <div class="center"><div class="legendFont">Please confirm to schedule the following appointment.</div></div>
                        <br>
					    <table>
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
	      			    </table>
			    </div>
			    <div id="advisorButton">
					<input type="submit" name="confirm" id="confirm" value="Confirm" />
					<input type="submit" name="go_back" id="go_back" value="Go Back" />
			    </div>
			</form>
		</div>
	</div>
</body>
</html>