$(function(){

   $('#form-depuracion').submit(function(e){
      e.preventDefault();
      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         beforeSend: function(){
            $('#btn-depuracion').empty().prop("disabled",true).append('Enviando...');
         },
         complete:function(respuesta){
            //console.log(respuesta);
            /*
            * Se ejecuta al termino de la petición
            * */

            //spin
            
         },
         success: function(respuesta){
            /*
            * Se ejecuta cuando no hay ningun error
            * */
            //console.log(respuesta);

            // $('#btn-depuracion-pdf').attr('href','/bodega/baja-pdf/'+respuesta.baja_id);
            // $('#btn-depuracion').parent().addClass('scale-out');
            // $('#btn-depuracion-pdf').parent().removeClass('scale-out').addClass('scale-in');
            alertify.success("Depuracion registrada")
         },
         error: function(respuesta){
            $('#btn-depuracion').empty().prop("disabled",false).append('Registrar');
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey][0]);
         }
      });
   });

});
