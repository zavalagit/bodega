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
	 
	 <style>
		table th,table td{
         
          font-size: 9px !important;
      }
	  </style>
	 
     <table>
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
          @foreach ($necropsia_clasificaciones as $necropsia_clasificacion)
            <tr>
              <td colspan="{{$fiscalias->count() +5 }}" style="text-align: center; background-color: #152F4A; color: white !important;">{{strtoupper($necropsia_clasificacion->nombre)}}</td>
            </tr>
             {{-- @continue( ($necropsia_clasificacion == 'apoyo_uspec') || ($necropsia_clasificacion == 'apoyo_uecs') ) --}}
             @foreach ($necropsias->where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->sortBy('nombre') as $necropsia)
                <tr>
                   <td>{{$n++}}</td>
                   <td>{{$necropsia->nombre}}</td>
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
         
          
             @endforeach
          

             <tr style="background-color: #c09f77; color:white !important;">
               <td>{{$n++}}</td>
               <td>TOTAL</td>
               
               <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',2)->count()}}</td>
               <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',108)->count()}}</td>
               <td>{{$necros->where('fiscalia2_id',4)->where('unidad_id',66)->count()}}</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  @continue($fiscalia->id == 4)
                    <td>{{$necros->where('fiscalia2_id',$fiscalia->id)->count()}}</td>
              @endforeach
                  <td>{{$necros->count()}}</td>
               
             </tr>
          
             
          
          
        </tbody>   
      </table>  

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