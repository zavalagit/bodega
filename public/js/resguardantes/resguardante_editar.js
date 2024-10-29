$(function(){

   $('#btn-usuario-editar').click(function(e){
      e.preventDefault();
      var form = new FormData($('#form-resguardante-editar')[0]);
      $(this).attr('disabled','on');
      $id_resguardante = $('#id-resguardante').val();
      
      $.ajax({
         data: form,
         url: "/administrador/resguardante-guardar/"+$id_resguardante,
         type: "post",
         processData: false,
         contentType: false,
      }).done(function(data){
         //console.log(data);
         if(data.satisfactorio){
            //alertify.logPosition("top right");
            alertify.success("Se edito usuario :D");
            //alertify.success("Espere un momento.");
            setTimeout(function(){
            var url_back =  document.referrer;
            window.location.href = url_back;
            },2000);
            
         }
         else{
            //alertify.logPosition("top right");
            alertify.error(data.error[0]);
            $('#btn-usuario-editar').removeAttr('disabled');
         }

    });//ajax      

   });

});      