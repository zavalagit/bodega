$(function(){
   /*
   --Agregamos el siguiente codigo en el blade
   @if ($cadena->indicios->count() > 3)
      <thead>
         <tr>
            <th width="5%" class="th-center">
               <input class="filled-in" type="checkbox" id="select-indicios" data-num="{{$cadena->indicios->sum('numero_indicios')}}" name=""/>
               <label for="indicios-select"></label>
            </th>
            <th colspan="3"><b>SELECCIONA TODOS LOS INDICIO/EVIDENCIAS</b></th>
         </tr>
      </thead>
   @endif
   */
   /*
   --En el input cheackbox agregamos la clase "indicio-checkbox"
   */

   $('#select-indicios').click(function(e){
      if($(this).prop('checked')){
         $('.indicio-checkbox').prop('checked',true);
      }else{
         $('.indicio-checkbox').prop('checked',false);
      }
   });
   $('.indicio-checkbox').click(function(){
      if ($(this).prop('checked')) {
         let cantidad_identificadores = parseInt($('#select-indicios').attr('data-cantidad-identificadores'));
         let cantidad_indicio_checkbox = $('.indicio-checkbox:checked').length;
         if(cantidad_identificadores == cantidad_indicio_checkbox )
            $('#select-indicios').prop('checked',true);
      }else{
         $('#select-indicios').prop('checked',false);
      }
   })
});
