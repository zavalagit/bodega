$(function(){
	
  //Disabled recomendaciones traslado
  $('#condicionesSi').click(function(){
     $('#recomendaciones').removeAttr('disabled');
  });
  $('#condicionesNo').click(function(){
     $('#recomendaciones').attr('disabled','true');
  });

})