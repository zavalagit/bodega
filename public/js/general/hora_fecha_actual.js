$(function(){
   //Determinando la hora actual
   var date = new Date();
   var h = date.getHours();
   var m = date.getMinutes();
   if (h < 10) h = "0"+h;
   if (m < 10) m = "0"+m;
   var hora = h + ":" + m;
   $('.hora-actual').attr('value',hora);

   //Determinando la fecha actual
   var date = new Date();
   var day = date.getDate();
   var month = date.getMonth() + 1;
   var year = date.getFullYear();
   if (month < 10) month = "0" + month;
   if (day < 10) day = "0" + day;
   var today = year + "-" + month + "-" + day;
   $('.fecha-actual').attr("value", today);
});
