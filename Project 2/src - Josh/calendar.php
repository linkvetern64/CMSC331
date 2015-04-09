<?php
/**
	*This document is designed in order to allow the student to see the professors availability
	*Author:Josh Standiford
	*Email: jstand1@umbc.edu
	*file: index.php
	*/
session_start();
require_once("libs.php");

/*
* checks to see if the checkbox for availability is checked
*/
function isChecked($day){
	return isset($_POST[$day]);
}

/**
* Prints the times of the availability, 
* Will be updated to modify the SQL
*/
function printTimes($start, $end){
	 
	for($i = 0; $start <= $end; $i++){
		if($start >= 1300)
		{
			echo($start % 1200);
		}
		else
		{
			echo($start);
		}
		if($start%100 == 0)
		{
			$start += 30;	
		}	
		else
		{
			$start += 70;
		}
		echo("<br>");
	}	
}

function commitChanges($id, $day, $checked){
	$conn = connect();
	$results = mysql_fetch_array(mysql_query("SELECT `id` FROM `Availability` WHERE id = " . $id));
	if($results[0] != NULL)
	{
		//If the ID was found update it
		$query = "UPDATE `Availability` 
				  SET `" . $day . "` = '" . $checked . "'
				  WHERE id = " . $id;
		mysql_query($query);
	}
	else
	{
		//If the ID is new, add it to the table and insert values
		$query = "INSERT INTO `Availability`(`" . $day . "`, `id`) 
			      VALUES ('" . $checked . "','" . $id . "')";
		mysql_query($query);
	}	  
	disconnect($conn);
}

/**********/
/* Helper functions above
/**********/

$conn = connect();
$daysOfWeek[0] = "monday";
$daysOfWeek[1] = "tuesday";
$daysOfWeek[2] = "wednesday";
$daysOfWeek[3] = "thursday";
$daysOfWeek[4] = "friday";
$User_ID = $_SESSION["id"];

for($j = 0; $j <= 4; $j++){
	
	if(isChecked($daysOfWeek[$j]))
	{
		//This function will set times the advisor would like 
		//printTimes($_POST[$daysOfWeek[$j] . "Start"],$_POST[$daysOfWeek[$j] . "End"]); 
		commitChanges($User_ID, $daysOfWeek[$j], 1);
	}
	else{
		commitChanges($User_ID, $daysOfWeek[$j], 0);
	}
}
//ADD DROP DOWN ALERT MESSAGE WHEN SOMETHING IS UPDATED "Schedule has been updated"  click it to dismiss!!!!!!
//redirects back to same page once updates are made
header("Location:granted.php");

//makes an array list of days and filter them through functions




