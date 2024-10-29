@isset($peticion)
    @if ($peticion->estado === 'pendiente')
        @php
            $peticion_r = $peticion;
            $peticion = NULL;
        @endphp
    @endif
@endisset

@isset($peticion)
    <div class="row" >
        <div class="col s12">
            <blockquote>2.- Datos de la elaboración de la Petición</blockquote>
        </div>

        @if ( ($peticion->solicitud_id == 61) || ($peticion->solicitud_id == 62) )
        <div class="input-field col s12 m12 l6">
        @else    
        <div class="input-field col s12 m12 l12">
        @endif
            <input class="datos-elaboracion" id="fecha-elaboracion" type="date" class="center-align" name="fecha_elaboracion" value="{{$peticion->fecha_elaboracion}}">
            <label class="active" for="fecha_elaboracion">FECHA DE ELABORACIÓN</label>
        </div>

        @if ( ($peticion->solicitud_id == 61) || ($peticion->solicitud_id == 62) )
        <div class="input-field col s12 m12 l6">
            <input class="datos-elaboracion" id="fecha-necropsia" type="date" class="center-align" name="fecha_necropsia" value="{{$peticion->fecha_necropsia}}">
            <label class="active" for="fecha-necropsia">DÍA AL QUE PERTENCE LA NECROPSIA (DÍA EN LA QUE SE REPORTA)</label>
            <a style="color:#152f4a"> <i style="color:red;" class="fas fa-info-circle"></i> Tenga en cuenta que el día para el reporte de las necropsias comienza, por ejemplo, hoy a las 07:00:00 a.m. y termina el día de mañana a las 06:59:59 a.m.</a>
        </div>
        @endif

    </div>
    <div class="row">
        <div class="col s12 m12 l12">
            <p><b>TIPO DE ESTUDIO</b></p>
        </div>
        <p class="col s12 m4 l2">
            @if ($peticion->documento_emitido === 'dictamen')
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="dictamen" value="dictamen" checked/>
            @else
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="dictamen" value="dictamen"/>
            @endif
            <label for="dictamen">DICTAMEN</label>
        </p>
        <p class="col s12 m4 l2">
            @if ($peticion->documento_emitido === 'informe')
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="informe" value="informe" checked/>
            @else
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="informe" value="informe"/>
            @endif
            <label for="informe">INFORME</label>
        </p>
        {{-- <p class="col s12 m4 l2">
            @if ($peticion->documento_emitido === 'informe_busqueda')
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="informe-busqueda" value="informe_busqueda" checked/>
            @else
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="informe-busqueda" value="informe_busqueda"/>
            @endif
            <label for="informe-busqueda">INFORME DE BUSQUEDA</label>
        </p>
        <p class="col s12 m4 l2">
            @if ($peticion->documento_emitido === 'informe_requerimiento')
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="informe-requerimiento" value="informe_requerimiento" checked/>
            @else
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="informe-requerimiento" value="informe_requerimiento"/>
            @endif
            <label for="informe-requerimiento">INFORME DE REQUERIMIENTO</label>
        </p> --}}
        <p class="col s12 m4 l2">
            @if ($peticion->documento_emitido === 'certificado')
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="certificado" value="certificado" checked/>
            @else
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="certificado" value="certificado"/>
            @endif
            <label for="certificado">CERTIFICADO</label>
        </p>
        <p class="col s12 m4 l2">
            @if ($peticion->documento_emitido === 'salida_juzgado')
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="salida_juzgado" value="salida_juzgado" checked/>
            @else
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="salida_juzgado" value="salida_juzgado"/>
            @endif
            <label for="salida_juzgado">SALIDA A JUZGADO</label>
        </p>
        <p class="col s12 m4 l2">
            @if ($peticion->documento_emitido === 'archivo')
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="archivo" value="archivo" checked/>
            @else
                <input class="datos-elaboracion" name="documento_emitido" type="radio" id="archivo" value="archivo"/>
            @endif
            <label for="archivo">ARCHIVO</label>
        </p>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <input class="datos-elaboracion"  id="cantidad-estudios" type="number" min="0" name="cantidad_estudios" value="{{$peticion->cantidad_estudios}}">
            <label for="cantidad-estudios">CANTIDAD DE ESTUDIOS*</label>
        </div>
    </div>
@endisset

@empty($peticion)
    <div class="row">
        <div class="col s12">
            <blockquote>2.- Datos de la elaboración de la Petición</blockquote>
        </div>

        @isset($peticion_r)
            @if ( ($peticion_r->solicitud_id == 61) || ($peticion_r->solicitud_id == 62) )
            <div class="input-field col s12 m12 l6">
            @else    
            <div class="input-field col s12 m12 l12">
            @endif
                <input id="fecha-elaboracion" type="date" class="center-align" name="fecha_elaboracion">
                <label class="active" for="fecha_elaboracion">FECHA DE ELABORACIÓN</label>
            </div>

            @if ( ($peticion_r->solicitud_id == 61) || ($peticion_r->solicitud_id == 62) )
            <div class="input-field col s12 m12 l6">
                <input id="fecha-necropsia" type="date" class="center-align" name="fecha_necropsia">
                <label class="active" for="fecha-necropsia">DÍA AL QUE PERTENCE LA NECROPSIA (DÍA EN LA QUE SE REPORTA)</label>
                <a style="color:#152f4a"> <i style="color:red;" class="fas fa-info-circle"></i> Tenga en cuenta que el día para el reporte de las necropsias comienza, por ejemplo, hoy a las 07:00:00 a.m. y termina el día de mañana a las 06:59:59 a.m.</a>
            </div>
            @endif
        @endisset
        @empty($peticion_r)
            <div class="input-field col s12 m12 l12">
                <input id="fecha-elaboracion" type="date" class="center-align" name="fecha_elaboracion">
                <label class="active" for="fecha_elaboracion">FECHA DE ELABORACIÓN</label>
            </div>
        @endempty


    </div>
    <div class="row">
        <div class="col s12 m12 l12">
            <p><b>DOCUMENTO EMITIDO</b></p>
        </div>
        <p class="col s12 m4 l2">
            <input name="documento_emitido" type="radio" id="dictamen" value="dictamen" />
            <label for="dictamen">DICTAMEN</label>
        </p>
        <p class="col s12 m4 l2">
            <input name="documento_emitido" type="radio" id="informe" value="informe" />
            <label for="informe">INFORME</label>
        </p>
        {{-- <p class="col s12 m4 l2">
            <input name="documento_emitido" type="radio" id="informe-busqueda" value="informe_busqueda" />
            <label for="informe-busqueda">INFORME DE BUSQUEDA</label>
        </p>
        <p class="col s12 m4 l2">
            <input name="documento_emitido" type="radio" id="informe-requerimiento" value="informe_requerimiento" />
            <label for="informe-requerimiento">INFORME DE REQUERIMIENTO</label>
        </p> --}}
        <p class="col s12 m4 l2">
            <input name="documento_emitido" type="radio" id="certificado" value="certificado" />
            <label for="certificado">CERTIFICADO</label>
        </p>
        <p class="col s12 m4 l2">
            <input name="documento_emitido" type="radio" id="salida_juzgado" value="salida_juzgado" />
            <label for="salida_juzgado">SALIDA A JUZGADO</label>
        </p>
        <p class="col s12 m4 l2">
            <input name="documento_emitido" type="radio" id="archivo" value="archivo" />
            <label for="archivo">ARCHIVO</label>
        </p>
    </div>

    {{--
    @php $no = 1; @endphp
    <div id="div-row-segunda-etapa" class="row">
        <div class="input-field col s12 m6 l6">
            <select id="especialidad-select" name="especialidad">
                <option value="" selected>SELECCIONA LA ESPECIALIDAD</option>
                @foreach ($especialidades as $especialidad)
                    <option value="{{$especialidad->id}}">{{$no++}}.- {{$especialidad->nombre}}</option>
                @endforeach
            </select>
            <label>ESPECIALIDAD</label>
        </div>
        <div class="input-field col s12 m12 l6">
            <select id="solicitud-select" name="solicitud">
                
            </select>
            <label>SOLICITUD</label>
        </div>
    </div>
    --}}

    <div class="row">
        <div class="input-field col s12">
            <input id="cantidad-estudios" type="number" min="0" name="cantidad_estudios">
            <label for="cantidad-estudios">CANTIDAD DE ESTUDIOS*</label>
        </div>
    </div>
@endempty
