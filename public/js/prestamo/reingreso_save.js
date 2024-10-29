$(function(){
   $('#btn-reingreso').click(function(e){
      e.preventDefault();

      console.log('vamos bien');
      var form = new FormData($('#form-reingreso')[0]);

      $.ajax({
         url: '/bodega/reingreso-save',
         type: 'post',
         data: form,
         processData: false,
         contentType: false,
         success: function(respuesta){
            if (respuesta.satisfactorio) {
               $('#btn-reingreso').attr('disabled','disabled');
               alertify.success("REINGRESO CON EXITO");
               setTimeout(function(){
                  window.close();
               },2000);
            }
            else{
               console.log('Todo mal en satisfactorio');
               console.log(respuesta.request);
               console.log(respuesta.prestamos);
            }
         },
         error: function(respuesta){
            console.log('Todo mal en error');
            console.log(respuesta);
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey]);
         }
      });
   });
});
