

   function input_objeto_aportado_index(){
      $('.colectivo-parentesco').each(function(i,e){
         $('.div-objeto-aportado',this).each(function(j,f){
            $('input',this).removeAttr('name').attr('name','ausente_objeto_aportado['+i+']['+j+']'); 
         });
      });
   }

