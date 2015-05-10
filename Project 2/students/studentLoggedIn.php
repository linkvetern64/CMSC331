<?php

//start the session
 session_start();

//include global variables
include('globals/globalVariables.php');

//validation
$error = false;
$error_msg = '';

if(!$_SESSION["auth"])
{
    header('Location:../index.php');
}

if(isset($_POST['continue']))
{
    //get the value for appointment type
    $appointment = $_POST['appointment'];
    
    if($appointment == "Cancel")
    {
	header('Location: cancelAppointment.php');
    }
    elseif ($appointment == "Reschedule")
    {
	header('Location: rescheduleAppointment.php');
    }
    elseif ($appointment == "Individual")
    {
	header('Location: individualAppointment.php');
    }
    elseif ($appointment == "Group")
    {
        header('Location: showGroupDate.php');
    }
    else
    {
	$error = true;
        $error_msg = "Please choose one of the following options.";
    }
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
	    <h2>Welcome to COEIT Academic Advising</h2>
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
	<div id="taskBox">
                <form action="?" name="appointment" id="appointment" method="POST">
                    <div class="student_info">
                        <fieldset>
                            <div class="center"><div class="legendFont">Which of the following tasks would you like to perform?</div></div>
                            <br>
			    <table>
	     			<span class="error"><font color="red" size="2"><?php echo $error_msg; ?></font></span>
				<div id="radio">
				  <?php if($previous_appt == true) { ?>
					<input type="radio" name="appointment" value="Cancel">Cancel an appointment</input><br>
					<input type="radio" name="appointment" value="Reschedule">Reschedule an appointment</input><br>
				  <?php } else { ?>
				  	<input type="radio" name="appointment" value="Individual">Make an individual appointment</input><br>
				  	<input type="radio" name="appointment" value="Group">Make a group appointment</input><br>
				  <?php } ?>
				</div>
      			    </table>
		        </fieldset>
		    </div>
		    <div id="taskButton">
                      <input type="submit" name="continue" id="continue" value="Continue" />
		    </div>
		</form>
	 </div>
    </div>
</body>
</html>