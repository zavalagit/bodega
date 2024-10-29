$(function(){

   $('body').on('change','.parentesco-select',function(e){
      // e.preventDefault();
      console.log($(this).val());

      let _token = $('#meta-csrf-token').attr('content');
      let accion = $(this).attr('data-accion');
      let parentesco_select = $(this);

      // console.log('accion: '+accion);

      if( $(this).val() ==  '10' ){
         $.ajax({
            type: "post",
            url: "/colectivo-form-parentesco-otro/"+accion,
            data: {'_token': _token},
            // dataType: "dataType",
            success: function (vista) {
               // console.log(vista);
               parentesco_select.parent().parent().after(vista);
            }
         });
      }else{
         console.log('hermanos: ' +$(this).parent().parent().siblings('div.parentesco-otro').length );
         
         if ( $(this).parent().parent().siblings('div.parentesco-otro').length > 0 ) {
            $(this).parent().parent().siblings('div.parentesco-otro').remove();
         }
      }

   });

});