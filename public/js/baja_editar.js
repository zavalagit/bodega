$(function(){

//QUIEN RECIBE (PERITO O CIUDADANO)

	//CAMBIAR A PERITO
	$('body').on('click','#cambiar-a-perito',function(e){
		e.preventDefault();

		$('#section-recibe').empty();

		var perito =
			'<div class="right-align">'+
                '<a href="" id="cambiar-a-ciudadano" class="tooltipped" data-position="left" data-delay="10" data-tooltip="Cambiar a Ciudadano"><i class="fa fa-times" aria-hidden="true" fa-lg></i></a>'+
            '</div>'+
            '<div class="row">'+
               	'<div class="input-field col s2" id="div-perito-recibe">'+
					'<input id="input_perito_recibe" type="text" autocomplete="off" name="perito_recibe">'+
					'<label for="input_perito_entrega">Perito Rrecibe</label>'+
				'</div>'+
				'<div class="input-field col s4">'+
					'<ul id="lista-peritos">'+
					'</ul>'+
				'</div>'+
            '</div>'+
            '<div class=row id="datos_perito">'+
            '</div>';

		$('#section-recibe').append(perito);

	});


	$('body').on('keyup','#input_perito_recibe',function(){

		var buscar = $(this).val();
		var _token = $('#_token').val();

		console.log(buscar);

		if (buscar.length > 0) {
			$.ajax({
				url: '/bodega/autocompletar',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){
					$('#lista-peritos').empty();

					$.each(data.usuarios, function(i,usuario){
						console.log(usuario);

						$('#lista-peritos').append('<li><a href="" class="perito" data-id="'+usuario.id+'"><b>'+usuario.folio+'</b>: '+usuario.nombre+'</a></li>');
					});

				}//success
			});
		}
		else{
			$('#lista-peritos').empty();
		}

	});


	$('body').on('click','.perito',function(e){
		e.preventDefault();

    	Materialize.updateTextFields();


  		$('#input_perito_recibe').val('');
  		$('#lista-peritos').empty();
  		$('#div-perito-recibe').hide();

		var _token = $('#_token').val();
		var id = $(this).attr('data-id');

		$.ajax({
			url: "/datos-perito",
			type: "post",
			data: {_token:_token,id:id},
		}).done(function(data){

				var perito =
					'<input type="hidden" id="" name="id_perito" value="'+data.perito.id+'">'+
					'<div class="input-field col s2">'+
						'<input type="text" disabled value="'+data.perito.folio+'">'+
						'<label>Folio credencial</label>'+
					'</div>'+
					'<div class="input-field col s4">'+
						'<input type="text" disabled value="'+data.perito.nombre+'">'+
						'<label>Nombre</label>'+
					'</div>'+
					'<div class="input-field col s3">'+
						'<input type="text" disabled value="'+data.cargo+'">'+
						'<label>Cargo</label>'+
					'</div>'+
					'<div class="input-field col s3">'+
						'<a href="" id="borrar_perito"><i class="fa fa-times" aria-hidden="true"></i></a>'+
					'</div>';


        	$('#datos_perito').append(perito);
        	$('#input_perito_recibe').attr('disabled','on');
        	$('#quien-recibe').attr('disabled','on');

			$(document).ready(function() {
				Materialize.updateTextFields();
			});
    	});//done
	});

	$('body').on('click','#borrar_perito',function(e){
		e.preventDefault();
		$('#datos_perito').empty();
		$('#input_perito_recibe').removeAttr('disabled');
		$('#quien-recibe').removeAttr('disabled');
		$('#div-perito-recibe').show();
	});

//~~~~ FIN PERITO RECIBE ~~~~


//CAMBIAR A CIUDADANO
	$('body').on('click','#cambiar-a-ciudadano',function(e){
		e.preventDefault();

		$('#section-recibe').empty();

		var ciudadano =
			'<div class="right-align">'+
				'<a href="" id="cambiar-a-perito"><i class="fa fa-times" aria-hidden="true" fa-lg></i></a>'+
			'</div>'+
			'<div class="row">'+
				'<div class="input-field col s12">'+
					'<input id="quien-recibe" type="text" name="quien_recibe">'+
					'<label for="quien-recibe">Quien recibe</label>'+
				'</div>'+
			'</div>'+
			'<div class="row">'+
				'<div class="input-field col s12">'+
					'<input id="identificacion" type="text" placeholder="IFE, INE, etc." name="identificacion">'+
					'<label for="identificacion">IDENTIFICACIÓN</label>'+
				'</div>'+
			'</div>';

		$('#section-recibe').append(ciudadano);

	});


//GUARDANDO BAJA
	$('#btn-baja-editar').click(function(e){
		e.preventDefault();

		var form = new FormData($('#form-baja-editar')[0]);

      	$.ajax({
     		data: form,
         	url: "/bodega/baja-editar-guardar",
         	type: "post",
 			processData: false,
         	contentType: false,
      	}).done(function(data){
         	console.log(data);
        	if(data.satisfactorio){
	            //alertify.logPosition("top right");
	            alertify.success("SE EDITÓ CON EXITO :D");
         	}
         	else {
            	//alertify.logPosition("top right");
            	alertify.error(data.error[0]);
         	}
      	});

	});


});
