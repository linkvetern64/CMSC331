<?php
session_start();
require_once("libs.php");

function getTable($User_ID, $time, $index){
	
	$conn = connect();
	$query = mysql_query("SELECT  `9:00`, `9:30`, `10:00`, `10:30`, `11:00`, `11:30`, `12:00`, `12:30`, `1:00`, `1:30`, `2:00`, `2:30`, `3:00`, `3:30`
			  FROM  `Calendar` 
              WHERE  `Calendar_Key` =  '" . $User_ID . "/" . $time . "'");
	
	$results = mysql_fetch_array($query);
	
	 
	return $results[$index];
}

function getAppointments($User_ID, $date, $time){
	
	$conn = connect();
	$key = $User_ID . "/" . $date . "/" . $time;
	$query = mysql_query("SELECT * FROM `Appointments` WHERE appointmentKey = '" . $key . "'"); 
	$rows = mysql_fetch_assoc($query);
	
	for($i = 0; $i < 10; $i++){
		if($rows["id" . $i] != ""){
			echo($rows["id" . $i]);
			echo(", ");
		}
		if($i == 4){
			echo("<br>");
		}
	}
}