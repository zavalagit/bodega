$(function(){

    $('#btn-ubicacion-editar').click(function(e){
        e.preventDefault();

        var form =  new FormData($('#form-ubicacion-editar')[0]);
        let id = $('#form-ubicacion-editar').attr('data-id');
        
        $(this).attr('disabled','on');
       
        $.ajax({
            data: form,
            url: "/ubicacion-agregar/"+id,
            type: "post",
            processData: false,
            contentType: false,
          }).done(function(data){
            console.log(data);
      
      
            if(data.satisfactorio){
              //alertify.logPosition("top right");
              alertify.success("¡SE MODIFICO CON EXITO!");
              //alertify.success("Espere un momento.");
              setTimeout(function(){
                location.reload();
              },2000);
            }
            else {
              //alertify.logPosition("top right");
              alertify.error(data.error[0]);
              $('#btn-ubicacion-agregar').removeAttr('disabled');
            }
        });//ajax
        
    });

});