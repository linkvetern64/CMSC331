<?php
// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//	      or cancel any or all of the previous appointments
//
// myFunctions.php : - includes global functions to setTime, formatTime, formatDate, and ifempty 
//                   - provides global functions to be used for sets of pages
//
//setTime: parameters include a time array, its length, and another time variable 
//	   if the time variable and index of time array are the same
//	      the time has already been appointed to someone else
//	      therefore set the time to NULL ==> 
//	   otherwise check if it exists in proceeding index
//	   does not return, but it does change the array elements


function setTime(&$array, $len, $time) 
{
   $counter = $len;

   while($counter >= 0)
   {
	if($array[$counter] == $time)
	{
	    $array[$counter] = NULL;
	}
	$counter = $counter - 1;
   }
}

//formatTime: parameter includes a time variable (format as follows: H:i:S)
//	      if the time is 12:00:00 then formats it to 12:00 PM
//	      if the time is 09:00:00 then formats it to 09:00 AM
//	      returns the formatted time
function formatTime($time)
{
   $t_arr = explode(":", $time);
   $hour = $t_arr[0];
   $minutes = $t_arr[1];
   $number = $hour.$minutes;
   $formatted = $hour.":".$minutes;

 if($number == NULL)
 {
    return NULL;
 }
 else
 {
   if($formatted == "12:00")
   {
	$formatted = $formatted." PM";
   }
   elseif($formatted == "12:30")
   {
	$formatted = $formatted." PM";
   }
   elseif($formatted == "01:00")
   {
	$formatted = $formatted." PM";
   }
   elseif($formatted == "01:30")
   {
	$formatted = $formatted." PM";
   }
   elseif($formatted == "02:00")
   {
	$formatted = $formatted." PM";
   }
   elseif($formatted == "02:30")
   {
	$formatted = $formatted." PM";
   }
   elseif($formatted == "03:00")
   {
	$formatted = $formatted." PM";
   }
   elseif($formatted == "03:30")
   {
	$formatted = $formatted." PM";
   }
   else
   {
	$formatted = $formatted." AM";
   }
   return $formatted;
 }
}

//formatDate: parameter includes a date variable (format as follows: yyyy-mm-dd)
//	      if the date is 2015-03-22 then formats it to 03/22/2015
//	      returns the formatted date
function formatDate($date)
{
  $date_arr = explode("-", $date);
  $year = $date_arr[0];
  $month = $date_arr[1];
  $day = $date_arr[2];
  $formatted = $month."/".$day."/".$year;

  return $formatted;
}

//ifempty: parameter includes an array
//	   if it has NO element returns 1
//	   otherwise returns 0
function ifempty(&$array)
{
  $counter = "";

  foreach($array as $element)
  {
     $counter = "".$element; 
  }
  
  if($counter == "")
  {
     return 1;
  }
  else
  {
     return 0;
  }
}

//
//availableDate: parameters passed in are day and advisor name
//		 The function determines the day of the week
//		 and looks up the advisor ID
//		 Then checks if that advisor's availability is set
//		 and if so returns a boolean true/false while
//		 updating the relevant session information
function availableDate($date,$advisor) {
	 //Determine advisor key
	 $conn = connect();
		 
	//Gathers the private key to validate the login user
	$advisorName = explode(" ",$advisor);
	$result1 = mysql_fetch_array(mysql_query("SELECT `id` FROM `Advisors` WHERE firstName = '$advisorName[0]' AND lastName = '$advisorName[1]'"));
	$advisor_id = $result1[0];
	$_SESSION['advisor_id'] = $advisor_id;
	
	//Checks what day of the week it is
	$dayOfWeek = date('l',strtotime($date));

	//Check if that advisor has availability that day, return result
	$result2 = mysql_fetch_array(mysql_query("SELECT `" . $dayOfWeek . "` FROM `Availability` WHERE id = $advisor_id"));
	disconnect($conn);

	$available = $result2[0];

	return $available;	
}

//
//createCalendarKey: parameters passed in are day and advisor name
//		 The function creates a calendar key if it does not exists
//		 already. If it does exist, it returns false.

function createCalendarKey($date,$advisor_id){
	 $appt_Key = $advisor_id."/".$date;

	 $conn = connect();
	$results = mysql_fetch_array(mysql_query("SELECT `Calendar_Key` FROM `Calendar` WHERE id = '$advisor_id' AND Date_ID = '$date'"));
	disconnect($conn);

	 //The logic to create a key
	 $_SESSION['appt_Key'] = $appt_Key;
	 
	 //If the object existed, return true
	 if($results[0]){
	 return 1;
	 }

	 //The alternative to return that the key did not exist
	 else {
	 return 0;
	 }
}

?>