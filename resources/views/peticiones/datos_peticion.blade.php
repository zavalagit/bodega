<!--1ra etapa-->
<div class="row">
    <div class="col s12">
        <blockquote>1.- Datos de la Petición</blockquote>
    </div>
</div>

@isset($peticion)
    <div class="row">
        <div class="input-field col s12 m6 l3">
            <input class="datos-peticion" id="nuc" type="text" name="nuc" value="{{$peticion->nuc}}">
            <label for="nuc">N.U.C.*</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m6 l3">
            <select class="datos-peticion" id="fiscalia-select" name="fiscalia1">
                <option value="" disabled>SELECCIONA LA FISCAÍA A LA QUE PERTENECE LA PETICIÓN</option>
                @foreach ($fiscalias as $fiscalia)
                    @if ($peticion->fiscalia1_id == $fiscalia->id)
                        <option selected value="{{$fiscalia->id}}">{{$no++}}.- {{$fiscalia->nombre}}</option>
                    @else
                        <option value="{{$fiscalia->id}}">{{$no++}}.- {{$fiscalia->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>FISCALÍA A LA QUE PERTENECE LA PETICIÓN</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m6 l3">
            <select class="datos-peticion" id="fiscalia-select" name="fiscalia2">
                <option value="" disabled>SELECCIONA LA FISCALÍA EN LA QUE SE ATIENDE LA PETICIÓN</option>
                    @foreach ($fiscalias as $fiscalia)
                        @if ($peticion->fiscalia2_id == $fiscalia->id)
                            <option selected value="{{$fiscalia->id}}">{{$no++}}.- {{$fiscalia->nombre}}</option>
                        @else
                            <option value="{{$fiscalia->id}}">{{$no++}}.- {{$fiscalia->nombre}}</option>
                        @endif
                    @endforeach
            </select>
            <label>FISCALÍA EN LA QUE SE ATIENDE LA PETICIÓN</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m6 l3">
            <select class="datos-peticion" id="unidad-select" name="unidad">
                <option value="" disabled>SELECCIONA LA UNIDAD EN LA QUE SE ATIENDE LA PETICIÓN</option>
                @foreach ($unidades as $unidad)
                    @if ($peticion->unidad_id == $unidad->id)
                        <option selected value="{{$unidad->id}}">{{$no++}}.- {{$unidad->nombre}}</option>
                    @else
                        <option value="{{$unidad->id}}">{{$no++}}.- {{$unidad->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>UNIDAD EN LA QUE SE ATIENDE LA PETICIÓN</label>
        </div>
        <div class="input-field col s12 m6 l3">
            <input class="datos-peticion" id="fecha_peticion" type="date" class="center-align" name="fecha_peticion" value="{{$peticion->fecha_peticion}}">
            <label class="active" for="fecha_peticion">FECHA DE PETICIÓN*</label>
        </div>
        <div class="input-field col s12 m6 l3">
            <input class="datos-peticion" id="fecha-recepcion" type="date" class="center-align" name="fecha_recepcion" value="{{$peticion->fecha_recepcion}}">
            <label class="active" for="fecha-peticion">FECHA DE RECEPCIÓN*</label>
        </div>
        <div class="input-field col s12 m6 l3">
            <input class="datos-peticion" id="oficio_numero" type="text" name="oficio_numero" value="{{$peticion->oficio_numero}}">
            <label for="oficio_numero">NO. OFICIO*</label>
        </div>
        <div class="input-field col s12 m6 l3">
            <input class="datos-peticion" id="folio-interno" type="text" name="folio_interno" value="{{$peticion->folio_interno}}">
            <label for="folio-interno">NÚMERO LIBRO</label>
        </div>
        <div class="input-field col s12 m12 l4">
            <input class="datos-peticion" id="sp_solicita" type="text" name="sp_solicita" value="{{$peticion->sp_solicita}}">
            <label for="sp_solicita">M. P. o Servidor Público Solicita*</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m12 l4">
            <select class="datos-peticion" id="petfiscalia-select" name="petfiscalia">
                <option value="" disabled>SELECCIONA LUGAR DE ADSCRIPCIÓN DEL SERVIDOR PÚBLICO</option>
                @foreach ($petfiscalias as $petfiscalia)
                    @if ($peticion->petfiscalia_id == $petfiscalia->id)
                        <option selected value="{{$petfiscalia->id}}">{{$no++}}.- {{$petfiscalia->nombre}}</option>
                    @else
                        <option value="{{$petfiscalia->id}}">{{$no++}}.- {{$petfiscalia->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>FISCALÍA DEL M.P. O SERVIDOR PÚBLICO</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m12 l4">
            <select class="datos-peticion" name="petadscripcion">
                @foreach ($peticion->petfiscalia->petadscripciones->sortBy('nombre') as $petadscripcion)
                    @if ($peticion->petadscripcion_id == $petadscripcion->id)
                        <option selected value="{{$petadscripcion->id}}">{{$no++}}.- {{$petadscripcion->nombre}}</option>
                    @else
                        <option value="{{$petadscripcion->id}}">{{$no++}}.- {{$petadscripcion->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO</label>
        </div>
    </div>

    <div id="div-row-segunda-etapa" class="row">
        @php $no = 1; @endphp
        <div class="input-field col s12 m6 l6">
            <select class="datos-peticion" id="especialidad-select" name="especialidad">
                @foreach ($especialidades as $especialidad)
                    @if ($peticion->solicitud->especialidad->id === $especialidad->id)
                        <option selected value="{{$especialidad->id}}">{{$no++}}.- {{$especialidad->nombre}}</option>
                    @else
                        <option value="{{$especialidad->id}}">{{$no++}}.- {{$especialidad->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>ESPECIALIDAD</label>
        </div>

        @php
            $no = 1;
        @endphp
        <div class="input-field col s12 m12 l6">
            <select class="datos-peticion" id="solicitud-select" name="solicitud">
                @foreach ($peticion->solicitud->especialidad->solicitudes->sortBy('nombre') as $solicitud)
                    @if ($peticion->solicitud_id == $solicitud->id)
                        <option selected value="{{$solicitud->id}}">{{$no++}}.- {{$solicitud->nombre}}</option>
                    @else
                        <option value="{{$solicitud->id}}">{{$no++}}.- {{$solicitud->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>SOLICITUD</label>
        </div>

        @isset($peticion->necropsia_id)
            @php
                $no = 1;
            @endphp
            <div id="div-row-necropsia-clasificacion" class="input-field col s12 m6 l6">
                @php
                    $array_necropsia_clasificacion = [
                        ['value'=>'dolosa','nombre'=>'Dolosa'],
                        ['value'=>'hecho_transito','nombre'=>'Hecho de tránsito'],
                        ['value'=>'patologia_otra','nombre'=>'Patología u otra'],
                        ['value'=>'suicidio','nombre'=>'Suicidio'],
                        ['value'=>'apoyo_uspec','nombre'=>'Apoyo a la USPEC'],
                    ];
                @endphp
                <select class="datos-peticion" id="necropsia-clasificacion-select" name="necropsia_clasificacion">
                    <option value="" selected disabled>SELECCIONA LA CLASIFICACIÓN DE LA NECROPSIA</option>
                    @foreach ($array_necropsia_clasificacion as $clasificacion)
                        @if ($clasificacion['value'] === $peticion->necropsia->necropsia_tipo)
                            <option value="{{$clasificacion['value']}}" selected>{{$no++}}.- {{$clasificacion['nombre']}}</option>
                        @else
                            <option value="{{$clasificacion['value']}}">{{$no++}}.- {{$clasificacion['nombre']}}</option>
                        @endif
                    @endforeach
                </select>
                <label>asd</label>
            </div>
            @php
                $no = 1;
            @endphp
            <div id="div-row-necropsia-tipo" class="input-field col s12 m6 l6">
                <select class="datos-peticion" id="necropsia-tipo-select" name="necropsia_tipo">
                    @foreach ($necropsias->where('necropsia_tipo',$peticion->necropsia->necropsia_tipo) as $necropsia)
                    @if ($necropsia->id === $peticion->necropsia_id)
                        <option value="{{$necropsia->id}}" selected>{{$no++}}.- {{$necropsia->nombre}}</option>
                    @else
                        <option value="{{$necropsia->id}}">{{$no++}}.- {{$necropsia->nombre}}</option>    
                    @endif
                    @endforeach
                </select>
                <label>ESPECIALIDAD</label>
            </div>
        @endisset
    </div>
@endisset

@empty($peticion)
    <div class="row">
        <div class="input-field col s12 m6 l3">
            <input id="nuc" type="text" name="nuc">
            <label for="nuc">N.U.C.*</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m6 l3">
            <select id="fiscalia-select" name="fiscalia1">
                <option value="" disabled>SELECCIONA LA FISCALÍA A LA QUE PERTENECE LA PETICIÓN</option>
                @foreach ($fiscalias as $fiscalia)
                    @if (Auth::user()->fiscalia->id === $fiscalia->id)
                        <option selected value="{{$fiscalia->id}}">{{$no++}}.- {{$fiscalia->nombre}}</option>
                    @else
                        <option value="{{$fiscalia->id}}">{{$no++}}.- {{$fiscalia->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>FISCALÍA A LA QUE  PERTENECE LA PETICIÓN</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m6 l3">
            <select id="fiscalia-select" name="fiscalia2">
                <option value="" disabled>SELECCIONA LA FISCALÍA EN LA QUE SE ATIENDE LA PETICIÓN</option>
                @foreach ($fiscalias as $fiscalia)
                    @if (Auth::user()->fiscalia->id === $fiscalia->id)
                        <option selected value="{{$fiscalia->id}}">{{$no++}}.- {{$fiscalia->nombre}}</option>
                    @else
                        <option value="{{$fiscalia->id}}">{{$no++}}.- {{$fiscalia->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>FISCALÍA EN LA QUE SE ATIENDE LA PETICIÓN</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m6 l3">
            <select id="unidad-select" name="unidad">
                <option value="" disabled>SELECCIONA LA UNIDAD EN LA QUE SE ATIENDE LA PETICIÓN</option>
                @foreach ($unidades as $unidad)
                    @if (Auth::user()->unidad->id === $unidad->id)
                        <option selected value="{{$unidad->id}}">{{$no++}}.- {{$unidad->nombre}}</option>
                    @else
                        <option value="{{$unidad->id}}">{{$no++}}.- {{$unidad->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>UNIDAD EN LA QUE SE ATIENDE LA PETICIÓN</label>
        </div>
        <div class="input-field col s12 m6 l3">
            <input id="fecha_peticion" type="date" class="center-align" name="fecha_peticion">
            <label class="active" for="fecha_peticion">FECHA DE PETICIÓN*</label>
        </div>
        <div class="input-field col s12 m6 l3">
            <input id="fecha-recepcion" type="date" class="center-align" name="fecha_recepcion">
            <label class="active" for="fecha-recepcion">FECHA DE RECEPCIÓN*</label>
        </div>
        <div class="input-field col s12 m6 l3">
            <input id="oficio_numero" type="text" name="oficio_numero">
            <label for="oficio_numero">NO. OFICIO*</label>
        </div>
        <div class="input-field col s12 m6 l3">
            <input id="folio-interno" type="text" name="folio_interno">
            <label for="folio-interno">NÚMERO LIBRO</label>
        </div>
        <div class="input-field col s12 m12 l4">
            <input id="sp_solicita" type="text" name="sp_solicita">
            <label for="sp_solicita">M. P. o Servidor Público Solicita*</label>
        </div>
        @php $no = 1; @endphp
        <div class="input-field col s12 m12 l4">
            <select id="petfiscalia-select" name="petfiscalia">
                <option value="" disabled>SELECCIONA LUGAR DE ADSCRIPCIÓN DEL SERVIDOR PÚBLICO</option>
                @foreach ($petfiscalias as $petfiscalia)
                    @if ($petfiscalia->fiscalia->id === Auth::user()->fiscalia->id)
                        <option selected value="{{$petfiscalia->id}}">{{$no++}}.- {{$petfiscalia->nombre}}</option>
                    @else
                        <option value="{{$petfiscalia->id}}">{{$no++}}.- {{$petfiscalia->nombre}}</option>
                    @endif
                @endforeach
            </select>
            <label>FISCALÍA DEL M.P. O SERVIDOR PÚBLICO</label>
        </div>
        <div class="input-field col s12 m12 l4">
            <select id="petadscripcion-select" name="petadscripcion">
                <!-- -->
            </select>
            <label>LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO</label>
        </div>
    </div>

    @php $no = 1; @endphp
    <div id="div-row-segunda-etapa" class="row">
        <div class="input-field col s12 m6 l6">
            <select id="especialidad-select" name="especialidad">
                <option value="" selected disabled>SELECCIONA LA ESPECIALIDAD</option>
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

    @if ( Auth::user()->tipo === 'admin_peticiones' )
    <div class="input-field col s12 m6 l6" id="servidor-sp1">
        <a class="btn-modal-sp" data-sp="sp1" href="">Agregar Servidor Público <i class="fas fa-user-plus"></i></a>
     </div>
    @endif
@endempty


   

   