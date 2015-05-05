// Name: Deep Patel
// Date: 03/22/2015
// Class: CMSC331
// Project1:  Allows COEIT students to make an individual or group appointment,
//       or cancel any or all of the previous appointments
// 
// create a datepicker calendar that has MINDATE = 3 days; 
//                                       MAXDATE = 09/09/2015
//                                       and disabled SAT & SUN
//                             - best tool for selecting a date!
$("#date").datepicker({
   dateFormat: 'yy-mm-dd',
   changeMonth: true,
   minDate: 3,
   maxDate: '2015-09-09',
   showButtonPanel: true,

   beforeShowDay : function (date)
   {
      var dayOfWeek = date.getDay ();
      // 0 : Sunday, 1 : Monday, ...
      if (dayOfWeek == 0 || dayOfWeek == 6) 
      {
      return [false];
      }
      else 
      {
      return [true];
      }
   }
});