
@extends('plantilla.template')

@section('titulo')
   BUSCAR DESTRUCCION
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



@section('seccion', 'ASIGANAR INDICIOS DEPURACION')


@section('contenido')


<!--div busqueda-->
<div class="row">
   <form class="col s12" autocomplete="off">
      <div class="row">
         <div class="input-field col s8" id="input-buscar">
            @isset($buscar_texto)
               <input type="text" id="buscar-texto" name="buscar_texto" value="{{$buscar_texto}}">
            @endisset
            @empty($buscar_texto)
               <input type="text" id="buscar-texto" placeholder="Buscar... N.U.C. parcial o total" name="buscar_texto">
            @endempty
         </div>
         <div class="input-field col s2">
            <button class="btn-guardar-ic" type="submit" name="buscar_btn" value="buscar"><i class="fas fa-search fa-lg i-buscar"></i></button>
         </div>

      </div>
   </form>
</div>
<!--div busqueda-->

   
   <div class="contenedor-tabla">
      <table id="tabla-entradas" class="highlight">
         <thead>
            <tr>
               <th width="20" class="th-center">Nº</th>
            {{-- <th width="80">Rechazar</th> --}}
            <th width="70">Validar Todo</th>
            <th width="150">N.U.C.</th>
            <th width="150">Folio</th>
            <th>NATURALEZA</th>
            <th width="70">Estado</th>
            <th class="th-descripcion" width="750">Descripción</th>
            </tr>
         </thead>
         <tbody>
            @isset($cadenas)
               @php $n = 1; @endphp
               @forelse ($cadenas as $key => $cadena)
                  <!--contador-->
                  <td rowspan="{{$cadena->indicios->count()}}" class="sticky-1 td-contador"><b>{{$n++}}</b></td>
                  
                  <!--validar-->
                  <td rowspan="{{$cadena->indicios->count()}}" class="sticky-2 td-center">
                     <a href="destruccion-form/registrar/{{$cadena->id}}" target="_blank" class="validar-enlace" data-id="{{$cadena->id}}"><i style="color: #c09f77;" class="fas fa-check-square fa-lg"></i></a>
                  </td>
                  
                  <!--nuc-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="150px" style="background-color: #394049;color: #c6c6c6 !important;"><b>{{$cadena->nuc}}</b></td>
                  
                  <!--folio-->
                  @isset($cadena->entrada)
                     <td rowspan="{{$cadena->indicios->count()}}" class="sticky-3"><b>{{$cadena->folio_bodega}}</b></td> 
                  @endisset

                  <!--naturaleza-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="200px">{{$cadena->entrada->naturaleza->nombre}}</td>
                  

                  <!--indicios-->
                  @foreach ($cadena->indicios as $indicio)
                        @if ($loop->iteration > 1)
                           <tr>    
                        @endif
                           
                           <!--indicio_estado-->
                           <td style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;"> @include('indicio.indicio_estado') </td>
                           <!--indicio_descripción-->
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
            @endisset
            @empty($cadenas)
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
