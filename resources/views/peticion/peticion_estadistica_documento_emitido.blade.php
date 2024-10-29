<table class="highlight bordered">
   <caption><b>DOCUMENTO EMITIDO</b></caption>
   <thead>
      <tr>
         <th>DOCUMENTO</th>
         <th>CANTIDAD DOCUMENTOS</th>
         <th>CANTIDAD ESTUDIOS</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td>DICTAMEN</td>
         <td>{{$atendidas->where('documento_emitido','dictamen')->count()}}</td>
         <td>{{$atendidas->where('documento_emitido','dictamen')->sum('cantidad_estudios')}}</td>
      </tr>
      <tr>
         <td>CERTIFICADO</td>
         <td>{{$atendidas->where('documento_emitido','certificado')->count()}}</td>
         <td>{{$atendidas->where('documento_emitido','certificado')->sum('cantidad_estudios')}}</td>
      </tr>
      <tr>
         <td>INFORME</td>
         <td>{{$atendidas->where('documento_emitido','informe')->count()}}</td>
         <td>{{$atendidas->where('documento_emitido','informe')->sum('cantidad_estudios')}}</td>
      </tr>
      <tr>
         <td>JUZGADO</td>
         <td>{{$atendidas->where('documento_emitido','salida_juzgado')->count()}}</td>
         <td>{{$atendidas->where('documento_emitido','salida_juzgado')->sum('cantidad_estudios')}}</td>
      </tr>
      <tr>
         <td>ARCHIVO</td>
         <td>{{$atendidas->where('documento_emitido','archivo')->count()}}</td>
         <td>{{$atendidas->where('documento_emitido','archivo')->sum('cantidad_estudios')}}</td>
      </tr>
	  @if(Auth::user()->unidad_id == 1 || in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']))
	  <tr>
         <td>COLABORACIONES</td>
         <td>{{$atendidas->where('documento_emitido','colaboraciones')->count()}}</td>
         <td>{{$atendidas->where('documento_emitido','colaboraciones')->sum('cantidad_estudios')}}</td>
      </tr>
	  @endif
      <tr>
         <td class="td-total">TOTAL</td>
         <td class="td-total">{{$atendidas->count()}}</td>
         <td class="td-total">{{$atendidas->sum('cantidad_estudios')}}</td>
      </tr>
   </tbody>
</table>