<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// showIndividualTime.php: - the user has picked a date to make an individual appointment
//			          - the program shows the available times to sign up for the appointment
//			   
//			MAX STUDENTS: at most 1 student for an advisor at a specified time
//			Times are: 10:00AM, 10:30AM, 11:00AM, 11:30AM, 2:30AM, 3:00AM
//
//		   after the choice has been made and click continue	=> redirects to confirm.php
//		   	if the choice field is left blank then error is displayed!
//
// The user still has options to: logout at anytime	==> redirects to logout.php ==> destroys session, cookies ==> automatically redirects to index.php
//				    or go back to the previous page ==> redirects to showIndividualDate.php
// 
// File Header!
//
//include the webpage header
include("../../advisors/libs.php");
include("globals/myFunctions.php");

include("headersFooters/showIndividualTimeHeader.php");
include("navigation/navigationBar.php");

?>
  
	<div id="section">
		<form action="?" id="showDate" method="POST">
			<div class="student_info">

				<!-- if the available appointment array is empty, then error is displayed that appointments are full -->
				<?php if(ifempty($time_arr)==1) { ?>
				<font color="red" size="5"><center>Individual appointments are full!</center>
				<font color="red" size="3">Note: please go back and select a different date or another advisor.</font></font>
				<?php } else { ?>

				<div class="center"><div class="legendFont">Please choose an available appointment time.</div></div>
				<br>
				<table>
				<span class="error"><font color="red" size="2"><?php echo $error_msg; ?></font></span>
				<br>
				Enter Time:
				<select name="time">
				<option selected="selected" disabled="disabled">Select</option>

				<?php foreach($time_arr as $available_times) { ?>
				<?php if($available_times != "") { ?>
				<option value="<?php echo $available_times ?>" ><?php echo formatTime($available_times) ?></option>
				<?php } ?>	
				<?php } ?>

				</select>
				</table>
				<?php } ?></br>
			</div>    
			<div id="showDateButton">
				<input type="submit" name="continue" id="continue" value="Continue" />
				<input type="submit" name="go_back" id="go_back" value="Go Back" />
			</div>
		</form>
	</div>

<?php

//include the footer
include("headersFooters/footer.php");

?>