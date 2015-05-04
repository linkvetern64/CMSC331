<?php 
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
// 
// index.php: - welcome and Login page for COEIT Academic Advising
//	          - Login requirement: student must have a valid UMBC ID# in order to sign up
//		       
//		      - provides navigation bar on left for students to be prepared for advising appointment
//	          - student is able to make appointment or manage previous appointment once logged in
//		      - Once logged in successfully, the user will be redirected to loggedIn.php
//            
//            - the program error checks and verifies UMBC ID#, name, and major
//            - if any field is left blank then error message is displayed.
//            - designed to let the user decide whether to make individual or group appointment, or cancel appointment
//            - also lets the user logout at anytime!
//
// About Dates: I have used jQuery and Javascript to implement the calendar
//              MAX DATE: the last date to schedule for advising: according to UMBC Calendar it is 09/09/2015 
//              MIN DATE: student must sign up before 3 days!
//
//
// About Times: I have used the advisor time sheet for both group and individual advising
//              Individual: 10:00 AM, 10:30AM, 11:00AM, 11:30AM, 2:30PM, 3:00PM
//              Group: 12:00PM, 12:30PM
// 
// About Error Checking: We discussed that a student may not have more than one Individual 
//                       or more than one Group appointment.
//                              - Discussed during the meeting you had signed up for us!
//
// Individual students: only 1 student for an advisor at a specified time
// Group students: max group of 10 students at a specified time
//
//
// File Header!
//
//include the welcome header
include("headersFooters/header.php");

//include the navigation bar
include("navigation/navigationBar.php");


// File Body!
?>
    <div id="section">
        <h2>Login</h2>

        <div id="login">
            <form action="?" name=”LogIn Form” id="LogIn Form" method="POST">
                <div class="student_info">
                    <fieldset>
                        <table>
                            <p>
                                <!-- prompt to enter name, id and major -->
                                <tr><td>First Name:<sup><font color="red">*</font></sup></td>
                                    <td><input type="text" name="fname"></input></td>
                                </tr>   

                                <tr>
                                    <td>Middle Name:<sup><font color="red"></font></sup></td>
                                    <td><input type="text" name="mname"></input></td>
                                </tr>
                            
                                <tr><td>Last Name:<sup><font color="red">*</font></sup></td>
                                    <td><input type="text" name="lname"></input></td>
                                </tr>

	                            <tr><td>Student ID#:<sup><font color="red">*</font></sup></td>
                                    <td><input type="text" name="student_id"></input></td>    
                                </tr>
                            
                                <tr><td>Major:</td><td><select name="major">
                                    <option selected="selected" disabled="disabled">Select</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Computer Engineering">Computer Engineering</option>   
        		                    <option value="Chemical Engineering">Chemical Engineering</option>
        		                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    <option value="Other">Other</option>
                                    </select></td>
                                </tr>
                            
                                <tr>
                                    <td><td><div id="loginButton"><input type="submit" name="submitted" id="submit" value="Login" /></div></td></td>
                                </tr>
            				</p>
                            <span class="error"><font color="red"><?php echo $error_msg; ?></font></span>
                        </table>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>

<?php

// File Footer! 

//include the footer
include("headersFooters/footer.php");

?>