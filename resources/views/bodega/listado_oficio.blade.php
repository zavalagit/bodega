{{-- {{dd('vista')}} --}}
@extends('bodega.plantilla')

@section('css')
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">

   <style media="screen">
      *{ 
         box-sizing: border-box !important;
      }
   
      /* .row{
         margin: 0 !important;
         padding: 0 !important;
      } */
   
      body{
         background: #394049;
      } 

   /* #tabla-entradas{
       width: 100% !important;
   } */

   /* td{
      vertical-align: top !important; */
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


     /*sticky-1*/
      /* #tabla-entradas .sticky-1{
         position: sticky;
         left: 0;
         width: 55px;
      }
      #tabla-entradas tbody tr td .sticky-1{
         background-color: #304049;
      }
      #tabla-entradas thead tr th{
         background-color: #304049;
      } */
      /*sticky-2*/
      /* #tabla-entradas .sticky-2{
         position: sticky;
         left: 55px;
         width: 100px;
      }
      #tabla-entradas tbody tr .sticky-2{
         background-color: #c09f77 !important; */
      }
      /*sticky-3*/
      /* #tabla-entradas .sticky-3{
         position: sticky;
         left: 154.5px;
      }
      #tabla-entradas tbody tr .sticky-3{
         background-color: #152f4a !important;
      }
      #tabla-entradas tbody tr td.sticky-3{
         color: #c6c6c6 !important;
         width: 100px;
      } */

      .sig:hover{
         color: #c09f77 !important;
      }
      .fa-chevron-circle-right:hover{
         color: #c09f77 !important;
      }

      .carousel{
         width: 96%;
         height:93vh;
         margin: auto;
         background-color: #394049;
      }
      .carousel-item{
         border-radius: 40px; 
      }      

   </style>
@endsection

@section('titulo')
   ENTRADAS
@endsection
@section('seccion', 'ENTRADAS')


@section('contenido')

<form action="/bodega/listado-oficio-historial" method="post" autocomplete="off">
   {{-- {{ csrf_token() }} --}}
   <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
   <input type="hidden" name="hola" value="hola">


   <div class="carousel carousel-slider center">
      {{-- <div class="carousel-fixed-item center">
         <a class="btn waves-effect white grey-text darken-text-2">button</a>
      </div> --}}
      <div class="carousel-item" href="#one!" style="background-color: #c6c6c6;">
         <div class="row" style="padding-top: 10px !important">
            <div class="col s2 offset-s10">
               <a href="" class="adelante"><i style="color: #152f4a;" class="fas fa-chevron-circle-right fa-2x"></i></a>
            </div>
         </div>
         <div class="row">
            <div class="col s12">
               <p>
                  <i style="color: #394049;" class="fas fa-square fa-lg"></i>
                  <span style="font-size: 20px !important; color: #152f4a;"><b>Seleccione los indicios que van a ser parte del listado.</b></span>
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
                              <input type="checkbox" class="filled-in cadena-checkbox" id="cadena-{{$cadena->id}}" data-id-cadena="{{$cadena->id}}" name="caedena_{{$cadena->id}}" checked/>
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
                                       <input type="checkbox" class="filled-in indicio-checkbox c-{{$cadena->id}}" id="indicio-{{$indicio->id}}" name="indicio_{{$indicio->id}}" checked disabled/>
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
      <div class="carousel-item" href="#two!" style="padding-top:20px !important; background-color: #c6c6c6;">
         <div class="row" style="padding-top: 10px !important;">
            <div class="col s2">
               <a href="" class="atras"><i style="color: #152f4a;" class="fas fa-chevron-circle-left fa-2x"></i></a>
            </div>
            <div class="col s2 offset-s8">
               <a href="" class="adelante"><i style="color: #152f4a;" class="fas fa-chevron-circle-right fa-2x"></i></a>
            </div>
         </div>
         <div class="row">
            <div class="col s12">
               
            </div>
         </div>
         <div class="row">
            <div class="input-field col s3">
               <input id="oficio-numero" type="text" name="oficio-numero">
               <label for="oficio-numero">Número de oficio</label>
            </div>
            <div class="input-field col s3">
               <input id="fecha-solicitud" type="date" name="fecha_solicitud">
               <label class="active" for="fecha">Fecha de solicitud</label>
            </div>
            <div class="input-field col s3">
               <input id="fecha-elaboracion" type="date" name="fecha_elaboracion">
               <label class="active" for="fecha">Fecha de elaboración</label>
            </div>
            <div class="input-field col s3">
               <input id="fecha-entrega" type="date" name="fecha_entrega">
               <label class="active" for="fecha">Fecha de entrega</label>
            </div>
         </div>
         <div class="row">
            <div class="col s12">
               <hr class="hr-main">
            </div>
         </div>
         <div class="row">
            <div class="col s2 offset-s10">
               <button class="btn-guardar" name="btn_listado" value="oficio">Guardar</button>
            </div>
         </div>
      </div>
      <div class="carousel-item green white-text" href="#three!">
         <h2>Third Panel</h2>
         <p class="white-text">This is your third panel</p>
      </div>
      <div class="carousel-item blue white-text" href="#four!">
         <h2>Fourth Panel</h2>
         <p class="white-text">This is your fourth panel</p>
      </div>
   </div>
      
   {{-- <button type="submit">consultar</button> --}}
</form>


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
<script src="{{asset('js/entrada/cadena_accion.js')}}" charset="utf-8"></script>



   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-entradas').addClass('active').css({'font-weight':'bold'});
   </script>

   
   <script src="{{asset('js/cadenas/cadena_estado.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/listado_oficio.js')}}" charset="utf-8"></script>

   {{-- <script>
      var texto = $('#buscar-texto').val();
       if(texto != ''){
         console.log('entro:' + texto);
         $('td').mark(texto,{
         "separateWordSearch": false,
         });
      }
   </script> --}}

@endsection
{{-- {{dd('vista')}} --}}
@extends('bodega.plantilla')

@section('css')
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">

   <style media="screen">
      *{ 
         box-sizing: border-box !important;
      }
   
      /* .row{
         margin: 0 !important;
         padding: 0 !important;
      } */
   
      body{
         background: #394049;
      } 

   /* #tabla-entradas{
       width: 100% !important;
   } */

   /* td{
      vertical-align: top !important; */
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


     /*sticky-1*/
      /* #tabla-entradas .sticky-1{
         position: sticky;
         left: 0;
         width: 55px;
      }
      #tabla-entradas tbody tr td .sticky-1{
         background-color: #304049;
      }
      #tabla-entradas thead tr th{
         background-color: #304049;
      } */
      /*sticky-2*/
      /* #tabla-entradas .sticky-2{
         position: sticky;
         left: 55px;
         width: 100px;
      }
      #tabla-entradas tbody tr .sticky-2{
         background-color: #c09f77 !important; */
      }
      /*sticky-3*/
      /* #tabla-entradas .sticky-3{
         position: sticky;
         left: 154.5px;
      }
      #tabla-entradas tbody tr .sticky-3{
         background-color: #152f4a !important;
      }
      #tabla-entradas tbody tr td.sticky-3{
         color: #c6c6c6 !important;
         width: 100px;
      } */

      .sig:hover{
         color: #c09f77 !important;
      }
      .fa-chevron-circle-right:hover{
         color: #c09f77 !important;
      }

      .carousel{
         width: 96%;
         height:93vh;
         margin: auto;
         background-color: #394049;
      }
      .carousel-item{
         border-radius: 40px; 
      }      

   </style>
@endsection

@section('titulo')
   ENTRADAS
@endsection
@section('seccion', 'ENTRADAS')


@section('contenido')

<form action="/bodega/listado-oficio-historial" method="post" autocomplete="off">
   {{-- {{ csrf_token() }} --}}
   <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
   <input type="hidden" name="hola" value="hola">


   <div class="carousel carousel-slider center">
      {{-- <div class="carousel-fixed-item center">
         <a class="btn waves-effect white grey-text darken-text-2">button</a>
      </div> --}}
      <div class="carousel-item" href="#one!" style="background-color: #c6c6c6;">
         <div class="row" style="padding-top: 10px !important">
            <div class="col s2 offset-s10">
               <a href="" class="adelante"><i style="color: #152f4a;" class="fas fa-chevron-circle-right fa-2x"></i></a>
            </div>
         </div>
         <div class="row">
            <div class="col s12">
               <p>
                  <i style="color: #394049;" class="fas fa-square fa-lg"></i>
                  <span style="font-size: 20px !important; color: #152f4a;"><b>Seleccione los indicios que van a ser parte del listado.</b></span>
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
                              <input type="checkbox" class="filled-in cadena-checkbox" id="cadena-{{$cadena->id}}" data-id-cadena="{{$cadena->id}}" name="caedena_{{$cadena->id}}" checked/>
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
                                       <input type="checkbox" class="filled-in indicio-checkbox c-{{$cadena->id}}" id="indicio-{{$indicio->id}}" name="indicio_{{$indicio->id}}" checked disabled/>
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
      <div class="carousel-item" href="#two!" style="padding-top:20px !important; background-color: #c6c6c6;">
         <div class="row" style="padding-top: 10px !important;">
            <div class="col s2">
               <a href="" class="atras"><i style="color: #152f4a;" class="fas fa-chevron-circle-left fa-2x"></i></a>
            </div>
            <div class="col s2 offset-s8">
               <a href="" class="adelante"><i style="color: #152f4a;" class="fas fa-chevron-circle-right fa-2x"></i></a>
            </div>
         </div>
         <div class="row">
            <div class="col s12">
               
            </div>
         </div>
         <div class="row">
            <div class="input-field col s3">
               <input id="oficio-numero" type="text" name="oficio-numero">
               <label for="oficio-numero">Número de oficio</label>
            </div>
            <div class="input-field col s3">
               <input id="fecha-solicitud" type="date" name="fecha_solicitud">
               <label class="active" for="fecha">Fecha de solicitud</label>
            </div>
            <div class="input-field col s3">
               <input id="fecha-elaboracion" type="date" name="fecha_elaboracion">
               <label class="active" for="fecha">Fecha de elaboración</label>
            </div>
            <div class="input-field col s3">
               <input id="fecha-entrega" type="date" name="fecha_entrega">
               <label class="active" for="fecha">Fecha de entrega</label>
            </div>
         </div>
         <div class="row">
            <div class="col s12">
               <hr class="hr-main">
            </div>
         </div>
         <div class="row">
            <div class="col s2 offset-s10">
               <button class="btn-guardar" name="btn_listado" value="oficio">Guardar</button>
            </div>
         </div>
      </div>
      <div class="carousel-item green white-text" href="#three!">
         <h2>Third Panel</h2>
         <p class="white-text">This is your third panel</p>
      </div>
      <div class="carousel-item blue white-text" href="#four!">
         <h2>Fourth Panel</h2>
         <p class="white-text">This is your fourth panel</p>
      </div>
   </div>
      
   {{-- <button type="submit">consultar</button> --}}
</form>


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
<script src="{{asset('js/entrada/cadena_accion.js')}}" charset="utf-8"></script>



   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-entradas').addClass('active').css({'font-weight':'bold'});
   </script>

   
   <script src="{{asset('js/cadenas/cadena_estado.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/listado_oficio.js')}}" charset="utf-8"></script>

   {{-- <script>
      var texto = $('#buscar-texto').val();
       if(texto != ''){
         console.log('entro:' + texto);
         $('td').mark(texto,{
         "separateWordSearch": false,
         });
      }
   </script> --}}

@endsection
