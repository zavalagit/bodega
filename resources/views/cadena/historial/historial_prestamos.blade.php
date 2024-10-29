<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','3. PRESTAMOS ~ ')
      @slot('icono','fas fa-file-export')
   @endcomponent

   {{-- <div class="col s12 m12 l12">
      <a href="" style="color: #152f4a; display: block;" class="right-align foto-form-modal">
         <i class="fas fa-file-upload" style="color: #c09f77;"></i>
         <b><span> - Agregar fotos</span></b>
      </a>
   </div> --}}

   <div class="col s12">
      <table style="width: 100% !important;">
         <thead>
            <tr>
               <th rowspan="2" class="th-contador">Nº</th>
               <th rowspan="2">ESTADO</th>
               <th rowspan="2">ACCIÓN</th>
               <th rowspan="2">PDF</th>
               <th rowspan="2">FOTOS</th>
               {{-- <th>FOLIO</th> --}}
               <th>H. PRESTAMO</th>
               <th>F. PRESTAMO</th>
               <th>RB. ENTREGA</th>
               <th>SP. RECIBE</th>
               <th>INDIC. PRESTAMO</th>
            </tr>
            <tr>
               {{-- <th>N.U.C.</th> --}}
               <th>H. REINGRESO</th>
               <th>F. REINGRESO</th>
               <th>RB. RECIBE</th>
               <th>SP. ENTREGA</th>
               <th>INDIC. REINGRESO</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($cadena->prestamos as $i => $prestamo)
               <tr>
                  <td rowspan="2" width="2%">{{$i+1}}</td>
                  <td rowspan="2" width="5%">{{$prestamo->estado}}</td>
                  <!--accion-->
                  <td rowspan="2" width="6%">
                     <!--editar-->
                     <a href="/bodega/prestamo-editar-form/{{$prestamo->id}}" target="blank">
                        <i class="fas fa-edit"></i> <small><strong>(Editar)</strong></small>
                     </a>
                     <hr>
                     <!--eliminar-->
                     <a href="{{route('prestamo_eliminar',['prestamo'=>$prestamo])}}" class="registro-eliminar">
                        <i class="fas fa-trash"></i> <small><strong>(Borrar)</strong></small>
                     </a>
                  </td>
                  <!--pdf-->
                  <td rowspan="2" width="4%">
                     <a href="/bodega/prestamo-pdf/{{$prestamo->id}}" target="blank"><i class="fas fa-file-pdf"></i></a>
                  </td>
                  <!--fotos-->                  
                  <td rowspan="2" width="4%">
                     <a href=""
                        class="foto-form-modal"
                        data-cadena="{{$cadena}}"
                        data-modelo="prestamo"
                        data-modelo-id="{{$prestamo->id}}"
                     >
                        <i class="fas fa-file-upload"></i> <small><strong>(Subir)</strong></small>
                     </a> <hr>
					 {{--
                     @if ($prestamo->fotos->count())
                        <a
                           href="{{$prestamo->fotos->count() ? '' : route('foto_form',['modelo'=>'prestamo','modelo_id'=>$cadena->prestamo])}}"
                           class="{{$prestamo->fotos->count() ? 'btn-fotos' : ''}}"
                           data-modelo="prestamo"
                           data-modelo-id="{{$prestamo->id}}"
                        >
                           <i class="far fa-image"></i> <small><strong>(Ver)</strong></small>
                        </a>                         
                     @endif
					 --}}
                  </td>
                  <td width="5%">{{date('H:i:s',strtotime($prestamo->prestamo_hora))}}</td>
                  <td width="5%">{{date('d-m-Y',strtotime($prestamo->prestamo_fecha))}}</td>
                  <td width="32%">{{$prestamo->user1->name}}</td>
                  <td width="32%">{{$prestamo->perito1->nombre}}</td>
                  <td width="5%">---</td>
               </tr>
               <tr>
                  {{-- <td>{{$cadena->nuc}}</td> --}}
                  <td>{{date('H:i:s',strtotime($prestamo->reingreso_hora)) ?? '---'}}</td>
                  <td>{{$prestamo->reingreso_fecha}}</td>
                  <td>{{$prestamo->user2->name ?? '---'}}</td>
                  <td>{{$prestamo->perito2->nombre ?? '---'}}</td>
                  <td>---</td>
               </tr>                      
            @endforeach
         </tbody>
      </table>
   </div>
   <div class="col s12"><hr class="hr-1"></div>
</div>

{{--
@foreach ($cadena->prestamos as $prestamo)
   <div class="row" style="display: none;">
      <div class="col s12">
         <ul id="fotos-prestamo-{{$prestamo->id}}">
            @foreach ($prestamo->fotos as $i => $foto)
               <li><img src="{{asset('storage/fotos_indicios/'.$cadena->folio_bodega.'/prestamo//'.$prestamo->id.'/'.$foto->nombre)}}" alt="Foto-{{$i}}"></li>            
            @endforeach         
         </ul>
      </div>
   </div>
@endforeach
--}}