<ul class="collapsible expandable">
   <li>
       <div class="collapsible-header collapsible-titulo" style="background-color: #c09f77; color: #152f4a; padding: 0 10px !important; font-weight:bolder">
           <div style="font-weight:bolder; font-size:25px;">DESGLOSE POR SOLICITUD</div>
       </div>
   </li>
   @foreach ($especialidades->sortBy('nombre') as $key => $especialidad)
      <li>
         <div class="collapsible-header">
            <div class=""><b> <i class="fas fa-chevron-down"></i> {{$especialidad->nombre}}</b></div>
         </div>
         <div class="collapsible-body">
            <table class="highlight bordered">
               <thead>
                  <th>Nº</th>
                  <th>Solicitud</th>
                  <th>Recibidas</th>
                  <th>Atendidas</th>
                  <th>Pendientes</th>
                  <th>Rezago</th>
                  <th>Dictamen</th>
                  <th>Certificado</th>
                  <th>Informe</th>
                  <th>Salida juzgado</th>
                  <th>Archivo</th>
				  @if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))
				  <th>Colaboraciones</th>
				  @endif
                  <th>Estudios</th>
               </thead>
               <tbody>
                  @foreach ($especialidad->solicitudes->sortBy('nombre')->values() as $n => $solicitud)
                     <tr>
                        <td style="width:5%;">{{$n+1}}</td>
                        <!--solicitud-->
                        <td style="width:45%; text-align: left;">{{$solicitud->nombre}}</td>
                        <td>{{$recibidas->where('solicitud_id',$solicitud->id)->count()}}</td>
                        <!--atendidas-->
                        <td>{{$atendidas->where('solicitud_id',$solicitud->id)->count()}}</td>
                        <!--pendientes-->
                        <td>{{$pendientes->where('solicitud_id',$solicitud->id)->count()}}</td>
                        <!--rezago-->
                        <td>{{$recibidas->where('solicitud_id',$solicitud->id)->where('estado','pendiente')->count()}}</td>
                        <!--dictamen-->
                        <td>{{$atendidas->where('solicitud_id',$solicitud->id)->where('documento_emitido','dictamen')->count()}}</td>
                        <!--certificado-->
                        <td>{{$atendidas->where('solicitud_id',$solicitud->id)->where('documento_emitido','certificado')->count()}}</td>
                        <!--informe-->
                        <td>{{$atendidas->where('solicitud_id',$solicitud->id)->where('documento_emitido','informe')->count()}}</td>
                        <!--juzgado-->
                        <td>{{$atendidas->where('solicitud_id',$solicitud->id)->where('documento_emitido','salida_juzgado')->count()}}</td>
                        <!--archivo-->
                        <td>{{$atendidas->where('solicitud_id',$solicitud->id)->where('documento_emitido','archivo')->count()}}</td>
						<!--colaboraciones-->
						@if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))
                        <td>{{$atendidas->where('solicitud_id',$solicitud->id)->where('documento_emitido','colaboraciones')->count()}}</td>
						@endif
                        <!--estudios-->
                        <td>{{$atendidas->where('solicitud_id',$solicitud->id)->sum('cantidad_estudios')}}</td>
                     </tr>
                  @endforeach
                  <tr>
                     <td>{{$especialidad->solicitudes->count() + 1}}</td>
                     <td>TOTAL</td>
                     <!--recibidas-->
                     <td>{{$recibidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->count()}}</td>
                     <!--atendidas-->
                     <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->count()}}</td>
                     <!--pendientes-->
                     <td>{{$pendientes->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->count()}}</td>
                     <!--rezago-->
                     <td>{{$recibidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('estado','pendiente')->count()}}</td>
                     <!--dictamen-->
                     <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','dictamen')->count()}}</td>
                     <!--certificado-->
                     <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','certificado')->count()}}</td>
                     <!--informe-->
                     <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
                     <!--juzgado-->
                     <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','salida_juzgado')->count()}}</td>
                     <!--archivo-->
                     <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','archivo')->count()}}</td>
					 <!--colaboraciones-->
					 @if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))
                     <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','colaboraciones')->count()}}</td>
					 @endif
                     <!--estudios-->
                     <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->sum('cantidad_estudios')}}</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </li>
   @endforeach
</ul>

