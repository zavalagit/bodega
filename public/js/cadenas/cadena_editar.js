$(function() {

  $('#btn-editar').click(function(e) {
    e.preventDefault();
    var form = new FormData($('#form-cadena-editar')[0]);
    var id = $(this).attr('data-id');
    var url = "/cadena-guardar/" + id;

    $.ajax({
      data: form,
      url: url,
      type: "post",
      processData: false,
      contentType: false,
    }).done(function(data) {

      if (data.satisfactorio) {
        //alertify.logPosition("top right");
        alertify.success("CADENA EDITADA");

        if(data.tipo_usuario === 'usuario'){
          setTimeout(function() {
            window.location.href = '/consultar-cadena?buscar=' + data.nuc;
            //window.location.href = 'anexos-pdf/'+data.id;
          }, 1000);
        }
        else if (data.tipo_usuario === 'administrador') {
          setTimeout(function(){
            var url_back =  document.referrer;
            window.location.href = url_back;
          },1000);
        }
      }
      else {
        //alertify.logPosition("top right");
        alertify.error(data.error);
        //window.location.href = 'editar-cadena-perito/11';
      }
    });
  });

});
