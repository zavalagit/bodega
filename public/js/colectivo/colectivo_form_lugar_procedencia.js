$(function(){

   // $('#colectivo-entidad-select').change(function(){
   //    if ( $(this).val() == '16' ) {
   //       $('#colectivo-delegacion-select').prop('disabled',false);
   //    }else{
   //       $('#colectivo-delegacion-select').children('option').prop('selected',false);
   //       $('#colectivo-delegacion-select').prop('disabled',true);
   //    }
   //    $('select').formSelect();

   // });
   
   $('#colectivo-entidad-select').change(function(){
      let _token = $('#meta-csrf-token').attr('content');
      $.ajax({
         type: "post",
         url: "/colectivo-form-municipio-procedencia/"+$(this).val(),
         data: {'_token': _token},
         // dataType: "dataType",
         success: function (vista) {
            console.log(vista);
            $('#colectivo-delegacion-select').empty().append(vista);
            //$('select').formSelect();
			$('select').material_select();

            // $('div.colectivo-parentesco:eq('+div_colectivo_parentesco_index+')').append(vista);
            // $('div.colectivo-parentesco:eq('+div_colectivo_parentesco_index+') .div-btn-objeto-eleminar').removeClass('hide');
            // input_objeto_aportado_index(); //funcion_global

            // if( $('.div-objeto-aportado').length >= 3 ){
            //    $('#id-div-btn-objeto-agregar').addClass('hide')
            // }
         }
      });
   });


      // $('select').formSelect();

   // });


});