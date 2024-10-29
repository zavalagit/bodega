{{--
@extends( ( Auth::user()->tipo == 'coordinador' ) ? 'plantillas.peticiones.plantilla_coordinador' : 'plantillas.plantilla_director')
--}}

@php
    $plantilla = '';
    if( Auth::user()->tipo == 'coordinador' )
        $plantilla = 'plantillas.peticiones.plantilla_coordinador';
    elseif( (Auth::user()->tipo == 'director_unidad') || (Auth::user()->tipo == 'director_fiscalia') )
        $plantilla = 'plantillas.plantilla_director';
    elseif(  Auth::user()->tipo == 'usuario' )
        $plantilla = 'plantilla.template';
@endphp

@extends($plantilla)

@if (Auth::user()->tipo === 'usuario')
    {{--item menu selected--}}
   @section('nombre_pagina','vista-peticion-estadistica')
   @section('nombre_submenu','submenu-peticiones')
@endif

@section('seccion', 'ESTADISTICA')

@section('titulo','ESTADISCA')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">
<link rel="stylesheet" href="{{asset('css/tablas.css')}}">

<style>
    
    .fecha-encabezado{
        margin: 0 !important;
    }
    .fecha-encabezado h5{
        text-align: center;
        background-color: #152f4a;
        color: #c09f77;
        padding-top: 6px;
        padding-bottom: 6px;
    }

    /* .tabla-peticiones td{
        width:50%; 
        text-align:left;
    } */

    /* caption{
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    } */

    /* .td-izq{
        width: 80% !important;
        text-align:left;
        padding-left:3% !important;
    }
    .td-der{
        width:20% !important;
        text-align:right;
        padding-right:10% !important;
    } */
    .td-izq-total{
        width: 80% !important;
        text-align:center;
        padding-left:3% !important;
        background-color:#c09f77;
        color:#394049 !important;
        font-weight: bold;
    }
    .td-der-total{
        width:20% !important;
        text-align:right;
        padding-right:10% !important;
        background-color:#394049;
        color:white !important;
    }
    /* .td-sub{
        background-color: #c6c6c6;
        color: white;
    } */
    .row .collapsible-header{
        margin-bottom: 0 !important;
    }


    .collapsible-header{
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }

    .collapsible-titulo{
        background-color:#394049;
        text-align: center !important;
        font-weight: bold;
        border-radius: 0 !important;
    }

    .collapsible-izq{
        background-color:#c09f77;
        color:#394049 !important;
        font-weight: bold;
        padding-top: 5px !important;
        padding-bottom: 5px !important;
        padding-left: 25px !important;
    }
    .collapsible-der{
        padding-right:10% !important;
        background-color:#394049;
        color:white !important;
        padding-top: 5px !important;
        padding-bottom: 5px !important;
        padding-left: 25px !important;
    }
    /* .collapsible-body{
        padding: 12px !important;
    } */

    .hola{
        background-color: #fff !important;
        border-radius: 0 !important;
    }
</style>
@endsection

@section('contenido')
    <!--buscar-->
    <section>
        <form class="col s12">
            <div class="row">
                
                @if (Auth::user()->tipo === 'coordinador')
                    <div id="div-fiscalias" class="input-field col s2">
                        <select id="fiscalia-select" name="buscar_fiscalia">
                        @foreach ($fiscalias->sortBy('nombre') as $f)
                            <option value="{{$f->id}}" {{ ($f->id === $fiscalia->id) ? 'selected' : '' }}>{{$f->nombre}}</option>
                        @endforeach
                        </select>
                        <label>Seleccione Fiscalía</label>
                    </div>
                    
                    @if ($lugar === 'unidad')
                        <div id="div-unidades" class="input-field col s2">
                            <select id="unidad-select" name="buscar_unidad">
                            @foreach ($unidades->sortBy('nombre') as $u)
                                <option value="{{$u->id}}" {{ ($u->id === $unidad->id) ? 'selected' : '' }}>{{$u->nombre}}</option>
                            @endforeach
                            </select>
                            <label>Seleccione Unidad</label>
                        </div>
                    @endif
                @endif

                

                <div class="input-field col s2">
                    @isset($fecha_inicio)
                        <input type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
                    @endisset
                    @empty($fecha_inicio)
                        <input type="date" name="fecha_inicio" >
                    @endempty
                </div>
                <div class="input-field col s2">
                    @isset($fecha_fin)
                        <input type="date" name="fecha_fin" value="{{$fecha_fin}}">
                    @endisset
                    @empty($fecha_fin)
                        <input type="date" name="fecha_fin" >
                    @endempty
                </div>
                <div class="input-field col s1">
                    <button class="btn waves-effect waves-light" type="submit" name="btn_buscar" value="buscar">
                        <i style="color:#394049;" class="fas fa-search"></i>
                    </button>
                </div>
				{{--
                @if (Auth::user()->tipo != 'usuario')
                    <div class="input-field col s1">
                        <button class="btn waves-effect waves-light" type="submit" name="btn_buscar" value="pdf">
                            <span>PDF</span>
                        </button>
                    </div>
                
                @endif
				--}}
            </div>
        </form>
    </section>

    <!--encabezado-->
    <section>
        <div class="row">
            <div class="fecha-encabezado col s12" style="margin-bottom:0 !important;">
                <h5 style="margin-bottom:0 !important;"> <b>PETICIONES {{$fecha_encabezado}}</b> </h5>
            </div>

            <div class="fecha-encabezado col s12" style="margin-top:0 !important;">
                @if ($lugar === 'unidad')
                    <h5 style="margin-top:0 !important;"> <b>{{$unidad->nombre}}</b> </h5>
                @elseif($lugar === 'fiscalia')
                    <h5 style="margin-top:0 !important;"> <b>{{$fiscalia->nombre}}</b> </h5>
                @elseif( Auth::user()->tipo === 'usuario')
                    <h5 style="margin-top:0 !important;"><b>{{Auth::user()->nombre}}</b></h5>
                @endif
            </div>
        </div>
    </section>
    
    <!--peticiones y rezago-->
    <section>
        <div class="row">
            <div class="col s12 m12 l6">
                @include('peticiones.include_peticiones')
            </div>
            {{--
            <!--rezago-->
            <div class="col s12 m12 l6">
                @include('peticiones.include_rezago')
            </div>
            --}}

            <div class="col s12 m12 l6">
                @include('peticiones.include_documento_emitido')
            </div>
        </div>        
    </section>
    
    <!--documento_emitido, necro, estudio osteologico-->
    <section>
        <div class="row">
            
            @if ( ( ($lugar === 'unidad') && ( $unidad->id == 2 || $unidad->id == 6 ) ) || ($lugar === 'fiscalia') )   
                @if( ($lugar == 'unidad') && ($lugar_id == 2) )
                    <div class="col s12 m12 l3">
                @else
                    <div class="col s12 m12 l6">    
                @endif
                    
                @include('peticiones.include_necropsias_collapsible')
                </div>
            
                
                @if( ($lugar == 'unidad') && ($lugar_id == 2) )
                    <div class="col s12 m12 l3">
                @else
                    <div class="col s12 m12 l6">    
                @endif
                    
                @include('peticiones.include_osteologico_collapsible')
                </div>
                

                @if( ($lugar == 'unidad') && ($lugar_id == 2) )
                    <div class="col s12 m12 l3">
                        @include('peticiones.include_necropsias_uspec')
                    </div>
                    <div class="col s12 m12 l3">
                        @include('peticiones.include_necropsias_uecs')
                    </div>
                @endif
                
            @endif
        </div>
    </section>
    
    <!--peticiones por especialidad-->
    <section>
        <div class="row">
            <div class="col s12">
               @include('peticiones.include_peticiones_especialidad')
            </div>
        </div>
    </section>

     
        <!--cantdad_estudios-->
        <section>
            <div class="row">
                <div class="col s12">
                
                @include('peticiones.include_cantidad_estudios') 
        
                </div>
            </div>
        </section>

		{{--
        <!--colectivos-->
        @if ( ( ($lugar === 'unidad') && ( $unidad->id == 1 ) ) || ($lugar === 'fiscalia') || ( Auth::user()->unidad_id == 1 ) )
            <section>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Cantidad de registros</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{$colectivos->count()}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Tipo de muestra</th>
                                    <th>% de uso</th>
                                    <th>Cantidad de estudios</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pruebas->sortBy('nombre')->values() as $i => $prueba)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$prueba->nombre}}</td>
                                        <td>{{$colectivos->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; })}}/{{$colectivos->count()}} ~ {{round( (float)( ( $colectivos->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; }) ) / $colectivos->count() ) * 100 )}} %</td>
                                        <td>{{ $colectivos->sum(function ($colectivo) use($prueba){ return $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->sum('pivot.cantidad_estudios'); }) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4">no hay registros</td></tr>    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        @endif
		--}}



    @if (!empty($otro_array))
     <div class="row">
        <div class="col s12">
            <table>
                <caption><b>OTROS</b></caption>
                <thead>
                    <tr>
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">Perito</th>
                        <th style="text-align:center;">Especialidad</th>
                        <th style="text-align:center;">Solicitud</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                    @endphp

                    @foreach ($otro_array as $key => $peticion)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$peticion->user->name}}</td>
                            <td>{{$peticion->solicitud->especialidad->nombre}}</td>
                            <td>{{$peticion->solicitud->nombre}}</td>
                        </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div>
        @if (!empty($otro_array))
            <div class="col s12">
                <table>
                    <caption><b>OTROS</b></caption>
                    <thead>
                        <tr>
                            <th style="text-align:center;">N°</th>
                            <th style="text-align:center;">Especialidad</th>
                            <th style="text-align:center;">Dictamen</th>
                            <th style="text-align:center;">Informe</th>
                            <th style="text-align:center;">Certificado</th>
                            <th style="text-align:center;">Salida a Juzgado</th>
                            <th style="text-align:center;">Archivo</th>
                            <th style="text-align:center;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $n = 1;
                            $total_atendidas_otras = 0;
                            $especialidades_otras_array = [];
                            foreach ($otro_array as $key => $peticion) {
                                if ( !array_key_exists($peticion->solicitud->especialidad->nombre,$especialidades_otras_array) ){
                                    $especialidades_otras_array[$peticion->solicitud->especialidad->nombre] = ['dictamen'=>0,'informe'=>0,'certificado'=>0,'salida_juzgado'=>0,'archivo'=>0];
                                    $especialidades_otras_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;
                                }
                                else{
                                    $especialidades_otras_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;
                                }
                            }
                        @endphp
                        @foreach ($especialidades_otras_array as $key => $peticion)
                            <tr>
                                <td>{{$n++}}</td>
                                <td>{{$key}}</td>
                                <td>{{$peticion['dictamen']}}</td>
                                <td>{{$peticion['informe']}}</td>
                                <td>{{$peticion['certificado']}}</td>
                                <td>{{$peticion['salida_juzgado']}}</td>
                                <td>{{$peticion['archivo']}}</td>
                                <td>{{array_sum($especialidades_otras_array[$key])}}</td>
                            </tr>
                            @php
                                $total_atendidas_otras += array_sum($especialidades_otras_array[$key]);
                            @endphp
                        @endforeach
                        <tr style="background-color:#c09f77;">
                            <td colspan="2"> <b>TOTAL</b> </td>
                            <td>{{array_sum(array_column($especialidades_otras_array,'dictamen'))}}</td>
                            <td>{{array_sum(array_column($especialidades_otras_array,'informe'))}}</td>
                            <td>{{array_sum(array_column($especialidades_otras_array,'certificado'))}}</td>
                            <td>{{array_sum(array_column($especialidades_otras_array,'salida_juzgado'))}}</td>
                            <td>{{array_sum(array_column($especialidades_otras_array,'archivo'))}}</td>
                            <td>{{$total_atendidas_otras}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

@section('js')

<script src="{{asset('js/peticiones/peticion_editar.js')}}"></script>
<script src="{{asset('js/get_tablas/get_unidades.js')}}"></script>

  <script type="text/javascript">
    $('.li-consultar-cadena').removeClass('active');
    $('.li-registrar-cadena').addClass('active');
  </script>
@endsection