<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','1. INDICIOS SELECCIONA ~ ')
      @slot('icono','fas fa-check-square')
   @endcomponent

   <div class="col s12">
      <table>
         {{-- @if ($cadena->indicios->count() > 3)
            <thead>
               <tr>
                  <th width="6%" class="th-center">
                     <label for="select-indicios">
                        <input class="filled-in" type="checkbox" id="select-indicios" data-cantidad-identificadores="{{$cadena->indicios->count()}}" data-num="{{$cadena->indicios->sum('numero_indicios')}}" name=""/>
                        <span></span>
                     </label>
                  </th>
                  <th colspan="5"><b>SELECCIONA TODOS LOS INDICIO/EVIDENCIAS</b></th>
               </tr>
            </thead>
         @endif --}}
         <thead>
            <tr>
               <th class="th-center">SELECCIONAR</th>
               <th class="th-center">ESTADO</th>
               <th>IDENTIFICADOR</th>
               <th>DESCRIPCIÓN</th>
               <th class="th-center">CANTIDAD DE INDICIOS</th>
               <th class="th-center">CATEGORIA</th>
               
               {{-- <th>ESTADO</th> --}}
            </tr>
         </thead>
         <tbody>
            @foreach($cadena->indicios as $key => $indicio)
               <tr>
                  @php $rowspan = isset($indicio->indicio_descripcion_disponible) ? 2 : 1; @endphp
                  <td rowspan="{{$rowspan}}" class="td-center" width="5%">
                     <label for="indicio-{{$indicio->id}}">
                        <input type="checkbox"
                           id="indicio-{{$indicio->id}}"
                           class="indicio-checkbox filled-in"
                           {{$formAccion == 'editar' ? 'disabled' : ''}}
                           {{isset($baja->id) && $baja->indicios->contains('id',$indicio->id) ? 'checked' : ''}}
                           {{in_array($indicio->estado,['prestamo','baja','prestamo_baja']) ? 'disabled' : ''}}
                           name="indicios[]"
                           value={{$indicio->id}}
                        />
                        <span></span>
                     </label>
                  </td>
                  <td rowspan="{{$rowspan}}" class="td-center" width="4%">
                     @include('indicio.indicio_estado')
                  </td>
                  <td rowspan="{{$rowspan}}" width="8%"><b>{{$indicio->identificador}}</b></td>
                  <td>{{$indicio->descripcion}}</td>
                  <td width="8%" class="td-center">{{$indicio->numero_indicios}}</td>
                  <td rowspan="{{$rowspan}}" width="10%">
                     <select id="baja-tipo-{{$indicio->id}}"
                        class="select-baja-tipo"
                        data-url="{{route('baja_parcial_vista',['indicio'=>$indicio])}}"
                        data-indicio-id="{{$indicio->id}}"
                        disabled
                        name="indicios_baja_tipo[{{$indicio->id}}]">
                        <option value="" disabled selected>Elije el tipo de baja</option>
                        <option value="parcial">Parcial</option>
                        <option value="completa" {{($indicio->estado == 'activo_baja' ? 'disabled' : '')}}>Completa</option>
                     </select>
                  </td>
               </tr>
               @isset($indicio->indicio_descripcion_disponible)
                  <tr>
                     <td><span style="color:tomato;">Disponible: </span>{{$indicio->indicio_descripcion_disponible}}</td>
                     <td class="td-center"><span style="color:tomato;">{{$indicio->indicio_cantidad_disponible}}</td>
                  </tr>
               @endisset
            @endforeach
         </tbody>
      </table>
   </div>
</div>