<?php
/**
	*This is the document that is displayed once the login has been preformed
	*this is the central hub of the advising website
	*Author:Josh Standiford
	*Email: jstand1@umbc.edu
	*file: index.php
	*/
session_start();
require_once("libs.php");
require_once("getAppointments.php");
if(!$_SESSION["auth"]){
	header("Location:../students/index.php");
}

$User_ID = $_SESSION["id"];
$conn = connect();
$query = mysql_query("select firstName FROM Advisors WHERE id = '" . $_SESSION["id"] . "'");
$results = mysql_fetch_array($query);
$firstName = $results[0];
$checkemDubs[0] = "checked";
$_SESSION["alert"] = true; //This determines if the alert is sent or not
//Initializes the calendar and spots
if(!isset($_SESSION["runOnce"])){
	$sess = getDay();
	$_SESSION["theDay"] = $sess[0];
	$_SESSION["DATE"] = $sess[1];
}

disconnect($conn);
?>
<html>
<head>
	<title>Advisor Homepage</title>
	<link rel="shortcut icon" href="Pictures/favicon.ico" />
	<link rel="icon" type="image/png" href="../students/images//icon.png" />
	<link href="Styles/styles.css" rel="stylesheet" type="text/css" media="all" />
	<link href="Styles/popups.css" rel="stylesheet" type="text/css" media="all" />
	<link href="Styles/alerts.css" rel="stylesheet" type="text/css" media="all" />
	<link href="Styles/theme.css" rel="stylesheet" type="text/css" media="all" />
	<link href="Styles/popoutbox.css" rel="stylesheet" type="text/css" media="all" />
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
	<!-- this script makes the alerts on mouse over disappear -->
	<script>
	$(document).ready(function()
		{
			$('#alert').mouseover(function() {
			   $("#alert").fadeOut(1000);
			});
		}	
	);
	
	</script>
	 
	<!-- This function -->
	<script>
	$(document).mouseup(function (e)
	{
		var container = new Array();
		container.push($('#'));

		$.each(container, function(key, value) {
			if (!$(value).is(e.target) // if the target of the click isn't the container...
				&& $(value).has(e.target).length === 0) // ... nor a descendant of the container
			{
				$(value).hide();
			}
		});
	});
	</script>
	<!--  -->
	<script type="text/javascript">
	function showInput() {
		if (document.getElementById('group').checked) {
			document.getElementById('ifChecked').style.display = 'block';
			document.getElementById('addAppointment').style.height = '370px';
		}
		else{
		document.getElementById('ifChecked').style.display = 'none';
		document.getElementById('addAppointment').style.height = '173px';
		}
	}
	
	//Sends email when reschedule occurs
	function pushEmail() {
		$.get("email.php");
		return false;
	}
	</script>
	<style>
 
  </style>
</head>
<body onload="showInput()" class="body">
<div class="alerts error" id="alert"><img src="Pictures/error.png" width="40px" height="40px">error completing function</div>
<div id="welcome">Welcome back, <?php echo($firstName); ?> [<a href="logout.php">logout</a>],  <a href="#popup1">Settings</a></div>

<!-- POPOUT WINDOW -->

<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Settings</h2>
		<a class="close" href="#">X</a>
			<div id="content">
			
			<label>E-mail:<input type="text" align="right"></label><br>
			<label>Password:<input type="password" align="right" ></label><br>
			<br>
			<input type="submit" onclick="pushEmail();"> 
			</div>	
			
			<div id="themeWrapper">
				<h4>Update Theme</h4>
				<div id="themeList">
				<div class="theme" style="background-color:#550022;color:#ffffff;"></div>
				<div class="theme" style="background-color:#f1f1f1;color:#000000;"></div>
				<div class="theme" style="background-color:#223322;color:#ffffff;"></div>
				<div class="theme" style="background-color:#111111;color:#ffffff;"></div>
				<div class="theme" style="background-color:#323232;color:#ffffff;"></div>
				<div class="theme" style="background-color:#444444;color:#ffffff;"></div>
				</div>
			</div>
			<script>
			$( ".theme" ).click(function() {
			  var color = $( this ).css( "background-color" );	
			  var fontColor = $( this ).css( "color" );
			  $( 'body' ).css('background', color);
			  $( 'body'	).css('color', fontColor)
			});
			
			</script>
	</div>
</div>

<!-- END TEST -->
 
<div id="header">

<!--   This is the title and hr
<h3 style="text-align:center;z-index:0;"><div id="title">Advisor Control Panel</div></h3>
<hr class="faded">
-->
</div>
<div id="wrapper">
<center><h4>Availability 9</center></h4>
<div id="scheduleMaker">
<br>
<form action="calendar.php" method="post">
  <input type="checkbox" name="monday" value="Monday" <?php echo(checkDay("monday")); ?>>Monday 
  <div id="dateRight">
	  Start: 
	  <select name="mondayStart">
	  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600">4:00</option>
	</select> End:
	<select name="mondayEnd">
	  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600"selected="true">4:00</option>
	</select>
</div>
<br>
  <input type="checkbox" name="tuesday" value="Tuesday" <?php echo(checkDay("tuesday")); ?>>Tuesday
  <div id="dateRight">
	Start: 
	  <select name="tuesdayStart">
	  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600">4:00</option>
	</select> End:
	<select name="tuesdayEnd">
	  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600"selected="true">4:00</option>
	</select>
</div>
<br>
  <input type="checkbox" name="wednesday" value="Wednesday" <?php echo(checkDay("wednesday")); ?>>Wednesday
  <div id="dateRight">
  Start: 
  <select name="wednesdayStart">
  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600">4:00</option>
</select> End:
<select name="wednesdayEnd">
  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600"selected="true">4:00</option>
</select></div><br>
  <input type="checkbox" name="thursday" value="Thursday" <?php echo(checkDay("thursday")); ?>>Thursday
  <div id="dateRight">
  Start: 
  <select name="thursdayStart">
  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600">4:00</option>
</select> End:
<select name="thursdayEnd">
  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600"selected="true">4:00</option>
</select></div><br>
  <input type="checkbox" name="friday" value="Friday" <?php echo(checkDay("friday")); ?>>Friday 
  <div id="dateRight">
	  Start: 
	  <select name="fridayStart">
	  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600">4:00</option>
	</select> End:
	<select name="fridayEnd"> 
	  <option value="900">9:00</option>
	  <option value="930">9:30</option>
	  <option value="1000">10:00</option>
	  <option value="1030">10:30</option>
	  <option value="1100">11:00</option>
	  <option value="1130">11:30</option>
	  <option value="1200">12:00</option>
	  <option value="1230">12:30</option>
	  <option value="1300">1:00</option>
	  <option value="1330">1:30</option>
	  <option value="1400">2:00</option>
	  <option value="1430">2:30</option>
	  <option value="1500">3:00</option>
	  <option value="1530">3:30</option>
	  <option value="1600"selected="true">4:00</option>
	</select>
</div>
<br><br>	 

  <input type="submit" value="Update">
	
</form>
</div>
<br>
<center><h4>Appointment Editor</center></h4>
<div id="addAppointment">
	<form action="addAppointment.php" method="post">
	<label for="appointment">Date: </label><input id="appointment" name="appointmentDate" type="date" value="<?php echo date('Y-m-d'); ?>"/>
		<div id="apptTypes">
		<label>Single <input type="radio" checked="checked" onclick="javascript:showInput();" id="single" name="groupType"></label> 
		<label>Group <input type="radio" onclick="javascript:showInput();" id="group" name="groupType"></label>
		</div>
		<div>
		Start: 
		<select name="appointmentStart">
		<option value="900">9:00 AM</option>
		<option value="930">9:30 AM</option>
		<option value="1000">10:00 AM</option>
		<option value="1030">10:30 AM</option>
		<option value="1100">11:00 AM</option>
		<option value="1130">11:30 AM</option>
		<option value="1200">12:00 PM</option>
		<option value="1230">12:30 PM</option>
		<option value="1300">1:00 PM</option>
		<option value="1330">1:30 PM</option>
		<option value="1400">2:00 PM</option>
		<option value="1430">2:30 PM</option>
		<option value="1500">3:00 PM</option>
		<option value="1530">3:30 PM</option>
		</select>
		</div>
		<br>
		Student IDs:
		<!--
		<textarea rows="6" cols="35" name="studentIDs" placeholder="Enter names as comma seperated list..."></textarea>
		-->
		<br>
		<label>ID 0: <input type="text" width="30px"></label><br>
		 <div id="ifChecked" style="display:none">
		<label>ID 1: <input type="text"></label><br>
		<label>ID 2: <input type="text"></label><br>
		<label>ID 3: <input type="text"></label><br>
		<label>ID 4: <input type="text"></label><br>
		<label>ID 5: <input type="text"></label><br>
		<label>ID 6: <input type="text"></label><br>
		<label>ID 7: <input type="text"></label><br>
		<label>ID 8: <input type="text"></label><br>
		<label>ID 9: <input type="text"></label><br>
		 </div>
		<br>
		<input type="submit">
		<input type="radio" name="editing" value="edit">Edit
		<input type="radio" name="editing" value="delete">Delete
		<input type="radio" name="editing" value="add" checked="true">Add
	</form>


</div>
</div>
</div>
<div id="calendarWrap">
<div id="appointmentCalendar">
<div id="calendarTopper"><h1 style="text-align:center"><?php echo $_SESSION["theDay"]; ?></h1></div>
<div id="timeIDBlock">
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"9:00")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"9:30")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"10:00")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"10:30")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"11:00")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"11:30")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"12:00")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"12:30")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"1:00")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"1:30")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"2:00")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"2:30")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"3:00")); ?></div>
	<div id="timeIDBlocks"><div id="pad"></div><?php echo(getTable($User_ID, $_SESSION["DATE"],"3:30")); ?></div>
</div>
<div id="calendarTimes">
	<div id="timeBlock">9:00</div>
	<div id="timeBlock">9:30</div>
	<div id="timeBlock">10:00</div>
	<div id="timeBlock">10:30</div>
	<div id="timeBlock">11:00</div>
	<div id="timeBlock">11:30</div>
	<div id="timeBlock">12:00</div>
	<div id="timeBlock">12:30</div>
	<div id="timeBlock">1:00</div>
	<div id="timeBlock">1:30</div>
	<div id="timeBlock">2:00</div>
	<div id="timeBlock">2:30</div>
	<div id="timeBlock">3:00</div>
	<div id="timeBlock">3:30</div>
</div>
</div>
<div id="calendarBottom">
<form action="updateDay" method="post">
<br>
<label for="appointment">Change Day: </label><input id="appointment" name="dayPicker" type="date" value="<?php echo date('Y-m-d'); ?>"/>
<input type="submit" value="Update">
</form>
<style="text-align:right;">[<a href="print.php">print</a>]</style>
</div>

</div>

</body>
</html>
