$(function(){
   let data_autocomplete = {}; //elementos a cargar en el input autocomplete
   let data_modelo_id = {};
   let input_autocomplete;
   let data_ajax = {}; //datos a enviar por ajax
   const modelo = {
      'user': modelo_user(),
      // 'perito': modelo_perito(),
      // 'unidad': modelo_unidad(),
   };
   /*
      --html:
         *UNIDAD

         <div class="input-field col s11">
            <input type="hidden" id="unidad-hidden" name="unidad" value="{{isset($cadena->id) ? $cadena->unidad_id : ''}}">
            <input type="text" id="unidad-autocomplete" class="autocomplete"
               {{isset($cadena->id) ? 'disabled' : ''}}
               data-input-hidden="unidad-hidden"
               data-modelo="unidad"
               data-url="{{route('get_modelo_unidades')}}"
               data-btn="btn-unidad-autocomplete-reset"
               placeholder="Escriba el nombre de la Unidad y despues seleccione alguna de las sugerencias mostradas"
               value="{{isset($cadena->id) ? $cadena->unidad->nombre : ''}}"
            >
            <label for="autocomplete-input"><i class="fas fa-archway"></i> ~ UNIDAD ADMINISTRATIVA
               <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
            </label>
         </div>
         <div class="input-field col s1">
            <a href="" id="btn-unidad-autocomplete-reset" class="btn-autocomplete-reset" 
               data-input-hidden="unidad-hidden"
               data-input-autocomplete="unidad-autocomplete">
               <i class="fas fa-times-circle fa-lg" ></i>
            </a>
         </div>
   */

   $(document).on('keypress','input.autocomplete',function(e){
      input_autocomplete = $(this);
      $.ajax({
         url: $(this).attr('data-url'),
         type: 'POST',
         data: get_data(),
         success:function(data){
            // e.preventDefault();
            data.registros.forEach(element => {
               get_clave(element);   
            });
         }
      });

      autocomplete();
   });

   //get_data
   function get_data(){
      data_ajax['_token'] = $('#_token').val() ? $('#_token').val() : $('#meta-csrf-token').attr('content');
      data_ajax['buscar'] = $(input_autocomplete).val();
      modelo[$(input_autocomplete).attr('data-modelo')]; //constante modelo
      return data_ajax;
   };
   
   //Datos a enviar por modelo
   //modelo_user
   function modelo_user(){
      data_ajax['user_tipo'] = $(input_autocomplete).attr('data-user-tipo') ? $(input_autocomplete).attr('data-user-tipo') : null; 
      data_ajax['user_fiscalia'] = $(input_autocomplete).attr('data-user-fiscalia') ? $(input_autocomplete).attr('data-user-fiscalia') : null; 
      data_ajax['user_unidad'] = $(input_autocomplete).attr('data-user-unidad') ? $(input_autocomplete).attr('data-user-unidad') : null;
   };
   
   //get_clave para el autocomplete
   function get_clave(registro){
      let clave;
      if ($(input_autocomplete).attr('data-modelo') == 'perito')
         clave = registro.folio+' - '+registro.nombre;
      else if($(input_autocomplete).attr('data-modelo') == 'user')
         clave = registro.folio+' - '+registro.name;
      else if($(input_autocomplete).attr('data-modelo') == 'unidad')
         clave = registro.nombre;

      data_autocomplete[clave] = null;
      data_modelo_id[clave] = registro.id; 

   }


   //Autocomplete
   function autocomplete(){
      $(input_autocomplete).autocomplete({
         data: data_autocomplete,
         onAutocomplete: function(clave) {
            // Callback function when value is autcompleted.
            $( '#'+$(input_autocomplete).attr('data-input-hidden') ).val(data_modelo_id[clave]);
            $(input_autocomplete).prop('disabled',true);

            data_autocomplete = {};
            data_modelo_id = {};
            data_ajax = {};
         },
         minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
      });
      // $('#'+attr_id).prop('disabled',true);
   };

   $('.btn-autocomplete-reset').click(function(e){
      e.preventDefault();
      $('#' + $(this).attr('data-input-hidden') ).val('');
      $('#' + $(this).attr('data-input-autocomplete') ).val('').prop('disabled',false);
   })
});

