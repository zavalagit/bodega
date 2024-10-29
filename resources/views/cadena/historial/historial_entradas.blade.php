<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','2. INGRESO ~ ')
      @slot('icono','fas fa-file-export')
   @endcomponent
   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th>FOLIO</th>
               <th>H. INGRESO</th>
               <th>F. INGRESO</th>
               <th>FOTOS</th>
               <th>AGREGAR FOTOS</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{$cadena->folio_bodega}}</td>
               <td>{{date('H:i:s',strtotime($cadena->entrada->hora))}}</td>
               <td>{{date('d-m-Y',strtotime($cadena->entrada->fecha))}}</td>
               <td>
                  {{-- <a
                     href="{{$cadena->entrada->fotos->count() ? '' : route('foto_form',['modelo'=>'entrada','modelo_id'=>$cadena->entrada])}}"
                     class="{{$cadena->entrada->fotos->count() ? 'fotos-ingreso' : ''}}"
                  >
                     <i class="far fa-image"></i>
                  </a> --}}
                  <a
                     href=""
                     class="btn-fotos"
                     data-modelo="entrada"
                     data-modelo-id="{{$cadena->entrada->id}}"
                  >
                     <i class="far fa-image"></i>
                  </a>
               </td>
               <td>
                  <a href=""
                     class="foto-form-modal"
                     data-cadena="{{$cadena}}"
                     data-modelo="entrada"
                     data-modelo-id="{{$cadena->entrada->id}}"
                  >
                     <i class="fas fa-file-upload"></i>
                  </a>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="col s12"><hr class="hr-1"></div>
</div>
{{--
<div class="row" style="display: none;">
   <div class="col s12">
      <ul id="fotos-entrada-{{$cadena->entrada->id}}">
         @foreach ($cadena->entrada->fotos as $i => $foto)
            <li><img src="{{asset('storage/fotos_indicios/'.$cadena->folio_bodega.'/entrada//'.$cadena->entrada->id.'/'.$foto->nombre)}}" alt="Foto-{{$i}}"></li>            
         @endforeach         
       </ul>
   </div>
</div>
--}}