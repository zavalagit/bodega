$(function(){
   /*
      --html:
         <div class="col s12">
            <div class="row">
               <div class="input-field col s12">
                  <input id="perito-hidden" type="hidden" name="id_perito">
                  <input  class="autocomplete" id="autocomplete-input" data-tabla="peritos" data-input-hidden="perito-hidden" type="text">
                  <label for="autocomplete-input">Autocomplete</label>
               </div>
            </div>
         </div>

         *contiene varios datas
            ·data-tabla -> tabla o modelo a la que se hace referencia
            ·data-input-hidden -> es el id del input donde vamos a cargar el id del modelo
            ·data-user-tipo -> en caso de que sea el modelo users podemos pasar que tipo de usuario queremos
   */

   $('body').on('keypress','input.autocomplete',function(){
      let buscar = $(this).val();
      let tabla = $(this).attr('data-tabla');
      let input_hidden =  $(this).attr('data-input-hidden');
      console.log(input_hidden);
      let _token;
      if($('#_token').val())
         _token = $('#_token').val();
      else{
         _token = $('#meta-csrf-token').attr('content');
      }
      let url;
      let datos = {
         '_token':_token,
         'buscar':buscar,
      }
   
      if (tabla == 'peritos') {
         url =  '/get-perito';
      }
      else if (tabla == 'users'){
         url = '/get-user';
         //user_tipo
         if($(this).attr('data-user-tipo')){
            datos['user_tipo'] = $(this).attr('data-user-tipo');
         }
         //user_fiscalia
         if($(this).attr('data-user-fiscalia')){
            datos['user_fiscalia'] = $(this).attr('data-user-fiscalia');
         }
      }

      // console.log(datos);
   
  
      $.ajax({
         url: url,
         type: 'POST',
         data: datos,
         success:function(data){
            // console.log(data.registros);
            let objeto_input = {}; //elementos a cargar en el input autocomplete
            let objeto_id = {}; //ids de los elementos que se cargan en el input autocomplete, para despues obtener el id del registro seleccionado
            let clave;

            data.registros.forEach(element => {
               //  console.log(element.folio);
               if (tabla == 'peritos') {
                  clave = element.folio+' - '+element.nombre;
               }
               else if(tabla == 'users'){
                  clave = element.folio+' - '+element.name;
               }
               
               objeto_input[clave] = null;
               objeto_id[clave] = element.id;      
            });

            /*Autocomplete*/
            $('input.autocomplete').autocomplete({
               data: objeto_input,
               limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
               onAutocomplete: function(val) {
                  // Callback function when value is autcompleted.
                  // console.log(val);
                  $('#'+input_hidden).val(objeto_id[val]);

               },
               minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
         }
      });
   });
});

