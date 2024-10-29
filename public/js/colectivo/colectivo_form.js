$(function(){

   $('#form-colectivo').submit(function(e){
      e.preventDefault();
      // let form = new FormData($('#form-colectivo')[0]);
		console.log( $(this).attr('method') );
		console.log( $(this).attr('action') );

      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         beforeSend: function(){
            $('#btn-colectivo').empty().prop("disabled",true).append('Enviando...');
            // $('#btn-colectivo').empty().append('Enviando...');
         },
         complete:function(respuesta){
            // console.log(respuesta);
            /*
            * Se ejecuta al termino de la petición
            * */

            //spin
            
         },
         success: function(respuesta) {
            // console.log(respuesta);
            // console.log(respuesta.parentesco);
			
            if(respuesta.accion == 'registrar'){
               console.log(respuesta.request);
               $('#btn-colectivo').empty().append('Registrado');
               alertify.success("REGISTRO REALIZADO");
               setTimeout(function(){
                  location.href ="/colectivo-consultar";
                  // alertify.log("PUEDE REALIZAR OTRO REGISTRO");
               },2000);
            }
            else if(respuesta.accion == 'editar'){
               $('#btn-colectivo').empty().append('Editado');
               alertify.success("REGISTRO MODIFICADO");
               setTimeout(function(){
                  window.location.href =  document.referrer;
               },2000);
            }
            else if(respuesta.accion == 'clonar'){
               $('#btn-colectivo').empty().append('Clonado');
               alertify.success("REGISTRO CLONADO");
               setTimeout(function(){
                  location.href ="/colectivo-consultar";
               },2000);
            }
            else if(respuesta.accion == 'validar'){
               $('#btn-colectivo').empty().append('Validado');
               alertify.success("REGISTRO VALIDADO");
               setTimeout(function(){
                  window.location.href =  document.referrer;
               },2000);
            }
            else if(respuesta.accion == 'entregar'){
               $('#btn-colectivo').empty().append('Entregado');
               alertify.success("SE AGREGARON LOS DATOS DE ENTREGA");
               setTimeout(function(){
                  window.location.href =  document.referrer;
               },2000);
            }
         },
         error: function(respuesta){
            $('#btn-colectivo').empty().prop("disabled",false).append('Registrar');
            // console.log(respuesta);
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey][0]);

            //aletifyjs
            // alertify.set('notifier','position', 'top-center');
            // alertify.set('notifier','delay', 4);
            // alertify.error(respuesta.responseJSON.errors[firstKey][0]);
         }
      });
   });

});