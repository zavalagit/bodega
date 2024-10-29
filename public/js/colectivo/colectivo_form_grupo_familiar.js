$(function(){

   $('body').on('submit','#form-grupo-familiar',function(e){
      e.preventDefault();

      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         beforeSend: function(){
            $('#btn-colectivo').empty().prop("disabled",true).append('Enviando...');
         },
         complete:function(respuesta){
            // console.log(respuesta);
            /*
            * Se ejecuta al termino de la petición
            * */

            //spin
            
         },
         success: function(respuesta) {
               alertify.success("GRUPO FAMILIAR MODIFICADO");
               setTimeout(function(){
                  location.reload();
                  // alertify.log("PUEDE CONTINUAR CAPTURANDO");
               },3000);
         },
         error: function(respuesta){
            $('#btn-colectivo').empty().prop("disabled",false).append('Registrar');
            // console.log(response);
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey][0]);

            //aletifyjs
            // alertify.set('notifier','position', 'top-center');
            // alertify.set('notifier','delay', 4);
            // alertify.error(respuesta.responseJSON.errors[firstKey][0]);
         }
      });
   });

});