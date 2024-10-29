$(function(){

   $('#unidad-select').change(
      function(){
         console.log( $('#unidad-select').val() );
         
         let unidad_id = $('#unidad-select').val();

         $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {unidad_id: unidad_id},
            url: '/get-especialidades',
            type: 'post',
        }).done(function(data){
            console.log(data);
            

            let option='<option value="" selected>SELECCIONA LA ESPECIALIDAD</option>';
            $.each(data,function(i,valor){
                
                $.each(valor,function(j,v){
                    let n = j+1;
                    option = option + '<option value="'+v['id']+'">'+n+'.- '+v['nombre']+'</option>';
                    
                });
                
            });
            
            console.log(option);

            $('#especialidad-select').empty();
            $('#especialidad-select').append(option);
            $('#especialidad-select').material_select();
            $('#solicitud-select').empty();
            $('#solicitud-select').material_select();
            

        });
      }
   );

});