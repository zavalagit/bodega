@component('peticion.peticion_componentes.peticion_componente_reporte')
   @slot('fecha_formato',$fecha_formato)

   {{--
      <div id="titulo">
         <h4><b>FISCALÍA {{Auth::user()->fiscalia->nombre}}</b></h4>
         @if (Auth::user()->tipo === 'director_unidad')
         <h4><b>FISCALÍA {{Auth::user()->unidad->nombre}}</b></h4>
         @endif
     </div>
     --}}

     @foreach ($necropsia_clasificaciones as $necropsia_clasificacion)
     {{-- @continue( ($necropsia_clasificacion == 'apoyo_uspec') || ($necropsia_clasificacion == 'apoyo_uecs') ) --}}
     <table>
       <caption><b>{{mb_strtoupper($necropsia_clasificacion->nombre)}}</b></caption>
      <thead>
          <tr>
            <th>No.</th>
            <th>AUTOPSIA MECANISMOS</th>   
            <th>MORELIA</th>   
            <th>USPEC</th>   
            <th>UECS</th>   
            @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
              @continue($fiscalia->id == 4)
              <th>{{$fiscalia->nombre}}</th>
            @endforeach
            <th>TOTAL</th>
         </tr>
      </thead>
      <tbody>
         @php $n = 1; @endphp
            @foreach ($necropsias->where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->sortBy('nombre') as $necropsia)
               <tr>
                  <td>{{$n++}}</td>
                  <td style="text-align: 10% !important;">{{$necropsia->nombre}}</td>
                  <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',2)->where('necropsia_id',$necropsia->id)->count()}}</td>
                  <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',108)->where('necropsia_id',$necropsia->id)->count()}}</td>
                  <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',66)->where('necropsia_id',$necropsia->id)->count()}}</td>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     @continue($fiscalia->id == 4)
                     <td>{{$necros->where('fiscalia2_id',$fiscalia->id)->where('necropsia_id',$necropsia->id)->count()}}</td>
                  @endforeach
                  <td>{{$necros->where('necropsia_id',$necropsia->id)->count()}}</td>
               </tr>

               
               
            @endforeach
        

         {{-- @foreach ($necropsias->where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->sortBy('nombre') as $necropsia) --}}
            <tr>
              <td>{{$n++}}</td>
              <td>TOTAL</td>
              <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',2)->whereIn('necropsia_id',$necropsias->where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->pluck('id'))->count()}}</td>
               <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',108)->whereIn('necropsia_id',$necropsias->where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->pluck('id'))->count()}}</td>
               <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',66)->whereIn('necropsia_id',$necropsias->where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->pluck('id'))->count()}}</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  @continue($fiscalia->id == 4)
                  <td>{{$necropsias->where('fiscalia2_id',$fiscalia->id)->whereIn('necropsia_id',$necropsias->where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->pluck('id'))->count()}}</td>
               @endforeach
                  <td>{{$necropsias->whereIn('necropsia_id',$necropsias->where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->pluck('id'))->count()}}</td>

            </tr>
         {{-- @endforeach   --}}
{{--
            @php
                $ids = [];
                      foreach ($necros->where('necropsia_clasificacion_id',$necropsia_clasificacion->id) as $key => $necro) {
                        array_push($ids, $necro->id);
                      }
            @endphp
    --}}        
            
          </tbody>   
        </table>  
        @endforeach
        
        <br>
        <br>
        
        <table style="border: 0px !important;">
          <tr>
            <td style="border: 0px !important; text-align: center;">COORDINADOR GENERAL DE SERVICIOS PERICIALES <br> DR. EN D. PEDRO GUTIERREZ GUTIERREZ</td>
            <td style="border: 0px !important; text-align: center;">TITULAR DE LA {{Auth::user()->unidad->nombre}}<br> {{Auth::user()->name}}</td>
          </tr>
          <br>
          <!--
          <tr>
             <td style="border: 0 0 1px 0 solid #000 !important; text-align: center;"><br></td>
             <td style="border: 0 0 1px 0 solid #000 !important; text-align: center;"><br></td>
          </tr>
       -->
        </table>

@endcomponent