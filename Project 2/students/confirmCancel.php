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

	     
	     $q = "DELETE FROM `students` WHERE `student_id` = '$student_id'";

	     $rs = $COMMON->executeQuery($q, $_SERVER["SCRIPT_NAME"]);

	  }

          $len = $len - 1; 
        }

        $counter = $counter + 1; 
   }

   //Code to delete the data from the advisor DB
   
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
   mysql_query("UPDATE `Calendar` SET `$tempAppt_time` = 'NULL' WHERE `Calendar_Key` = '$appt_Key'");
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
	    <h2>Confirm To Cancel Advising Appointment</h2>
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
                        <div class="center"><div class="legendFont">Please confirm to cancel the following appointment.</div></div>
                        <br>
					    <table>
							<div id="radio">

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
			    <div id="advisorButton">
					<input type="submit" name="confirm" id="confirm" value="Confirm" />
					<input type="submit" name="go_back" id="go_back" value="Go Back" />
				</div>
			</form>
		</div>
	</div>
</body>
</html>