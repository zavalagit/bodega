$(function(){

	$('#btn-nota').click(function(e){
		e.preventDefault();		
		var form = new FormData($('#form-nota')[0]);

      $.ajax({
         data: form,
         url: "/bodega/nota-guardar",
         type: "post",
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);
         
        if(data.satisfactorio){
         
            alertify.logPosition("top right");
            alertify.success("Se envio nota");

            setTimeout(function(){
               location.reload();
            },1300);
         }
         else {
            alertify.logPosition("top right");
            alertify.error(data.error[0]);
            //window.location.href = 'editar-cadena-perito/11';
         }
         
      });
	});

	$('.nota-enlace').click(function(e){
		e.preventDefault();

		$('#nota-mensaje').empty();

		var id = $(this).attr('data-id');
		var _token = $('#span-csrf').attr('data-csrf');

		console.log('holasssss');
		console.log(id);
		console.log(_token);

		$.ajax({
			url: '/bodega/nota-obtener',
			type: 'POST',
			data: {_token:_token,id:id},
			success:function(data){
				console.log(data);

				$('#id_cadena_modal').val(data.cadena.id);
				$('#nota-mensaje').append(data.cadena.nota);
				$('#nota').modal('open');
			}
		});
      
	});

});