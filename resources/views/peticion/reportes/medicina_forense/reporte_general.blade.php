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

     <table>
      <thead>
         <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">ESPECIALIDAD</th>   
            <th colspan="{{$fiscalias->count()+1}}">FISCALÍAS</th>   
         </tr>
         <tr>
            @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
            <th>{{$fiscalia->nombre}}</th>
            @endforeach
            <th>TOTAL</th>
         </tr>
      </thead>
      <tbody>
         @php $n = 1; @endphp
         @foreach ($especialidades->sortBy('nombre') as $especialidad)
               <tr>
                  <td>{{$n++}}</td>
                  <td>{{$especialidad->nombre}}</td>

                  
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     <td>{{ number_format( $atendidas->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',2)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado'])->count() )}}</td>
                  @endforeach

               

                  <!--TOTAL-->   
                     <td>{{ number_format( $atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado'])->count() )}}</td>

               </tr>             
          @endforeach



            {{-- <tr>
               <td>{{$n++}}</td>
               <td>Necropsias</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     <td>{{ number_format( $necros->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',2)->count() )}}</td>  
               @endforeach
               <!--TOTAL-->
               <td>{{ number_format( $necros->count() )}}</td> 
            </tr> --}}

            
            <!--INFORMES-->
            <tr>
               <td>{{$n++}}</td>
               <td>Informes</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{ number_format( $atendidas->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',2)->where('documento_emitido','informe')->count() )}}</td>                    
               @endforeach
               <!--TOTAL-->
               <td>{{ number_format( $atendidas->where('documento_emitido','informe')->count() )}}</td>  
            </tr>
			
			<!--salida_juzgado-->
            <tr>
               <td>{{$n++}}</td>
               <td>Salida juzgado</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{ number_format( $atendidas->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',2)->where('documento_emitido','salida_juzgado')->count() )}}</td>                    
               @endforeach
               <!--TOTAL-->
               <td>{{ number_format( $atendidas->where('documento_emitido','salida_juzgado')->count() )}}</td>  
            </tr>
			
			<!--archivo-->
            <tr>
               <td>{{$n++}}</td>
               <td>Archivo</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{ number_format( $atendidas->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',2)->where('documento_emitido','archivo')->count() )}}</td>                    
               @endforeach
               <!--TOTAL-->
               <td>{{ number_format( $atendidas->where('documento_emitido','archivo')->count() )}}</td>  
            </tr>


            <tr>
               <td>{{$n++}}</td>
               <td>TOTAL</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{ number_format( $atendidas->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',2)->whereIn('documento_emitido',['dictamen','certificado','informe','salida_juzgado','archivo'])->count())}}</td>
               @endforeach
               <td>{{number_format( $atendidas->whereIn('documento_emitido',['dictamen','certificado','informe','salida_juzgado','archivo'])->count() )}}</td>
            </tr>
          
            </tbody>   
         </table>

         <table>
            <thead>
               <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">NECROPSIAS</th>   
                  <th colspan="{{$fiscalias->count()+1}}">FISCALÍAS</th>   
               </tr>
               <tr>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <th>{{$fiscalia->nombre}}</th>
                  @endforeach
                  <th>TOTAL</th>
               </tr>
            </thead>
            <tbody>
               @php $n = 1; @endphp
               <tr>
                  <td>{{$n++}}</td>
                  <td>Medicina</td>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                        <td>{{ number_format( $necros->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',2)->count() )}}</td>  
                  @endforeach
                  <td>{{ number_format( $necros->where('unidad_id',2)->count() )}}</td>
               </tr>
               <tr>
                  <td>{{$n++}}</td>
                  <td>USPEC</td>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                        <td>{{ number_format( $necros->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',108)->count() )}}</td>  
                  @endforeach
                  <td>{{ number_format( $necros->where('unidad_id',108)->count() )}}</td>
               </tr>
               <tr>
                  <td>{{$n++}}</td>
                  <td>UECCS</td>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                        <td>{{ number_format( $necros->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',66)->count() )}}</td>  
                  @endforeach
                  <td>{{ number_format( $necros->where('unidad_id',66)->count() )}}</td>
               </tr>
               
            </tbody>
         </table>

         {{-- <tr>
               <td>{{$n++}}</td>
               <td>Necropsias</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     <td>{{ number_format( $necros->where('fiscalia2_id',$fiscalia->id)->where('unidad_id',2)->count() )}}</td>  
               @endforeach
               <!--TOTAL-->
               <td>{{ number_format( $necros->count() )}}</td> 
            </tr> --}}

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