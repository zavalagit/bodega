$(function(){

	$('#btn-guardar-perito').click(function(e){
		e.preventDefault();
      	var form = new FormData($('#form-capturar-perito')[0]);
     
      $.ajax({
         data: form,
         url: "/bodega/perito-guardar",
         type: "post",
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);

        if(data.satisfactorio){
         
            //alertify.logPosition("top right");
            alertify.success("Se capturo Perito con exito");
            setTimeout(function(){
               location.reload();
            },2000);
         }
         else {
            //alertify.logPosition("top right");
            alertify.error(data.error[0]);
            $('#btn-registrar-cadena').removeAttr('disabled');
         }
         
      });

	});

});
