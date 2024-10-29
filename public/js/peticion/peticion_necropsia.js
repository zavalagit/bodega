$(function(){

   $("#unidad-select,#especialidad-select,#solicitud-select").change(
      function() {
         necropsia_campos_ocultar();
         necropsia_apoyo_ocultar();
      }
   );

   $('#solicitud-select').change(
      function() {
         if ( ($('#solicitud-select').val() == '61') || ($('#solicitud-select').val() == '62') ){
            $('.necropsia-campo').fadeIn(800);
            select_documento_emitido(true);
         }else{
            select_documento_emitido(false);
         }            
      }
   );

   $('#necropsia-clasificacion-select').change(
      function() {
         if ( $(this).val() == '1' ) {
            $('#necropsia-apoyo').fadeIn(800);
         }
         else{
            necropsia_apoyo_ocultar();
         }
      }
   );

   $('input[type="radio"][name="unidad_necropsia_apoyo"]').change(function(){
      console.log($('#necropsia-pertenece').attr('data-is-coordinador'));
      console.log($(this).val());
      if ( ($(this).val() == 'no') && $('#necropsia-pertenece').attr('data-is-coordinador') ) {
         console.log('entradasdasd');
         $('#necropsia-pertenece').fadeIn(800);
      }
      else{
         $('#necropsia-pertenece').fadeOut('fast');
         $('#necropsia-pertenece input').prop('checked', false);
      }
   });

});


//funcion global
function necropsia_campos_ocultar(){
   //se ocultan los campos de necropsia
   $('.necropsia-campo').fadeOut('fast');
   //reset al select de necropsia clasificacion
   $('#necropsia-clasificacion-select').prop('selectedIndex',0);
   //se limpia el select de necropsia diafnostico
   $('#necropsia-select').empty();
   
   $('select').formSelect();
}
function necropsia_apoyo_ocultar(){
   $('#necropsia-apoyo').fadeOut('fast');
   $('#necropsia-apoyo input').prop('checked', false);
}
function select_documento_emitido(bit){
   $('#select-documento-emitido option[value!="dictamen"]').prop('disabled',bit);
   $('#select-documento-emitido option[value="dictamen"]').prop('selected',bit);
}