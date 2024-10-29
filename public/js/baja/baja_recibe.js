$(function(){
   
   $("[name='input_radio_baja_recibe']").click(function () { 
      
      /*perosna que esta ahorita en el hmtl para la baja*/
      let persona = $('#datos-baja-recibe').attr('data-baja-recibe');
      console.log(persona);

      if ( $(this).val() == 'servidor_publico' ) {
         if( !(persona == 'servidor_publico') ){
            $('#datos-baja-recibe').empty();
            $('#datos-baja-recibe').attr('data-baja-recibe','servidor_publico');

            let append = 
               '<div class="input-field col s11">'+
                  '<input id="baja_recibe-servidor-publico" type="hidden" name="baja_recibe">'+
                  '<input  class="autocomplete" id="baja-recibe-autocomplete" data-tabla="peritos" data-input-hidden="baja_recibe-servidor-publico" type="text">'+
                  '<label for="baja-recibe-autocomplete">Servidor público</label>'+
               '</div>'+
               '<div class="input-field col s1">'+
                  '<a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="baja-recibe-autocomplete" data-input-hidden="baja_recibe-servidor-publico">'+
                     '<i class="fas fa-times-circle fa-lg" ></i>'+
                  '</a>'+
               '</div>';

            $('#datos-baja-recibe').append(append);
         }

      }
      else if( $(this).val() == 'civil' ){
         if( !(persona == 'civil') ){
            $('#datos-baja-recibe').empty();
            $('#datos-baja-recibe').attr('data-baja-recibe','civil');

            let append =
               '<div class="input-field col s4">'+
                  '<input type="text" id="civil-identificacion" name="baja_recibe_civil_identificacion">'+
                  '<label for="civil-identificacion">Identificación</label>'+
               '</div>'+
               '<div class="input-field col s8">'+
                  '<input type="text" id="civil-nombre" name="baja_recibe_civil_nombre">'+
                  '<label for="civil-nombre">Nombre</label>'+
               '</div>';

            $('#datos-baja-recibe').append(append);
         }
      }

      
   });

});