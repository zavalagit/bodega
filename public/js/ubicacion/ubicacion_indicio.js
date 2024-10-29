$(function(){

   $('#ubicacion-indicio-lista').hide();
   $('#form-ubicacion-indicio').hide();

   $('.modal-open-indicio').click(function(e){
      e.preventDefault();
      let id_indicio = $(this).attr('data-indicio-id');
      var ubicacion_indicio =
         '<input type="hidden" value="' + id_indicio + '" name="id_indicio">';
      $('#form-ubicacion-indicio').append(ubicacion_indicio);
      $('#modal-ubicacion-indicio').modal('open');
   });

   //Buscar Ubicacion (lugar)
   $('#ubicacion-indicio-input').keyup(function(){
		var buscar = $(this).val();
      var _token = $('meta[name="csrf-token"]').attr('content');
      

		if (buscar.length > 0) {
			$.ajax({
				url: '/ubicacion-get',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){
               $('#ubicacion-indicio-lista').empty();

               if (data.ubicaciones.length) {
                  $.each(data.ubicaciones, function (i, ubicacion) {
                     $('#ubicacion-indicio-lista').append('<a href="" class="collection-item ubicacion-indicio-item" data-ubicacion-id="' + ubicacion.id + '" data-nombre="' + ubicacion.nombre + '"><b>' + ubicacion.nombre + '</b></a>');
                  });
                  $('#ubicacion-indicio-lista').show();
               } else {
                  $('#ubicacion-indicio-lista').hide();
                  $('#ubicacion-indicio-lista').empty();
               }
				}
			});
		}
		else{
         $('#ubicacion-indicio-lista').hide();
			$('#ubicacion-indicio-lista').empty();
		}
   });

   //Elegir ubicacion (lugar)
   $('body').on('click', '.ubicacion-indicio-item', function (e) {
      e.preventDefault();
      var id_indicio = $(this).attr('data-indicio-id');
      var id_ubicacion = $(this).attr('data-ubicacion-id');
      var ubicacion_nombre = $(this).attr('data-nombre');

      Materialize.updateTextFields();

      $('#ubicacion-indicio-input').hide();
      $('#ubicacion-indicio-input').val('');
      $('#ubicacion-indicio-lista').hide();
      $('#ubicacion-indicio-lista').empty();

      var ubicacion_asignar_id =
         '<input type="hidden" value="' + id_ubicacion + '" name="id_ubicacion">';
      let ubicacion_asignar_nombre =
         '<div class="row">' +
            '<div class="col s12">' +
               '<ul class="collection with-header">' +
                  '<li class="collection-item"><div>' + ubicacion_nombre + '<a href="" id="ubicacion-indicio-x" class="secondary-content"><i style="color:red;" class="fas fa-times-circle"></i></a></div></li>' +
               '</ul>' +
            '</div>' +
         '</div>';
      let ubicacion_asignar_btn =
         '<div class="row">' +
            '<div class="col s1 offset-s10">' +
               '<button id="ubicacion-indicio-btn" class="btn waves-effect waves-light" type="submit">guardar</button>' +
            '</div>' +
         '</div>';



      $('#form-ubicacion-indicio').append(ubicacion_asignar_id);
      $('#form-ubicacion-indicio').append(ubicacion_asignar_nombre);
      $('#form-ubicacion-indicio').append(ubicacion_asignar_btn);
      $('#form-ubicacion-indicio').show();

      Materialize.updateTextFields();
   });

   //Cambiar ubicacion
   $('body').on('click',"#ubicacion-indicio-x",function(e){
      e.preventDefault();
      $('#form-ubicacion-indicio').hide();
      $('#form-ubicacion-indicio').empty();
      $('#ubicacion-indicio-input').show();
      $('#ubicacion-indicio-input').focus();
   });

   //Guardar Ubicacion
   $(function () {
      $('body').on('click', '#ubicacion-indicio-btn', function (e) {
         e.preventDefault();
         var form = new FormData($('#form-ubicacion-indicio')[0]);
         $(this).attr('disabled', 'on');

         $.ajax({
            data: form,
            url: "/ubicacion-indicio-guardar",
            type: "post",
            processData: false,
            contentType: false,
         }).done(function (data) {
            console.log(data);


            if (data.satisfactorio) {
               //alertify.logPosition("top right");
               alertify.success("¡SE ASIGNO LUGAR!");
               //alertify.success("Espere un momento.");
               setTimeout(function () {
                  location.reload();
               }, 1500);
            } else {
               //alertify.logPosition("top right");
               alertify.error('Error al Guardar');
               $('#ubicacion-general-btn').removeAttr('disabled');
            }

         }); //ajax

      });
   })

});