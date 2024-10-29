$(function(){
    $('body').on('click','#ubicacion-general-btn',function(e){
        e.preventDefault();
        var form =  new FormData($('#form-ubicacion')[0]);
        $(this).attr('disabled','on');

        $.ajax({
            data: form,
            url: "/ubicacion-general-guardar",
            type: "post",
            processData: false,
            contentType: false,
          }).done(function(data){
            console.log(data);
      
      
            if(data.satisfactorio){
              //alertify.logPosition("top right");
              alertify.success("¡REGISTRO CON EXITO!");
              //alertify.success("Espere un momento.");
              setTimeout(function(){
                location.reload();
              },1500);
            }
            else {
              //alertify.logPosition("top right");
              alertify.error('Error al Guardar');
              $('#ubicacion-general-btn').removeAttr('disabled');
            }
      
          });//ajax

    });
})