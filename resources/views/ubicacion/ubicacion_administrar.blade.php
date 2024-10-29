@extends('bodega.plantilla')

@section('seccion', 'REGISTRO UBICACION EN BODEGA')

@section('titulo','REGISTRAR-UBICACION')

@section('css')
<link rel="stylesheet" href="{{asset('css/colores.css')}}">
<link rel="stylesheet" href="{{asset('css/tablas.css')}}">


<style>
    th{
        border-top: 1px solid #c09f77;
        border-left: 1px solid #c09f77;
    }
    td{
        border-left: 1px solid #c6c6c6;
    }
    .btn-ubicacion-nva{
        display:inline-block;
        width:295px !important;
        height:55px !important;
        padding:5px;
    }
    .btn-ubicacion-nva i{
        vertical-align:middle !important; color: #c6c6c6;
    }
    .btn-ubicacion-nva span{
        font-size: 20px; vertical-align:middle !important; text-align:center !important; color: #c6c6c6;
        font-weight: bold;
        /* text-decoration: #c6c6c6 underline; */
    }
    a:hover i, a:hover span{
        color: #394049 !important;
        /* text-decoration: #394049 underline; */

    }
    .modal{
        width: 80% !important;
        height: 80% !important;
    }
</style>

@endsection

@section('contenido')
<span id="span-csrf" data-csrf="{{csrf_token()}}"></span>


<div class="row navbar-fixed">
      <form class="col s12" autocomplete="off">
         <div class="row">
            <div class="input-field col s3">
               <select name="filtro" id="filtro">
               <option value="" disabled selected>FILTRAR POR...</option>
                  <option value="1">DESCRIPCIÓN</option>
                  <option value="2">FECHA</option>
                  <option value="6">TIPO (NATURALEZA)</option>
               </select>
            </div>
            <div class="input-field col s6" id="input-buscar">
               @isset($buscar)
                  <input type="text" name="buscar" value="{{$buscar}}">
               @endisset
               @empty($buscar)
                  <input type="text" placeholder="Buscar..." name="buscar">
               @endempty
            </div>

            <div class="input-field col s2">
               <button class="btn waves-effect waves-light" type="submit">
                  Buscar
               </button>
            </div>

         </div>
      </form>
</div>
<!--div busqueda-->

<section>
    <div class="row">
        <div class="col s2 offset-s10">
            <a href="#terms" class="modal-trigger btn-ubicacion-nva">
                <i class="fas fa-map-marker-alt fa-3x"></i>
                <span>Nueva ubicación</span>
            </a>
        </div>
    </div>
</section>


<div class="row">
    <div class="col s12">
        <table class="highlight">
            <thead>
                <tr>
                    <th width="3%" class="th-center">No.</th>
                    <th width="70%">NOMBRE</th>
                    <th width="5%">AÑO</th>
                    <th width="16%">NATURALEZA</th>
                    <th width="3%">EDITAR</th>
                    <th width="3%">ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                @php $n = 1; @endphp
                @foreach ($ubicaciones as $ubicacion)
                    <tr data-id="{{$ubicacion->id}}">
                        <td class="td-contador">{{$n++}}</td>
                        <td>{{$ubicacion->nombre}}</td>
                        <td>{{$ubicacion->anio}}</td>
                        <td>{{$ubicacion->naturaleza->nombre}}</td>
                        <td>
                            <a href='/ubicacion-editar/{{$ubicacion->id}}' class="btn-ubicacion-editar" >
                                <i class="fas fa-pen-square fa-lg i-dorado"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#delete" class="btn-delete"><i class="fas fa-window-close fa-lg i-dorado"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>





<td  class="col s2"><i class="fal fa-ballot"></i></td>
</div>
</div>




<div class="modal" id="terms">
    <div class="modal-content">
        <h5>Agreagar lugar</h5>
        <form id="form-ubicacion-agregar">
            {{csrf_field()}}
            <input type="text" placeholder="Nombre ubicación" name="nombre">
            <input type="number" placeholder="YYYY" min="2017" max="2020" name="anio">
            <select name="naturaleza">
                <option value="" disabled selected>Selecciona la Naturaleza</option>
                @foreach ($naturalezas as $key => $naturaleza)
                    <option value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
                @endforeach
            </select>
            <button class="btn waves-effect waves-light" type="submit" id="btn-ubicacion-agregar">Agregar lugar</button>
        </form>
    </div>
</div>

<div class="modal" id="edit">
    <div class="modal-content">
        <h4>Editar</h4>
        <form action="">
            <input type="text" name="nombre">
            <input type="text" name="anio">
            <select class="" name="naturaleza_id">
                <option value="" disabled selected></option>
                @foreach ($naturalezas as $key => $naturaleza)
                <option value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
                @endforeach
            </select>
            <button class="btn waves-effect waves-light" type="submit" id="buscar-btn">Echo</button>
        </form>
    </div>
</div>
{{--}}
{!! Form::open(['route' =>['destroyubicacion',':USER_ID'], 'method'=> 'DELETE', 'id'=>'form-delete']) !!}
{!! Form::close()!!}

--}}

@endsection


@section('js')

  <script src="{{asset('js/ubicacion/ubicacion_agregar.js')}}"></script>

@endsection
