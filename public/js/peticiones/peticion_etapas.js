$(function(){
   
   let accion  = $('#accion').attr('data-accion');
   let peticion = $('#peticion-datos').attr('data-peticion');
   peticion  = JSON.parse(peticion+'"}');
   let fecha_hoy = $('#peticion-datos').attr('data-fecha-hoy');


   if (accion == 'continuar') {
      if(peticion.estado == 'pendiente'){
         $('.datos-peticion').attr('readonly','readonly');
      }
      else if(peticion.estado == 'atendida'){
         $('.datos-peticion').attr('readonly','readonly');
         $('.datos-elaboracion').attr('readonly','readonly');
      }
   }



   // if(fecha_hoy === peticion.created_at){
   //    console.log('si');
   // }
   // else{
   //    $('.datos-peticion').attr('disabled','disabled');
   // }

   // if(peticion.estado === 'atendida'){
   //    if(peticion.fecha_sistema === fecha_hoy){
   //       console.log('si');
   //    }
   //    else{
   //       $('.datos-elaboracion').attr('disabled','disabled');
   //    }
   // }

});