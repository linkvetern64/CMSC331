<?php
session_start();

include("libs.php");

function searchAppointments($studentID){
	
	$query = mysql_query("SELECT id FROM `Calendar` WHERE " . studentID . " = EY64938");
	
	$result = mysql_fetch_array($query);
	
	return $result;
}
	
 