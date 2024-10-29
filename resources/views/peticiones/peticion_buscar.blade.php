@extends('plantillas.plantilla_director')

@section('seccion', "PETICIONES")
@section('titulo','CONSULTAR-CADENA')

@section('css')

    <link rel="stylesheet" href="{{asset('css/botones/btn_icon.css')}}">
   <style media="screen">
      .fa-search{
         color: #4db6ac;
      }

      .fa-file-pdf-o{
         color: #b71c1c;
      }






     .div-buscador{
      margin: 0 !important;
      padding: 0 !important;
     }
     .fa-file-pdf{
       color: red;
     }
     .fa-copy{
       color: #607d8b;
     }
     .fa-file-pdf:hover,.fa-copy:hover,.fa-pen:hover{
       font-size: 117%;
     }




     table {
      width: 230% !important;
      overflow-x: scroll;
      overflow-y: hidden;
   }

   </style>
@endsection

@section('contenido')

@if ($errors->any())
   {{dd('holasss')}}
@endif



   <section>

      
      <form class="col s12">
         <div class="row">
            


            <div class="input-field col s2">
               <select multiple name="peticion_estado[]">
                  <option disabled>TODO</option>
                  @foreach ($array_peticion_estado as $pe)
                     @isset($request->peticion_estado)
                        <option value="{{$pe}}" {{ ( in_array($pe,$request->peticion_estado) ) ? "selected" : "" }}>{{strtoupper($pe)}}</option> 
                     @endisset
                     @empty($request->peticion_estado)
                        <option value="{{$pe}}" selected>{{strtoupper($pe)}}</option> 
                     @endempty
                  @endforeach
               </select>
               <label>Estado de la petición</label>
            </div>
            
            <div class="input-field col s2">
               <select name="fecha_tipo">
                  @foreach ($array_fecha_tipo as $ft)
                     <option value="{{$ft}}" {{ ($ft == $request->fecha_tipo) ? "selected" : "" }}>{{strtoupper($ft)}}</option>
                  @endforeach
               </select>
               <label>Tipo de fecha</label>
            </div>
         

            <div class="input-field col s3">
               <select name="especialidad_buscar" id="">
                  <option value="0" selected>Todo</option>
                  @foreach ($especialidades as $especialidad)                     
                     <option value="{{$especialidad->id}}" {{ ($especialidad->id == $request->especialidad_buscar) ? "selected" : "" }}>{{$especialidad->nombre}}</option>
                  @endforeach
               </select>
               <label>Especialidad</label>
            </div>

            <div class="input-field col s2">
               <input type="date" name="fecha_inicio" value="{{$request->fecha_inicio}}">
            </div>
            <div class="input-field col s2">
               <input type="date" name="fecha_fin" value="{{$request->fecha_fin}}">
            </div>
            <div class="input-field col s5">
               <input id="buscar-input" type="text" name="buscar_texto" value="{{$request->buscar_texto}}">
            </div>
            <div class="input-field col s1">
              <button class="btn-buscar btn-icon" type="submit" name="btn_buscar" value="buscar"><i class="fas fa-search fa-lg"></i></button>
              <button class="btn-buscar btn-icon" type="submit" name="btn_buscar" value="pdf"><i class="far fa-file-pdf fa-lg"></i></button>
            </div>
            {{--
            <div class="input-field col s1">
              <button class="btn-buscar btn-icon" type="submit" name="btn_buscar" value="pdf"><i class="fas fa-file-pdf fa-lg"></i></button>
            </div>
            --}}
         </div>
      </form>

      

{{--
      <form class="col s12">
            <div class="row">
               <div class="input-field col s11 ">
                 @isset($buscar_texto)
                     <input id="buscar-input" type="text" name="buscar_texto" value="{{$buscar_texto}}">
                 @endisset
                 @empty($buscar_texto)
                     <input id="buscar-input" type="text" placeholder="BUSCAR... NUC" name="buscar_texto">
                 @endempty
               </div>
               <div class="input-field col s1">
                 <button class="btn-buscar btn-icon" type="submit" name="btn_buscar" value="buscar"><i class="fas fa-search fa-lg"></i></button>
               </div>
            </div>
         </form>

--}}
    </section>

    

    <div class="row">
        <div class="col s12">
            <table class="highlight bordered centered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>fecha crear</th>
                  <th>fecha sistema</th>
                  <th>estudios</th>
                  <th>ESTADO</th>
                  <th style="text-align:left;">N.U.C.</th>
                  <th>FECHA PETICIÓN</th>
                  <th>NÚMERO OFICIO</th>
                  <th>folio interno</th>
                  <th style="text-align:left;">M. P. SOLICITA</th>
                  <th>FECHA ELABORACIÓN</th>
                  <th>DOCUMENTO EMITIDO</th>
                  <th style="text-align:left;">SOLICITUD</th>
                  <th>ESPECIALIDAD</th>
                  <th>FECHA DE ENTREGA</th>
                  <th style="text-align:left;">M. P. RECIBE</th>
                  <th style="text-align:left;">FISCALÍA</th>
                  <th style="text-align:left;">ADSCRIPCIÓN</th>
                  <th style="text-align:left;">PERITO</th>
                    @if (Auth::user()->tipo === 'director_fiscalia')
                    <th>UNIDAD</th>  
                    @endif
                </tr>
              </thead>
              <tbody>
                  @isset($peticiones)
                     @php
                     $no_consecutivo = 1;
                     @endphp
                     @foreach ($peticiones as $peticion)
                        <tr>
                           <td class="td-no" style="width:3%;">{{$no_consecutivo++}}</td>
                           <td style="width:3%;">{{ date('H:i:s d-m-Y',strtotime($peticion->created_at)) }}</td>
                           <td style="width:5%;">{{ date('d-m-Y',strtotime($peticion->fecha_sistema)) }}</td>
                           <td>{{$peticion->cantidad_estudios}}</td>
                           <td class="td-no" style="width:3%;">{{$peticion->estado}}</td>
                           <td style="text-align:left;">{{$peticion->nuc}}</td>
                           <td style="width:6%;">{{$peticion->fecha_peticion}}</td>
                           <td style="width:8%;">{{$peticion->oficio_numero}}</td>
                           <td style="width:6%;">{{$peticion->folio_interno}}</td>
                           <td style="text-align:left;width:10%;">{{$peticion->sp_solicita}}</td>
                           <!--2da etapa-->
                           <td style="width:6%;">
                              @isset($peticion->fecha_elaboracion)
                                 {{$peticion->fecha_elaboracion}} 
                              @endisset
                              @empty($peticion->fecha_elaboracion)
                                    ---
                              @endempty
                           </td>
                           <td style="width:8%;">
                              @isset($peticion->documento_emitido)
                                 {{strtoupper($peticion->documento_emitido)}} 
                              @endisset
                              @empty($peticion->documento_emitido)
                                    ---
                              @endempty
                           </td>
                           <td style="text-align:left;width:10%;">
                              @isset($peticion->solicitud_id)
                                 {{$peticion->solicitud->nombre}} 
                              @endisset
                              @empty($peticion->solicitud_id)
                                    ---
                              @endempty
                           </td>
                           <td style="width:8%;">
                              @isset($peticion->solicitud_id)
                                 {{$peticion->solicitud->especialidad->nombre}} 
                              @endisset
                              @empty($peticion->solicitud_id)
                                    ---
                              @endempty
                           </td>
                           <!--3ra etapa-->
                           <td style="width:6%;">
                              @isset($peticion->fecha_entrega)
                                 {{$peticion->fecha_entrega}} 
                              @endisset
                              @empty($peticion->fecha_entrega)
                                    ---
                              @endempty
                           </td>
                           <td  style="text-align:left;width:10%;">
                              @isset($peticion->sp_recibe)
                                 {{$peticion->sp_recibe}} 
                              @endisset
                              @empty($peticion->sp_recibe)
                                    ---
                              @endempty
                           </td>
                           <td style="text-align:left;width:10%;">{{$peticion->petfiscalia->nombre}}</td>
                           <td style="text-align:left;width:10%;">
                              @isset($peticion->petadscripcion_id)
                                 {{$peticion->petadscripcion->nombre}} 
                              @endisset
                              @empty($peticion->petadscripcion_id)
                                 ---
                              @endempty
                           </td>
                           <td style="text-align:left;width:15%;">{{$peticion->user->name}}</td>
                           @if (Auth::user()->tipo === 'director_fiscalia')
                           <td>{{$peticion->unidad->nombre}}</td>  
                           @endif

                        </tr>
                     @endforeach
                  @endisset
                  @empty($peticiones)
                     <tr>
                        @if (Auth::user()->tipo === 'director_fiscalia')
                           <td style="text-align:left; padding-left:10px; color:grey;" colspan="15">{{$mensaje}}</td>
                        @else
                           <td style="text-align:left; padding-left:10px; color:grey;" colspan="14">{{$mensaje}}</td>
                        @endif
                     </tr>
                  @endempty
              </tbody>
            </table>
        </div>
    </div>


    


   <!-- Modal Structure -->
  <div id="nota" class="modal">
    <div class="modal-content">
      <h5>Nota</h5>
      <p id="nota-mensaje">

      </p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>
  </div>


  <!-- Modal Etiqueta -->
  <div id="modal-etiqueta" class="modal">
    <div class="modal-content">
      <h5 class="center-align"><b>FORMATO DE ETIQUETADO</b></h5>
      <h5>Tipo de Etiqueta</h5>
      <form id="form-etiqueta" action="/etiqueta" target="_blank">




      </form>
    </div>

  </div>


@endsection

@section('js')
   <script type="text/javascript">
      $('.li-registrar-cadena').removeClass('active');
      $('.li-consultar-cadena').addClass('active');
      $('.a-disabled').bind('click', false);
   </script>

@endsection
