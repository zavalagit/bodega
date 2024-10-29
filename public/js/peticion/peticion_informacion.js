$(function(){

   //Información empleado
	$('.peticion-info').click(function(e){
      e.preventDefault();
      console.log('entrasd');
		$.ajax({
			type:'post',
			url: '/peticion-informacion/'+$(this).attr('data-peticion-id'),
			data: {_token: $('#meta-csrf-token').attr('content')},
		}).done(function(data){
			console.log(data);
         $('#modal-peticion-informacion .modal-content').html(data);
         $('#modal-peticion-informacion').modal('open');
		});
	});//fin info empleado


});