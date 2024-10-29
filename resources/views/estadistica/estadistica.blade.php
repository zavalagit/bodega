
{{-- @extends( ( Auth::user()->tipo == 'administrador' ) ? 'administrador.plantillafiscalia' : 'plantillas.bodega.plantilla_rb') --}}

@extends( ( Auth::user()->tipo == 'administrador' ) ? 'administrador.plantillafiscalia' : 'bodega.plantilla')

@section('titulo')
    Estadistica ie
@endsection

@section('css')
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
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
       width: 100% !important;
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
/*
   .td-folio{
      width: 100px !important;
   }
*/




     .btn{
         background-color: #bdbdbd;
      }

/*
      .tabla{
         margin-top: 0 !important;
      }
*/
      h5{
         margin-bottom: 0;
         /*color: #112046;*/
      }

      .modal{
        width: 30% !important;
      }

      .modal-seccion-enlaces{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
      }
      .modal-enlace{
        width: 40%;
        margin: 20px;
      }
      .modal-enlace a{
        font-size: 14px !important;
      }
      .modal-enlace a:hover{
        color:rgb(124, 67, 126);
        font-size: 15px !important;
      }

   </style>
@endsection

@section('seccion')
    Estadística Ingresos - Prestamos - Bajas
@endsection

@section('contenido')

   <div class="row">
        <form class="col s12" autocomplete="off">
            <div class="row">
               <div class="input-field col s12 m6 l3">
                  <input type="date" name="fecha_inicio" required value="{{ app('request')->input('fecha_inicio') }}">
               </div>
               <div class="input-field col s12 m6 l3">
                  <input type="time" name="hora_inicio" value="{{ app('request')->input('hora_inicio') }}">
               </div>
                <div class="input-field col s12 m6 l3">
                  <input type="date" name="fecha_fin" value="{{ app('request')->input('fecha_fin') }}">
                </div>
                <div class="input-field col s12 m6 l3">
                  <input type="time" name="hora_fin" value="{{ app('request')->input('hora_fin') }}">
               </div>

               <div class="col s3">
                  <input name="tipo_inventario" type="radio" id="fecha-acuse" {{( app('request')->input('tipo_inventario') == 'fecha_acuse' ) ? "checked" : "checked"}} value="fecha_acuse" />
                  <label for="fecha-acuse">Hora/Fecha Ingreso a Bodega</label>
               </div>
               <div class="col s3">
                  <input name="tipo_inventario" type="radio" id="fecha-registro" {{( app('request')->input('tipo_inventario') == 'fecha_registro' ) ? "checked" : ""}} value="fecha_registro" />
                  <label for="fecha-registro">Hora/Fecha Registro en sistema</label>
               </div>

               <div class="input-field col s2">
                  <button class="btn waves-effect waves-light" type="submit">
                     Buscar
                  </button>
               </div>
            </div>
        </form>
   </div>


   <div class="tabla">
      <table class="responsive-table highlight bordered">
         <thead>
            <tr>
               <th>Nº</th>
               <th>Región</th>
               <th>Indicios</th>
               <th>Evidencias</th>
               <th>I/E Prestamos</th>
               <th>I/E Bajas</th>
            </tr>
         </thead>
         <tbody>
            @php $n=1; @endphp
            @isset($array_estadistica)
                @foreach ($array_estadistica as $key => $fiscalia)
                    <tr>
                        <td class="td-contador">{{$n++}}</td>
                        <td>{{$key}}</td>
                        <td>{{$fiscalia['indicios']}}</td>
                        <td>{{$fiscalia['evidencias']}}</td>
                        <td>{{$fiscalia['prestamos']}}</td>
                        <td>{{$fiscalia['bajas']}}</td>
                    </tr>
                @endforeach
                <tr class="tr-total">
                     <td class="td-contador">{{$n++}}</td>
                    <td> <b>TOTAL</b> </td>
                    <td>{{array_sum(array_column($array_estadistica,'indicios'))}}</td>
                    <td>{{array_sum(array_column($array_estadistica,'evidencias'))}}</td>
                    <td>{{array_sum(array_column($array_estadistica,'prestamos'))}}</td>
                    <td>{{array_sum(array_column($array_estadistica,'bajas'))}}</td>
                </tr>
            @endisset
            @empty($array_estadistica)
                <tr>
                    <td colspan="5">no hay</td>
                </tr>
            @endempty
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

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content" style="padding:5px; padding-bottom:15px;">
      <div class="modal-cerrar right-align right-align">
        <a href="#" class="btn-modal-cerrar"><i class="fas fa-times" style="color:#d50000"></i></a>
      </div>
      <h5 class="modal-folio center-align"></h5>

      <section class="modal-seccion-enlaces">
        <div class="modal-enlace center-align">
          <a hfef="" target="_blank" style="font-size: 14px" class="link-editar"><i class="fas fa-pen"></i> EDITAR</a>
        </div>
        <div class="modal-enlace center-align">
          <a hfef="" target="_blank" style="font-size: 14px" class="link-historial"><i class="fas fa-clock"></i> HISTORIAL</a>
        </div>
        <div class="modal-enlace center-align">
          <a hfef="" target="_blank" style="font-size: 14px" class="link-prestamo"><i class="fas fa-arrow-circle-left"></i> PRESTAMO</a>
        </div>
        <div class="modal-enlace center-align">
          <a hfef="" target="_blank" style="font-size: 14px" class="link-baja"><i class="fas fa-arrow-circle-down"></i> BAJA</a>
        </div>
        <div class="modal-enlace center-align">
          <a hfef="" target="_blank" style="font-size: 14px" class="link-fotos"><i class="fas fa-arrow-circle-down"></i> FOTOS</a>
        </div>
      </section>
<!--
      <table>

          <tr>
              <th width="">EDITAR</th>
              <td width="">link<td>
          </tr>
          <tr>
              <th width="">HISTORIAL</th>
              <td width="">link<td>
          </tr>
          <tr>
              <th width="">PRESTAMO</th>
              <td width="">link<td>
          </tr>
          <tr>
              <th width="">BAJA</th>
              <td width="">link<td>
          </tr>

      </table>
    -->
    </div>
    <!--
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  -->
  </div>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-entradas').addClass('active').css({'font-weight':'bold'});
   </script>

   <script src="{{asset('js/busqueda.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/acciones.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/buscar_texto_rbi.js')}}" charset="utf-8"></script>

@endsection
