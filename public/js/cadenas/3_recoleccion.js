$(function(){

	//3. Recoleccion
   	$('#refresh-recoleccion').click(function(e){
		e.preventDefault();

		var verifica = $('input[name="identificador[]"]').val();
		if(verifica != ""){
			var arr = $('input[name="identificador[]"]').map(function () {
				return this.value; // $(this).val()
			}).get();
			var select_manual = '<option value="" disabled selected>Selecciona los identificador(es)</option>';
			var select_instrumental = '<option value="" disabled selected>Selecciona los identificador(es)</option>';
			var select_bolsa = '<option value="" disabled selected>Selecciona los identificador(es)</option>';
			var select_caja = '<option value="" disabled selected>Selecciona los identificador(es)</option>';
			var select_recipiente = '<option value="" disabled selected>Selecciona los identificador(es)</option>';
			$.each(arr,function(i,valor){
				select_manual = select_manual + '<option id="'+valor+'-manual'+'" value="'+valor+'">'+valor+'</option>';
				select_instrumental = select_instrumental + '<option id="'+valor+'-instrumental'+'" value="'+valor+'">'+valor+'</option>';
				select_bolsa = select_bolsa + '<option id="'+valor+'-bolsa'+'" value="'+valor+'">'+valor+'</option>';
				select_caja = select_caja + '<option id="'+valor+'-caja'+'" value="'+valor+'">'+valor+'</option>';
				select_recipiente = select_recipiente + '<option id="'+valor+'-recipiente'+'" value="'+valor+'">'+valor+'</option>';
			});

			$('#manual').children().remove();
			$('#instrumental').children().remove();
			$('#bolsa').children().remove();
			$('#caja').children().remove();
			$('#recipiente').children().remove();
			$('#manual').append(select_manual);
			$('#instrumental').append(select_instrumental);
			$('#bolsa').append(select_bolsa);
			$('#caja').append(select_caja);
			$('#recipiente').append(select_recipiente);
			$('select').material_select();
		}
		else{
			$('#manual').children().remove();
			$('#manual').append('<option value="" disabled selected>Selecciona los identificador(es)</option>');
			$('#instrumental').children().remove();
			$('#instrumental').append('<option value="" disabled selected>Selecciona los identificador(es)</option>');
			$('select').material_select();
		}
   	});


	$('#manual').change(function(){
		console.log($('#manual').val());
		console.log($('#instrumental').val());
	});

});