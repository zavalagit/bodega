<div class="row">
   <div class="col s12">
      @component('componentes.componente_nota_2')
         @slot('icono')
            <i style="color: tomato" class="fas fa-comment-alt"></i>
         @endslot
         @slot('mensaje')
            Solo las Peticiones de Necropsia y Estudio Osteológico que están <strong><i>atendidas</i></strong> se veran reflejadas.
         @endslot         
      @endcomponent
   </div>
   <!--necropsias-->
   @foreach ($unidades_necropsias as $unidad)
      @continue( ( Auth::user()->tipo == 'coordinador_peticiones_unidad' ) && ( Auth::user()->unidad_id != $unidad->id ) )
	  @continue( ( Auth::user()->tipo == 'coordinador_peticiones_region' ) && ( $unidad->id != 2 ) )

      <div class="col s12 l2">
         <ul class="collapsible">
            <li>
               <div class="collapsible-header" style="background-color: #c09f77; color: #152f4a; font-weight: bold; font-size: 18px;">{{$unidad->sigla ?? $unidad->nombre}} - Necropsias</div>
            </li>
            @foreach ($necropsia_clasificaciones as $necropsia_clasificacion)
               <li>
                  <div class="collapsible-header">
                     {{-- <i class="fas fa-circle fa-xs"></i> --}}
                     {{$necropsia_clasificacion->nombre}}
                     <span class="badge">
                        {{
                           $necros->where('solicitud_id',61)
                              ->where('unidad_id',$unidad->id)
                              ->where('unidad3_id',null)
                              ->whereIn('necropsia_id',$necropsia_clasificacion->necropsia_causas->pluck('id'))
                              ->count()
                        }}
                     </span>
                  </div>
                  <div class="collapsible-body">
                     <table>
                        @foreach ($necropsia_clasificacion->necropsia_causas->sortBy('nombre') as $necropsia_causa)
                           <tr>
                              <td>{{$necropsia_causa->nombre}}</td>
                              <td>
                                 {{
                                    $necros->where('solicitud_id',61)
                                       ->where('unidad_id',$unidad->id)
                                       ->where('unidad3_id',null)
                                       ->where('necropsia_id',$necropsia_causa->id)
                                       ->count()
                                 }}
                              </td>
                           </tr>
                        @endforeach
                     </table>
                  </div>
               </li>                   
            @endforeach
            <!--unidadde para apoyar-->
            {{--@if ($unidad->id == 2)--}}
               @foreach ($unidades_apoyo->sortBy('nombre') as $unidad_apoyo)
                  <li>
                     <div class="collapsible-header">
                        {{-- <i class="fas fa-circle fa-xs"></i> --}}
                        Apoyo a {{$unidad_apoyo->nombre}}
                        <span class="badge">
                           {{$necros->where('unidad_id',$unidad->id)->where('solicitud_id',61)->where('unidad3_id',$unidad_apoyo->id)->count()}}
                        </span>
                     </div>
                     <div class="collapsible-body">
                        <table>
                           @foreach ($necropsia_clasificaciones->where('id',1)->first()->necropsia_causas->sortBy('nombre') as $necropsia_causa)
                              <tr>
                                 <td>{{$necropsia_causa->nombre}}</td>
                                 <td>{{$necros->where('solicitud_id',61)->where('unidad3_id',$unidad_apoyo->id)->where('necropsia_id',$necropsia_causa->id)->count()}}</td>
                              </tr>
                           @endforeach
                        </table>
                     </div>
                  </li>             
               @endforeach
			   {{--  @endif --}}
            <!--total-->
            <li>
               <div class="collapsible-header" style="background-color: #152f4a; color: #c09f77;">
                  {{-- <i class="fas fa-circle fa-xs"></i> --}}
                  <b>TOTAL</b>
                  <span class="badge" style="color: #c09f77;">
                     <b>{{$necros->where('solicitud_id',61)->where('unidad_id',$unidad->id)->count()}}</b>
                  </span>
               </div>
            </li>
         </ul>
      </div>
   @endforeach

   <!--osteologico-->
   @foreach ($unidades_necropsias as $unidad)
      @continue( ( Auth::user()->tipo == 'coordinador_peticiones_unidad' ) && ( Auth::user()->unidad_id != $unidad->id ) )
	  @continue( ( Auth::user()->tipo == 'coordinador_peticiones_region' ) && ( $unidad->id != 2 ) )
	  
      <div class="col s12 l2">
         <ul class="collapsible">
            <li>
               <div class="collapsible-header" style="background-color: #c09f77; color: #152f4a; font-weight: bold; font-size: 18px;">{{$unidad->sigla ?? $unidad->nombre}} - Osteológico</div>
            </li>
            @foreach ($necropsia_clasificaciones as $necropsia_clasificacion)
               <li>
                  <div class="collapsible-header">
                     {{-- <i class="fas fa-circle fa-xs"></i> --}}
                     {{$necropsia_clasificacion->nombre}}
                     <span class="badge">
                        {{
                           $necros->where('solicitud_id',62)
                              ->where('unidad_id',$unidad->id)
                              ->where('unidad3_id',null)
                              ->whereIn('necropsia_id',$necropsia_clasificacion->necropsia_causas->pluck('id'))
                              ->count()
                        }}
                     </span>
                  </div>
                  <div class="collapsible-body">
                     <table>
                        @foreach ($necropsia_clasificacion->necropsia_causas->sortBy('nombre') as $necropsia_causa)
                           <tr>
                              <td>{{$necropsia_causa->nombre}}</td>
                              <td>
                                 {{
                                    $necros->where('solicitud_id',62)
                                       ->where('unidad_id',$unidad->id)
                                       ->where('unidad3_id',null)
                                       ->where('necropsia_id',$necropsia_causa->id)
                                       ->count()
                                 }}
                              </td>
                           </tr>
                        @endforeach
                     </table>
                  </div>
               </li>                   
            @endforeach
            <!--unidadde para apoyar-->
            {{--@if ($unidad->id == 2)--}}
               @foreach ($unidades_apoyo->sortBy('nombre') as $unidad_apoyo)
                  <li>
                     <div class="collapsible-header">
                        {{-- <i class="fas fa-circle fa-xs"></i> --}}
                        Apoyo a {{$unidad_apoyo->nombre}}
                        <span class="badge">
                           {{$necros->where('unidad_id',$unidad->id)->where('solicitud_id',62)->where('unidad3_id',$unidad_apoyo->id)->count()}}
                        </span>
                     </div>
                     <div class="collapsible-body">
                        <table>
                           @foreach ($necropsia_clasificaciones->where('id',1)->first()->necropsia_causas->sortBy('nombre') as $necropsia_causa)
                              <tr>
                                 <td>{{$necropsia_causa->nombre}}</td>
                                 <td>{{$necros->where('solicitud_id',62)->where('unidad3_id',$unidad_apoyo->id)->where('necropsia_id',$necropsia_causa->id)->count()}}</td>
                              </tr>
                           @endforeach
                        </table>
                     </div>
                  </li>             
               @endforeach
			   {{--@endif--}}
            <!--total-->
            <li>
               <div class="collapsible-header" style="background-color: #152f4a; color: #c09f77;">
                  {{-- <i class="fas fa-circle fa-xs"></i> --}}
                  <b>TOTAL</b>
                  <span class="badge" style="color: #c09f77;">
                     <b>{{$necros->where('solicitud_id',62)->where('unidad_id',$unidad->id)->count()}}</b>
                  </span>
               </div>
            </li>
         </ul>
      </div>
   @endforeach
   

   <!--unidades que tambien realizan necros-->
   {{-- @foreach ($unidades_apoyo->sortBy('nombre') as $unidad)
      <div class="col s12 l3">
         <ul class="collapsible">
            <li>
               <div class="collapsible-header" style="background-color: #c09f77; color: #152f4a; font-weight: bold; font-size: 18px;">{{$unidad->nombre}}</div>
            </li>
            <li>
               <div class="collapsible-header">
                  NECROPSIAS
                  <span class="badge">
                     {{$necros_->where('solicitud_id',61)->where('unidad_id',$unidad->id)->count()}}
                  </span>
               </div>
               <div class="collapsible-body">
                  <table>
                     @foreach ($necropsia_clasificaciones->where('id',1)->first()->necropsia_causas->sortBy('nombre') as $necropsia_causa)
                        <tr>
                           <td>{{$necropsia_causa->nombre}}</td>
                           <td>
                              {{
                                 $necros->where('solicitud_id',61)
                                    ->where('unidad3_id',110)
                                    ->where('necropsia_id',$necropsia->id)                                 
                                    ->count()
                              }}
                           </td>
                        </tr>
                     @endforeach
                  </table>
               </div>
            </li>
            <li>
               <div class="collapsible-header">
                  OSTEOLOGICO
                  <span class="badge">
                     {{
                        $necros->where('solicitud_id',62)
                           ->where('unidad3_id',110)                        
                           ->count()
                     }}
                  </span>
               </div>
               <div class="collapsible-body">
                  <table>
                     @foreach ($necropsias->where('necropsia_clasificacion_id',1)->sortBy('nombre') as $necropsia)
                        <tr>
                           <td>{{$necropsia->nombre}}</td>
                           <td>
                              {{
                                 $necros->where('solicitud_id',62)
                                    ->where('unidad3_id',110)
                                    ->where('necropsia_id',$necropsia->id)                                 
                                    ->count()
                              }}
                           </td>
                        </tr>
                     @endforeach
                  </table>
               </div>
            </li>
            <!--total-->
            <li>
               <div class="collapsible-header" style="background-color: #152f4a; color: #c09f77;">
                  <b>TOTAL</b>
                  <span class="badge" style="color: #c09f77;">
                     <b>{{
                        $necros->where('unidad3_id',110)->count()
                     }}</b>
                  </span>
               </div>
            </li>
         </ul>
      </div>
   @endforeach --}}

   <!--USPEC-->
   {{-- <div class="col s12 l3">
      <ul class="collapsible">
         <li>
            <div class="collapsible-header" style="background-color: #c09f77; color: #152f4a; font-weight: bold; font-size: 18px;">USPEC</div>
         </li>
         <li>
            <div class="collapsible-header">
               NECROPSIAS
               <span class="badge">
                  {{
                     $necros->where('solicitud_id',61)
                        ->where('unidad3_id',110)                        
                        ->count()
                  }}
               </span>
            </div>
            <div class="collapsible-body">
               <table>
                  @foreach ($necropsias->where('necropsia_clasificacion_id',1)->sortBy('nombre') as $necropsia)
                     <tr>
                        <td>{{$necropsia->nombre}}</td>
                        <td>
                           {{
                              $necros->where('solicitud_id',61)
                                 ->where('unidad3_id',110)
                                 ->where('necropsia_id',$necropsia->id)                                 
                                 ->count()
                           }}
                        </td>
                     </tr>
                  @endforeach
               </table>
            </div>
         </li>
         <li>
            <div class="collapsible-header">
               OSTEOLOGICO
               <span class="badge">
                  {{
                     $necros->where('solicitud_id',62)
                        ->where('unidad3_id',110)                        
                        ->count()
                  }}
               </span>
            </div>
            <div class="collapsible-body">
               <table>
                  @foreach ($necropsias->where('necropsia_clasificacion_id',1)->sortBy('nombre') as $necropsia)
                     <tr>
                        <td>{{$necropsia->nombre}}</td>
                        <td>
                           {{
                              $necros->where('solicitud_id',62)
                                 ->where('unidad3_id',110)
                                 ->where('necropsia_id',$necropsia->id)                                 
                                 ->count()
                           }}
                        </td>
                     </tr>
                  @endforeach
               </table>
            </div>
         </li>
         <!--total-->
         <li>
            <div class="collapsible-header" style="background-color: #152f4a; color: #c09f77;">
               <b>TOTAL</b>
               <span class="badge" style="color: #c09f77;">
                  <b>{{
                     $necros->where('unidad3_id',110)->count()
                  }}</b>
               </span>
            </div>
         </li>
      </ul>
   </div> --}}
   
   <!--UECS-->
   {{-- <div class="col s12 l3">
      <ul class="collapsible">
         <li>
            <div class="collapsible-header" style="background-color: #c09f77; color: #152f4a; font-weight: bold; font-size: 18px;">UECS</div>
         </li>
         <li>
            <div class="collapsible-header">
               NECROPSIAS
               <span class="badge">
                  {{
                     $necros->where('solicitud_id',61)
                        ->where('unidad3_id',66)                        
                        ->count()
                  }}
               </span>
            </div>
            <div class="collapsible-body">
               <table>
                  @foreach ($necropsias->where('necropsia_clasificacion_id',1)->sortBy('nombre') as $necropsia)
                     <tr>
                        <td>{{$necropsia->nombre}}</td>
                        <td>
                           {{
                              $necros->where('solicitud_id',61)
                                 ->where('unidad3_id',66)
                                 ->where('necropsia_id',$necropsia->id)                                 
                                 ->count()
                           }}
                        </td>
                     </tr>
                  @endforeach
               </table>
            </div>
         </li>
         <li>
            <div class="collapsible-header">
               OSTEOLOGICO
               <span class="badge">
                  {{
                     $necros->where('solicitud_id',62)
                        ->where('unidad3_id',66)                        
                        ->count()
                  }}
               </span>
            </div>
            <div class="collapsible-body">
               <table>
                  @foreach ($necropsias->where('necropsia_clasificacion_id',1)->sortBy('nombre') as $necropsia)
                     <tr>
                        <td>{{$necropsia->nombre}}</td>
                        <td>
                           {{
                              $necros->where('solicitud_id',62)
                                 ->where('unidad3_id',66)
                                 ->where('necropsia_id',$necropsia->id)                                 
                                 ->count()
                           }}
                        </td>
                     </tr>
                  @endforeach
               </table>
            </div>
         </li>
         <!--total-->
         <li>
            <div class="collapsible-header" style="background-color: #152f4a; color: #c09f77;">
               <b>TOTAL</b>
               <span class="badge" style="color: #c09f77;">
                  <b>{{
                     $necros->where('unidad3_id',66)->count()
                  }}</b>
               </span>
            </div>
         </li>
      </ul>
   </div> --}}


</div>