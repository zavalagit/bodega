$(function(){
   $('.btn-inhabilitar').click(function(e){
      e.preventDefault();
      let cadena_folio = $(this).attr('data-cadena-folio');
      let cadena_id = $(this).attr('data-cadena-id');
      $("#modal-inhabilitar #modal-header .header-folio").empty();
      $("#modal-inhabilitar #modal-header .header-folio").append(cadena_folio);
      $("#modal-inhabilitar #modal-body #modal-contenido").empty();
      $("#modal-inhabilitar #modal-body #modal-contenido").append('<p style="text-align:center; font-size:20px;"><b>¿Quieres inhabilitar la cadena?</b></p>');
      let opciones =
         '<div class="col s6 center-align">'+
            '<a href="" class="btn-cadena-editar" data-cadena-id="'+cadena_id+'"><i style="vertical-align:3px; color:#394049;" class="fas fa-thumbs-up fa-lg"></i> <span style="font-size: 20px; color: #394049;"><b>Si</b></span></a>'+
         '</div>'+
         '<div class="col s6 center-align">'+
            '<a href="" class="btn-inhabilitar-opcion" data-opcion="no"><i style="vertical-align:2px; color:#394049;" class="fas fa-thumbs-down fa-lg"></i> <span style="font-size: 20px; color: #394049;"><b>No</b></span></a>';
         '</div>';
      $("#modal-inhabilitar #modal-body #modal-contenido").append(opciones);
      $('#modal-inhabilitar').modal('open');
   });
   /*opcion de inhabilitar*/
   $('body').on('click','.btn-inhabilitar-opcion',function(e){
      e.preventDefault();
      let opcion = $(this).attr('data-opcion');
      let cadena_id = $(this).attr('data-cadena-id');
      let _token = $('meta[name="csrf-token"]').attr('content');
      if (opcion === 'si'){
         let cadena_editar = 'no';
         $.ajax({
            url: '/cadena-editar-habilitar',
            type: 'POST',
            data: {_token:_token,id:cadena_id,cadena_editar:cadena_editar},
            success:function(data){
               if(data.satisfactorio){
                  alertify.success("Se inhabilito la Cadena. Espere...");
                  setTimeout(function(){
                     location.reload();
                  },1400);
               }
               else{
                  console.log('Todo mal');
               }
            }
         });
      }
      else if (opcion === 'no'){ 
         $('#modal-inhabilitar').modal('close');
      }
   });
});
