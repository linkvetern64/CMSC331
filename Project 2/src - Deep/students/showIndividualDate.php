<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// showGroupDate.php: - the user chose to make an individual appointment
//			          - the program shows any available dates to sign up
//			   
//			MIN DATE:   The user must sign up before 3 days to meet any advisor
//			MAX DATE:   The user only has till September 9th 2015 to sign up for FALL 2015.
//
//		   after the choice has been made and click continue	=> redirects to showIndividualTime.php
//		   	if the choice field is left blank then error is displayed!
//
// The user still has options to: logout at anytime	==> redirects to logout.php ==> destroys session, cookies ==> automatically redirects to index.php
//				    or go back to the previous page ==> redirects to individual.php to select another advisor
//
// File Header!
//
//include the page header
include("headersFooters/showIndividualDateHeader.php");

//include navigation bar
include("navigation/navigationBar.php");


// File Body!
?>
	<div id="section">
		<form action="?" name="showDate" id="showDate" method="POST">
			<div class="student_info">
				<div class="center"><div class="legendFont">Please choose an appointment date.</div></div>
				<br>
				<table>
					<span class="error"><font color="red" size="2"><?php echo $error_msg; ?></font></span>
					<br>
					Enter Date: <input type="text" id="date" name="date" size="8">
				</table>
				<!-- using jQuery to display a very nice calendar that matches the webpage as well -->
      	        <!-- highly recommend trying this out! my first time trying and really liked it! -->
				<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
				<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
				<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
				<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/ui.js"></script>
				</br>
			</div>    
			<div id="showDateButton">
				<input type="submit" name="continue" id="continue" value="Continue" />
				<input type="submit" name="go_back" id="go_back" value="Go Back" />
			</div>
		</form>
	</div>

<?php

// File Footer!

//include the footer
include("headersFooters/footer.php");

?>