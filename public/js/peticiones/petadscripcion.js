$(function(){

    //console.log($('#petfiscalia-select').val());

    var petfiscalia_id = $('#petfiscalia-select').val();
    
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {petfiscalia_id: petfiscalia_id},
        url: '/get-petadscripciones',
        type: 'post',
    }).done(function(data){
        //console.log(data.petadscripciones[0]['nombre']);

        var option='<option value="" selected disabled>SELECCIONA EL LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO</option>';
        $.each(data,function(i,valor){
            
            $.each(valor,function(j,v){
                var n = j+1;
                option = option + '<option value="'+v['id']+'">'+n+'.- '+v['nombre']+'</option>';
                
            });
            
        });

        //console.log(option);
        
    
        $('select').material_select();
        $('#petadscripcion-select').append(option);
        $('select').material_select();
    });



    $('#petfiscalia-select').change(function(){
        
        //console.log($('#petfiscalia-select').val());

        var petfiscalia_id = $('#petfiscalia-select').val();

        
        console.log($('select[name="petadscripcion"]').attr('id'));

        if($('select[name="petadscripcion"]').attr('id')){
            console.log('simon');
        }
        else{
            $('select[name="petadscripcion"]').attr('id','petadscripcion-select')
        }
        

   
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {petfiscalia_id: petfiscalia_id},
            url: '/get-petadscripciones',
            type: 'post',
        }).done(function(data){
            if(data.petadscripciones.length > 0){
                //console.log(data.petadscripciones[0]['nombre']);
                $('select[name="petadscripcion"]').removeAttr('disabled');
            }
            else{
                console.log('nada en data');
                $('select[name="petadscripcion"]').attr('disabled','on');
            }

            var option='<option value="" selected disabled>SELECCIONA EL LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO</option>';
            //console.log('data: '+data.petadscripciones);
            

            $.each(data,function(i,valor){
                
                $.each(valor,function(j,v){
                    var n = j+1;
                    option = option + '<option value="'+v['id']+'">'+n+'.- '+v['nombre']+'</option>';
                    
                });
                
            });

            //console.log('option: '+option);
            
            $('#petadscripcion-select').children().remove();
            $('select').material_select();
            $('#petadscripcion-select').append(option);
            $('select').material_select();
        });


    });


});