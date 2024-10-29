$(function(){

	$('.btn-eliminar-prestamo').click(function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var _token = $('meta[name="csrf-token"]').attr('content');

//		console.log(id);

		$.confirm({
			boxWidth: '30%',
			useBootstrap: false,
			theme: 'material',
			type: 'orange',
			animation: 'rotate',
			title: 'ELIMINAR',
			content: '¿QUIERES ELIMINAR EL PRESTAMO?',
			buttons: {
				ACEPTAR: function () {

					$.ajax({
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     					data: {_token:_token,id:id},
			         	url: "/bodega/prestamo-eliminar",
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
