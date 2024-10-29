<div class="col s12">
   <table>
      @if ($cadena->indicios->count() > 3)
         <thead>
            <tr>
               <th width="6%" class="th-center">
                  <input class="filled-in" type="checkbox" id="select-indicios" data-cantidad-identificadores="{{$cadena->indicios->count()}}" data-num="{{$cadena->indicios->sum('numero_indicios')}}" name=""/>
                  <label for="select-indicios"></label>
               </th>
               <th colspan="3"><b>SELECCIONA TODOS LOS INDICIO/EVIDENCIAS</b></th>
            </tr>
         </thead>
      @endif
      <thead>
         <tr>
            <th class="th-center">SELECCIONAR</th>
            <th>IDENTIFICADOR</th>
            <th>DESCRIPCIÓN</th>
            <th class="th-center">NO. INDICIOS</th>
            {{-- <th>ESTADO</th> --}}
         </tr>
      </thead>
      <tbody>
         @foreach($cadena->indicios as $key => $indicio)
            <tr style="{{($indicio->estado != 'activo') ? 'background-color:#c6c6c6' : ''}}">
               <td width="6%" class="td-center">
                  <input type="checkbox" id="indicio-{{$indicio->id}}" class="indicio-checkbox filled-in" data-num="{{$indicio->numero_indicios}}" name="indicios[]" value={{$indicio->id}} {{($indicio->estado != 'activo') ? 'disabled' : ''}}/>
                  <label for="indicio-{{$indicio->id}}"></label>
               </td>
               <td width="10%">{{$indicio->identificador}}</td>
               <td>{{$indicio->descripcion}}</td>
               <td width="10%" class="td-center">{{$indicio->numero_indicios}}</td>
            </tr>
         @endforeach
      </tbody>
   </table>
</div>