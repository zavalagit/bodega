// eliminar-archivo
$(function(){

   //input-raddio-modelo
   $('.input-radio-modelo').click(function(){
      // e.preventDefault();
      // console.log('holasd');
      // console.log( $(this).val() );
      // $('.input-radio-modelo').removeAttr('disabled');
      // $(this).prop('disabled',true);

      if( $(this).val() == 'region' ){
         $('#select-modelo-region').removeClass('hide');
         $('#select-modelo-region select').removeAttr('disabled');
         $('#hr-modelo-region').removeClass('hide');
         
         $('#select-modelo-unidad').addClass('hide');
         $('#hr-modelo-unidad').addClass('hide');
      }
      else if( $(this).val() == 'unidad' ){
         $('#select-modelo-unidad').removeClass('hide');
         $('#select-modelo-unidad select').removeAttr('disabled');
         $('#hr-modelo-unidad').removeClass('hide');

         $('#select-modelo-region').addClass('hide');
         $('#hr-modelo-region').addClass('hide');
      }
      else if( $(this).val() == 'administrador' ){
         $('#select-modelo-region').addClass('hide');
         $('#hr-modelo-region').addClass('hide');

         $('#select-modelo-unidad').addClass('hide');
         $('#hr-modelo-unidad').addClass('hide');
      }

      $('select').formSelect();
      
   });


   $('#b-region').change(function(){
      console.log('entrasflll');
      if( $(this).val() == 4 ){
         $("#select-unidad").removeClass('hide');
         $("#hr-select-unidad").removeClass('hide');
      }else{
         $("#select-unidad").addClass('hide');
         $("#hr-select-unidad").addClass('hide');
         $('select#b-unidad option:selected').prop('selected',false);
         $('select#b-unidad').formSelect();
      }
   });

});