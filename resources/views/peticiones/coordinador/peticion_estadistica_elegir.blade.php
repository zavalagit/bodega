@extends('plantillas.peticiones.plantilla_coordinador')

@section('seccion', "PETICIONES $fecha_encabezado")
@section('titulo','CONSULTAR-CADENA')

@section('css')

    <link rel="stylesheet" href="{{asset('css/botones/btn_icon.css')}}">
   <style media="screen">
      body{
         zoom: 73% !important;
      }
      caption{
         color: #c6c6c6 !important;
         background-color: #152F4A !important;
      }

      .col{
         margin-bottom: 2%;
      }

      .div-fiscalia{
         background-color: #394049;
         color: #c09f77;
         border-radius: 25px 25px 0 25px;
         padding: 10px 0 10px 15px;
      }
      .div-fiscalia:hover{
         background-color: #152f4a;
      }
   </style>
@endsection

@section('contenido')


   <!--div busqueda-->
<div class="row">
    <form class="col s12" autocomplete="off">
       <div class="row" style="margin-bottom:0px !important;">
          <div class="input-field col s2" style="margin-bottom:0px !important;">
            @isset($fecha_inicio)
                <input id="fecha-inicio" type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
            @endisset
            @empty($fecha_inicio)
                <input id="fecha-inicio" type="date" name="fecha_inicio">    
            @endempty
            <label class="active" for="fecha-inicio">FECHA INICIO</label>
          </div>
          <div class="input-field col s2" style="margin-bottom:0px !important;">
            @isset($fecha_fin)
                <input id="fecha-fin" type="date" name="fecha_fin" value="{{$fecha_fin}}">
            @endisset
            @empty($fecha_fin)
                <input id="fecha-fin" type="date" name="fecha_fin">
            @endempty
             <label class="active" for="fecha-fin">FECHA FIN</label>
          </div>
          
          <div class="input-field col s1">
             <button class="" type="submit" name="buscar_btn" value="buscar"><i class="fas fa-search fa-lg"></i></button>
             <!--
             <button class="" type="submit" name="buscar_btn" value="pdf"><i style="color:red;" class="fas fa-file-pdf fa-lg"></i></button>
             <button class="" type="submit" name="buscar_btn" value="excel"><i style="color:darkgreen;" class="fas fa-file-excel fa-lg"></i></button>
             -->
          </div>
 
       </div>
    </form>
 </div>
 <!--div busqueda-->

 
   <div class="row">
      @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
         <div class="col s3">
            <div class="div-fiscalia">
               @if ($fiscalia->id == 4)
                  <h6><b>{{$fiscalia->nombre}}</b></h6>
                  <p>solicitudes: {{$peticiones->where('fiscalia2_id',$fiscalia->id)->count()}} (Divididas en en tres unidades)</p>
                  <p>solicitudes atendidas: {{$atendidas->where('fiscalia2_id',$fiscalia->id)->wherein('estado',['atendida','entregada'])->count()}}</p>
                  <p><a href="/peticion-estadistica-elegir/unidad?fecha_inicio={{$fecha_inicio}}&fecha_fin={{$fecha_fin}}&buscar_btn=buscar">Ver más...</a></p>
                  <p>&nbsp;</p>
               @else
                  <h6><b>{{$fiscalia->nombre}}</b></h6>
                  <p>solicitudes: {{$peticiones->where('fiscalia2_id',$fiscalia->id)->count()}}</p>
                  <p>solicitudes atendidas: {{$atendidas->where('fiscalia2_id',$fiscalia->id)->wherein('estado',['atendida','entregada'])->count()}}</p>
                  <p><a href="/peticion-estadistica/fiscalia/{{$fiscalia->id}}?fecha_inicio={{$fecha_inicio}}&fecha_fin={{$fecha_fin}}&buscar_btn=buscar">Estadística</a></p>
                  <p><a href="/concentrado-dia/fiscalia/{{$fiscalia->id}}?fecha_inicio={{$fecha_inicio}}&fecha_fin={{$fecha_fin}}&buscar_btn=buscar">Concentrado_diario</a></p>
               @endif
            </div>
         </div>
      @endforeach
   </div>
  
@endsection

@section('js')
  


@endsection
