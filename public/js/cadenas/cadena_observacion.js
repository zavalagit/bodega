$(function(){
   $('.btn-observacion').click(function(e){
      e.preventDefault()
      let cadena_folio = $(this).attr('data-cadena-folio');
      let cadena_observacion = $(this).attr('data-cadena-observacion');
      $("#modal-observacion #modal-header .header-folio").empty();
      $("#modal-observacion #modal-header .header-folio").append(cadena_folio);
      $("#modal-observacion #modal-body #modal-contenido").empty();
      $("#modal-observacion #modal-body #modal-contenido").append('<p><b>'+cadena_observacion+'</b></p>');
      $('#modal-observacion').modal('open');
   });
});