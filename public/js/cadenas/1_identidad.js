$(function(){

   //Agrega nueva descripcion
   $('#add-desc').click(function(e)
   {
      e.preventDefault();
      var desc =
         '<div class="row div-indicio">'+
         '<hr>'+
            '<div class="input-field col s12 m3 l2">'+
               '<input id="identificador" type="text" class="center-align" name="identificador[]">'+
               '<label for="identificador">IDENTIFICADOR*</label>'+
            '</div>'+
            '<div class="input-field col s12 m9 l9">'+
               '<textarea id="descripcion" class="materialize-textarea" name="descripcion[]"></textarea>'+
               '<label for="descripcion">DESCRIPCIÓN*</label>'+
            '</div>'+
            '<div class="input-field col s12 m12 l5">'+
               '<textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]"></textarea>'+
               '<label for="descripcion">UBICACIÓN DEL LUGAR*</label>'+
            '</div>'+
            '<div class="input-field col s6 m6 l2">'+
               '<input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]">'+
               '<label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>'+
            '</div>'+
            '<div class="input-field col s6 m6 l2">'+
               '<input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]">'+
               '<label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>'+
            '</div>'+
            '<div class="input-field col s12 m4 l2">'+
               '<input id="estado_indicio" type="text" name="estado_indicio[]">'+
               '<label for="estado_indicio">ESTADO DEL INDICIO</label>'+
            '</div>'+
            '<div class="input-field col s12 m8 l9">'+
               '<textarea id="observacion" class="materialize-textarea" name="observacion[]"></textarea>'+
               '<label for="observacion">OBSERVACIÓN EN ETIQUETA</label>'+
            '</div>'+
            '<div class="input-field col s6 m1 l1 center-align">'+
               '<a href="" class="clonar-indicio">'+
                  '<i class="fas fa-clone" style="color:orange"></i>'+
               '</a>'+
            '</div>'+
            '<div class="input-field col s6 m1 l1 center-align">'+
               '<a href="" class="x-desc">'+
                  '<i class="fas fa-times" style="color:red"></i>'+
               '</a>'+
            '</div>'+
         '</div>';

      $('#identidad').append(desc);

   });
   
   //Elimina una descripcion
   $('body').on('click',".x-desc",function(e){
      e.preventDefault();

      console.log('holaaaaaa');
      

      var hijos = $('#identidad').children('.div-indicio');

      if(hijos.length > 1)
        $(this).parent().parent().remove();
   });

   //Clonar indicio
   $('body').on('click',".clonar-indicio",function(e){
      e.preventDefault();
      $(this).parent().parent().clone().appendTo('#identidad');
   });

});
