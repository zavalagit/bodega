$(function(){

   $('body').on('change','#fiscalia-select',
      function(){
         console.log('hola ' + $('#fiscalia-select').val() );
         
         let fiscalia_id = $('#fiscalia-select').val();

         if (fiscalia_id == 4) {
            $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               /*data: {fiscalia_id: fiscalia_id},*/
               url: '/get-unidades',
               type: 'post',
           }).done(function(data){
               console.log(data);
               
               let option = '';
   
               option =
                  '<div id="div-unidades" class="input-field col s12 m6 l2">'+
                     '<select id="unidad-select" name="buscar_unidad">'+
                        '<option value="" selected>SELECCIONE LA UNIDAD</option>';
               $.each(data,function(i,valor){
                   
                   $.each(valor,function(j,v){
                       let n = j+1;
                       option = option + '<option value="'+v['id']+'">'+n+'.- '+v['nombre']+'</option>';
                       
                   });
   
                   option = option +
                     '</select>'+
                     '<label>ESPECIALIDAD</label>'+
                     '</div>';
                   
               });
               
               console.log(option);
   
               $('#div-unidades').remove();
               $('#div-fiscalias').after(option);
               $('#unidad-select').material_select();
           });
         }
         else{
            $('#div-unidades').remove();
         }
      }
   );

});