@extends( ( Auth::user()->tipo == 'administrador' ) ? 'administrador.plantillafiscalia' : 'bodega.plantilla')

@section('css')
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">

   <style media="screen">
      .fa-search{
         color: #4db6ac;
      }
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
      .fa-file-pdf-o{
         color: #d50000;
      }
      thead{
         background-color:
      }
      .fa-check{
         color: #4caf50;
      }
      .fa:hover{
         font-size: 1.3em;
      }
      .icon-check:hover{
         font-size: 1.5em;
      }

      body {
         overflow-x: scroll; /*horizontal scroll*/
          overflow-y: scroll; /*vertical scroll*/
}
   table{
       width: 180% !important;
   }

   .th-center,.td-center{
      text-align: center;
   }

   a.accion{
      border-radius: 0 !important;
      background-color: rgba(255, 255, 255, 0) !important;
      border: 1px solid rgb(50, 162, 170) !important;
      color: black !important;
   }
   a.accion:hover{
      background-color: rgb(50, 162, 170) !important;
      color: white !important;
   }

   .td-folio{
      width: 100px !important;
   }

   .encabezado{
      margin: 0 !important;
      text-align: center;
   }

   td{
      vertical-align: top !important;
     }

     .btn{
         background-color: #bdbdbd;
      }

      .tabla{
         margin-top: 0 !important;
      }

      h5{
         margin-bottom: 0;
         /*color: #112046;*/
      }
   </style>
@endsection

@section('titulo')
   ENTRADAS
@endsection

@section('contenido')

<!--div busqueda-->
   <div class="row navbar-fixed">                  
         <form class="col s12" autocomplete="off">
            <div class="row">
               <div class="input-field col s3">
                  <select name="filtro" id="filtro">
                  <option value="" disabled selected>FILTRAR POR...</option>
                     <option value="1">DESCRIPCIÓN</option>
                     <option value="2">FECHA</option>
                     <option value="3">FOLIO</option>
                     <option value="4">HORA</option>
                     <option value="5">N.U.C.</option>
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

   <div class="encabezado">
      <h5 class=" amber"><b>E N T R A D A S</b></h5>
   </div>

   <div class="tabla">
      <table class="responsive-table highlight bordered">   
         <thead class="blue lighten-5">
            <tr>
               <th class="td-folio">N0.</th>
               <th class="td-folio">EDITAR</th>
               <th class="td-folio">ACCIÓN</th>
               <th class="td-folio">FOLIO</th>
               <!--
               <th class="td-folio">Editar</th>
               <th class="th-center">Historial</th>
               <th class="th-center">Prestamo</th>
               <th class="th-center">Baja</th>
               -->
               <th class="th-center">RESGUARDO</th>
               <th>N.U.C.</th>
               <th>FECHA</th>
               <th>NATURALEZA</th>
               <th>QUIEN ENTREGA</th>
               <th>DESCRIPCIÓN</th>
               <th>OBSERVACIÓN</th>
               <th>UBICACIÓN</th>
            </tr>
         </thead>
         <tbody>
            @if (count($cadenas))
               @foreach ($cadenas as $key => $cadena)

                  @foreach($cadena->bajas as $k => $baja)
                     @if($baja->tipo == 'definitiva')
                        <tr class="red lighten-4">
                     @else
                        <tr class="lime lighten-5">
                     @endif
                  @endforeach

                  @foreach($cadena->prestamos as $k => $prestamo)
                     @if($prestamo->estado == 'activo')
                        <tr class="blue lighten-4">
                        @break
                     @endif      
                  @endforeach              

                     <td>{{$key+1}}</td>

                     <td>
                        <a href="/administrador/editar-cadena/{{$cadena->id}}">editar</a>
                     </td>


                     <td>
                        <a class='dropdown-btn' data-beloworigin="true" href='#' data-activates='dropdown1' data-folio="{{$cadena->folio_bodega}}" data-id="{{$cadena->id}}">
                           <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        </a>
                     </td>
                     <td class="td-folio"><b>{{$cadena->folio_bodega}}</b></td>
                     {{--
                     <td><a href="/bodega/editar/{{$cadena->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                     <td class="th-center"><a href="/bodega/historial-cadena/{{$cadena->folio_bodega}}"><i class="fa fa-history"></i></a></td>
                     <td class="th-center"><a href="/bodega/prestamo/{{$cadena->folio_bodega}}"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></td>
                     <td class="th-center"><a href="/bodega/baja/{{$cadena->folio_bodega}}"><i class="fa fa-angle-double-down" aria-hidden="true"></i></a></td>
                     --}}
                     <td class="td-center"><a href="/bodega/resguardo/{{$cadena->folio_bodega}}"><i class="fa fa-save"></i></a></td>
                     <td >{{$cadena->nuc}}</td>
                     @isset($cadena->entrada->fecha)
                     <td >{{date('d-m-Y',strtotime($cadena->entrada->fecha))}}</td>
                     @endisset
                     @isset($cadena->entrada->tipo)
                     <td >{{$cadena->entrada->naturaleza->nombre}}</td>
                     @endisset
                     @isset($cadena->entrada->perito_id)
                        <td >{{$cadena->entrada->perito->nombre}}</td>
                     @endisset   
                     <td style="width: 35%">
                        @foreach ($cadena->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}}:</b>{{$indicio->descripcion}}<br>
                        @endforeach
                     </td>
                     <!--OBSERVACIÓN-->
                     @isset($cadena->observacion)
                        <td>{{$cadena->entrada->observacion}}</td>
                     @endisset
                     @empty($cadena->observacion)
                        <td>---</td> 
                     @endempty
                        
                     <td style="width: 10%">
                        @foreach ($cadena->indicios as $key => $indicio)
                           @isset($indicio->resguardo)
                              <span class="green-text text-darken-3"><b>{{$indicio->resguardo}}</b></span><br>
                           @endisset
                           @empty ($indicio->resguardo)
                              <span class="red-text text-accent-4"><b>No Asignado</b></span><br>
                           @endempty
                        @endforeach
                     </td>
                  </tr>
               @endforeach
            @else
               <tr>
                  <td colspan="12">
                     <blockquote class="yellow lighten-2">No hay registros</blockquote>
                  </td>
               </tr>
            @endif
         </tbody>
      </table>
   </div>

  
   <ul id='dropdown1' class='dropdown-content'>
    <li id="folio-dropdown"></li>
    <li><a hfef="" target="_blank" style="font-size: 14px" id="editar-link">EDITAR</a></li>
    <li><a hfef="" target="_blank" style="font-size: 14px" id="historial-link">HISTORIAL</a></li>
    <li><a hfef="" target="_blank" style="font-size: 14px" id="prestamo-link">PRESTAMO</a></li>
    <li><a hfef="" target="_blank" style="font-size: 14px" id="baja-link">BAJA</a></li>
  </ul>



@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-entradas').addClass('active').css({'font-weight':'bold'});
   </script>

   <script src="{{asset('js/busqueda.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/acciones.js')}}" charset="utf-8"></script>

@endsection
