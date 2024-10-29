$(function(){

   $('.indicio-checkbox').click(function(){
      let indicio_id = $(this).val();
      if($(this).prop('checked')){
         console.log('baja-tipo-'+indicio_id);
         $('#baja-tipo-'+indicio_id).prop('disabled',false);
      }else{
         remove_baja_parcial(indicio_id);

         $('#baja-tipo-'+indicio_id+' option:selected').prop('selected',false);
         $('#baja-tipo-'+indicio_id+' option:first').prop('selected',true);
         $('#baja-tipo-'+indicio_id).prop('disabled',true);

      }

      $('select').formSelect();
   });


   $('.select-baja-tipo').change(function(){
      if( $(this).val() == 'parcial' ){
         $.ajax({
            type: "post",
            url: $(this).attr('data-url'),
            data: {_token: $('#meta-csrf-token').attr('content')},
            // dataType: "dataType",
            success: function (vista) {

               $('#tabla-baja-parcial').removeClass('ocultar');
               $('#tabla-baja-parcial tbody').append(vista);
            }
         });
      }
      else if( $(this).val() == 'completa' ){
         let indicio_id = $(this).attr('data-indicio-id');
         remove_baja_parcial(indicio_id);
      }
   });


   function remove_baja_parcial(indicio_id) {
      $('#baja-parcial-'+indicio_id).remove();      
      if ( $('#tabla-baja-parcial tbody').children('tr').length == 0 ) {
         $('#tabla-baja-parcial').addClass('ocultar');
      }
   }

});