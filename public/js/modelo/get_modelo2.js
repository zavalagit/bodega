$(function(){
   let autocomplete_data = {}; //elementos a cargar en el input autocomplete
   let input_hidden = {};
   // const modelo_clave{
   //    user : clave_user()
   // }
   // let attr_id;
   // $('input.autocomplete').autocomplete({
   //    data: {
   //      "Apple": null,
   //      "Microsoft": null,
   //      "Google": 'https://placehold.it/250x250'
   //    },
   //  });
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

   function autocomplete(attr_id) {
      $('#'+attr_id).autocomplete({
         data: autocomplete_data,
         limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
         onAutocomplete: function(clave) {
            // Callback function when value is autcompleted.
            console.log(clave);
            $('#' + $('#'+attr_id).attr('data-input-hidden') ).val(input_hidden[clave]);
            $('#'+attr_id).prop('disabled',true);
         },
         minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
      });
      // $('#'+attr_id).prop('disabled',true);
   }
   
   /*modelo user*/
   function modelo_user(input){
      let datos = {};
         datos['user_tipo'] = $(input).attr('data-user-tipo') ? $(input).attr('data-user-tipo') : null; 
         datos['user_fiscalia'] = $(input).attr('data-user-fiscalia') ? $(input).attr('data-user-fiscalia') : null; 
         datos['user_unidad'] = $(input).attr('data-user-unidad') ? $(input).attr('data-user-unidad') : null;
      return datos;
   }
   function clave_user(registro){
      let clave = registro.folio+' - '+registro.name;
      return clave;
   }

   function get_data(input) { //attr_id es el id del input autocomplete
      const modelo = {
         'user': modelo_user(input),
      }
      datos = modelo[$(input).attr('data-modelo')]
      datos['buscar'] = $(input).val();
      datos['_token'] = $('#_token').val() ? $('#_token').val() : $('#meta-csrf-token').attr('content');

      return datos;
   }         


   $(document).on('keypress','input.autocomplete',function(e){
      // let input_autocomplete = $(this);
      let modelo = $(this).attr('data-modelo');
      $.ajax({
         url: $(this).attr('data-url'),
         type: 'POST',
         data: get_data( $(this) ),
         success:function(data){
            e.preventDefault();
            // console.log(data);
            let objeto_input = {}; //elementos a cargar en el input autocomplete
            let objeto_id = {}; //ids de los elementos que se cargan en el input autocomplete, para despues obtener el id del registro seleccionado
            let clave;

            data.registros.forEach(element => {
               if (modelo == 'perito') {
                  clave = element.folio+' - '+element.nombre;
               }
               else if(modelo == 'user'){
                  clave = clave_user(element);
               }
               
               objeto_input[clave] = null;
               objeto_id[clave] = element.id;      
            });

            console.log(objeto_input);
            autocomplete_data = objeto_input;
            input_hidden = objeto_id;
         }
      });

      autocomplete($(this).attr('id'));
   });
});

