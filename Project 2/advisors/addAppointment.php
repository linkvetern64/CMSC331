<?php
session_start();
require_once("libs.php");

$appDate = $_POST["appointmentDate"];
$appStart = $_POST["appointmentStart"];
$studentIDs["0"] = $_POST["id0"];
$studentIDs["1"] = $_POST["id1"];
$studentIDs["2"] = $_POST["id2"];
$studentIDs["3"] = $_POST["id3"];
$studentIDs["4"] = $_POST["id4"];
$studentIDs["5"] = $_POST["id5"];
$studentIDs["6"] = $_POST["id6"];
$studentIDs["7"] = $_POST["id7"];
$studentIDs["8"] = $_POST["id8"];
$studentIDs["9"] = $_POST["id9"];

$User_ID = $_SESSION["id"];
$Calendar_Key = $User_ID . "/" . $appDate;

$answer = $_POST['editing'];  


	$conn = connect();

	if($appStart > 1230){
		$appStart = $appStart % 1200;
	}
	if(strlen($appStart) > 3){
		$appStart = substr($appStart,0,2) .':'. substr($appStart,2,2);
	}
	else{
		$appStart = substr($appStart,0,1) .':'. substr($appStart,1,2);
	}

	$Appointment_Key = $Calendar_Key . "/" . $appStart;

	//Check to see if the row exists in the table if it does update it, otherwise insert it
	$results = mysql_query("SELECT  `" . $appStart ."` 
	FROM  `Calendar` 
	WHERE id = " . $User_ID . "
	AND Date_ID =  '" . $appDate . "'");
    $items = mysql_fetch_array($results);
	
	//print_r($items);
	
	if ($answer == "add") {    
	$queryTwo = "INSERT INTO `Appointments` ( `appointmentKey`, `id0`, 
	`id1`, `id2`, `id3`, `id4`, `id5`, `id6`, `id7`, `id8`, `id9`) 
	VALUES ( '" . $Appointment_Key . "' , '" . $studentIDs["0"] . "' , '" . $studentIDs["1"] . "'
	, '" . $studentIDs["2"] . "', '" . $studentIDs["3"] . "', '" . $studentIDs["4"] . "'
	, '" . $studentIDs["5"] . "', '" . $studentIDs["6"] . "', '" . $studentIDs["7"] . "'
	, '" . $studentIDs["8"] . "', '" . $studentIDs["9"] . "')";
	mysql_query($queryTwo);
	
		if(is_null($items[0])){
		$query = "INSERT INTO  `Calendar` (  `" . $appStart ."`  ,  `id` ,  `Date_ID` , `Calendar_Key` ) 
		VALUES (
				'" . $Appointment_Key . "', " . $User_ID . ",  '" . $appDate . "',  '" . $Calendar_Key . "'
				)
				ON DUPLICATE KEY UPDATE `" . $appStart . "` = '" . $Appointment_Key . "'";
				
		mysql_query($query);
	}    
	//AdvisorID/Date_Time/Hour:Minutes  Key to appts table
	}
	else if($answer == "edit"){
		
		$query = "UPDATE  `Calendar` SET  `" . $appStart ."` = CONCAT(  `" . $appStart ."` ,  '" . $studentIDs . "' ) WHERE  `Calendar_Key` =  '" . $Calendar_Key . "'";
		mysql_query($query);
	}
	else if($answer == "delete"){
		$query = "DELETE FROM `Appointments` WHERE `appointmentKey` = '" . $Appointment_Key  ."'";
		mysql_query($query);
		$query2 = "UPDATE  `Calendar` SET  `" . $appStart ."` = NULL WHERE  `Calendar_Key` =  '" . $Calendar_Key . "'";
		mysql_query($query2);
	}
	else if($answer == "reschedule"){
		//Work on reschedule logic
	}
	else{
		//Throw internal error
	}

	disconnect($conn);
	header("Location:granted.php");
