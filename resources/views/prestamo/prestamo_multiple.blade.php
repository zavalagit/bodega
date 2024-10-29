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
   FORMULARIO DE PRESTAMO
@endsection
@section('seccion', 'PRESTAMO MÚLTIPLE')


@section('contenido')

<div class="row">
<form class="col s12" id="form-prestamo">
   {{-- {{ csrf_token() }} --}}
   <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
   <input type="hidden" id="prestamo-tipo" name="prestamo_multiple" value="prestamo_multiple" data-prestamo-tipo="prestamo-multiple">
   <input type="hidden" id="prestamo-etapa" name="prestamo_etapa" value="prestamo">


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
                  <span style="font-size: 20px !important; color: #152f4a;"><b>Seleccione los indicios que van a ser parte del prestamo o baja.</b></span>
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
                        <th>NATURALEZA</th>
                        <th>SELECCIONAR</th>
                        <th>IDENTIFICADOR</th>
                        <th>DESCRIPCIÓN</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php $no = 1; @endphp
                        @forelse ($cadenas as $key => $cadena)
                           <!--contador-->
                           <td rowspan="{{$cadena->indicios->count()}}" class="td-contador" style="width: 2%;">{{$no++}}</td>
                           <!--seleccionar-->
                           <td rowspan="{{$cadena->indicios->count()}}" style="width: 5%;">
                              <input type="checkbox" class="filled-in cadena-checkbox" id="cadena-{{$cadena->id}}" {{--disabled--}}{{( ( $cadena->indicios->count() ) == ( $cadena->indicios->where('estado','activo')->count() ) ) ? 'checked' : 'disabled'}} data-id-cadena="{{$cadena->id}}" data-indicios-cantidad="{{$cadena->indicios->count()}}" name="cadenas[]" value="{{$cadena->id}}"/>
                              <label for="cadena-{{$cadena->id}}"></label>
                           </td>
                           <!--folio-->
                           <td rowspan="{{$cadena->indicios->count()}}" style="width: 6%;"><b>{{$cadena->folio_bodega}}</b></td>
                           <!--estado-->
                           <td rowspan="{{$cadena->indicios->count()}}" style="width: 4%;">
                              @php $estado = true; @endphp
                              @if ($cadena->editar === 'si')
                                 @php $estado = false; @endphp
                                 <a href="" id="jc-cadena-editar" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-id="{{$cadena->id}}" data-cadena-editar="{{$cadena->editar}}">
                                    <i style="color: #fdd835;" class="fas fa-square cadena-estado-editar"></i>
                                 </a>
                              @endif
                              @if ($cadena->bajas->count())
                                 @php $estado = false; @endphp
                                 <i style="color: #f44336;" class="fas fa-square cadena-estado-baja"></i>
                              @endif
                              @if ($cadena->prestamos->count() && ($cadena->prestamos->last()->estado == 'activo'))
                                 @php $estado = false; @endphp
                                 <i style="color: #42a5f5;" class="fas fa-square cadena-estado-prestamo"></i>
                              @endif
                              @if ($estado)
                                 <i style="color: #76ff03;" class="fas fa-square cadena-estado-activo"></i>
                              @endif
                              @if ($cadena->entrada->observacion != '')
                                 <a href="" class="jc-cadena-observacion" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-observacion="{{$cadena->entrada->observacion}}">
                                    <i style="color: #b388ff;" class="fas fa-square cadena-estado-observacion"></i>
                                 </a>
                              @endif
                           </td>
                           <!--nuc-->
                           <td rowspan="{{$cadena->indicios->count()}}" width="8%">{{$cadena->nuc}}</td>
                           <!--naturleza-->
                           @isset($cadena->entrada->naturaleza_id)
                              <td rowspan="{{$cadena->indicios->count()}}" width="10%">{{$cadena->entrada->naturaleza->nombre}}</td>
                           @endisset
                           <!--descripcion-->
                           @foreach ($cadena->indicios as $indicio)
                              @if ($loop->iteration > 1)
                                 <tr>    
                              @endif
                                    <td>
                                       <input type="checkbox" class="filled-in indicio-checkbox {{($indicio->estado == 'activo') ? "c-{$cadena->id}" : ""}}" id="indicio-{{$indicio->id}}" {{--checked--}}{{($indicio->estado == 'activo') ? "checked" : ""}} {{--disabled--}}{{( ( $cadena->indicios->count() ) == ( $cadena->indicios->where('estado','activo')->count() ) ) ? 'disabled' : ''}} {{($indicio->estado != 'activo') ? 'disabled' : "data-cadena-id=$cadena->id"}} name="indicios[]" value="{{$indicio->id}}"/>
                                       <label for="indicio-{{$indicio->id}}">
                                    </td>
                                    @if ($indicio->estado === 'activo')
                                       <td width="6%" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                                       <td style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
                                    @elseif($indicio->estado === 'prestamo')
                                       <td class="blue lighten-4" width="6%" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                                       <td class="blue lighten-4" style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
                                    @elseif($indicio->estado === 'baja')
                                       <td class="red lighten-4" width="6%" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                                       <td class="red lighten-4" style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
                                    @endif
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
            @include('prestamo.prestamo_datos')
         </div>
      </div>
      <div class="carousel-item blue white-text" href="#four!">
         <h2>Fourth Panel</h2>
         <p class="white-text">This is your fourth panel</p>
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
<script src="{{asset('js/prestamo/prestamo_crear.js')}}"></script>



   
   <script src="{{asset('js/cadenas/cadena_estado.js')}}"></script>
   <script src="{{asset('js/cadenas/cadena_select.js')}}"></script>
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>



@endsection
