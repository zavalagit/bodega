@extends('plantillas.plantilla_fiscal')

@section( 'seccion', "SOLICITUDES DE LA FECHA ".date('d-m-Y',strtotime($fecha)) )
@section('titulo','Solicitudes')
@section('css')
   <style>
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
            <input id="fecha-inicio" type="date" name="fecha" value="{{$fecha}}">
            <label class="active" for="fecha-inicio">FECHA</label>
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
      @foreach ($fiscalias as $fiscalia)
         <div class="col s3">
            <div class="div-fiscalia">
               <h6><b>{{$fiscalia->nombre}}</b></h6>
               <p>solicitudes del día: {{$peticiones->where('fiscalia2_id',$fiscalia->id)->count()}}</p>
               <p>solicitudes atendidas: {{$peticiones->where('fiscalia2_id',$fiscalia->id)->wherein('estado',['atendida','entregada'])->count()}}</p>
               <a href="/fiscal-inicio?buscar_fiscalia={{$fiscalia->id}}&fecha_peticiones={{$fecha}}&buscar_btn=buscar">Ver mas...</a>
            </div>
         </div>
      @endforeach
   </div>







@endsection
@section('js')
@endsection
