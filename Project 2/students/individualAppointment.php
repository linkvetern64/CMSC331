<?php

//start the session
session_start();

//include global variables
include('globals/globalVariables.php');

//include common methods to connect to database
include('CommonMethods.php');

include("../advisors/libs.php");

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

if(isset($_POST['continue']))
{
  if(!isset($_POST['advisor']))
  {
     $error = true;
     $error_msg = "Please choose one of the following advisors.";
  }
  else
  {
    $_SESSION['appt_type'] = "Individual";

    //get the value for advisor
    $advisor = $_POST['advisor'];

    //set the value for advisor
    $_SESSION['advisor'] = $advisor;
  
    header('Location: showIndividualDate.php');
  }
}
elseif(isset($_POST['go_back']))
{
   if($_SESSION['reschedule'] == true)
   {
	header('Location: rescheduleAppointment.php');
   }
   else
   {
   	header('Location: studentLoggedIn.php');
   }
}

?>


<!DOCTYPE HTML>
<html>
<head>
   <title>COEIT Academic Advising</title>
   <link rel="icon" type="image/png" href="images/icon.png" />
   <link rel="stylesheet" type="text/css" href="css/myStyle.css">
</head>
 
<body>
    <div class = "fixed">
      <div class="transbox">
        <div class = "header">
	    <h2>Welcome to Individual Advising</h2>
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
            <form action="?" name="Individual Appointment" id="Individual Appointment" method="POST">
                <div class="student_info">
                    <div class="center"><div class="legendFont">Please choose one of the following advisors.</div></div>
                    <br>
				    <table>
				    	<!-- radio options for selecting an advisor for indivdual appointment -->
		     			<span class="error"><font color="red" size="2"><?php echo $error_msg; ?></font></span>
						<div id="radio">
							<!-- Dynamically populate advisors list -->
							<?php
								$advisors = getAdvisorList();
								for($i = 0; $i < numAdvisors(); $i++){
									echo("<input type='radio' name='advisor' value='" . $advisors[$i] . "'>" . $advisors[$i] . "</input><br>");
								}
							?>
						</div>
					</table>
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