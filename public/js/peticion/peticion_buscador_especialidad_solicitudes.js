$(function(){
   $('#b-especialidad').change(function(){
      if ( $(this).val() == 0 ) {
         $('#select-solicitud').addClass('hide');
         $('#hr-select-solicitud').addClass('hide');
      }else{
         $.ajax({
            type: "post",
            url: "/get-solicitudes-form-select/"+$(this).val(),
            data: {_token:$('#meta-csrf-token').attr('content')},
            // dataType: "dataType",
            success: function (vista) {
               console.log(vista);
               $('#b-solicitud').empty().append(vista);
               $('#select-solicitud').removeClass('hide');
               $('#hr-select-solicitud').removeClass('hide');         
               $('select').formSelect();
            }
         });
      }
   });
});