$(function(){

//RESGUARDANTE 1
	$('#resguardante1-buscar').hide();

	$('#input_resguardante1').keyup(function(){
		var buscar = $(this).val();
		var _token = $('#_token').val();

		if (buscar.length > 0) {
			$.ajax({
				url: '/bodega/prestamo-resguardante',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){

					$('#lista-resguardantes1').empty();

					$.each(data.resguardantes, function(i,usuario){
						console.log(usuario);

						$('#lista-resguardantes1').append('<li><a href="" class="resguardante1" data-id="'+usuario.id+'"><b>'+usuario.folio+'</b>: '+usuario.nombre+'</a></li>');
					});
				}//success
			});
		}
		else{
			$('#lista-resguardantes1').empty();
		}
	});


	$('body').on('click','.resguardante1',function(e){
		e.preventDefault();

		Materialize.updateTextFields();

  		$('#input_resguardante1').val('');
  		$('#lista-resguardantes1').empty();

		var _token = $('#_token').val();
		var id = $(this).attr('data-id');

		$.ajax({
			url: "/bodega/resguardante-datos",
			type: "post",
			data: {_token:_token,id:id},
		}).done(function(data){

			console.log(data);

				var resguardante =
					'<input type="hidden" id="" name="id_resguardante1" value="'+data.resguardante.id+'">'+
					'<div class="input-field col s2">'+
						'<input type="text" disabled value="'+data.resguardante.folio+'">'+
						'<label>Folio credencial</label>'+
					'</div>'+
					'<div class="input-field col s6">'+
						'<input type="text" disabled value="'+data.resguardante.nombre+'">'+
						'<label>Nombre</label>'+
					'</div>'+
					'<div class="input-field col s3">'+
						'<input type="text" disabled value="'+data.cargo+'">'+
						'<label>Cargo</label>'+
					'</div>'+
					'<div class="input-field col s1">'+
						'<a href="" id="borrar_resguardante1"><i class="fa fa-times" aria-hidden="true"></i></a>'+
					'</div>';

        	$('#datos_resguardante1').append(resguardante);
        	$('#input_resguardante1').attr('disabled','on');
        	$('#resguardante1-buscar').hide();

			Materialize.updateTextFields();
    	});//done
	});

	$('body').on('click','#borrar_resguardante1',function(e){
		e.preventDefault();
		$('#datos_resguardante1').empty();
		$('#input_resguardante1').removeAttr('disabled');
		$('#resguardante1-buscar').show();
	});


//RESGUARDANTE 2
	$('#resguardante2-buscar').hide();

	$('#input_resguardante2').keyup(function(){
		var buscar = $(this).val();
		var _token = $('#_token').val();

		if (buscar.length > 0) {
			$.ajax({
				url: '/bodega/prestamo-resguardante',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){

					$('#lista-resguardantes2').empty();

					$.each(data.resguardantes, function(i,usuario){
						console.log(usuario);

						$('#lista-resguardantes2').append('<li><a href="" class="resguardante2" data-id="'+usuario.id+'"><b>'+usuario.folio+'</b>: '+usuario.nombre+'</a></li>');
					});
				}//success
			});
		}
		else{
			$('#lista-resguardantes2').empty();
		}
	});


	$('body').on('click','.resguardante2',function(e){
		e.preventDefault();

		Materialize.updateTextFields();

  		$('#input_resguardante2').val('');
  		$('#lista-resguardantes2').empty();

		var _token = $('#_token').val();
		var id = $(this).attr('data-id');

		$.ajax({
			url: "/bodega/resguardante-datos",
			type: "post",
			data: {_token:_token,id:id},
		}).done(function(data){

			console.log(data);

				var resguardante =
					'<input type="hidden" id="" name="id_resguardante2" value="'+data.resguardante.id+'">'+
					'<div class="input-field col s2">'+
						'<input type="text" disabled value="'+data.resguardante.folio+'">'+
						'<label>Folio credencial</label>'+
					'</div>'+
					'<div class="input-field col s6">'+
						'<input type="text" disabled value="'+data.resguardante.nombre+'">'+
						'<label>Nombre</label>'+
					'</div>'+
					'<div class="input-field col s3">'+
						'<input type="text" disabled value="'+data.cargo+'">'+
						'<label>Cargo</label>'+
					'</div>'+
					'<div class="input-field col s1">'+
						'<a href="" id="borrar_resguardante2"><i class="fa fa-times" aria-hidden="true"></i></a>'+
					'</div>';

        	$('#datos_resguardante2').append(resguardante);
        	$('#input_resguardante2').attr('disabled','on');
        	$('#resguardante2-buscar').hide();

			Materialize.updateTextFields();
    	});//done
	});

	$('body').on('click','#borrar_resguardante2',function(e){
		e.preventDefault();
		$('#datos_resguardante2').empty();
		$('#input_resguardante2').removeAttr('disabled');
		$('#resguardante2-buscar').show();
	});



//RB1
	$('#rb1-buscar').hide();

	$('body').on('click','#rb1-delete',function(e){
		e.preventDefault();
		$('#rb1-buscar').show();
		$('#rb1-datos').empty();
		$('#rb1-datos').hide();
		$('#icon-delete').hide();
	});

	$('#rb1-input').keyup(function(){
		var buscar = $(this).val();
		var _token = $('#_token').val();

		if (buscar.length > 0) {

			$.ajax({
				url: '/bodega/rb-buscar',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){
					console.log(data);

					$('#rb1-lista').empty();
					$.each(data.rbs, function(i,rb){
						$('#rb1-lista').append('<li><a href="" class="rbi1" data-id="'+rb.id+'"><b>'+rb.folio+'</b>: '+rb.name+'</a></li>');
					});
				}
			});
		}
		else{
			$('#rb1-lista').empty();
		}

	});


	$('body').on('click','.rbi1',function(e){
		e.preventDefault();

		var _token = $('#_token').val();
		var id = $(this).attr('data-id');

    	Materialize.updateTextFields();

  		$('#rb1-buscar').hide();
  		$('#rb1-lista').empty();
  		$('#rb1-lista').hide();
  		$('#rb1-div-lista').hide();

		$.ajax({
			url: "/bodega/rb-datos",
			type: "post",
			data: {_token:_token,id:id},
		}).done(function(data){

				console.log(id);

				var rb =
					'<input type="hidden" name="id_rb1" value="'+data.rb.id+'">'+
				    '<input id="rb1-entrega" type="text" name="nombre" disabled value="'+data.rb.name+'">'+
				    '<label for="rb1-entrega">NOMBRE</label>';

        	$('#rb1-datos').append(rb);
        	$('#rb1-datos').show();
			$('#icon-delete').show();

			Materialize.updateTextFields();

    	});//done
	});


//RB2
	$('#rb2-buscar').hide();

	$('body').on('click','#rb2-delete',function(e){
		e.preventDefault();
		$('#rb2-buscar').show();
		$('#rb2-datos').empty();
		$('#rb2-datos').hide();
		$('#icon2-delete').hide();
	});

	$('#rb2-input').keyup(function(){
		var buscar = $(this).val();
		var _token = $('#_token').val();

		if (buscar.length > 0) {

			$.ajax({
				url: '/bodega/rb-buscar',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){
					console.log(data);

					$('#rb2-lista').empty();
					$.each(data.rbs, function(i,rb){
						$('#rb2-lista').append('<li><a href="" class="rbi2" data-id="'+rb.id+'"><b>'+rb.folio+'</b>: '+rb.name+'</a></li>');
					});
				}
			});
		}
		else{
			$('#rb2-lista').empty();
		}

	});


	$('body').on('click','.rbi2',function(e){
		e.preventDefault();

		var _token = $('#_token').val();
		var id = $(this).attr('data-id');

    	Materialize.updateTextFields();

  		$('#rb2-buscar').hide();
  		$('#rb2-lista').empty();
  		$('#rb2-lista').hide();
  		$('#rb2-div-lista').hide();

		$.ajax({
			url: "/bodega/rb-datos",
			type: "post",
			data: {_token:_token,id:id},
		}).done(function(data){

				console.log(id);

				var rb =
					'<input type="hidden" name="id_rb2" value="'+data.rb.id+'">'+
				    '<input id="rb2-entrega" type="text" name="nombre" disabled value="'+data.rb.name+'">'+
				    '<label for="rb2-entrega">NOMBRE</label>';

        	$('#rb2-datos').append(rb);
        	$('#rb2-datos').show();
			$('#icon2-delete').show();

			Materialize.updateTextFields();

    	});//done
	});


	//Guardar
	$('#btn-editar-prestamo').click(function(e){
		e.preventDefault();

		var form = new FormData($('#form-editar-prestamo')[0]);



		$.ajax({
         data: form,
         url: "/bodega/prestamo-editar-guardar",
         type: "post",
         processData: false,
         contentType: false,
      	}).done(function(data){

			if(data.satisfactorio){
				//alertify.logPosition("top right");
				alertify.success("CAMBIOS REALIZADOS :D");
			}
			else {
				//alertify.logPosition("top right");
				alertify.error(data.error[0]);
				//$('#btn-registrar-cadena').removeAttr('disabled');
			}

		});
  	});

});
