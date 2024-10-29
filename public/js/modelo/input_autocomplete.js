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

   $('body').on('click','.btn-limpiar-input-autocomplete',function(e){
      e.preventDefault();
      let input_autocomplete = $(this).attr('data-input-autocomplete');
      let input_hidden = $(this).attr('data-input-hidden');

      $('#'+input_autocomplete).removeAttr('readonly');
      $('#'+input_autocomplete).val('');
      $('#'+input_hidden).val('');

   });

});