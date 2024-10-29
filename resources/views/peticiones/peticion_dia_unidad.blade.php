@extends('plantillas.peticiones.plantilla_coordinador')

@section('seccion', "PETICIONES DEL DÍA ($fecha)")
@section('titulo','CONSULTAR-CADENA')

@section('css')

    <link rel="stylesheet" href="{{asset('css/botones/btn_icon.css')}}">
   <style media="screen">
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
 
    <div class="row">
       @foreach ($unidades as $unidad)
          <div class="col s3">
             <div class="div-fiscalia">
                <h6><b>{{$unidad->nombre}}</b></h6>
                <p>solicitudes del día: {{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->count()}}</p>
                <p>solicitudes atendidas: {{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->whereIn('estado',['atendida','entregada'])->count()}}</p>
                <a href="/peticion-dia/{{Auth::user()->fiscalia->id}}/{{$unidad->id}}">Ver más...</a>
             </div>
          </div>
       @endforeach
    </div>
  
@endsection

@section('js')
  


@endsection
