$(function(){

   $('#unidad-select').change(  
       function(){
           $.ajax({
               type: 'post',
               url: '/get-especialidades-options/'+$(this).val(),
               data: {_token : $('meta[name="csrf-token"]').attr('content'),},
           }).done(function(view){
               $('#especialidad-select').empty().append(view);
               $('#solicitud-select').empty();
               $('select').formSelect();
           });
       }
   );

});