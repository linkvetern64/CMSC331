<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// cancelAppointment.php: - the user chose to cancel previous appointment(s)
//		      			  - the program uses mysql query to list all appointments
//						  - with checkbox the user has choice to cancel one or more appointments
//						  
// The user still has options to: logout at anytime	==> redirects to logout.php ==> destroys session, cookies ==> automatically redirects to index.php
//				    or go back to the previous page ==> redirects to loggedIn.php

// File Header!
// include the header for the page
include("headersFooters/cancelAppointmentHeader.php");

// include the navigation bar
include("navigation/navigationBar.php");


// File Body!
?>

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
								<?php while($row = mysql_fetch_array($result)) { ?>
									<?php $adv = $row['advisor']; ?>
			     					<?php $appt_type = $row['appt_type']; ?>
			    					<?php $appt_date = $row['appt_date']; ?>
			     					<?php $appt_time = $row['appt_time']; ?>
									<?php $str = $appt_type." appointment on "; ?>

									<input type="checkbox" name="tags[]" value="<?php echo $counter; ?>" />
									<?php $counter = $counter + 1; ?>	
								
									<!-- format the date from 2015-03-22 to 03/22/2015 -->
									<!-- format the time from 10:00:00 to 10:00 AM or 12:00:00 to 12:00 PM -->			
									<?php echo $str; echo formatDate($appt_date); echo " at "; echo formatTime($appt_time); ?>
									<?php if($adv != "") { ?>
										<?php echo " with "; echo $adv; ?>
									<?php } ?><br>
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

<?php

// File Footer!

//include the footer
include("headersFooters/footer.php");

?>