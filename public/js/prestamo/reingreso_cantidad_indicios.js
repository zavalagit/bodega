$(function () {
   
   $(document.body).on('keyup','.reingreso-canitidad-indicios',function(){
      let indicio_id = $(this).attr('data-indicio-id');
      if ( $(this).val() == '' ) {
         remove_tr(indicio_id);
      }
      else if ( $(this).val() == 0 ) {
         remove_tr(indicio_id);
      }
      else if ( $(this).val() == $(this).attr('data-prestamo-cantidad-indicios') ) {
         remove_tr(indicio_id);
      }
      else if ( $(this).val() != $(this).attr('data-prestamo-cantidad-indicios') ) {
         $.ajax({
            type: "post",
            url: $(this).attr('data-url'),
            data: {_token: $('#meta-csrf-token').attr('content')},
            // dataType: "dataType",
            success: function (view) {
               console.log(view);
               
               if ( $('#reingreso-descripcion-disponible-'+indicio_id).length == 0 ) {
                  $('#tabla-reingreso-descripcion-disponible').removeClass('ocultar');
                  $('#tabla-reingreso-descripcion-disponible tbody').append(view);
                }

            }
         });
      }
   });

   function remove_tr(indicio_id) {
      $('#reingreso-descripcion-disponible-'+indicio_id).remove();
      if( $('#tabla-reingreso-descripcion-disponible tbody tr').length == 0)  $('#tabla-reingreso-descripcion-disponible').addClass('ocultar');
   }

});
