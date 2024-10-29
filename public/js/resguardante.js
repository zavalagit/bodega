$(function(){

	$('#btn-resguardante').click(function(e){
		e.preventDefault();


		console.log('asdadad');

		var form = new FormData($('#form-resguardante')[0]);

		$.ajax({
			data: form,
			url: '/bodega/guardar-resguardante',
			type: 'post',
			processData: false,
			contentType: false,
		}).done(function(data){
		 	console.log(data);
/*
			if(data.satisfactorio){
				alertify.logPosition("top right");
				alertify.success("Se dio Cadena de alta con el folio: "+data.folio);
				setTimeout(function(){
				window.location.href = '/bodega/cadenas';
				//window.location.href = 'anexos-pdf/'+data.id;
				},3000);
			}
			else {
				alertify.logPosition("top right");
				alertify.error(data.error[0]);
				//window.location.href = 'editar-cadena-perito/11';
			}
*/		  
		});
   	});




	$('#input_resguardante').keyup(function(){

		var buscar = $(this).val();
		var _token = $('#_token').val();

		console.log(buscar);

		if (buscar.length > 0) {
			$.ajax({
				url: '/bodega/prestamo-resguardante',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){
					
					$('#lista-resguardantes').empty();		
			
					$.each(data.resguardantes, function(i,usuario){
						console.log(usuario);

						$('#lista-resguardantes').append('<li><a href="" class="resguardante" data-id="'+usuario.id+'"><b>'+usuario.folio+'</b>: '+usuario.nombre+'</a></li>');	
					});

				}//success
			});
		}
		else{
			$('#lista-resguardantes').empty();
		}
				
	});


	$('body').on('click','.resguardante',function(e){
		e.preventDefault();	


	//	$(document).ready(function() {
    		Materialize.updateTextFields();
  //		});


  		$('#input_resguardante').val('');
  		$('#lista-resguardantes').empty();

		var _token = $('#_token').val();
		var id = $(this).attr('data-id');

		$.ajax({
			url: "/bodega/resguardante-datos",
			type: "post",
			data: {_token:_token,id:id},
		}).done(function(data){

			console.log(data);

				var resguardante =				
					'<input type="hidden" id="" name="id_resguardante" value="'+data.resguardante.id+'">'+
					'<div class="input-field col s2">'+
						'<input type="text" disabled value="'+data.resguardante.folio+'">'+
						'<label>Folio credencial</label>'+
					'</div>'+
					'<div class="input-field col s4">'+
						'<input type="text" disabled value="'+data.resguardante.nombre+'">'+
						'<label>Nombre</label>'+
					'</div>'+
					'<div class="input-field col s3">'+
						'<input type="text" disabled value="'+data.cargo+'">'+
						'<label>Cargo</label>'+
					'</div>'+
					'<div class="input-field col s3">'+
						'<a href="" id="borrar_resguardante"><i class="fa fa-times" aria-hidden="true"></i></a>'+
					'</div>';
		

        	$('#datos_resguardante').append(resguardante);
        	$('#input_resguardante').attr('disabled','on');
        
			$(document).ready(function() {
				Materialize.updateTextFields();
			});
    	});//done
	});

	$('body').on('click','#borrar_resguardante',function(e){
		e.preventDefault();

		$('#datos_resguardante').empty();
		$('#input_resguardante').removeAttr('disabled');



	});






});