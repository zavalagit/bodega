$(function(){

   $(document).on('click','.btn-objeto-agregar',function(e){
      e.preventDefault();
      
      div_colectivo_parentesco_index = $(this).parent().parent().index( '.colectivo-parentesco' );
      console.log(div_colectivo_parentesco_index);

      let _token = $('#meta-csrf-token').attr('content');
      let accion = $(this).attr('data-accion');

      $.ajax({
         type: "post",
         url: "/colectivo-form-objeto-donado/"+accion,
         data: {'_token': _token},
         // dataType: "dataType",
         success: function (vista) {
            // console.log(vista);
            $('div.colectivo-parentesco:eq('+div_colectivo_parentesco_index+')').append(vista);
            //M.updateTextFields();
			Materialize.updateTextFields();
            $('div.colectivo-parentesco:eq('+div_colectivo_parentesco_index+') .div-btn-objeto-eleminar').removeClass('hide');
            input_objeto_aportado_index(); //funcion_global

            // if( $('.div-objeto-aportado').length >= 3 ){
            //    $('#id-div-btn-objeto-agregar').addClass('hide')
            // }
         }
      });
   });

   $('body').on('click','.btn-objeto-eliminar',function(e){
      e.preventDefault();
      div_colectivo_parentesco_index = $(this).closest('.colectivo-parentesco').index( '.colectivo-parentesco' );
      
      if ( $('div.colectivo-parentesco:eq('+div_colectivo_parentesco_index+') .div-objeto-aportado').length > 1 ) {
         $(this).closest('.div-objeto-aportado').remove();

         // if( $('.div-objeto-aportado').length < 3 ){
         //    $('#id-div-btn-objeto-agregar').removeClass('hide')
         // }
      }
      
      if ( $('div.colectivo-parentesco:eq('+div_colectivo_parentesco_index+') .div-objeto-aportado').length == 1) {
         $('div.colectivo-parentesco:eq('+div_colectivo_parentesco_index+') .div-objeto-aportado .div-btn-objeto-eleminar').addClass('hide');
      }
   });

   /**
    * funciones
    */
   

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