$(function(){

    //Boton Registrar Petición
    $('.btn-peticion-guardar').click(function(e){
      e.preventDefault();
      let accion  = $('#accion').attr('data-accion');
      var form = new FormData($('#form-peticion-registrar')[0]);
      
      console.log('Accion: '+accion);
      

      $(this).attr('disabled','on');
  
      $.ajax({
        data: form,
        url: "/peticion-guardar/"+accion,
        type: "post",
        processData: false,
        contentType: false,
      }).done(function(data){
        console.log(data);

        if(data.satisfactorio){
          //alertify.logPosition("top right");  
          alertify.success("¡REGISTRO CON EXITO!");
          $("#form-peticion-registrar")[0].reset();
          
          setTimeout(function(){
            if(accion == 'registrar'){
              window.location = '/peticion-consultar';
            }
            else if(accion == 'continuar'){
              let url_back = document.referrer;
              window.location = url_back;
            }
            else if(accion == 'clonar'){
              window.location = '/peticion-consultar';
            }
          },1500);        
        }
        else {
          //alertify.logPosition("top right");
          alertify.error(data.error[0]);
          $('.btn-peticion-guardar').removeAttr('disabled');
        }  
      });//ajax


    });


  
});
  