$(function(){

   $('#btn-bparcial').click(function(e){
      e.preventDefault();

      var form = new FormData($('#form-bparcial')[0]);

      $.ajax({
         data: form,
         url: '/bodega/realizar-baja-parcial',
         type: 'post',
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);
         if(data.satisfactorio){

            console.log('bien');
            alertify.logPosition("top right");
            alertify.success("Baja con exito");
            $('#btn-prestamo').attr('disabled','disabled');
            $('#btn-pdf-prestamo').removeAttr('disabled');
            var rutapdf = "/bodega/prestamo-pdf/"+data.idprestamo;
            $('#btn-pdf-prestamo').attr("href",rutapdf);
         }
         else{

            alertify.logPosition("top right");
            alertify.error(data.error[0]);
         }

      });
   });

});
