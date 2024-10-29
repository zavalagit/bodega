$(function(){

    $('#ubicacion-general-lista').hide();
    $('#form-ubicacion-general').hide();

    //Buscar Ubicacion (lugar)
    $('#ubicacion-general-input').keyup(function(){
		var buscar = $(this).val();
		var _token = $('meta[name="csrf-token"]').attr('content');

		if (buscar.length > 0) {
			$.ajax({
				url: '/ubicacion-get',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){
                    $('#ubicacion-general-lista').empty();
                    
                    if(data.ubicaciones.length){
                        $.each(data.ubicaciones, function(i,ubicacion){
                            $('#ubicacion-general-lista').append('<a href="" class="collection-item ubicacion-item" data-id="'+ubicacion.id+'" data-nombre="'+ubicacion.nombre+'"><b>'+ubicacion.nombre+'</b></a>');
                        });
                        $('#ubicacion-general-lista').show();
                    }
                    else{
                        $('#ubicacion-general-lista').hide();
                        $('#ubicacion-general-lista').empty();
                    }
				}
			});
		}
		else{
            $('#ubicacion-general-lista').hide();
			$('#ubicacion-general-lista').empty();
		}
    });

    //Elegir ubicacion (lugar)
    $('body').on('click','.ubicacion-item',function(e){
		e.preventDefault();
        var ubicacion_id = $(this).attr('data-id');
        var ubicacion_nombre = $(this).attr('data-nombre');

    	Materialize.updateTextFields();

  		$('#ubicacion-general-input').hide();
  		$('#ubicacion-general-input').val('');
  		$('#ubicacion-general-lista').hide();
        $('#ubicacion-general-lista').empty();

        var ubicacion_asignar_id =
            '<input type="hidden" value="'+ubicacion_id+'" name="id_ubicacion">';
        let ubicacion_asignar_nombre =
            '<div class="row">'+
                '<div class="col s12">'+
                    '<ul class="collection with-header">'+
                        '<li class="collection-item"><div>'+ubicacion_nombre+'<a href="" id="ubicacion-general-x" class="secondary-content"><i style="color:red;" class="fas fa-times-circle"></i></a></div></li>'+
                    '</ul>'+
                '</div>'+
            '</div>';
        let ubicacion_asignar_btn =
            '<div class="row">'+
                '<div class="col s1 offset-s10">'+
                    '<button id="ubicacion-general-btn" class="btn waves-effect waves-light" type="submit">guardar</button>'+
                '</div>'+
            '</div>';
        

        
        $('#form-ubicacion-general').append(ubicacion_asignar_id);
        $('#form-ubicacion-general').append(ubicacion_asignar_nombre);
        $('#form-ubicacion-general').append(ubicacion_asignar_btn);
        $('#form-ubicacion-general').show();

        Materialize.updateTextFields();    	
    });
    
    //Cambiar ubicacion
    $('body').on('click',"#ubicacion-general-x",function(e){
        e.preventDefault();
		$('#form-ubicacion-general').hide();
        $('#form-ubicacion-general').empty();
        $('#ubicacion-general-input').show();
        $('#ubicacion-general-input').focus();
    });
    

    //Guardar Ubicacion
    $(function(){
        $('body').on('click','#ubicacion-general-btn',function(e){
            e.preventDefault();
            var form =  new FormData($('#form-ubicacion-general')[0]);
            $(this).attr('disabled','on');
    
            $.ajax({
                data: form,
                url: "/ubicacion-general-guardar",
                type: "post",
                processData: false,
                contentType: false,
              }).done(function(data){
                console.log(data);
          
          
                if(data.satisfactorio){
                  //alertify.logPosition("top right");
                  alertify.success("¡SE ASIGNO LUGAR!");
                  //alertify.success("Espere un momento.");
                  setTimeout(function(){
                    location.reload();
                  },1500);
                }
                else {
                  //alertify.logPosition("top right");
                  alertify.error('Error al Guardar');
                  $('#ubicacion-general-btn').removeAttr('disabled');
                }
          
              });//ajax
    
        });
    })
    
});