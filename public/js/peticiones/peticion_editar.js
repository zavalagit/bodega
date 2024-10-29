$(function(){
    $('.btn-peticion-editar').click(function(e){
        e.preventDefault();
        var form = new FormData($('#form-peticion-editar')[0]);
    
        $(this).attr('disabled','on');
    
        $.ajax({
          data: form,
          url: "/peticion-guardar/editar",
          type: "post",
          processData: false,
          contentType: false,
        }).done(function(data){
            //console.log(data);
    
    
          if(data.satisfactorio){
            //alertify.logPosition("top right");
            alertify.success("¡CAMBIOS CON EXITO!");
            //alertify.success("Espere un momento.");
                    
            setTimeout(function(){
              var url_back =  document.referrer;
              window.location = url_back;
            //window.location.href = 'anexos-pdf/'+data.id;
            },1500);
        
          }
          else {
            //alertify.logPosition("top right");
            alertify.error(data.error[0]);
            $('.btn-peticion-editar').removeAttr('disabled');
          }
    
        });//ajax
  
    });
});