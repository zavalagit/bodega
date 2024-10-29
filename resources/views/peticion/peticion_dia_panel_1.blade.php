 <div class="col s12 div-table-responsive" style="margin-top:10px;">
   <table id="tabla-panel-uno" class="">
      <caption width="100%">DESGLOSE DE PETICIONES DEL DÍA</caption>
      <thead>
         <tr>
            <th>Tipo peticiones</th>
            <th width="6%" class="th-center">Rcibidas</th>
            <th width="6%" class="th-center">Atendidas</th>
            <th width="6%" class="th-center">Pendientes</th>
            <th width="6%" class="th-center">Rezago</th>
            <th width="6%" class="th-center">Dictamen</th>
            <th width="6%" class="th-center">Certificado</th>
            <th width="6%" class="th-center">Informe</th>
            <th width="6%" class="th-center">Salida Juzgado</th>
            <th width="6%" class="th-center">Archivo</th>
			{{--@if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))--}}
				<th width="6%" class="th-center">Colaboraciones</th>
			{{--@endif--}}
            <th width="6%" class="th-center">Estudios</th>
            <th width="8%">Necropsias registradas en el día</th>             
            <th width="8%">Necropsiaa pertenecientes al día</th>
         </tr>
      </thead>
      <tbody>
         <!--peticiones del día-->
         <tr>
            <!--tipo de peticiones-->
            <td>Peticiones del día</td>
            <!--recibidas-->
            <td class="td-numero">{{$recibidas->count()}}</td>
            <!--atendidas-->
            <td class="td-numero">{{$atendidas->count()}}</td>
            <!--pendientes-->
            <td class="td-numero">{{$recibidas->where('estado','pendiente')->count() + $recibidas->where('fecha_sistema','>',old('b_fecha_inicio',date('Y-m-d')))->count()}}</td>
            <!--rezago-->
            <td class="td-numero">{{$recibidas->where('estado','pendiente')->count()}}</td>
            <!--dictamen-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','dictamen')->count()}}</td>
            <!--certificado-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','certificado')->count()}}</td>            
            <!--informe-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','informe')->count()}}</td>
            <!--juzgado-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','salida_juzgado')->count()}}</td>
            <!--archivo-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','archivo')->count()}}</td>
			<!--colaboraciones-->
            {{--@if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))--}}
				<td class="td-numero">{{$atendidas->where('documento_emitido','colaboraciones')->count()}}</td>
			{{--@endif--}}
            <!--estudios-->
            <td class="td-numero">{{$atendidas->sum('cantidad_estudios')}}</td>
            <!--necropsias_registradas_en_el_dia-->
            <td class="td-numero">{{$atendidas->where('necropsia_id','<>',null)->count()}}</td>
            <!--necropsias_pertenecientes_al_dia-->
            <td class="td-numero">{{$necros->count()}}</td>
         </tr>

         <!--peticiones atendidas en dia, pero registradas en fecha anterior-->
         <tr>
            <!--tipo de peticiones-->
            <td>Peticiones atendidas en día, pero registradas en fecha anterior</td>
            <!--recibidas-->
            <td class="td-numero">---</td>
            <!--atendidas-->
            <td class="td-numero">{{$rezago->count()}}</td>
            <!--pendientes-->
            <td class="td-numero">---</td>
            <!--rezago-->
            <td class="td-numero">---</td>
            <!--dictamen-->
            <td class="td-numero">{{$rezago->where('documento_emitido','dictamen')->count()}}</td>
            <!--certificado-->
            <td class="td-numero">{{$rezago->where('documento_emitido','certificado')->count()}}</td>
            <!--informe-->
            <td class="td-numero">{{$rezago->where('documento_emitido','informe')->count()}}</td>
            <!--juzgado-->
            <td class="td-numero">{{$rezago->where('documento_emitido','salida_juzgado')->count()}}</td>
            <!--archivo-->
            <td class="td-numero">{{$rezago->where('documento_emitido','archivo')->count()}}</td>
			<!--colaboraciones-->
            {{--@if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))--}}
				<td class="td-numero">{{$rezago->where('documento_emitido','colaboraciones')->count()}}</td>
			{{--@endif--}}
            <!--estudios-->
            <td class="td-numero">{{$rezago->sum('cantidad_estudios')}}</td>
            <!--necropsias_registradas_en_el_dia-->
            <td class="td-numero">---</td>
            <!--necropsias_pertenecientes_al_dia-->
            <td class="td-numero">---</td>
         </tr>

         <!--total-->
         <tr class="tr-total">
            <!--tipo de peticiones-->
            <td>TOTAL</td>
            <!--recibidas-->
            <td class="td-numero">{{$recibidas->count()}}</td>
            <!--atendidas-->
            <td class="td-numero">{{$atendidas->count() + $rezago->count()}}</td>
            <!--pendientes-->
            <td class="td-numero">{{$recibidas->where('estado','pendiente')->count() + $recibidas->where('fecha_sistema','>',old('b_fecha_inicio',date('Y-m-d')))->count()}}</td>
            <!--rezago-->
            <td class="td-numero">{{$recibidas->where('estado','pendiente')->count()}}</td>
            <!--dictamen-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','dictamen')->count() + $rezago->where('documento_emitido','dictamen')->count()}}</td>
            <!--certificado-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','certificado')->count() + $rezago->where('documento_emitido','certificado')->count()}}</td>            
            <!--informe-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','informe')->count() + $rezago->where('documento_emitido','informe')->count()}}</td>
            <!--juzgado-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','salida_juzgado')->count() + $rezago->where('documento_emitido','salida_juzgado')->count()}}</td>
            <!--archivo-->
            <td class="td-numero">{{$atendidas->where('documento_emitido','archivo')->count() + $rezago->where('documento_emitido','archivo')->count()}}</td>
			<!--colaboraciones-->
            {{--@if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))--}}
				<td class="td-numero">{{$atendidas->where('documento_emitido','colaboraciones')->count() + $rezago->where('documento_emitido','colaboraciones')->count()}}</td>
			{{--@endif--}}
            <!--estudios-->
            <td class="td-numero">{{$atendidas->sum('cantidad_estudios') + $rezago->sum('cantidad_estudios')}}</td>
            <!--necropsias_registradas_en_el_dia-->
            <td class="td-numero">{{$atendidas->where('necropsia_id','<>',null)->count()}}</td>
            <!--necropsias_pertenecientes_al_dia-->
            <td class="td-numero">{{$necros->count()}}</td>
         </tr>
      </tbody>
   </table>
</div>
