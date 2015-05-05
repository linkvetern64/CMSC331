<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// deleteAppointment.php: - the user has confirmed to cancel appointment(s)
//			                  - the appointment(s) has/have also been deleted from the database
//                        - the program here prompts the user to logout to remove any left over
//                          information such as session() or cookies
//  the only option available is to logout ==> redirects to logout.php ==> deletes session, cookies ==> automatically redirects to index.php
//
// File Header!
//
include("headersFooters/deletedAppointmentHeader.php");
include("navigation/navigationBar.php");


// File Body!
?>

  <!-- prompt for remember to logout! -->
  <div id="thankYouMsg">
    <?php echo $fname; echo " "; echo $mname; echo " "; echo $lname; ?> , 
  	always remember to logout before you leave!

    <form action="logout.php" id="logout" method="POST">
      <div id="taskButton">
        <input type="submit" name="logout" id="logout" value="Logout" />
      </div>
    </form>
  </div>

<?php

// File Footer!

//include the footer
include("headersFooters/footer.php");

?>