@php
   $array_necropsia_tipo = array(
      'dolosa' => 0,
      'hecho_transito' => 0,
      'patologia_otra' => 0,
      'suicidio' => 0,
      'apoyo_uspec' => 0,
      'apoyo_uecs' => 0,
   );
@endphp
@foreach ($necropsias_uecs as $peticion)
         @php
            $array_necropsia_tipo[$peticion->necropsia->necropsia_tipo] += 1;
         @endphp
@endforeach


<ul class="collapsible" data-collapsible="expandable" style="margin-top:0 !important;">
   <li>
      <div class="collapsible-header collapsible-titulo">
         <div>NECROPSIAS UECS</div>
      </div>
    </li>
   @foreach ($array_necropsia_tipo as $key => $necropsia_tipo)
      <li>
         <div class="row collapsible-header">
            <div class="col s10"><b>{{strtoupper($key)}}</b></div>
            <div class="col s2"><b>{{$necropsia_tipo}}</b></div>
         </div>
         <div class="collapsible-body">
            <table class="highlight bordered">
               @foreach ($necropsias->where('necropsia_tipo',$key) as $necropsia)
                  <tr>
                     <td class="td-izq"><b>{{$necropsia->nombre}}</b></td>
                     <td class="td-der">{{$necropsias_uecs->where('solicitud_id',61)->where('necropsia_id',$necropsia->id)->count()}}</td>
                  </tr>
               @endforeach
            </table>
         </div>
      </li>
   @endforeach
   <li>
      <div class="row collapsible-header" style="padding:0 !important;">
         <div class="collapsible-izq col s9"><b>TOTAL NECROPSIAS</b></div>
         <div class="collapsible-der col s3"><b>{{$necropsias_uecs->where('solicitud_id',61)->count()}}</b></div>
      </div>
    </li>
</ul>
