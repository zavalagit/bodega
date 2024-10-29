$(function(){

   /**
    * HTML
    *    <div class="input-field col s1">
            <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="reingreso-responsable-bodega-autocomplete" data-input-hidden="prestamo-responsable-bodega">
               <i class="fas fa-times-circle fa-lg" ></i>
            </a>
         </div>
    * 
    *    Lo importante son los data-input-autocomplete y data-input-hidden que son
    *    los id's de esos campos
    */

   $(document).on('click','.btn-limpiar-input-autocomplete',function(e){
      e.preventDefault();
      let input_hidden = $(this).attr('data-id-input-hidden');
      let input_autocomplete = $(this).attr('data-id-input-autocomplete');

      $('#'+input_hidden).val('');
      $('#'+input_autocomplete).prop('disabled',false);
      $('#'+input_autocomplete).val('');

   });

});