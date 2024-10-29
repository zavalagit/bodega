$(function(){

	//2. Documentacion
      //Disabled Documentacion
      $('#otroSi').click(function(){
         console.log('holasi');
         $('#especifique').removeAttr('disabled');
      });
      $('#otroNo').click(function(){
         console.log('holano');
         $('#especifique').attr('disabled','true');
      });

});