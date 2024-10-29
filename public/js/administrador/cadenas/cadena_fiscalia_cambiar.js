$(function(){

   $('#btn-fiscalia-cambiar').click(function(e){
      e.preventDefault();
      var form = new FormData($('#form-fiscalia-cambiar')[0]);
      let cadena_id = $('#cadena-datos').attr('data-cadena-id');
      
      $.ajax({
         data: form,
         url: "/fiscalia-cambiar-guardar",
         type: "post",
         processData: false,
         contentType: false,
      }).done(function(data){
           //console.log(data);
   
   
         if(data.satisfactorio){
           //alertify.logPosition("top right");
           alertify.success("¡Se cambio Fiscalía!");
           //alertify.success("Espere un momento.");
           setTimeout(function(){
           //window.location.href = 'consultar-cadena?buscar='+data.nuc;
           //window.location.href = 'anexos-pdf/'+data.id;
           window.close();
           },3000);
         }
         else {
           //alertify.logPosition("top right");
           alertify.error(data.error[0]);
           $('#btn-registrar-cadena').removeAttr('disabled');
         }
   
      });//ajax
      
   });

});