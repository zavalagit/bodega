$(function(){
    
   $('#unidad1-select').change(
       function(){
           $.ajax({            
               type: 'post',
               url: '/get-unidades-options/'+$(this).val(),
               data: {_token : $('meta[name="csrf-token"]').attr('content'),},
           }).done(function(view){
               console.log(view);
               $('#unidad2-select').empty().append(view);
               $('select').formSelect();
           });
       }
   );

});
