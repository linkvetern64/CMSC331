<?php
/**
	*This document is designed to spread the schedule of the given day across a new page
	*this way it can be printed the full size of the paper 
	*Author:Josh Standiford
	*Email: jstand1@umbc.edu
	*file: index.php
	*/
session_start();
require_once("libs.php");
require_once("getAppointments.php");
$conn = connect();
$User_ID = $_SESSION["id"];

?>
<html>
<head><title>Print Schedule</title>

	<link rel="shortcut icon" href="Pictures/favicon.ico" />
	<link href="printStyle.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>

<div id="appointmentCalendar">
<div id="calendarTopper"><h1 style="text-align:center"><?php echo $_SESSION["theDay"]; ?></h1></div>
<div id="timeIDBlock">
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"9:00")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"9:30")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"10:00")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"10:30")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"11:00")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"11:30")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"12:00")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"12:30")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"1:00")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"1:30")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"2:00")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"2:30")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"3:00")); ?></div>
	<div id="timeIDBlocks"><?php echo(getTable($User_ID, $_SESSION["DATE"],"3:30")); ?></div>
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
</body>