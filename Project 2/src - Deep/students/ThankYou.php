<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// ThankYou.php: - the user has confirmed to schedule an appointment
//               - the appointment has been stored into the database table `appointment_list`
//               - the program here prompts the user to logout in order to remove any left over
//                 information such as session() or cookies
//  the only option available is to logout ==> redirects to logout.php ==> deletes session, cookies ==> automatically redirects to index.php
//
// File Header!
//include the wepage header
include("headersFooters/ThankYouHeader.php");

//include the navigation bar
include("navigation/navigationBar.php");


// File Body!
?>
  <div id="thankYouMsg">

    <!-- display my dear string! -->
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