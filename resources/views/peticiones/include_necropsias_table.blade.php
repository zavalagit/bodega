@php
   $array_necropsia_tipo = array(
         'suicidio' => 0,
         'dolosa' => 0,
         'hecho_transito' => 0,
         'patologia_otra' => 0
   );
@endphp
@foreach ($peticiones_recibidas as $peticion)
   @isset($peticion->necropsia_id)
         @php
            $array_necropsia_tipo[$peticion->necropsia->necropsia_tipo] += 1;
         @endphp
   @endisset
@endforeach


<table class="highlight bordered">
   <caption><b>NECROPSIAS</b></caption>
   <tbody>
         @foreach ($array_necropsia_tipo as $key => $necropsia_tipo)
            <tr>
               <td class="td-izq td-sub"><b>{{strtoupper($key)}}</b></td>
               <td class="td-der td-sub"><b>{{$necropsia_tipo}}</b></td>
            </tr>
            @foreach ($necropsias->where('necropsia_tipo',$key) as $necropsia)
               <tr>
                  <td class="td-izq">{{$necropsia->nombre}}</td>
                  <td class="td-der">{{$peticiones_recibidas->where('necropsia_id',$necropsia->id)->count()}}</td>
               </tr>
            @endforeach
         @endforeach
         <tr>
            <td class="td-izq-total"><b>Total necropsias</b></td>
            <td class="td-der-total"><b>{{$peticiones_recibidas->where('solicitud_id',61)->count()}}</b></td>
         </tr>
   </tbody>
</table>
