<?php

include("students/errorChecks/studentLoginErrorChecks.php");
include("advisors/errorChecks/advisorLoginErrorChecks.php");

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Welcome to COEIT Academic Advising</title>
	<link rel="icon" type="image/png" href="students/images/icon.png" />
	<link rel="stylesheet" href="students/css/style.css">
</head>

<body>
	<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
	<script src="students/js/index.js"></script>

	<h1 class="title">Welcome To COEIT Academic Advising</h1>

	<div id="login">
	  <div id="triangle"></div>
	  <h1>Advisor Login</h1>
	  <form action="?" method="POST">
	    <span class="error"><font color="red"><?php echo $error2_msg; ?></font></span>
	    <input id="textboxid" name="username" type="text" placeholder="Name:" /></br>
	    <input id="password" name="password" type="password" placeholder="Password" /></br>
	    <input type="submit" name="advisor_login" id="advisor_login" value="Log in" />
	  </form>
	</div>

	<div id="login">
	  <div id="triangle"></div>
	  <h1>Student Login</h1>
	  <form action="?" method="POST">
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
	
		<tr><td>Major:<sup><font color="red">*</font></sup></td>
		
		<td>
		<select style="width: 240px"name="major">
		<option selected="selected" disabled="disabled">Select</option>
		<option value="Computer Science">Computer Science</option>
		<option value="Computer Engineering">Computer Engineering</option>   
		<option value="Chemical Engineering">Chemical Engineering</option>
		<option value="Mechanical Engineering">Mechanical Engineering</option>
		<option value="Engineering Majors">Engineering Majors</option>
		</select>
		</td>
		</tr>

	    </p>

	    <span class="error"><font color="red"><?php echo $error_msg; ?></font></span>

	    </table>

		<input type="submit" name="student_login" id="student_login" value="Log in" />

	  </form>
	</div>
</body>
</html>