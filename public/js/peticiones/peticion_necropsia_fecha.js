$(function(){

   $('.tooltipped').tooltip({delay: 50});

   $('#solicitud-select').change(
      function(){
         let solicitud = $('#solicitud-select').val();
         let fecha = $('#fecha-elaboracion').val();

         
            if( (solicitud == 61) || (solicitud == 62) ){
               $('#fecha-elaboracion').parent().removeClass('l12');
               $('#fecha-elaboracion').parent().addClass('l6');

               let input = 
                  '<div class="input-field col s12 m12 l6">'+
                     '<input id="fecha-necropsia" type="date" class="center-align" name="fecha_necropsia">'+
                     '<label class="active" for="fecha-necropsia">DÍA AL QUE PERTENCE LA NECROPSIA (DÍA EN LA QUE SE REPORTA)</label>'+
                     '<a style="color:#152f4a"> <i style="color:red;" class="fas fa-info-circle"></i> Tenga en cuenta que el día para el reporte de las necropsias comienza, por ejemplo, hoy a las 07:00:00 a.m. y termina el día de mañana a las 06:59:59 a.m.  </a>'+
                  '</div>';

               $('#fecha-elaboracion').parent().after(input);
               
            }
            else{
               $('#fecha-necropsia').parent().remove();
               $('#fecha-elaboracion').parent().removeClass('l6');
               $('#fecha-elaboracion').parent().addClass('l12');
            }
         


      }
   );

   $('.tooltipped').tooltip({delay: 50});

});