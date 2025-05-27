@extends('plantilla.template')

@section('titulo')
   LISTADO SOLICITUD
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/colores.css')}}">
<link rel="stylesheet" href="{{asset('css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
<link rel="stylesheet" href="{{asset('css/entrada/modal_observacion.css')}}">

   <style media="screen">
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
   </style>
@endsection



@section('seccion', 'LISTADO SOLICITUD DEPURACION')


@section('contenido')


<!--div busqueda-->
<div class="row">
   
      <div class="row">
         <form autocomplete="off">
            <div class="input-field col s8 l8" id="input-buscar">
               @isset($buscar_texto)
                  <input type="text" id="buscar-texto" name="buscar_texto" value="{{$buscar_texto}}">
               @endisset
               @empty($buscar_texto)
                  <input type="text" id="buscar-texto" placeholder="Buscar... N.U.C. parcial o total" name="buscar_texto">
               @endempty
            </div>
            <div class="input-field col s2 l2">
               <button class="btn-guardar-ic" type="submit" name="buscar_btn" value="buscar"><i class="fas fa-search fa-lg i-buscar"></i></button>
            </div>
         </form>
         <div class="input-field col s12 l2">
            <a href="/soldepuracion-form/registrar"><button class="btn-guardar" id="btn-registrar" style="display: inline-block !important; width:100%;" name="btn_registrar" value="registrar">
               Registrar
            </button></a>
         </div>
      </div>
</div>
<!--div busqueda-->

   
   <div class="contenedor-tabla">
      <table id="tabla-entradas" class="highlight">
         <thead>
            <tr>
               <th width="25" class="th-center">Nº</th>
               <th width="80" class="th-center">Acción</th>
            {{-- <th width="80">Rechazar</th> --}}
            {{-- <th width="70">Validar</th> --}}
            <th width="150">N.U.C.</th>
            <th width="150">Folio Interno</th>
            <th width="120">Fecha Solicitud</th>
            <th>Cargo M.P.</th>
            <th>M.P. Solicita</th>
            <th>Area Solicitud</th>
            <th width="120">Fecha Resepcion</th>
            {{-- <th width="70">Estado</th>
            <th class="th-descripcion" width="750">Descripción</th> --}}
            </tr>
         </thead>
         <tbody>
            @isset($solicitud_depuraciones)
               @php $n = 1; @endphp
               @forelse ($solicitud_depuraciones as $key => $solicitud)
                  <!--contador-->
                  <td class="sticky-1 td-contador"><b>{{$n++}}</b></td>

                  <!--acción-->
                  <td style="background-color: #c09f77;color:" class="td-center">
                     <a href="" class="btn-acciones" data-cadena-folio="{{$solicitud->id}}" data-cadena-id="{{$solicitud->id}}">
                        <i style="color: #152f4a;" class="fas fa-ellipsis-h fa-lg"></i>
                     </a>
                  </td>
                  
                  <!--nuc-->
                  <td width="150px" style="background-color: #394049;color: #c6c6c6 !important;"><b>{{$solicitud->nuc}}</b></td>
                  
                  <!--folio_interno-->
                  <td class="td-center" style="background-color: #ffffff;color: #db1515 !important;"><b>{{$solicitud->folio_interno}}</b></td> 
                  

                  <!--fecha_solicitud-->
                  <td class="td-center">{{$solicitud->fecha_solicitud}}</td>

                   <!--cargo del M.P.-->
                  <td>{{$solicitud->unidad_solicitud}}</td>

                  <!--M.P. los solicita-->
                  <td>{{$solicitud->M_P_solicitud}}</td>

                  <!--Area de la solicitud-->
                  <td>{{$solicitud->unidad_solicitud}}</td>

                  <!--fecha resepcion-->
                  <td class="td-center">{{$solicitud->fecha_recepcion_solicitud}}</td>
                  
               @empty
                  <tr>
                     <td colspan="11">
                        <blockquote class="yellow lighten-2">No hay registros</blockquote>
                     </td>
                  </tr> 
               @endforelse
            @endisset
            @empty($solicitud_depuraciones)
            <tr>
               <td colspan="9">
                  <blockquote class="yellow lighten-2">
                        <b>Realice una busqueda</b> <i class="fas fa-search"></i>
                  </blockquote>
               </td>
            </tr>
         @endempty
         </tbody>
      </table>
   </div>


   

   <!--Modal observación-->
<div id="modal-observacion" class="modal">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   <div class="row">
      <div id="modal-header" class="col s12 modal-observacion-header">
         <p class="header-titulo header-folio"></p>
         <p class="header-titulo">Observación - Nota</p>
      </div>
   </div>
   <div id="modal-body" class="row modal-observacion-body">
      <div style="width: 98%;" class="right-align">
         <i style="color: #394049;" class="fas fa-sticky-note fa-2x"></i>
      </div>
      <div id="modal-contenido">
         <!--observacion o nota-->
      </div>
   </div>
   <div id="modal-footer" class="modal-observacion-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-revisar').addClass('active').css({'font-weight':'bold'});
   </script>

   <script src="{{asset('js/modal/modal.js')}}"></script>
   <script src="{{asset('js/indicio/indicio_observacion.js')}}"></script>
   <script src="{{asset('js/indicio/indicio_estado.js')}}"></script>

   <script src="{{asset('plugins/viewer_js/js/viewer.js')}}"></script>
   <script src="{{asset('plugins/viewer_js/js/jquery-viewer.js')}}"></script>

   <script>
      var texto = $('#buscar-texto').val();
       if(texto != ''){
         console.log('entro:' + texto);
         $('td').mark(texto,{
         "separateWordSearch": false,
         });
      }
   </script>

   @include('general.error_method_get')
@endsection
