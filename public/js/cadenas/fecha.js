$(function(){

      var int=self.setInterval("refresh()",5000);
      function refresh(){
         var motivo = $("input:radio[name=motivo]:checked").val();
       
         if(motivo=='localizacion' || motivo=='descubrimiento'){   
            var hora1 = $('#intervencion_hora').val();
            if(hora1!=''){
               $('input[name^="recoleccion_hora"').each(function (){
                  if($(this).val() !=''){
                     if(hora1 >= $(this).val()){
                        alertify.logPosition("top right");
                        alertify.error("Verifica la hora");
                     }                           
                  }
               });
            }
            var fecha1 = $('#intervencion_fecha').val();
            console.log(fecha1);
            if(fecha1!=''){
               $('input[name^="recoleccion_fecha"').each(function (){
                  if($(this).val() !=''){
                     if(fecha1 >= $(this).val()){
                        alertify.logPosition("top right");
                        alertify.error("Verifica la fecha");
                     }
                     else
                        console.log("else");
                  }
               });            
            }           
         }
         else if(motivo=='aportacion'){
            var hora1 = $('#intervencion_hora').val();
            if(hora1!=''){
               $('input[name^="recoleccion_hora"').each(function (){
                  if($(this).val() !=''){
                     if(hora1 > $(this).val()){
                        alertify.logPosition("top right");
                        alertify.error("Verifica la hora");
                     }                           
                  }
               });
            }
            var fecha1 = $('#intervencion_fecha').val();
            console.log(fecha1);
            if(fecha1!=''){
               $('input[name^="recoleccion_fecha"').each(function (){
                  if($(this).val() !=''){
                     if(fecha1 > $(this).val()){
                        alertify.logPosition("top right");
                        alertify.error("Verifica la fecha");
                     }
                     else
                        console.log("else");
                  }
               });            
            }  

         }
      }
      
      
         $('#manual').change(function(){
            console.log($('#manual').val());
            console.log($('#instrumental').val());

            var man = $('#manual').val();
            var ins = $('#instrumental').val();
            var int = 0;

            for(var i =0; i < man.length; i++){
               for(var j =0; j < ins.length; j++){
                     if(man[i] == ins[j]){
                        console.log(man[i]);
                        console.log(ins[j]);                     
                        int = 1;
                        break;
                     }
               }              
               if(int == 1){
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ man[i] +"no puede estar en Manual e Intrumental");
               }
//               break;
            }
           });  

            $('#instrumental').change(function(){
            console.log($('#manual').val());
            console.log($('#instrumental').val());

            var man = $('#manual').val();
            var ins = $('#instrumental').val();
            var int = 0;

            for(var i =0; i < man.length; i++){
               for(var j =0; j < ins.length; j++){
                     if(man[i] == ins[j]){
                        console.log(man[i]);
                        console.log(ins[j]);                     
                        int = 1;
                        break;

                        //desabiliar 
                     }
               }              
               if(int == 1){
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ man[i] +"no puede estar en Manual e Intrumental");
               }
//               break;
            }
           });         
      

         $('#bolsa').change(function(){
            console.log($('#bolsa').val());
            console.log($('#caja').val());
            console.log($('#recipiente').val());

            var bol = $('#bolsa').val();
            var caja = $('#caja').val();
            var rec = $('#recipiente').val();
            var int = 0;

            for(var i =0; i < bol.length; i++){
               for(var j =0; j < caja.length; j++){
                     if((bol[i] == caja[j]) || (bol[i] == rec[j])){
                        console.log(bol[i]);
                        console.log(caja[j]);      
                        console.log(rec[j]);                  
                        int = 1;
                        break;
                     }
               }              
               if(int == 1){
               //   console.log('se repite');
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ bol[i] +"no puede estar en Manual e Intrumental");
               }
//               break;
            }
           });
           $('#caja').change(function(){
            console.log($('#bolsa').val());
            console.log($('#caja').val());
            console.log($('#recipiente').val());

            var bol = $('#bolsa').val();
            var caja = $('#caja').val();
            var rec = $('#recipiente').val();
            var int = 0;

            for(var i =0; i < bol.length; i++){
               for(var j =0; j < caja.length; j++){
                     if((bol[i] == caja[j]) || (bol[i] == rec[j])){
                        console.log(bol[i]);
                        console.log(caja[j]);      
                        console.log(rec[j]);                  
                        int = 1;
                        break;
                     }
               }              
               if(int == 1){
               //   console.log('se repite');
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ bol[i] +"no puede estar en Manual e Intrumental");
               }
//               break;
            }
           });
           $('#recipiente').change(function(){
            console.log($('#bolsa').val());
            console.log($('#caja').val());
            console.log($('#recipiente').val());

            var bol = $('#bolsa').val();
            var caja = $('#caja').val();
            var rec = $('#recipiente').val();
            var int = 0;

            for(var i =0; i < bol.length; i++){
               for(var j =0; j < caja.length; j++){
                     if((bol[i] == caja[j]) || (bol[i] == rec[j])){
                        console.log(bol[i]);
                        console.log(caja[j]);      
                        console.log(rec[j]);                  
                        int = 1;
                        break;
                     }
               }              
               if(int == 1){
               //   console.log('se repite');
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ bol[i] +"no en el mismo embalaje");
               }
//               break;
            }
           });  


});