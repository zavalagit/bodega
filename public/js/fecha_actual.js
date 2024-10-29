$(function(){

	//Fecha por default
   	var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month; //concatenando (debido que el mes esta en un digito)
    if (day < 10) day = "0" + day;	//concatenando (debido que el día esta en un digito)

    var today = year + "-" + month + "-" + day;
    $("#intervencion_fecha").attr("value", today);


});
