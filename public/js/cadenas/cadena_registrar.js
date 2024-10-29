$(function(){

  //Boton Registrar Cadena Custodia
  $('#btn-registrar-cadena').click(function(e){
    console.log('entrasdasd');
    e.preventDefault();
    var form = new FormData($('#form-registrar-cadena')[0]);

    $(this).attr('disabled','on');

    $.ajax({
      data: form,
      url: "/cadena-guardar",
      type: "post",
      processData: false,
      contentType: false,
    }).done(function(data){
        //console.log(data);


      if(data.satisfactorio){
        //alertify.logPosition("top right");
        alertify.success("¡REGISTRO CON EXITO!");
        //alertify.success("Espere un momento.");
        setTimeout(function(){
        window.location.href = 'consultar-cadena?buscar='+data.nuc;
        //window.location.href = 'anexos-pdf/'+data.id;
        },2000);
      }
      else {
        //alertify.logPosition("top right");
        alertify.error(data.error[0]);
        $('#btn-registrar-cadena').removeAttr('disabled');
      }

    });//ajax
  });

});
