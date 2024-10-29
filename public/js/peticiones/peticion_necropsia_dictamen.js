$(function(){

   $('#fecha-elaboracion').change(
      function(){
         let fecha = $('#fecha-elaboracion').val();

         if(fecha != ''){
            console.log($('#solicitud-select').val());
            let solicitud = $('#solicitud-select').val();
                     
            if( (solicitud == 61) || (solicitud == 62) ){
               $("[name='documento_emitido']").attr('disabled','disabled');
               $("[name='documento_emitido']#dictamen").removeAttr('disabled');
               $("[name='documento_emitido']#dictamen").attr('checked','checked');
            }
            else{

               console.log('solicitud no');
            }
         }
         else{
            $("[name='documento_emitido']").removeAttr('disabled');
            $("[name='documento_emitido']").removeAttr('checked');
         }     
      }
   );

   $('#solicitud-select').change(
      function(){
         let solicitud = $('#solicitud-select').val();
         let fecha = $('#fecha-elaboracion').val();

         if(fecha != ''){
            if( (solicitud == 61) || (solicitud == 62) ){
               $("[name='documento_emitido']").attr('disabled','disabled');
               $("[name='documento_emitido']#dictamen").removeAttr('disabled');
               $("[name='documento_emitido']#dictamen").attr('checked','checked');
            }
            else{
               $("[name='documento_emitido']").removeAttr('disabled');
               $("[name='documento_emitido']").removeAttr('checked');
            }
         }


      }
   );



});