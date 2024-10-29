@extends('bodega.plantilla')

@section('seccion', 'Ubicación Editar')

@section('titulo','Ubicación Editar')

@section('css')
<link rel="stylesheet" href="{{asset('css/colores.css')}}">


<style>
    .modal{
        width: 80% !important;
        height: 80% !important;
    }
</style>

@endsection

@section('contenido')

<div class="row">
    <form id="form-ubicacion-editar" data-id="{{$ubicacion->id}}">
        {{csrf_field()}}
        <div class="row">
            <div class="input-field col s6">
                <input id="nombre" placeholder="nombre" type="text" value="{{$ubicacion->nombre}}" name="nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s6">
                <input type="number" id="anio" placeholder="YYYY" min="2017" max="2020" value="{{$ubicacion->anio}}" name="anio">
                <label for="anio">Año</label>
            </div>
            <div class="input-field col s6">
                <select name="naturaleza">
                    @foreach ($naturalezas as $key => $naturaleza)
                        @if ( $naturaleza->id === $ubicacion->naturaleza_id )
                            <option value="{{$naturaleza->id}}" selected>{{$naturaleza->nombre}}</option>
                        @else
                            <option value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            

            <button class="btn waves-effect waves-light" type="submit" id="btn-ubicacion-editar">editar</button>
        </div>
    </form>
</div>

@endsection


@section('js')
<script src="{{asset('js/ubicacion/ubicacion_editar.js')}}"></script>
@endsection
