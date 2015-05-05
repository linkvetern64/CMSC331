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
//	      if the time is 10:00:00 then formats it to 10:00 AM
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
   elseif($formatted == "02:30")
   {
	$formatted = $formatted." PM";
   }
   elseif($formatted == "03:00")
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

?>