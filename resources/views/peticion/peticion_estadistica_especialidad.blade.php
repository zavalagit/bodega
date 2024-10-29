<table>
   <caption><b>PETICIONES POR ESPECIALIDAD</b></caption>
   <thead>
       <tr>
           <th>Nº</th>
           <th>Especialidad</th>
           <th>Recibidas</th>
           <th>Atendidas</th>
           <th>Pendientes</th>
           <th>Rezago</th>
           <th>Dictamen</th>
           <th>Certificado</th>
           <th>Informe</th>
           <th>Salida a Juzgado</th>
           <th>Archivo</th>
		   @if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))
			   <th>Colaboraciones</th>
		   @endif
           <th>Estudios</th>
       </tr>
   </thead>
   <tbody>
      @foreach ($especialidades->sortBy('nombre')->values() as $i => $especialidad)
         <tr>
            <td>{{$i + 1}}</td>
            <td>{{$especialidad->nombre}}</td>
            <!--recibidas-->
            <td>{{$recibidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->count()}}</td>
            <!--atendidas-->
            <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->count()}}</td>
            <!--pendiente-->
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
      @endforeach

      <!--TOTAL-->
      <tr>
         <td>{{$i+2}}</td>
         <td>TOTAL</td>
         <!--recibidas-->
         <td>{{$recibidas->count()}}</td>
         <!--atendidas-->
         <td>{{$atendidas->count()}}</td>
         <!--pendiente-->
         <td>{{$pendientes->count()}}</td>
         <!--pendiente-->
         <td>{{$recibidas->where('estado','pendiente')->count()}}</td>
         <!--dictamen-->
         <td>{{$atendidas->where('documento_emitido','dictamen')->count()}}</td>
         <!--certificado-->
         <td>{{$atendidas->where('documento_emitido','certificado')->count()}}</td>
         <!--informe-->
         <td>{{$atendidas->where('documento_emitido','informe')->count()}}</td>
         <!--juzgado-->
         <td>{{$atendidas->where('documento_emitido','salida_juzgado')->count()}}</td>
         <!--archivo-->
         <td>{{$atendidas->where('documento_emitido','archivo')->count()}}</td>
		 <!--colaboraciones-->
		 @if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))
         <td>{{$atendidas->where('documento_emitido','colaboraciones')->count()}}</td>
		 @endif
         <!--estudios-->
         <td>{{$atendidas->sum('cantidad_estudios')}}</td>
      </tr>
   </tbody>
</table>