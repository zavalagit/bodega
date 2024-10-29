$(function(){

   $(document.body).on('submit','#form-prestamo,#form-reingreso',function(e){
      e.preventDefault();
      console.log($(this).attr('action'));

      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         success: function(respuesta){
            console.log(respuesta);

            if(respuesta.status){
               if (respuesta.formAccion == 'prestar') {
                  $('#btn-prestar').parent().addClass('ocultar');
                  $('#btn-realizar-reingreso').attr('href',route('prestamo_form',{formAccion:'reingresar',cadena:$('#btn-realizar-reingreso').attr('data-cadena-id'),prestamo:respuesta.prestamo.id}));
                  $('#btn-realizar-reingreso').parent().removeClass('ocultar');
                  $('#btn-prestamo-pdf').parent().removeClass('ocultar');
                  $('#btn-prestamo-pdf').attr('href','/bodega/prestamo-pdf/'+respuesta.prestamo.id);
                  alertify.success("Prestamo realizado");
               }
               else if( respuesta.formAccion == 'reingresar' ){
                  alertify.success("Reingreso realizado");
               }
               else if( respuesta.formAccion == 'editar' ){
                  alertify.success("Update realizado");
               }

               // if (prestamo_tipo == 'prestamo-unico') {
               //    $('#btn-prestamo-pdf').attr('href','/bodega/prestamo-pdf/'+respuesta.prestamo_pdf);
               // }
               // else if(prestamo_tipo == 'prestamo-multiple'){
               //    $('#btn-prestamo-pdf').attr('href','/bodega/prestamo-multiple-pdf/'+respuesta.prestamo_pdf);
               // }
               

               $('.indicio-checkbox').prop('disabled',true);
            }
            else{
               console.log('algo anda mal');
               console.log(prestamo.prestamo_pdf);
            }
         },
         error: function(respuesta){
            console.log(respuesta);
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey][0]);
         }
      });
   });

   // $('#btn-realizar-reingreso').click(function(e){
   //    e.preventDefault()
   //    $('#form-prestamo').attr('action',route('prestamo_save',{formAccion:'reingresar',prestamo:$(this).attr('data-prestamo-id')}))
   //    $('#section-reingreso').removeClass('ocultar');
   //    $('#btn-realizar-reingreso').parent().addClass('ocultar')
   // });
});