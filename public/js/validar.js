$(function(){

	$('.validar-enlace').click(function(e){

		e.preventDefault();

		var id = $(this).attr('data-id');
		$('#id_modal_validar').val(id);

		console.log(id);

		$('#modal-validar').modal('open');
	});


	$('#btn-validar').click(function(e){
		e.preventDefault();
		var form = new FormData($('#form-validar')[0]);

      $.ajax({
         data: form,
         url: "/bodega/asignar-folio",
         type: "post",
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);

        if(data.satisfactorio){

            //alertify.logPosition("top right");
            alertify.success("Se asigno Folio: "+data.folio+" con exito");

            setTimeout(function(){
               window.location.href = '/bodega/alta/'+data.id;
            },1300);

         /*
            setTimeout(function(){
               location.reload();
            },1300);
         */
         }
         else {
            //alertify.logPosition("top right");
            alertify.error(data.error[0]);
            //window.location.href = 'editar-cadena-perito/11';
         }

      });
	});

});
