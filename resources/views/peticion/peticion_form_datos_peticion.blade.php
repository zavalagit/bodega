@php
    $readonly = false;
    if ($formAccion == 'editar') {
        $readonly = ( date('Y-m-d',strtotime($peticion->created_at)) != date('Y-m-d') ) ? true : false;
    }
    elseif($formAccion == 'continuar'){
        $readonly = true;
    }
@endphp

<div class="row">
	<div class="col s12 {{!in_array($formAccion,['continuar','editar']) ? 'ocultar' : ''}}">
        @component('componentes.componente_nota')
            Hora y fecha en que se registró en sistema: <strong>{{date('H:i:s ~ d-m-Y',strtotime($peticion->created_at))}}</strong>.
        @endcomponent      
        <hr class="hr-1">
    </div>
    <div class="col s12 div-fieldset">
        <fieldset>
            <legend>1. Datos de la Petición</legend>
            <div class="row">
                <!--unidad_id-->
                <div class="input-field col s12 m6 l3">
                    <select id="unidad-select" class="{{$readonly ? 'readonly' : ''}}" name="unidad">
                        <option value="" disabled>SELECCIONA LA UNIDAD EN LA QUE SE ATIENDE LA PETICIÓN</option>
                        @foreach ($unidades->values() as $i => $unidad)
                            <option value="{{$unidad->id}}"
                                {{$formAccion == 'registrar' && Auth::user()->unidad_id == $unidad->id ? 'selected' : ''}}
                                {{$formAccion != 'registrar' && $peticion->unidad_id == $unidad->id ? 'selected' : ''}}
                            >{{$i+1}}.- {{$unidad->nombre}}</option>
                        @endforeach
                    </select>
                    <label>UNIDAD EN LA QUE SE ATIENDE LA PETICIÓN
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--fiscalia1_id-->
                <div class="input-field col s12 m6 l3">
                    <select id="fiscalia-select" class="{{$readonly ? 'readonly' : ''}}" name="fiscalia1">
                        <option value="" disabled>SELECCIONA LA FISCALÍA A LA QUE PERTENECE LA PETICIÓN</option>
                        @foreach ($fiscalias->values() as $i => $fiscalia)
                            <option value="{{$fiscalia->id}}" 
                                {{$formAccion == 'registrar' && Auth::user()->fiscalia_id == $fiscalia->id ? 'selected' : ''}}
                                {{$formAccion != 'registrar' && $peticion->fiscalia1_id == $fiscalia->id ? 'selected' : ''}}
                            >{{$i+1}}.- {{$fiscalia->nombre}}</option>
                        @endforeach
                    </select>
                    <label><i class="fas fa-building"></i> ~ FISCALÍA A LA QUE  PERTENECE LA PETICIÓN
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--fiscalia2_id-->
                <div class="input-field col s12 m6 l3">
                    <select id="fiscalia-select" class="{{$readonly ? 'readonly' : ''}}" name="fiscalia2">
                        <option value="" disabled>SELECCIONA LA FISCALÍA EN LA QUE SE ATIENDE LA PETICIÓN</option>
                        @foreach ($fiscalias->values() as $i => $fiscalia)
                            <option value="{{$fiscalia->id}}"
                                {{$formAccion == 'registrar' && Auth::user()->fiscalia->id == $fiscalia->id ? 'selected' : ''}}
                                {{$formAccion != 'registrar' && $peticion->fiscalia2_id == $fiscalia->id ? 'selected' : ''}}
                            >{{$i+1}}.- {{$fiscalia->nombre}}</option>
                        @endforeach
                    </select>
                    <label><i class="fas fa-building"></i> ~ FISCALÍA EN LA QUE SE ATIENDE LA PETICIÓN
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--nuc-->
                <div class="input-field col s12 m6 l3">
                    <input id="nuc" type="text" name="nuc" class="{{$formAccion == 'continuar' ? 'readonly' : ''}}" value="{{isset($peticion) ? $peticion->nuc : ''}}">
                    <label for="nuc"><i class="fas fa-folder"></i> ~ N.U.C.
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{$formAccion == 'continuar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion != 'editar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--fecha_peticion-->
                <div class="input-field col s12 m6 l3">
                    <input type="date" id="fecha_peticion" class="center-align {{$readonly ? 'readonly' : ''}}" name="fecha_peticion" value="{{isset($peticion) ? $peticion->fecha_peticion : ''}}">
                    <label class="active" for="fecha_peticion"><i class="fas fa-calendar-alt"></i> ~ FECHA DE PETICIÓN
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--fecha_recepción-->
                <div class="input-field col s12 m6 l3">
                    <input type="date" id="fecha-recepcion" class="center-align {{$readonly ? 'readonly' : ''}}" name="fecha_recepcion" value="{{isset($peticion) ? $peticion->fecha_recepcion : ''}}">
                    <label class="active" for="fecha-recepcion"><i class="fas fa-calendar-alt"></i> ~ FECHA DE RECEPCIÓN
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--no. oficio-->
                <div class="input-field col s12 m6 l3">
                    <input type="text" id="oficio_numero" class="{{$formAccion == 'continuar' ? 'readonly' : ''}}" name="oficio_numero" value="{{isset($peticion) ? $peticion->oficio_numero : ''}}">
                    <label for="oficio_numero">NO. OFICIO
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{$formAccion == 'continuar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion != 'editar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--folio interno-->
                <div class="input-field col s12 m6 l3">
                    <input type="text" id="folio-interno" class="{{$formAccion == 'continuar' ? 'readonly' : ''}}" name="folio_interno" value="{{isset($peticion) ? $peticion->folio_interno : ''}}">
                    <label for="folio-interno">FOLIO INTERNO O NÚMERO DE CONTROL EN LIBRO
                        <span class="asterisco-campo-editar asterisco-etapa-uno {{$formAccion != 'editar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--M.P. solicita-->
                <div class="input-field col s12 m12 l4">
                    <input type="text" id="sp_solicita" class="{{$readonly ? 'readonly' : ''}}" name="sp_solicita" value="{{isset($peticion) ? $peticion->sp_solicita : ''}}">
                    <label for="sp_solicita"><i class="fas fa-user-tie"></i> ~ M. P. o Servidor Público Solicita
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--unidad1-->
                <div class="input-field col s12 m12 l4">
                    <select id="unidad1-select" class="{{$readonly ? 'readonly' : ''}}" name="unidad1">
                        <option value="" disabled selected>FISCALÍA O UNIDAD A LA QUE PERTENECE EL M.P. O SERVIDOR PÚBLICO</option>
                        @foreach ($unidades1->sortBy('nombre')->values() as $i => $unidad1)
                            <option value="{{$unidad1->id}}"
                                {{isset($peticion) && $peticion->unidad1_id == $unidad1->id ? 'selected' : ''}}
                            >{{$i+1}}.- {{$unidad1->nombre}}</option>
                        @endforeach
                    </select>
                    <label><i class="fas fa-building"></i> ~ FISCALÍA O UNIDAD A LA QUE PERTENECE EL M.P. O SERVIDOR PÚBLICO
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--unidad2-->
                <div class="input-field col s12 m12 l4">
                    <select id="unidad2-select" class="{{$readonly ? 'readonly' : ''}}" name="unidad2">
                        @includeWhen(isset($peticion->unidad1_id),'unidad.unidad_form_select_options',['unidades' => isset($peticion->id) ? $peticion->unidad1->relacion_unidad : ''])
                    </select>
                    <label><i class="fas fa-archway"></i> ~ LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO
                        {{-- <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span> --}}
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--especialidad-->
                <div class="input-field col s12 m6 l6">
                    <select id="especialidad-select" class="{{$readonly ? 'readonly' : ''}}" name="especialidad">
                        @include('especialidad.especialidad_form_select_options')            
                    </select>
                    <label><i class="fas fa-laptop"></i> ~ ESPECIALIDAD
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--solicitud-->
                <div class="input-field col s12 m12 l6">
                    <select id="solicitud-select" class="{{$readonly ? 'readonly' : ''}}" name="solicitud">
                        @includeWhen(isset($peticion->id),'solicitud.solicitud_form_select_options',['solicitudes' => $solicitudes])
                    </select>
                    <label><i class="fas fa-file-alt"></i> ~ SOLICITUD
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--necropsia - clasificacion-->
                <div class="input-field col s12 m12 l6 necropsia-campo {{isset($peticion->necropsia_id) ? '' : 'ocultar'}}">
                    <select id="necropsia-clasificacion-select" class="{{$readonly ? 'readonly' : ''}}" name="necropsia_clasificacion">
                        <option value="" disabled selected>INIDIQUE LA CLASIFICACIÓN DE LA NECROPSIA</option>
                        @foreach ($necropsia_clasificaciones->values() as $i => $clasificacion)
                            <option value="{{$clasificacion->id}}" {{isset($peticion->necropsia_id) && $peticion->necropsia->necropsia_clasificacion_id == $clasificacion->id ? 'selected' : ''}}>{{$i+1}}. {{$clasificacion->nombre}}</option>
                        @endforeach
                    </select>
                    <label>NECROPSIA - CLASIFICACIÓN
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--necropsia - causa-->
                <div class="input-field col s12 m12 l6 necropsia-campo {{isset($peticion->necropsia_id) ? '' : 'ocultar'}}">
                    <select id="necropsia-select" class="{{$readonly ? 'readonly' : ''}}" name="necropsia_causa">
                        @includeWhen(isset($peticion->necropsia_id),'necropsia.necropsia_form_select_options',['necropsias' => $necropsias])
                    </select>
                    <label>NECROPSIA - DIAGNÓSTICO
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--necropsia - apoyo -->
                <section id="necropsia-apoyo" class="{{isset($peticion->necropsia_id) && $peticion->necropsia->necropsia_clasificacion_id == 1 ? '' : 'ocultar'}}">
                    <div class="col s12">
                        <p>
                            LA NECROPSIA FUE UN APOYO A:
                            <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                            <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        </p>
                    </div>
                    <div class="col s4">
                        <label>
                            <input type="radio" class="{{$readonly ? 'readonly' : ''}}" {{isset($peticion->necropsia_id) && $peticion->unidad3_id == null ? 'checked' : ''}} name="unidad_necropsia_apoyo" value="no"/>
                            <span>No, es apoyo</span>
                        </label>
                    </div>                        
                    @foreach ($unidades_apoyo->sortBy('nombre') as $i => $unidad)
                        <div class="col s4">
                            <label>
                                <input type="radio" class="{{$readonly ? 'readonly' : ''}}" {{isset($peticion->necropsia_id) && $peticion->unidad3_id == $unidad->id ? 'checked' : ''}} name="unidad_necropsia_apoyo" value="{{$unidad->id}}"/>
                                <span>Apoyo a la {{$unidad->nombre}}</span>
                            </label>
                        </div>
                    @endforeach
                </section>
                <!--necropsia - pertenece a uspec o uecs -->
                <section id="necropsia-pertenece"
                    class="{{isset($peticion->necropsia_id) && $peticion->necropsia->necropsia_clasificacion_id == 1 && Auth::user()->tipo == 'coordinador_peticiones_unidad' ? '' : 'ocultar'}}"
                    data-is-coordinador="{{Auth::user()->tipo == 'coordinador_peticiones_unidad' ? true : false}}"
                >
                    <div class="col s12">
                        <p>
                            LA NECROPSIA PERTENECE A:
                            <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                            <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        </p>
                    </div>
                    <div class="col s4">
                        <label>
                            <input type="radio" class="{{$readonly ? 'readonly' : ''}}" {{isset($peticion->necropsia_id) && $peticion->unidad3_id == null ? 'checked' : ''}} name="necropsia_pertenece" value="no"/>
                            <span>No, no pertenece</span>
                        </label>
                    </div>
                    <div class="col s4">
                        <label>
                            <input type="radio" class="{{$readonly ? 'readonly' : ''}}" {{isset($peticion->necropsia_id) && $peticion->unidad3_id == '110' ? 'checked' : ''}} name="necropsia_pertenece" value="110"/>
                            <span>Pertenece a la USPEC</span>
                        </label>
                    </div>
                    <div class="col s4">
                        <label>
                            <input type="radio" class="{{$readonly ? 'readonly' : ''}}" {{isset($peticion->necropsia_id) && $peticion->unidad3_id == '66' ? 'checked' : ''}} name="necropsia_pertenece" value="66"/>
                            <span>Pertenece a la UECS</span>
                        </label>
                    </div>
                </section>
                <!--user que pertenece el registro-->
                <section class="{{Auth::user()->tipo == 'usuario' ? 'ocultar' : ''}}">
                    <div class="col s12">
                        <hr class="hr-1">
                    </div>
                    <div class="input-field col s1">
                        <a href="" id="btn-user-autocomplete-reset" class="btn-autocomplete-reset" 
                        data-input-hidden="user-hidden"
                        data-input-autocomplete="user-autocomplete">
                        <i class="fas fa-times-circle fa-lg" ></i>
                        </a>
                    </div>
                    <div class="input-field col s11">
                        <input type="hidden" id="user-hidden" name="peticion_user" value="{{isset($peticion->id) ? $peticion->user_id : ''}}">
                        <input type="text" id="user-autocomplete" class="autocomplete"
                        {{isset($peticion->id) ? 'disabled' : ''}}
                        data-input-hidden="user-hidden"
                        data-modelo="user"
                        data-user-tipo='usuario'
                        data-url="{{route('get_modelo_user')}}"
                        data-btn="btn-user-autocomplete-reset"
                        placeholder="Escriba el nombre o folio del Perito y despues seleccione alguna de las sugerencias mostradas"
                        value="{{isset($peticion->id) ? $peticion->user->name : ''}}"
                        >
                        <label for="autocomplete-input"><i class="fas fa-user"></i> ~ USUARIO
                        <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                        </label>
                    </div>         
                </section>

                <div class="col s12 m12 l2 offset-l10 {{$formAccion != 'registrar' ? 'ocultar' : ''}}">
                    <button type="submit" id="btn-peticion-etapa-uno" class="btn-peticion-etapa btn-guardar" name="btn_etapa" value="etapa_uno">{{$formAccion}}</button>
                </div>
            </div>
        </fieldset>
    </div>
</div>