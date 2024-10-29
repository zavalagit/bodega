$(function(){

   $('#colectivo-parentesco-agregar').click(function(e){
      e.preventDefault();
      //console.log('entra');
      let _token = $('#meta-csrf-token').attr('content');
      let accion = $(this).attr('data-accion');

      $.ajax({
         type: "post",
         url: "/colectivo-form-parentesco/"+accion,
         data: {'_token': _token},
         // dataType: "dataType",
         success: function (vista) {
             console.log(vista);
            $('#seccion-colectivo-parentesco .colectivo-parentesco:last').after(vista);
            //$('select').formSelect();
			$('select').material_select();
            input_objeto_aportado_index(); //funcion_global
         }
      });
   });

   $('body').on('click','.colectivo-parentesco-eliminar',function(e){
      e.preventDefault();
      if ($('#seccion-colectivo-parentesco .colectivo-parentesco').length > 1) {
         $(this).parent().parent().remove();
         input_objeto_aportado_index(); //funcion_global
      }  
   });



   /**---------- */

   $('.btn-modal-parentesco').click(function(e){
      e.preventDefault();
      let _token = $('#meta-csrf-token').attr('content');
      let colectivo_id = $(this).attr('data-colectivo-id');
      $.ajax({
         type: "post",
         url: '/colectivo-parentesco-modal/'+colectivo_id,
         data: {'_token':_token},
         // dataType: "dataType",
         success: function (vista) {
            console.log(vista);


            $('#modal-parentesco .modal-content').empty();
            $('#modal-parentesco .modal-content').append(vista);
            $('#modal-parentesco').modal('open');
         }
      });
   });
});