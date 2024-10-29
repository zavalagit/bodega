$(function(){

	$('#input_sp').keyup(function(){

		var buscar = $(this).val();
		var _token = $('#_token').val();
		console.log(_token);

		if (buscar.length > 0) {
			$.ajax({
				url: '/autocompletar',
				type: 'POST',
				data: {_token:_token,buscar:buscar},
				success:function(data){

					$('#lista-sp').empty();


					$.each(data.usuarios, function(i,usuario){
						console.log(usuario);

						$('#lista-sp').append('<li><a href="" class="perito" data-id="'+usuario.id+'"><b>'+usuario.folio+'</b>: '+usuario.name+'</a></li>');
					});
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
				   '<h6><b>SERVIDO PÚBLICO INTERVIENE EN CADENA</b></h6>'+
				   '<div class="input-field col s12 m3 l1">'+
				      '<input id="folio" type="text" name="folio[]" disabled value="'+data.perito.folio+'">'+
				      '<label for="folio">FOLIO</label>'+
				   '</div>'+
				   '<div class="input-field col s12 m9 l3">'+
				      '<input id="nombre" type="text" name="nombre[]" disabled value="'+data.perito.name+'">'+
				      '<label for="nombre">NOMBRE</label>'+
				   '</div>'+
				   '<div class="input-field col s12 m6 l2">'+
				      '<input id="institucion" type="text" name="institucion[]" disabled value="'+data.institucion+'">'+
				      '<label for="institucion">INSTITUCIÓN</label>'+
				   '</div>'+
				   '<div class="input-field col s12 m6 l2">'+
				      '<input id="cargo" type="text" name="cargo[]" disabled value="'+data.cargo+'">'+
				      '<label for="cargo">CARGO</label>'+
				   '</div>'+
				   '<div class="input-field col s12 m12 l3">'+
				      '<input id="etapa" type="text" autofocus required name="etapa[]">'+
				      '<label for="etapa">ETAPA *</label>'+
				   '</div>'+
				   '<div class="input-field col s12 m1 l1 center-align">'+
				      '<a href="" id="x-sp">'+
				         '<i class="fas fa-times" style="color:red"></i>'+
				      '</a>'+
				   '</div>'+
				'</div>';

        	$('#section-sp').append(perito);

			$(document).ready(function() {
				Materialize.updateTextFields();
			});
    	});//done
	});


	//Elimina un servidor publico
	$('body').on('click',"#x-sp",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});

});
