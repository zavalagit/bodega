{{-- {{dd('vista')}} --}}
@extends('plantillas.plantilla_sin_menu')

@section('css')
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
   <link rel="stylesheet" href="{{asset('css/block.css')}}">

   <style media="screen">
      *{ 
         box-sizing: border-box !important;
      }
   
   
      body{
         background: #394049;
      } 


 
     table{
      border-spacing: 0 !important;
        border-collapse: separate !important;
     }

     .contenedor-tabla{
         border-left: 1px solid #ccc;
         border-right: 1px solid #ccc;
         overflow: hidden;
      }

      .panel{
         /* padding-top:20px !important;  */
         /* background-color: #c6c6c6; */
         background-color: #fff;
      }

      .atras i,
      .adelante i{
         color: #394049 !important;
      }
      .atras:hover i,
      .adelante:hover i{
         color: #152f4a !important;
      }
      /* .fa-chevron-circle-right:hover{
         color: #c09f77 !important;
      } */

      .carousel{
         width: 96%;
         height:93vh;
         margin: auto;
         background-color: #394049;
      }
      .carousel-item{
         border-radius: 40px; 
      }      
      #panel-uno{
         overflow-y: auto;
         overflow-x: auto;
      }
   </style>
@endsection

@section('titulo')
   REINGRESO MÚLTIPLE
@endsection
@section('seccion', 'REINGRESO MÚLTIPLE')


@section('contenido')

<div class="row">
<form class="col s12" id="form-reingreso">
   <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
   <input type="hidden" id="reingreso-tipo" name="reingreso_multiple" value="reingreso_multiple" data-reingreso-tipo="reingreso-multiple">
   <input type="hidden" id="prestamo-etapa" name="prestamo_etapa" value="reingreso">


   <div class="carousel carousel-slider center">
      {{-- <div class="carousel-fixed-item center">
         <a class="btn waves-effect white grey-text darken-text-2">button</a>
      </div> --}}
      <div class="carousel-item panel" id="panel-uno" href="#one!">
         <div class="row" style="padding-top: 10px !important">
            <div class="col s2 offset-s10">
               <a href="" class="adelante"><i class="fas fa-chevron-circle-right fa-2x"></i></a>
            </div>
         </div>

         <div class="row">
            <div class="col s12">
               <hr class="hr-main">
            </div>
         </div>

         <div class="row">
            <div class="col s12">
               <p>
                  <i style="color: #394049;" class="fas fa-square fa-lg"></i>
                  <span style="font-size: 20px !important; color: #152f4a;"><b>Seleccione los prestamos que van a ser parte del reingreso.</b></span>
               </p>
            </div>
         </div>
         <div class="row" style="">
            <div class="contenedor-tabla col s12">
               <table id="tabla-entradas" class="highlight">
                  <thead>
                     <tr>
                        <th class="sticky-1 th-center">Nº</th>
                        <th class="sticky-2">SELECCIONAR</th>
                        <th class="sticky-3">FOLIO</th>
                        <th>ESTADO</th>
                        <th>N.U.C.</th>
                        <th>RESGUARDANTE</th>
                        <th>IDENTIFICADOR</th>
                        <th>DESCRIPCIÓN</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($prestamos->values() as $key => $prestamo)
                        <tr>
                           <!--contador-->
                           <td rowspan="{{$prestamo->indicios->count()}}" class="td-contador" style="width: 2%;">{{$key+1}}</td>
                           <!--seleccionar-->
                           <td rowspan="{{$prestamo->indicios->count()}}" style="width: 5%;">
                              <input type="checkbox" class="filled-in cadena-checkbox" id="prestamo-{{$prestamo->id}}" {{--disabled--}}{{($prestamo->estado == 'activo') ? 'checked' : 'disabled'}} name="prestamos[]" value="{{$prestamo->id}}"/>
                              <label for="prestamo-{{$prestamo->id}}"></label>
                           </td>
                           <!--folio-->
                           <td rowspan="{{$prestamo->indicios->count()}}" style="width: 6%;"><b>{{$prestamo->cadena->folio_bodega}}</b></td>
                           <!--estado-->
                           <td rowspan="{{$prestamo->indicios->count()}}" style="width: 4%;">{{$prestamo->estado}}</td>
                           <!--nuc-->
                           <td rowspan="{{$prestamo->indicios->count()}}" width="8%">{{$prestamo->cadena->nuc}}</td>
                           <!--resguardante-->
                           <td rowspan="{{$prestamo->indicios->count()}}" width="10%">{{$prestamo->perito1->nombre}}</td>
                           <!--descripcion-->
                           @foreach ($prestamo->indicios as $indicio)
                              @if ($loop->iteration > 1)
                                 <tr>    
                              @endif
                                    <td width="6%" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                                    <td style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
                                 </tr>
                           @endforeach
                     @empty
                        <tr>
                           <td colspan="11">
                              <blockquote class="yellow lighten-2">No hay registros</blockquote>
                           </td>
                        </tr> 
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!--panel-->
      <div class="carousel-item panel" id="panel-form" href="#three!">
         <div class="row" style="padding-top: 10px !important;">
            <div class="col s2">
               <a href="" class="atras"><i class="fas fa-chevron-circle-left fa-2x"></i></a>
            </div>
            <div class="col s2 offset-s8">
               <a href="" class="adelante"><i class="fas fa-chevron-circle-right fa-2x"></i></a>
            </div>
         </div>

         <div class="row">
            <div class="col s12">
               <hr class="hr-main">
            </div>
         </div>

         <div class="row" id="formulario">
            <!--formulario-->
            @include('prestamo.reingreso_datos')
         </div>
      </div>
   </div>
      
   {{-- <button type="submit">consultar</button> --}}
</form>
</div>


@endsection

@section('js')

<script>
   $(function(){
      $('.carousel').carousel({
         noWrap: true,
      });
      $('.carousel.carousel-slider').carousel({fullWidth: true});

      $('.adelante').click(function(e){
         e.preventDefault();
         $('.carousel').carousel('next');
      })
      $('.atras').click(function(e){
         e.preventDefault();
         $('.carousel').carousel('prev');
      })




   });
</script>
{{-- <script src="{{asset('js/entrada/cadena_accion.js')}}" charset="utf-8"></script> --}}
   <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
   <script src="{{asset('js/prestamo/reingreso_save.js')}}"></script>
   <script src="{{asset('js/cadenas/cadena_estado.js')}}"></script>
   <script src="{{asset('js/cadenas/cadena_select.js')}}"></script>



@endsection
