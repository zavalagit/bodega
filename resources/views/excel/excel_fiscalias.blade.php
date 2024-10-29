<table border="1">
  <thead>
      <tr>
         <td rowspan="2">Fiscalía</td>
         <td rowspan="2">Peticiones</td>
         <td colspan="3">UNIDADES</td>
      </tr>
      <tr>
         @foreach ($data['unidades']->sortBy('nombre') as $unidad)
            <td>{{$unidad->nombre}}</td>             
         @endforeach
      </tr>
  </thead>
  <tbody>
   @php $no = 1; @endphp
      @foreach ($data['petfiscalias']->sortBy('nombre') as $petfiscalia)
            <tr>
               <td rowspan="3">{{$no++}}</td>
               <td rowspan="3">{{$petfiscalia->nombre}}</td>
                  <td rowspan="3">{{$petfiscalia->nombre}}</td>
               <td>Atendidas</td>
               @foreach ($data['unidades']->sortBy('nombre') as $unidad)
                  <td>{{$data['peticiones']->whereIn('estado',['atendida','entregada'])->where('unidad_id',$unidad->id)->where('petfiscalia_id',$petfiscalia->id)->count()}}</td>
               @endforeach    
            </tr>          
            
            <tr>
               
               <td>Pendientes</td>
               @foreach ($data['unidades']->sortBy('nombre') as $unidad)
                  <td>{{$data['peticiones']->where('estado','pendiente')->where('unidad_id',$unidad->id)->where('petfiscalia_id',$petfiscalia->id)->count()}}</td>
               @endforeach    
            </tr>
            
            <tr>
               <td>Total Recibidas</td>
               @foreach ($data['unidades']->sortBy('nombre') as $unidad)
                  <td>{{$data['peticiones']->where('petfiscalia_id',$petfiscalia->id)->where('unidad_id',$unidad->id)->count()}}</td>
               @endforeach    
            </tr>


         {{-- <tr>
            <td colspan="2">Total atendidas</td>

            @foreach ($unidades as $unidad)
               <td>{{$data['peticiones']->whereIn('esatdo',['atendidad','entregada'])->where('unidad_id',$unidad->id)->where('petfiscalia_id',$petfiscalia->id)->count()}}</td> 
            @endforeach
         </tr>
         <tr>
            <td colspan="2">Total pendientes</td>

            @foreach ($unidades as $unidad)
    
            <td>{{$data['peticiones']->where('esatdo','pendiente')->where('unidad_id',$unidad_id)->where('petfiscalia_id',$petfiscalia->id)->count()}}</td>
            @endforeach

         </tr> --}}
         
      @endforeach



      {{-- @php
        $no = 1;
      @endphp
      @foreach ($data['cadenas'] as $key => $cadena)
        @if($no%2 == 0)
        <tr>
        @else
        <tr class="grey lighten-2">
        @endif
              <td rowspan="{{$cadena->indicios->count()}}"><b>{{$no++}}</b></td>
              @if ($data['folio'])                      
                <td rowspan="{{$cadena->indicios->count()}}"><b>{{$cadena->folio_bodega}}</b></td>
              @endif
              <td rowspan="{{$cadena->indicios->count()}}"><b>{{$cadena->nuc}}</b></td>
              <td rowspan="{{$cadena->indicios->count()}}"><b>{{date('d-m-Y', strtotime($cadena->entrada->fecha))}}</b></td>
              @if ($data['sp_entrega'])
                <td rowspan="{{$cadena->indicios->count()}}"><b>{{$cadena->entrada->perito->nombre}}</b></td>  
              @endif
              <td rowspan="{{$cadena->indicios->count()}}"><b>{{$cadena->fiscalia->nombre}}</b></td>
           
                
                  @foreach ($cadena->indicios as $indicio)
                    @if ($loop->iteration > 1)
                     <tr>
                    @endif
                      <td>{{$indicio->identificador}}</td>
                      <td>{{$indicio->descripcion}}</td>
                      @if ($data['indicio_estado'])  
                        <td>{{$indicio->estado}}</td>
                     @endif
                     
                     @if ($data['indicio_resguardo'])
                        <td>
                        @if ($indicio->estado === 'activo')
                              BODEGA
                        @elseif($indicio->estado === 'prestamo')
                           {{$indicio->prestamos->where('estado','activo')->first()->perito1->nombre}}
                        @elseif($indicio->estado === 'baja')
                           @isset ($indicio->baja->perito_id)
                              {{$indicio->baja->perito->nombre}}
                           @endisset
                           @empty($indicio->baja->perito_id)
                              {{$indicio->baja->quien_recibe}} <br>
                              {{$indicio->baja->identificacion}}
                           @endempty
                        @endif
                        </td>
                     @endif
                     
                     </tr>
                    
                  @endforeach
                
              
        
      @endforeach --}}
  </tbody>
</table>



<table>
   <thead>
      <tr>
         <td rowspan="2">Fiscalía</td>
         <td rowspan="2">Documento emitido</td>
         <td colspan="{{$data['unidades']->count()}}">UNIDADES</td>
      </tr>
      <tr>
         @foreach ($data['unidades']->sortBy('nombre') as $unidad)
             <td>{{$unidad->nombre}}</td>
         @endforeach
      </tr>
   </thead>
   <tbody>
      @php $no = 1; @endphp
      @foreach ($data['petfiscalias']->sortBy('nombre') as $petfiscalia)
         <tr>
            <td rowspan="5">{{$no++}}</td>
            <td rowspan="5">{{$petfiscalia->nombre}}</td>
            <td>Dictamen</td>
            @foreach ($data['unidades']->sortBy('nombre') as $unidad)
               <td>{{$data['peticiones']->where('unidad_id',$unidad->id)->where('documento_emitido','dictamen')->where('petfiscalia_id',$petfiscalia->id)->count()}}</td>
            @endforeach
         </tr>
         <tr>
            <td>Informe</td>
            @foreach ($data['unidades']->sortBy('nombre') as $unidad)
               <td>{{$data['peticiones']->where('unidad_id',$unidad->id)->where('documento_emitido','informe')->where('petfiscalia_id',$petfiscalia->id)->count()}}</td>
            @endforeach
         </tr>
         <tr>
            <td>Certificado</td>
            @foreach ($data['unidades']->sortBy('nombre') as $unidad)
               <td>{{$data['peticiones']->where('unidad_id',$unidad->id)->where('documento_emitido','certificado')->where('petfiscalia_id',$petfiscalia->id)->count()}}</td>
            @endforeach
         </tr>
         <tr>
            <td>Salida juzgado</td>
            @foreach ($data['unidades']->sortBy('nombre') as $unidad)
               <td>{{$data['peticiones']->where('unidad_id',$unidad->id)->where('documento_emitido','salida_juzgado')->where('petfiscalia_id',$petfiscalia->id)->count()}}</td>
            @endforeach
         </tr>
         <tr>
            <td>Total</td>
            @foreach ($data['unidades']->sortBy('nombre') as $unidad)
               <td>{{$data['peticiones']->where('unidad_id',$unidad->id)->whereIn('documento_emitido',['dictamen','informe','certificado','salida_juzgado'])->where('petfiscalia_id',$petfiscalia->id)->count()}}</td>
            @endforeach
         </tr>

      @endforeach
   </tbody>
</table>

{{--
<table border="0">
  <tbody>
    @php
        $nombre = Auth::user()->name;
        $iniciales=substr($nombre,0,1);

        for ($i=0; $i < strlen($nombre)-1; $i++) {
          if($nombre[$i] == ' ')
            $iniciales = "{$iniciales}{$nombre[$i+1]}";
        }
      @endphp
    <tr>
      <td colspan="4" class="right-align border-no"></td>
    </tr>
    <tr>
      <td colspan="4" class="right-align border-no">{{$iniciales}}</td>
    </tr>
  </tbody>
</table>
--}}