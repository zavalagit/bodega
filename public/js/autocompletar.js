$(function(){

	$('#input_sp').keyup(function(){
		
		var buscar = $(this).val();
		var _token = $('#_token').val();

		console.log(_token);
//		console.log(folio);

		if (buscar.length > 0) {
			$.ajax({
				url: '/autocompletar',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){
//				console.log(data.usuarios);

				$('#lista-sp').empty();		
		

				$.each(data.usuarios, function(i,usuario){
					console.log(usuario);

					$('#lista-sp').append('<li><a href="" class="perito" data-id="'+usuario.id+'"><b>'+usuario.folio+'</b>: '+usuario.name+'</a></li>');	
				});

			//	$(‘#lista’).show();//mistrar la lista
			//	$(‘#lista_sp’).html(data);//mostrar resultado de consulta en la lista
				}
			});
		}
		else{
			$('#lista-sp').empty();
		}
				
	});


	$('body').on('click','.perito',function(e){
		e.preventDefault();

		$(document).ready(function() {
    		Materialize.updateTextFields();
  		});


  		$('#input_sp').val('');
  		$('#lista-sp').empty();

		var _token = $('#_token').val();
		var id = $(this).attr('data-id');

		$.ajax({
			url: "/datos-perito",
			type: "post",
			data: {_token:_token,id:id},
		}).done(function(data){

				var perito =
				'<div class="row">'+
					'<input type="hidden" id="" name="id_sp[]" value="'+data.perito.id+'">'+
				   '<h6><b>Persona que intervene en la cadena</b></h6>'+
				   '<div class="input-field col s1">'+
				      '<input id="folio" type="text" name="folio[]" disabled value="'+data.perito.folio+'">'+
				      '<label for="folio">Folio</label>'+
				   '</div>'+
				   '<div class="input-field col s3">'+
				      '<input id="nombre" type="text" name="nombre[]" disabled value="'+data.perito.name+'">'+
				      '<label for="nombre">Nombre</label>'+
				   '</div>'+
				   '<div class="input-field col s2">'+
				      '<input id="institucion" type="text" name="institucion[]" disabled value="'+data.institucion+'">'+
				      '<label for="institucion">Institución</label>'+
				   '</div>'+
				   '<div class="input-field col s2">'+
				      '<input id="cargo" type="text" name="cargo[]" disabled value="'+data.cargo+'">'+
				      '<label for="cargo">Cargo</label>'+
				   '</div>'+
				   '<div class="input-field col s2">'+
				      '<input id="etapa" type="text" autofocus required name="etapa[]">'+
				      '<label for="etapa">Etapa</label>'+
				   '</div>'+
				   '<div class="input-field col s1 center-align">'+
				      '<button type="button" name="button" id="x-sp">'+
				         '<i class="fa fa-times" aria-hidden="true"></i>'+
				      '</button>'+
				   '</div>'+
				'</div>';

        	$('#blockquote-traslado').before(perito);
        
			$(document).ready(function() {
				Materialize.updateTextFields();
			});
    	});//done
	});

});