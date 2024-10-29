$(function(){

   $('#form-baja').submit(function(e){
      e.preventDefault();
      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         beforeSend: function(){
            $('#btn-baja').empty().prop("disabled",true).append('Enviando...');
         },
         complete:function(respuesta){
            // console.log(respuesta);
            /*
            * Se ejecuta al termino de la petición
            * */

            //spin
            
         },
         success: function(respuesta){
            console.log(respuesta);

            $('#btn-baja-pdf').attr('href','/bodega/baja-pdf/'+respuesta.baja_id);
            $('#btn-baja').parent().addClass('scale-out');
            $('#btn-baja-pdf').parent().removeClass('scale-out').addClass('scale-in');
            alertify.success("Baja realizada")
         },
         error: function(respuesta){
            $('#btn-baja').empty().prop("disabled",false).append('Registrar');
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey][0]);
         }
      });
   });

});
