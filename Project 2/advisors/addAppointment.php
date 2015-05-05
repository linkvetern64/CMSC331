<?php
session_start();
require_once("libs.php");

$appDate = $_POST["appointmentDate"];
$appStart = $_POST["appointmentStart"];
$studentIDs = $_POST["studentIDs"];
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
	//Check to see if the row exists in the table if it does update it, otherwise insert it
	$results = mysql_query("SELECT  `" . $appStart ."` 
	FROM  `Calendar` 
	WHERE id = " . $User_ID . "
	AND Date_ID =  '" . $appDate . "'");
	$items = mysql_fetch_array($results);
	//print_r($items);
	
	if ($answer == "add") {          
		if(is_null($items[0])){
		$query = "INSERT INTO  `Calendar` (  `" . $appStart ."`  ,  `id` ,  `Date_ID` , `Calendar_Key` ) 
		VALUES (
				'" . $studentIDs . "', " . $User_ID . ",  '" . $appDate . "',  '" . $Calendar_Key . "'
				)
				ON DUPLICATE KEY UPDATE `" . $appStart . "` = '" . $studentIDs . "'";
				
		mysql_query($query);
	}    
	}
	else if($answer == "edit"){
		
		$query = "UPDATE  `Calendar` SET  `" . $appStart ."` = CONCAT(  `" . $appStart ."` ,  '" . $studentIDs . "' ) WHERE  `Calendar_Key` =  '" . $Calendar_Key . "'";
		mysql_query($query);
	}
	else {
		$query = "UPDATE  `Calendar` SET  `" . $appStart ."` = NULL WHERE  `Calendar_Key` =  '" . $Calendar_Key . "'";
		mysql_query($query);
	}
	

	disconnect($conn);
	header("Location:granted.php");
