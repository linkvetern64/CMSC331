<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// confirm.php: - the user chose to make either group or individual appointment
//		        - the program outputs the user information along with the provided appointment schedule
//				- if the user clicks confirm then ==> redirects to ThankYou.php and sends data to the database
//							      
// The user still has options to: logout at anytime	==> redirects to logout.php ==> destroys session, cookies ==> automatically redirects to index.php
//				    or go back to the previous page ==> redirects to either showGroupTime.php or showIndividualTime.php depending upon the last page visited
//
// File Header!
//
include("headersFooters/confirmHeader.php");

include("navigation/navigationBar.php");

// File Body!
?>
  
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

<?php

// File Footer!

//include the footer
include("headersFooters/footer.php");

?>