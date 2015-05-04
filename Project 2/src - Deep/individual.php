<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// individual.php: - the user chose to make an individual appointment
//		           - now the user may pick any of the advisors: Catherine Bielawski,
//					 Josh Abrams, Anne Arey, Emily Stephens
//
//		   after the choice has been made and click continue	=> redirects to showDate.php
//		   	if the choice field is left blank then error is displayed!
//		         
// The user still has options to: logout at anytime	==> redirects to logout.php ==> destroys session, cookies ==> automatically redirects to index.php
//				    or go back to the previous page ==> redirects to loggedIn.php
//
// File Header!
//
//include the header of the page
include("headersFooters/individualHeader.php");

//include the navigation bar
include("navigation/navigationBar.php");


// File Body!
?>
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
							<input type="radio" name="advisor" value="Catherine Bielawski">Catherine Bielawski</input><br>
							<input type="radio" name="advisor" value="Josh Abrams">Josh Abrams</input><br>
							<input type="radio" name="advisor" value="Anne Arey">Anne Arey</input><br>
							<input type="radio" name="advisor" value="Emily Stephens">Emily Stephens</input><br>
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

<?php

// File Footer!

//include the footer
include("headersFooters/footer.php");

?>