$(function(){
    
   $('#especialidad-select').change(
       function(){
           $.ajax({            
               type: 'post',
               url: '/get-solicitudes-options/'+$(this).val(),
               data: {_token : $('meta[name="csrf-token"]').attr('content'),},
           }).done(function(view){
               console.log(view);
               $('#solicitud-select').empty().append(view);
               $('select').formSelect();
           });
       }
   );

});
