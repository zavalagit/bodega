$(function(){

	$('.btn-fiscalia').click(function(e){
		e.preventDefault();

		var id = $(this).attr('data-id');
		var nombre = $(this).attr('data-nombre');
		var token = $(this).attr('data-csrf');


		console.log(id);
		console.log(nombre);
//		console.log(CSRF_TOKEN);


		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: {id: id, nombre:nombre},
			url: '/administrador/fiscalia-datos',
			type: 'post',
			processData: false,
			contentType: false,
		}).done(function(data){
			console.log(data);

			window.location.href = '/administrador/fiscalia/'+nombre+'/revisar';
/*
			if(data.satisfactorio){
				alertify.logPosition("top right");
				alertify.success("Se dio Cadena de alta con el folio: "+data.folio);

				setTimeout(function(){
				window.location.href = '/bodega/revisar';                
				},1500);

			}
			else{
				alertify.logPosition("top right");
				alertify.error(data.error[0]);
				//window.location.href = 'editar-cadena-perito/11';
			}
*/
		});


	});

});