$(function(){
    
    $('#especialidad-select').change(function(){
            
        console.log($('#especialidad-select').val());

        var especialidad_id = $('#especialidad-select').val();
        
    
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {especialidad_id: especialidad_id},
            url: '/get-solicitudes',
            type: 'post',
        }).done(function(data){
           
    
            console.log(data);
            

            let option='<option value="" selected>SELECCIONA EL TIPO DE SOLICITUD</option>';
            $.each(data,function(i,valor){
                
                $.each(valor,function(j,v){
                    var n = j+1;
                    option = option + '<option value="'+v['id']+'">'+n+'.- '+v['nombre']+'</option>';
                    
                });
                
            });
            
            console.log(option);
            
            $('#solicitud-select').children().remove();
            $('select').material_select();
            $('#solicitud-select').append(option);
            $('select').material_select();
            
        });
           
    
    
    });

});
