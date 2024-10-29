<table class="table-encabezado">
   <tr>
      <th colspan="2" style="text-align:center;">Relación de indicios y/o evidencias correspondiente a</td>
   </tr>
   
   @if ($datos['request']['nucs'][0] != null)
      <tr>
         <th rowspan="{{count($datos['request']['nucs'])}}">N.U.C.</td>
         <td>{{$datos['request']['nucs'][0]}}</td>
      </tr>
      @foreach ($datos['request']['nucs'] as $nuc)
         @continue($loop->first) 
         <tr>
            <td>{{$nuc}}</td>
         </tr>
      @endforeach
   @endif

   @if ($datos['request']['buscar_fecha_inicio'] != null)
      <tr>
      <th>Intervalo de fecha</th>
      <td>
         @if ($datos['request']['buscar_fecha_fin'] != null)
            {{ date("d-m-Y",strtotime($datos['request']['buscar_fecha_inicio']))}} ~ {{date("d-m-Y",strtotime($datos['request']['buscar_fecha_fin']))}} 
         @else
            {{$datos['request']['buscar_fecha_inicio']}}
         @endif
      </td>    
      </tr>
   @endif

   @if ($datos['request']['buscar_fiscalias'][0] != 0)
      <tr>
         <th rowspan="{{count($datos['request']['buscar_fiscalias'])}}">Región</td>
         <td>{{$fiscalias->where('id',$datos['request']['buscar_fiscalias'][0])->first()->nombre}}</td>
      </tr>
      @foreach ($datos['request']['buscar_fiscalias'] as $region)
         @continue($loop->first) 
         <tr>
            <td>{{$fiscalias->where('id',$region)->first()->nombre}}</td>
         </tr>
      @endforeach
   @endif

   @if ($datos['request']['buscar_naturalezas'][0] != 0)
      <tr>
         <th rowspan="{{count($datos['request']['buscar_naturalezas'])}}">Naturaleza</td>
         <td>{{$naturalezas->where('id',$datos['request']['buscar_naturalezas'][0])->first()->nombre}}</td>
      </tr>
      @foreach ($datos['request']['buscar_naturalezas'] as $naturaleza)
         @continue($loop->first) 
         <tr>
            <td>{{$naturalezas->where('id',$naturaleza)->first()->nombre}}</td>
         </tr>
      @endforeach
   @endif
   
   @if ($datos['request']['buscar_texto'][0] != null)
      <tr>
         <th rowspan="{{count($datos['request']['buscar_texto'])}}">Busqueda en descripción</td>
         <td>{{$datos['request']['buscar_texto'][0]}}</td>
      </tr>
      @foreach ($datos['request']['buscar_texto'] as $texto)
         @continue($loop->first) 
         <tr>
            <td>{{$texto}}</td>
         </tr>
      @endforeach
   @endif
</table>