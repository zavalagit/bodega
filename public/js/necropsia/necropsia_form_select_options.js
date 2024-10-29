$(function(){
    
   $('#necropsia-clasificacion-select').change(
       function(){
           $.ajax({            
               type: 'post',
               url: '/get-necropsias-options/'+$(this).val(),
               data: {_token : $('meta[name="csrf-token"]').attr('content'),},
           }).done(function(view){
               console.log(view);
               $('#necropsia-select').empty().append(view);
               $('select').formSelect();
           });
       }
   );

});
