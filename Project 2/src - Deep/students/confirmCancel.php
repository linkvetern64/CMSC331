<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// confirmCancel.php: - the user chose to cancel one or more of previous appointment(s)
//		        	  - the program outputs the appointment the user has chosen to cancel
//				  	  - if the user clicks confirm then proceed to cancel the appointment
//					  - connects to the `appointment_list` and DELETES that appointment
//					  - also redirects the user to deleteAppointment.php
//							      
// The user still has options to: logout at anytime	==> redirects to logout.php ==> destroys session, cookies ==> automatically redirects to index.php
//				    or go back to the previous page ==> redirects to cancelAppointment.php
//
// File Header!
//
// include the file header
include("headersFooters/confirmCancelHeader.php");

// include the navigation bar
include("navigation/navigationBar.php");


// File Body!
?>

    <div id="section">
    	<div id="advisorBox">
            <form action="?" name="cancel Appointment" id="cancel Appointment" method="POST">
                <div class="student_info">
                    <fieldset>
                        <div class="center"><div class="legendFont">Please confirm to cancel the following appointment(s).</div></div>
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
									   
										   if($adviser != "") {
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

<?php

// File Footer!

//include the footer
include("headersFooters/footer.php");

?>