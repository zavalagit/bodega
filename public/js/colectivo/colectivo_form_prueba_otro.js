$(function() {
   
   $('.prueba-checkbox').click(function () { 
      let id_prueba = $(this).attr('data-prueba-id');

      if (id_prueba == 5) {
         if( $(this).prop('checked') ){
            $('#otro-tipo-muestra input').val('');
            $('#otro-tipo-muestra').removeClass('hide');
            $('#otro-tipo-muestra input').focus();
         }
         else{
            $('#otro-tipo-muestra').addClass('hide');
         }
      }
   });

});