<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// loggedIn.php: User Logged In successfully! 
//		 Now the user may manage the appointments by given tasks to perform
//		 the tasks include: 1) make an individual appointment	=> redirects to individual.php
//		 		    2) make a group appointment		=> redirects to showDates.php
//	 	 if the user has previously made an appointment then	
//		 		    3) cancel an appointment		=> redirects to cancelAppointment.php
//		
// The user still has options to: logout at anytime	==> redirects to logout.php ==> destroys session, cookies ==> automatically redirects to index.php
//				    
//		    
// File Header!
//
//include the header of the page
include("headersFooters/loggedInHeader.php");

//include the navigation bar
include("navigation/navigationBar.php");


// File Body!
?>
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
				  <input type="radio" name="appointment" value="Individual">Make an individual appointment</input><br>
				  <input type="radio" name="appointment" value="Group">Make a group appointment</input><br>
				  <?php if($previous_appt == true) { ?>
				  	<input type="radio" name="appointment" value="Cancel">Cancel an appointment</input><br>
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
<?php

// File Footer!

//include the footer
include("headersFooters/footer.php");

?>