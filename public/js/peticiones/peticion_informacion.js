$(function(){

   //Información empleado
	$('.peticion-info').click(function(e){
      e.preventDefault();
      console.log($('#span-csrf').attr('data-csrf'));
		let id = $(this).attr('data-peticion-id');
      let url = '/peticion-informacion/'+id;
      console.log('holasss');

		$.ajax({
			headers:{'X-CSRF-TOKEN': $('#span-csrf').attr('data-csrf')},
			url:url,
			type:'post',
		}).done(function(data){
			console.log(data);
         $('.modal-content').html(data);
         $('#modal-peticion-informacion').modal('open');
		});
	});//fin info empleado


});