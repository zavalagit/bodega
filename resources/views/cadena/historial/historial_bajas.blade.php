<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','4. BAJAS ~ ')
      @slot('icono','fas fa-file-export')
   @endcomponent

   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th rowspan="2">Nº</th>
               {{-- <th>NO. INDICIOS</th> --}}                  
               <th rowspan="2">ACCIONES</th>
               <th rowspan="2">PDF</th>
               <th rowspan="2">FOTOS</th>
               <th rowspan="2">DESCRIPCIÓN</th>
               <th>H. BAJA</th>               
               <th>RB. ENTREGA</th>
               
               {{-- <th>IDENTIFICACIÓN</th>
               <th>CARGO</th> --}}
               <th rowspan="2">OBSERVACIONES</th>
            </tr>
            <tr>
               <th>F. BAJA</th>
               <th>RECIBE</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($cadena->bajas as $i => $baja)
               <tr>
                  <td rowspan="2">{{$i+1}}</td>
                  <!--acciones-->
                  <td rowspan="2">
                     <a href="{{route('baja_form',['formAccion'=>'editar','cadena'=>$cadena,'baja'=>$baja])}}" target="_blank">
                        <i class="fas fa-edit"></i> <small><strong>(Editar)</strong></small>
                     </a> <hr>
                     <!--eliminar-->
                     <a href="{{route('baja_eliminar',['baja'=>$baja])}}" class="registro-eliminar">
                        <i class="fas fa-trash"></i> <small><strong>(Borrar)</strong></small>
                     </a>
                  </td>
                  <!--pdf-->
                  <td rowspan="2"> <a href="{{route('baja_pdf',['baja'=>$baja])}}" target="_blank"><i class="fas fa-file-pdf"></i></a> </td>
                  <!--fotos-->
                  <td rowspan="2" width="4%">
                     <a href=""
                        class="foto-form-modal"
                        data-cadena="{{$cadena}}"
                        data-modelo="baja"
                        data-modelo-id="{{$baja->id}}"
                     >
                        <i class="fas fa-file-upload"></i> <small><strong>(Subir)</strong></small>
                     </a> <hr>
					 {{--
                     @if ($baja->fotos->count())
                        <a
                           href="{{$baja->fotos->count() ? '' : route('foto_form',['modelo'=>'baja','modelo_id'=>$baja])}}"
                           class="{{$baja->fotos->count() ? 'btn-fotos' : ''}}"
                           data-modelo="baja"
                           data-modelo-id="{{$baja->id}}"
                        >
                           <i class="far fa-image"></i> <small><strong>(Ver)</strong></small>
                        </a>                         
                     @endif
					 --}}
                  </td>                  
                  <!--descripcion-->            
                  <td rowspan="2">
                     @foreach($baja->indicios as $key => $indicio)
                        <b>{{$indicio->identificador}}:</b> {{$indicio->pivot->baja_tipo == 'parcial' ? $indicio->pivot->baja_descripcion : $indicio->descripcion}} ~ <span style="color: tomato;">({{$indicio->pivot->baja_tipo}})</span><br>
                     @endforeach
                  </td>
                  <td>{{date('H:i:s',strtotime($baja->hora))}}</td>
                  <td>{{$baja->user->name}}</td>
                  <td rowspan="2">{{$baja->observaciones ?? '---'}}</td>
               </tr>
               <tr>
                  <td>{{date('d-m-Y',strtotime($baja->fecha))}}</td>
                  <td>
                     @isset($baja->perito_id)                     
                        {{$baja->perito->folio}} - {{$baja->perito->nombre}} - {{$baja->perito->cargo->nombre}}
                     @endisset
                     @empty($baja->perito_id)
                        {{$baja->identificacion}}: {{$baja->quien_recibe}}
                     @endempty
                  </td>
               </tr>
            @empty
               <tr>
                  <td colspan="9">No hay registros</td>
               </tr>
            @endforelse
         </tbody>
      </table>
   </div>
</div>
{{--
@foreach ($cadena->bajas as $baja)
   <div class="row" style="display: none;">
      <div class="col s12">
         <ul id="fotos-baja-{{$baja->id}}">
            @foreach ($baja->fotos as $i => $foto)
               <li><img src="{{asset('storage/fotos_indicios/'.$cadena->folio_bodega.'/baja'.'/'.$baja->id.'/'.$foto->nombre)}}" alt="Foto-{{$i}}"></li>            
            @endforeach         
         </ul>
      </div>
   </div>
@endforeach
--}}