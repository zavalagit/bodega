@extends('bodega.plantilla')

@section('seccion', 'CONSULTA FOLIO PARA SU UBICACION')
@section('titulo','CONSULTAR-FOLIO')

@section('css')
   <style media="screen">

       body{
        overflow-x: hidden;
       }

   </style>
    <link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
   <link rel="stylesheet" href="{{asset('css/js_maker.css')}}">
@endsection

@section('contenido')

   <span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

{{-- <section>
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s12 m6 l2">
                    <input type="date" id="fecha-inicio" name="buscar_fecha_inicio" value="{{old('buscar_fecha_inicio')}}">
                    <label class="active" for="fecha-inicio">FECHA INICIO</label>
                </div>
                <div class="input-field col s12 m6 l2">
                    <input type="date" id="fecha-inicio" name="buscar_fecha_fin" value="{{old('buscar_fecha_fin')}}">
                    <label class="active" for="fecha-fin">FECHA INICIO</label>
                </div>
                <div class="input-field col s12 m12 l3">
                    <select name="buscar_naturaleza">
                       <option value="0">---</option>
                       @foreach ($naturalezas as $naturaleza)
                            <option value="{{$naturaleza->id}}" {{( old('buscar_naturaleza') == $naturaleza->id ) ? 'selected' : ''}}>{{$naturaleza->nombre}}</option>
                       @endforeach
                    </select>
                    <label>NATURALEZA</label>
                 </div>
                <div class="input-field col s12 m12 l4">
                    <input type="text" id="folio" placeholder="Folio" name="buscar_folio" value="{{old('buscar_folio')}}">
                    <label class="active" for="folio">FOLIO</label>
                </div>
                <div class="input-field col s12 m12 l1">
                    <button type="submit" class="btn-icono" id="buscar-btn" name="btn_buscar" value="buscar"><i class="fas fa-search fa-3x"></i></button>
                </div>
            </div>
        </form>
    </div>
</section> --}}

<div class="row">
    <div class="col s12 m12 l12 right-align" {{--style="padding-right: 0px !important;"--}}>
       {{-- <button class="btn-guardar-ic" type="submit" name="btn" value="buscar"><i class="fas fa-search i-buscar"></i></button> --}}
       <a class="modal-trigger a-btn pulse z-depth-2" href="#modal-buscar">
          <i class="fas fa-search fa-lg"></i> {{--<span><b>Buscar...</b></span>--}} 
       </a>
    </div>
 </div>

    <div class="row">
        <div class="col s12">
            <table class="highlight bordered responsive-table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>FOLIO BODEGA</th>
                        <th>UBICACIÓN</th>
                        <th>NATURALEZA</th>
                        <th>IDENTIFICADOR</th>
                        <th>DESCRIPCIÓN</th>
                        <th>UBICACIÓN</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @isset($cadenas)
                        @forelse ($cadenas->values() as $key => $cadena)
                        <tr>
                            <td rowspan="{{$cadena->indicios->count()}}" width='2%' class="td-contador">{{$key+1}}</td>
                            <td rowspan="{{$cadena->indicios->count()}}" width='7%'><b>{{$cadena->folio_bodega}}</b></td>
                            <td rowspan="{{$cadena->indicios->count()}}" width='3%' class="td-center"><a href="/ubicacion-asignar/{{$cadena->id}}" target="_blank"><i class="fas fa-pen-square fa-2x"></i></a></td>
                            <td rowspan="{{$cadena->indicios->count()}}" width='12%'>{{$cadena->entrada->naturaleza->nombre}}</td>
                            <!--indicios-->
                            @foreach ($cadena->indicios as $indicio)
                                @if ($loop->iteration > 1)
                                    <tr>    
                                @endif
                        
                                <td  width='6%'>{{$indicio->identificador}}</td>
                                <td>{{$indicio->descripcion}}</td>
                                <td  width='8%'>
                                @isset($indicio->ubicacion_id)
                                    {{$indicio->ubicacion->nombre}}
                                @endisset
                                @empty($indicio->ubicacion_id)
                                    No hay ubicación
                                @endempty
                                </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6"></td>
                            </tr> 
                        @endforelse
                    @endisset
                    @empty($cadenas)
                        <tr>
                            <td colspan="7">No hay coinsidencias</td>
                        </tr>
                    @endempty
                        
                </tbody>
            </table>
        </div>
    </div>

<!--Modal buscar-->
<div id="modal-buscar" class="modal modal-buscar">
    <div class="modal-cerrar right-align">
       <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
    </div>
    <div class="row">
       <div id="modal-header" class="col s12 modal-buscar-header">
          <p class="header-titulo header-folio"><i class="fas fa-search fa-sm"></i> Buscar...</p>
          {{-- <p class="header-titulo">buscar</p> --}}
       </div>
    </div>
    <div id="modal-body" class="row modal-buscar-body"> 
        <div id="modal-contenido" class="row" style="padding:10px 0 !important;">
            <form class="col s12" autocomplete="off">
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <input type="text" id="folio" placeholder="Folio" name="buscar_folio" value="{{old('buscar_folio')}}">
                        <label class="active" for="folio">FOLIO</label>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <input type="date" id="fecha-inicio" name="buscar_fecha_inicio" value="{{old('buscar_fecha_inicio')}}">
                        <label class="active" for="fecha-inicio">FECHA INICIO</label>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <input type="date" id="fecha-inicio" name="buscar_fecha_fin" value="{{old('buscar_fecha_fin')}}">
                        <label class="active" for="fecha-fin">FECHA INICIO</label>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <select name="buscar_naturaleza">
                        <option value="0">---</option>
                        @foreach ($naturalezas as $naturaleza)
                                <option value="{{$naturaleza->id}}" {{( old('buscar_naturaleza') == $naturaleza->id ) ? 'selected' : ''}}>{{$naturaleza->nombre}}</option>
                        @endforeach
                        </select>
                        <label>NATURALEZA</label>
                    </div>

                    <div class="col s12">
                        <hr class="hr-main">
                    </div>
                
                    <div class="input-field col s12">
                    <button type="submit" class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" name="btn_buscar" value="buscar">BUSCAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="modal-footer" class="modal-buscar-footer">
       {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
    </div>
 </div>
@endsection

@section('js')
   <script type="text/javascript">
      $('.li-registrar-cadena').removeClass('active');
      $('.li-consultar-cadena').addClass('active');
      $('.a-disabled').bind('click', false);
   </script>

   
<script src="{{asset('js/modal/modal.js')}}"></script>  
   <script type="text/javascript" src="{{asset('js/etiqueta.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/anexo3_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/anexo4_pdf.js')}}" ></script>

   <script type="text/javascript" src="{{asset('js/sesion_perito/buscar_maker.js')}}" ></script>

   @if ($errors->any())
    <script type="text/javascript">
        const error = @json($errors->first());
        alertify.error(error);
    </script>
@endif
@endsection
