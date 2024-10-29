$(function(){

   $('body').on('click','#btn-prestamo-editar',function(e){
      e.preventDefault();
      let form = new FormData($('#form-prestamo-editar')[0]);

      $.ajax({
         url: '/bodega/prestamo-editar-save',
         type: 'post',
         data: form,
         processData: false,
         contentType: false,
         success: function(respuesta){
            // console.log(prestamo);

            if(respuesta.satisfactorio){
               // console.log('holasasasas');
               // console.log(respuesta.request);
               alertify.success("Se realizó la edición")
               setTimeout(function(){
                  window.close();
               },2000);
            }
            else{
               console.log('succes: algo anda mal');
            }
         },
         error: function(respuesta){
            // console.log(respuesta);
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey]);
         }
      });
   });
});