$(function(){
   
   
   
   

   $('body').on('change','#solicitud-select',function(){
      console.log($('#solicitud-select').val());
      console.log(typeof $('#solicitud-select').val());
      
      if( ($('#solicitud-select').val() === '61') || ($('#solicitud-select').val() === '62') ){
         if( $('#necropsia-clasificacion-select').length === 0 ){
            let option = 
               '<div id="div-row-necropsia-clasificacion" class="input-field col s12 m6 l6">'+
                  '<select id="necropsia-clasificacion-select" name="necropsia_clasificacion">'+
                     '<option value="" selected disabled>SELECCIONA LA CLASIFICACIÓN DE LA NECROPSIA</option>'+
                     '<option value="dolosa">1.- Dolosa</option>'+
                     '<option value="hecho_transito">2.- Hecho de tránsito</option>'+
                     '<option value="patologia_otra">3.- Patología u otra</option>'+
                     '<option value="suicidio">4.- Suicidio</option>'+
                     '<option value="apoyo_uspec">5.- Apoyo a la USPEC</option>'+
                     '<option value="apoyo_uecs">5.- Apoyo a la UECS</option>'+
                  '</select>'+
                  '<label>ESPECIALIDAD</label>'+
               '</div>';
            

            $('select').material_select();
            $('#div-row-segunda-etapa').append(option);
            $('select').material_select();
         }
      }
      else{
         $('#div-row-necropsia-clasificacion').remove();
         $('#div-row-necropsia-tipo').remove();
      }
         
         
         
   });

   $('body').on('change','#necropsia-clasificacion-select',function(){
      console.log('teeeeewerwerwerwwwerwer');

      let necropsia_tipo = $(this).val();
      
      
      $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data: {necropsia_tipo: necropsia_tipo},
         url: '/get-necropsias',
         type: 'post',
      }).done(function(data){
         let option = 
            '<div id="div-row-necropsia-tipo" class="input-field col s12 m6 l6">'+
               '<select id="necropsia-tipo-select" name="necropsia_tipo">'+
                  '<option value="" selected disabled>SELECCIONA EL LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO</option>';
         
         let n=1;
         $.each(data.necropsias,function(i,necropsia){
            option = option + '<option value="'+necropsia.id+'">'+n+'.- '+necropsia.nombre+'</option>';
            n = n + 1;
         });

         option = option+
            '</select>'+
            '<label>ESPECIALIDAD</label>'+
            '</div>';
       
         if( $('#necropsia-tipo-select').length > 0 ){

            console.log('si entro aqui');
            
            $('#div-row-necropsia-tipo').remove();
         }

         $('select').material_select();
         $('#div-row-segunda-etapa').append(option);
         $('select').material_select();
      });


   });

});