@php
    $readonly = false;
    if ($formAccion == 'editar') {
        $readonly = ( date('Y-m-d',strtotime($peticion->fecha_sistema)) != date('Y-m-d') ) ? true : false;
    }
    elseif($formAccion == 'continuar'){
        $readonly = $peticion->estado == 'atendida' ? true : false;
    }
@endphp

<div class="row">
	@if (in_array($peticion->estado,['atendida','entregada']))
    <div class="col s12 {{!in_array($formAccion,['continuar','editar']) ? 'ocultar' : ''}}">
        @component('componentes.componente_nota')
            Fecha en que se indicó cómo atendida en sistema: <strong>{{date('d-m-Y',strtotime($peticion->fecha_sistema))}}</strong>.
        @endcomponent      
        <hr class="hr-1">
    </div>
	@endif

    <div class="col s12 div-fieldset">
        <fieldset>
            <legend>2. Datos de Elaboración</legend>
            <div class="row">
                <!--fehcha_elaboracion-->
                <div class="input-field col s12 m12 l3">
                    <input type="date" id="fecha-elaboracion" class="center-align {{$readonly ? 'readonly' : ''}}" name="fecha_elaboracion" value="{{isset($peticion) ? $peticion->fecha_elaboracion : ''}}">
                    <label class="active" for="fecha_elaboracion">FECHA DE ELABORACIÓN
                        <span class="asterisco-campo-obligatorio asterisco-etapa-dos {{$readonly ? 'ocultar' : ''}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--fecha_necropsia-->
                <div class="input-field col s12 m12 l3 necropsia-campo {{isset($peticion->necropsia_id) ? '' : 'ocultar' }}">
                    <input id="fecha-necropsia" type="date" class="center-align" name="fecha_necropsia" value="{{$peticion->fecha_necropsia}}">
                    <label class="active" for="fecha-necropsia">DÍA EN LA QUE SE REPORTA LA NECROPSIA
                        <span class="asterisco-campo-obligatorio asterisco-etapa-dos {{$readonly ? 'ocultar' : ''}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                    <span style="color:#152f4a"> <i style="color:red;" class="fas fa-info-circle"></i> Tenga en cuenta que el día para el reporte de las necropsias comienza, por ejemplo, hoy a las 07:00:00 a.m. y termina el día de mañana a las 06:59:59 a.m.  </span>
                </div>
                <!--documento_emitido-->
                <div class="input-field col s12 m12 l3">
                    <select id="select-documento-emitido" class="{{$readonly ? 'readonly' : ''}}" name="documento_emitido">
                        <option value="" disabled selected>DOCUMENTOE EMITIDO *</option>
                        <option value="archivo" {{isset($peticion) && $peticion->documento_emitido == 'archivo' ? 'selected' : ''}} {{isset($peticion) && isset($peticion->necropsia_id) ? 'disabled' : ''}}>1. ARCHIVO</option>
                        <option value="certificado" {{isset($peticion) && $peticion->documento_emitido == 'certificado' ? 'selected' : ''}} {{isset($peticion) && isset($peticion->necropsia_id) ? 'disabled' : ''}}>2. CERTIFICADO</option>
                        <option value="dictamen" {{isset($peticion) && $peticion->documento_emitido == 'dictamen' ? 'selected' : ''}} {{isset($peticion) && isset($peticion->necropsia_id) ? 'selected' : ''}}>3. DICTAMEN</option>
                        <option value="informe" {{isset($peticion) && $peticion->documento_emitido == 'informe' ? 'selected' : ''}} {{isset($peticion) && isset($peticion->necropsia_id) ? 'disabled' : ''}}>4. INFORME</option>
                        <option value="salida_juzgado" {{isset($peticion) && $peticion->documento_emitido == 'salida_juzgado' ? 'selected' : ''}} {{isset($peticion) && isset($peticion->necropsia_id) ? 'disabled' : ''}}>5. SALIDA A JUZGADO</option>
						@if(Auth::user()->unidad_id == 1)
							<option value="colaboraciones" {{isset($peticion) && $peticion->documento_emitido == 'colaboraciones' ? 'selected' : ''}}>6. COLABORACIONES</option>
						@endif
                    </select>
                    <label>DOCUMENTO EMITIDO
                        <span class="asterisco-campo-obligatorio asterisco-etapa-dos {{$readonly ? 'ocultar' : ''}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--estudios-->
                <div class="input-field col s12 m12 l3">
                    <input type="number" id="cantidad-estudios" class="{{$readonly ? 'readonly' : ''}}" min="0" max="3000" name="cantidad_estudios" value="{{isset($peticion) ? $peticion->cantidad_estudios : ''}}">
                    <label for="cantidad-estudios">CANTIDAD DE ESTUDIOS
                        <span class="asterisco-campo-obligatorio asterisco-etapa-dos {{$readonly ? 'ocultar' : ''}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <div
                    class="col s12 m12 l2 offset-l10
                    {{in_array($formAccion,['registrar','editar','clonar']) ? 'ocultar' : ''}}
                    {{$formAccion == 'continuar' && $peticion->estado != 'pendiente' ? 'ocultar' : ''}}
                    "
                >
                    <button type="submit" id="btn-guardar-etapa-dos" class="btn-peticion-etapa btn-guardar" name="btn_etapa" value="etapa_dos">GUARDAR</button>
                </div>
            </div>
        </fieldset>
    </div>
</div>

