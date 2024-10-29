$(function(){

	$('#filtro').change(function(){
		var opcion = $(this).val();

		if(opcion == 2){			
			$('#input-buscar').empty();
			$('#input-buscar').append('<input type="date" name="buscar">');
		}
		else if(opcion == 4){
			$('#input-buscar').empty();
			$('#input-buscar').append('<input type="time" name="buscar">');	
		}
		
		else if(opcion == 6){
			
			$('#input-buscar').empty();
			//$('#input-buscar').append('<input type="date" name="buscar">');

			var _token = $('meta[name="csrf-token"]').attr('content');

			$.ajax({
				url: '/naturaleza-select',
				type: 'POST',
				data: {_token:_token},
				success:function(data){
					//console.log(data.naturalezas);

					var options = '<option value="" disabled selected>-NATURALEZA-</option>'; 
					$.each(data.naturalezas, function(index,naturaleza){
						options = options + '<option value="'+naturaleza.id+'">'+naturaleza.id+'.- '+naturaleza.nombre+'</option>'; 
					});
	
					var select = 
						'<select name="buscar">'+
							options+
						'</select>';

					$('select').material_select();
					$('#input-buscar').append(select);
					$('select').material_select();
				}
			});
		}
		
		else{
			$('#input-buscar').empty();
			$('#input-buscar').append('<input type="text" placeholder="Buscar..." name="buscar">');
		}

	});

});
