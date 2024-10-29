$(function(){

   $('#btn-lugar').click(function(e){
      e.preventDefault();
      var form = new FormData($('#form-lugar')[0]);
      console.log('hola-lugar');
      $.ajax({
         data: form,
         url: '/bodega/store-lugar',
         type: 'post',
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);
         if(data.satisfactorio){
             alertify.logPosition("top right");
             alertify.success("Se agregó un nuevo lugar");

             setTimeout(function(){
               location.reload();
            },2000);
          }
          else {
             alertify.logPosition("top right");
             alertify.error(data.error[0]);
          }
      });
   });

   $('#btn-charola').click(function(e){
      e.preventDefault();
      var form = new FormData($('#form-charola')[0]);
      console.log('hola-charola');
      $.ajax({
         data: form,
         url: '/bodega/store-charola',
         type: 'post',
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);
         if(data.satisfactorio){
             alertify.logPosition("top right");
             alertify.success("Se agregó una nueva charola");
          }
          else {
             alertify.logPosition("top right");
             alertify.error(data.error[0]);
          }
      });
   });

   $('#btn-caja').click(function(e){
      e.preventDefault();
      var form = new FormData($('#form-caja')[0]);
      console.log('hola-caja');
      $.ajax({
         data: form,
         url: '/bodega/store-caja',
         type: 'post',
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);
         if(data.satisfactorio){
             alertify.logPosition("top right");
             alertify.success("Se agregó una nueva caja");
          }
          else {
             alertify.logPosition("top right");
             alertify.error(data.error[0]);
          }
      });
   });


   $('.indicio').click(function(e){
      e.preventDefault();
      console.log('me dieron click');

      var id_indicio = $(this).attr('data-id');
      var identificador = $(this).attr('data-identificador');
      var descripcion = $(this).attr('data-descripcion');

      $('#info-indicio').html("<b>"+identificador+": "+"</b>"+descripcion);
      $('#id_indicio').val(id_indicio);
      //$('#modal-resguardo').modal('open');
   });

   $('#btn-resguardar').click(function(e){
      e.preventDefault();
      var form = new FormData($('#form-resguardar')[0]);

      $.ajax({
         data: form,
         url: '/bodega/store-ubicacion',
         type: 'post',
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);
         if(data.satisfactorio){
             alertify.logPosition("top right");
             alertify.success("Indicio(s) Resguardado(s)");
             setTimeout(function(){
               location.reload();
            },1300);
          }
          else {
             alertify.logPosition("top right");
             alertify.error(data.error[0]);
          }
      });

   });

   $('#indicios').click(function(e){
      e.preventDefault();

      var folio = $(this).attr('data-folio');
      $('#folio').val(folio);
   });

   $('#btn-resguardar-todo').click(function(e){
      e.preventDefault();
      var form = new FormData($('#form-resguardar-todo')[0]);

      $.ajax({
         data: form,
         url: '/bodega/resguardar-todo',
         type: 'post',
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);
         if(data.satisfactorio){
             alertify.logPosition("top right");
             alertify.success("Indicios Resguardados");
             setTimeout(function(){
               location.reload();
            },1300);
          }
          else {
             alertify.logPosition("top right");
             alertify.error(data.error[0]);
          }
      });

   });

});
