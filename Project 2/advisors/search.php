<?php
session_start();

include("libs.php");

	$studentID = "EY64958";
	 
	$conn = connect();
	
	$query = mysql_query("SELECT `appointmentKey` FROM `Appointments` WHERE 
	Concat(id0, '', id1, '', id2, '', id3, '', id4
			, '', id5, '', id6, '', id7, '', id8, '', id9) LIKE  %'" . $studentID . "'%"); 
	
	$query = mysql_query("SELECT `appointmentKey` FROM `Appointments` WHERE `id0` = '" . $studentID . "'");
	$rows = mysql_fetch_assoc($query);
	//echo($rows["appointmentKey"]);
	$search = "<div style='width:100xp;height:100px;background-color:red;'>" . $rows["appointmentKey"] . "</div>";
	$result = mysql_fetch_array($query);
	
	disconnect($conn);
	
	echo( $search);

	
 