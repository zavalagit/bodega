$(function() {
   
   $('.prueba-checkbox').click(function () { 

      let id_prueba = $(this).attr('data-prueba-id');

      if( $(this).prop('checked') ){
         $('#prueba-cim-'+id_prueba).prop('disabled',false);
         $("[for='prueba-cim-"+id_prueba+"'] .asterisco").append('*');
         $('#prueba-cim-'+id_prueba).focus();
      }
      else{
         $('#prueba-cim-'+id_prueba).val('');
         $("[for='prueba-cim-"+id_prueba+"'] .asterisco").empty();
         $('#prueba-cim-'+id_prueba).prop('disabled',true);
      }
      
   });

});