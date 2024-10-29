$(function() {


  //Btn CLONAR GUARDAR CADENA
  $('#btn-clonar').click(function(e) {
    e.preventDefault();

    var form = new FormData($('#form-clonar')[0]);
    $(this).attr('disabled', 'on');
    var id = $(this).attr('data-id');


    $.ajax({
      data: form,
      url: "/cadena-guardar",
      type: "post",
      processData: false,
      contentType: false,
    }).done(function(data) {

      if (data.satisfactorio) {
        //alertify.logPosition("top right");
        alertify.success("NUEVA CADENA CON EXITO");
        //alertify.success("ESPERE UN MOEMENTO");
        setTimeout(function() {
          window.location.href = '/consultar-cadena?buscar=' + data.nuc;
          //window.location.href = 'anexos-pdf/'+data.id;
        }, 2000);
      } else {
        //alertify.logPosition("top right");
        alertify.error(data.error[0]);
        $('#btn-clonar').removeAttr('disabled');
      }

    });
  });//#btn-clonar

});//JQuery
