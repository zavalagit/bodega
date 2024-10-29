<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','4. DATOS DE LA(S) MUESTRA(S) RECOLECTADA(S) ~ ')
      @slot('icono','fas fa-edit')
   @endcomponent

   @if( in_array($accion,['registrar','editar','clonar']) )
      <div class="col s12">
         @if( (( $accion == 'editar' ) && ( date('Y-m-d') == date('Y-m-d', strtotime($colectivo->created_at)) )) || (in_array($accion,['registrar','clonar'])) )
            @component('componentes.componente_nota')
               En caso de que señale <strong><em>otro</em></strong>, debe indicar que otro tipo de muestra.
            @endcomponent
         @endif
         @if( ( $accion == 'editar' ) && ( date('Y-m-d') != date('Y-m-d', strtotime($colectivo->created_at)) ) )         
            @component('componentes.componente_nota')
               Estos datos ya <strong>NO</strong> pueden ser modificados.
            @endcomponent
         @endif
         <hr class="hr-1">
      </div>
   @endif
   
   <!--fecha_validacion-->
   @if ( in_array($colectivo->colectivo_estado,['validada','entregada']) )
      <div class="input-field col s12 m12 l12">
         <input type="date" id="colectivo-validacion-fecha" readonly name="colectivo_validacion_fecha" value="{{ $colectivo->colectivo_validacion_fecha }}">
         <label class="active" for="colectivo-validacion-fecha">FECHA DE VALIDACIÓN</label>
      </div>    
   @endif

   @if( in_array(Auth::user()->tipo,['coordinador_colectivos','admin_colectivos']) )
   
      <!--btn delete user2-->
      @if(  /*accion*/$accion == 'validar' ||
            /*accion*/( $accion == 'editar' && $colectivo->colectivo_validacion_fecha == date('Y-m-d') ) )
      <div class="input-field col s12 m12 l1">
         <a href="" class="btn-limpiar-input-autocomplete"
            data-id-input-hidden="perito-analiza-pruebas"
            data-id-input-autocomplete="input-autocomplete-perito-analiza-pruebas">
            <i class="fas fa-times-circle fa-lg" ></i>
         </a>
      </div>

      @endif
   
      @if ( /*accion*/$accion == 'validar' || /*estado*/in_array($colectivo->colectivo_estado,['validada','entregada']) )
          
      <!--input user2-->
      <div class="input-field col s12 12 l11">
         <input id="perito-analiza-pruebas" type="hidden" name="colectivo_perito_analiza_pruebas" value="{{$colectivo->user2_id ?: ''}}">
         <input type="text" id="input-autocomplete-perito-analiza-pruebas" class="autocomplete"
			autocomplete="off"
            data-input-hidden="perito-analiza-pruebas"
            data-url="/get-user"
            data-modelo="user"
            data-user-tipo="usuario"
            data-user-fiscalia=""
            data-user-unidad="1"
            {{$colectivo->user2_id ? 'disabled' : ''}}
            {{$accion == 'validar' ? 'autofocus' : ''}}
            value="{{$colectivo->user2_id ? "{$colectivo->user2->folio} - {$colectivo->user2->name}" : ''}}">
         <label for="input-autocomplete-perito-analiza-pruebas"><i class="fas fa-user-nurse"></i> ~ PERITO QUE REALIZÓ EL ESTUDIO*</label>
      </div>

      @endif

   @endif

   <!--tabla-->
   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th>Seleccionar</th>
               <th>Tipo de muestra</th>
               @if(  Auth::user()->tipo == 'coordinador_colectivos' )
                  @if ( /*accion*/$accion == 'validar' || /*estado*/in_array($colectivo->colectivo_estado,['validada','entregada']) )
                     <th>Control interno de muestra (CIM)</th>
                     <th>Cantidad de estudios</th>
                  @endif
               @endif
            </tr>
         </thead>
         <tbody>
            <tr>
               @if ( /*accion*/in_array($accion, ['registrar','clonar','validar']) ||
                     /*accion*/( $accion == 'editar' && $colectivo->colectivo_validacion_fecha == date('Y-m-d') ) )
                  <td><i style="color: tomato;" class="fas fa-asterisk fa-lg"></i></td>
               @endif
               @if ( /*accion*/in_array($accion, ['registrar','clonar']) ||
                     /*accion*/( $accion == 'editar' && $colectivo->colectivo_validacion_fecha == date('Y-m-d') ) )
                  <td colspan="2"><b>INDIQUE LAS MUESTRAS RECOLECTADAS</b></td>
               @endif
               @if ( /*accion*/$accion == 'validar' ||
                         /*accion*/( $accion == 'editar' && $colectivo->colectivo_validacion_fecha == date('Y-m-d') ) )
                  <td colspan="3"><b>INDIQUE EL CIM Y LA CANTIDAD DE ESTUDIOS</b></td>
               @endif
            </tr>
            @foreach ($pruebas as $prueba)
               <tr>
                  <!--prueba_checkbox-->
                  <td>
                     
                        <input type="checkbox" id="prueba-{{$prueba->id}}" class="prueba-checkbox filled-in" 
                           {{ ( ( $accion == 'editar' ) && ( date('Y-m-d') != date('Y-m-d', strtotime($colectivo->created_at)) ) ) ? 'disabled' : '' }} 
                           {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}} 
                           {{isset($colectivo) ? ( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? 'checked' : '' ) : ''}} 
                           data-prueba-id="{{$prueba->id}}" 
                           name="colectivo_pruebas[]" 
                           value="{{$prueba->id}}" />
                        <label for="prueba-{{$prueba->id}}"></label>
                  </td>
                  <!--prueba_nombre-->
                  <td width="60%">{{$prueba->nombre}}
                     @if ($prueba->id == 5)
                     <span id="otro-tipo-muestra" class="{{$colectivo->pruebas->contains('id',5) ? '' : 'hide'}}">
                        <input type="text" id="prueba-otro" name="prueba_otro"
                           {{ ( ( $accion == 'editar' ) && ( date('Y-m-d') != date('Y-m-d', strtotime($colectivo->created_at)) ) ) ? 'disabled' : '' }} 
                           {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}} 
                           value="{{$colectivo->pruebas->contains('id',5) ? $colectivo->pruebas->where('id',5)->first()->pivot->prueba_otro : ''}}
                        ">
                        <label for="prueba-otro"><i class="fas fa-vial"></i> ~ INDIQUE EL OTRO TIPO DE MUESTRA</label>
                     </span>
                     @endif
                  </td>
                  
                  @if( in_array(Auth::user()->tipo,['coordinador_colectivos','admin_colectivos']) )
                     @if ( /*accion*/$accion == 'validar' || /*estado*/in_array($colectivo->colectivo_estado,['validada','entregada']) )
                        <!--prueba_cim-->
                        <td>
                           @if ( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) )
                              <input type="text" id="prueba-cim-{{$prueba->id}}"
                                 {{($accion == 'entregar') ? 'readonly' : ''}}
                                 {{isset($colectivo) ? ( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? '' : 'disabled' ) : ''}}
                                 {{$accion == 'editar' && $colectivo->colectivo_validacion_fecha != date('Y-m-d') ? 'readonly' : ''}}
                                 name="prueba_cim[]"
                                 value="{{$colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->first()->pivot->prueba_cim : ''}}"
                              >
                              <label for="prueba-cim-{{$prueba->id}}"><i class="fas fa-flask"></i> ~ CONTROL INTERNO DE MUESTRA (CIM)<span class="asterisco">{{isset($colectivo) ? ( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? '*' : '' ) : ''}}</span></label>
                           @else
                              ---
                           @endif
                        </td>

                        <!--prueba_estudios-->
                        <td>
                           @if ( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) )
                              <input type="number" id="prueba-estudios-{{$prueba->id}}"
                                 class="prueba-estudios" {{($accion == 'entregar') ? 'disabled' : ''}}
                                 max="100" min="0" name="prueba_estudios[]"
                                 {{$colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? '' : 'disabled'}}
                                 {{$accion == 'editar' && $colectivo->colectivo_validacion_fecha != date('Y-m-d') ? 'readonly' : ''}}
                                 value="{{$colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->first()->pivot->prueba_estudios : ''}}">
                           @else
                              ---
                           @endif
                        </td>                           
                  
                     @endif
                  @endif


               </tr>
            @endforeach
         </tbody>
      </table>
   </div>

   <div class="col s12">
      <hr class="hr-3">
   </div>
</div>