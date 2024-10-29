$(function() {
   
   $('body').on('click','.btn-cadena-reset',function(e){
      e.preventDefault();

      let _token = $('#meta-csrf-token').attr('content');
      let cadena_id = $(this).attr('data-cadena-id');

      $.ajax({
         type: 'post',
         url: '/cadena-reset/'+cadena_id,
         data: {_token:_token},
         success:function(respuesta){
            if(respuesta.status)
               alertify.success("Reset realizado");
            else
               alertify.error("Tiene prestamos");


            setTimeout(function(){
               location.reload();
            },1000);
         },
         error: function(respuesta){
            alertify.error("No se puede hacer reset");
            console.log(respuesta);
         }
      });
   });

});