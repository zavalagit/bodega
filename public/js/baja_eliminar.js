$(function(){

	$('.btn-eliminar-baja').click(function(e){
		e.preventDefault();
		let id = $(this).attr('data-id');
		let _token = $('meta[name="csrf-token"]').attr('content');

		console.log(_token);

		$.confirm({
			boxWidth: '30%',
			useBootstrap: false,
			theme: 'supervan',
			type: 'red',
			animation: 'rotate',
			title: 'ELIMINAR',
			content: '¿QUIERES ELIMINAR LA BAJA?',
			buttons: {
				ACEPTAR: function () {

					$.ajax({
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     					data: {_token:_token,id:id},
			         	url: "/bodega/baja-eliminar",
			         	type: "POST",
			      	}).done(function(data){
			         	console.log(data);

			        	if(data.satisfactorio){
				            //alertify.logPosition("top right");
				            alertify.success("EL PRESTAMO SE ELIMINO CON EXITO");
				            setTimeout(function(){
               					location.reload();
            				},2000);
			         	}
			         	else {
			            	//alertify.logPosition("top right");
			            	alertify.error(data.error[0]);
			         	}

			      	});

				},
				CANCELAR: function () {
					//$.alert('Cancelar');
				}
			}
		});

	});

});
