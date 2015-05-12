<?php
session_start();

include("libs.php");

function searchAppointments($studentID){
	$conn = connect();
	
	$query = mysql_query("SELECT `appointmentKey` FROM `Appointments` WHERE 
	Concat(id0, '', id1, '', id2, '', id3, '', id4
			, '', id5, '', id6, '', id7, '', id8, '', id9) LIKE  %'" . $studentID . "'%"); 
	
	$query = mysql_query("SELECT `appointmentKey` FROM `Appointments` WHERE id0 = 123");
	$rows = mysql_fetch_assoc($query);
	
	$result = mysql_fetch_array($query);
	echo("HI");
	disconnect($conn);
	
}
	
 