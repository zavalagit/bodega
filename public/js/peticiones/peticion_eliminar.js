$(function(){

    $('.peticion-eliminar').click(function(e){
        e.preventDefault();

        var id = $(this).attr('data-id');
		var _token = $('meta[name="csrf-token"]').attr('content');

        $.confirm({
			boxWidth: '30%',
			useBootstrap: false,
			theme: 'material',
			type: 'red',
			animation: 'rotate',
			title: 'ELIMINAR',
			content: '¿QUIERES ELIMINAR ESTA PETICIÓN?',
			buttons: {
				ACEPTAR: function () {

					$.ajax({
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     					data: {_token:_token,id:id},
			         	url: "/peticion-eliminar",
			         	type: "POST",
			      	}).done(function(data){
			         	console.log(data);
			        	if(data.satisfactorio){
				            alertify.success("SE ELIMINO PETICIÓN");
				            setTimeout(function(){
               					location.reload();
            				},1500);
			         	}
			         	else {
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