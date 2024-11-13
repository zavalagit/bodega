$(function(){
   $('.btn-observacion_indicio').click(function(e){
      e.preventDefault()
      let indicio_nuc = $(this).attr('data-indicio-nuc');
      let indicio_observacion = $(this).attr('data-indicio-observacion');
      $("#modal-observacion #modal-header .header-folio").empty();
      $("#modal-observacion #modal-header .header-folio").append(indicio_nuc);
      $("#modal-observacion #modal-body #modal-contenido").empty();
      $("#modal-observacion #modal-body #modal-contenido").append('<p><b>'+indicio_observacion+'</b></p>');
      $('#modal-observacion').modal('open');
   });
});