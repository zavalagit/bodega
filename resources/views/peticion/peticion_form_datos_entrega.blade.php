@php
    $readonly = false;
    if ($formAccion == 'editar') {
        $readonly = ( date('Y-m-d',strtotime($peticion->fecha_entrega)) != date('Y-m-d') ) ? true : false;
    }
@endphp

<div class="row">
    <div class="col s12 {{$formAccion != 'editar' ? 'ocultar' : ''}}">
        @component('componentes.componente_nota')
            Fecha en que se indicó cómo entregada en sistema: <strong>{{date('d-m-Y',strtotime($peticion->fecha_sistema))}}</strong>.
        @endcomponent      
        <hr class="hr-1">
    </div>


    <div class="col s12 div-fieldset">
        <fieldset>
            <legend>3. Datos de la Entrega</legend>
            <div class="row">
                <div class="input-field col s12 m12 l6">
                    <input id="fecha_entrega" type="date" class="center-align" name="fecha_entrega" value="{{isset($peticion) ? $peticion->fecha_entrega : ''}}">
                    <label class="active" for="fecha_entrega">FECHA DE ENTREGA
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <div class="input-field col s12 m12 l6">
                    <input id="sp_recibe" type="text" name="sp_recibe" value="{{isset($peticion) ? $peticion->sp_recibe : ''}}">
                    <label for="sp_recibe">M. P. o Servidor Público recibe
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--button-etapa-->
                <div class="col s12 m12 l2 offset-l10
                    {{in_array($formAccion,['registrar','editar','clonar']) ? 'ocultar' : ''}}
                    {{-- {{$formAccion == 'continuar' ? '' : ''}} --}}
                    "
                >
                    <button type="submit" id="btn-guardar-etapa-tres" class="btn-peticion-etapa btn-guardar" name="btn_etapa" value="etapa_tres">GUARDAR</button>
                </div>
            </div>
        </fieldset>
    </div>
</div>
