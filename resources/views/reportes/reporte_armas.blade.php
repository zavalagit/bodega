@extends('plantilla.template')

{{-- nombre vista --}}
@section('nombre_pagina','vista-reporte-armas')
@section('nombre_submenu','submenu-reportes')

@section('titulo')
   Reporte-Armas
@endsection

@section('seccion', 'REPORTE DE ARMAS')

@section('css')
   
@endsection

@section('contenido')

    <div class="row">
        <form class="col s12" target="_blank" action="/reporte-armas-pdf">
            <div class="row">
                <div class="input-field col s6">
                    <input id="fecha_inicio" type="date" required name="fecha_inicio">
                    <label for="fecha_inicio" class="active">Fecha Inicio</label>
                </div>
                <div class="input-field col s6">
                    <input id="fecha_inicio" type="date" required name="fecha_fin">
                    <label for="fecha_inicio" class="active">Fecha fin</label>
                </div>
				<div class="input-field col s6 {{Auth::user()->tipo == 'responsable_bodega' ? 'hide' : ''}}">
                    <select name="region_id">
					  <option value="" disabled selected></option>
					  @foreach ($regiones as $region)
					  <option value="{{$region->id}}">{{$region->nombre}}</option>
					  @endforeach
					</select>
					<label>REGIÓN</label>                    
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <hr class="hr-main">
                </div>
            </div>

            <div class="row">
                <div class="input-field col offset-s10 s2">
                    <button class="btn-guardar" type="submit" name="btn" value="btn_entradas">
                        entradas
                    </button>
                    <button class="btn-guardar" type="submit" name="btn" value="btn_bajas">
                        bajas
                    </button>
                </div>
            </div>


        </form>


    </div>

@endsection

@section('js')

@endsection
