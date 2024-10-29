
@extends('bodega.plantilla')

@section('titulo')
   REVISAR
@endsection

@section('nombre_pagina','Colectivos revisar')

@section('css')
<link rel="stylesheet" href="{{asset('css/colores.css')}}">
<link rel="stylesheet" href="{{asset('css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">

   <style media="screen">
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
   </style>
@endsection



@section('seccion', 'CADENAS DE CUSTODIA PARA REVISIÓN')


@section('contenido')


<!--div busqueda-->
{{-- <div class="row">
   <form class="col s12" autocomplete="off">
      <div class="row">
         <div class="input-field col s8" id="input-buscar">
            @isset($buscar_texto)
               <input type="text" id="buscar-texto" name="buscar_texto" value="{{$buscar_texto}}">
            @endisset
            @empty($buscar_texto)
               <input type="text" id="buscar-texto" placeholder="Buscar... N.U.C., descripción, Servidor Público (folio o nombre)" name="buscar_texto">
            @endempty
         </div>
         <div class="input-field col s2">
            <button class="btn-guardar-ic" type="submit" name="buscar_btn" value="buscar"><i class="fas fa-search fa-lg i-buscar"></i></button>
         </div>

      </div>
   </form>
</div> --}}
<!--div busqueda-->

   <table class="highlight">
      <thead>
         <tr>
            <th width="20" class="th-center">Nº</th>
            <th width="80">Validar</th>
            <th width="150">Perito</th>
            <th width="150">CIM</th>
            <th class="th-descripcion" width="750">Descripción</th>
            <th width="80" class="th-center">Anexo 3</th>
            <th width="80" class="th-center">Anexo 4</th>
            <th width="80" class="th-center">Etiqueta</th>
           <!-- 
            <th>Editar</th>
           --> 
         </tr>
      </thead>
      <tbody>
         @isset($cadenas)
            @php $n=1; @endphp
            @forelse ($cadenas as $key => $cadena)
               <tr>
                  <td class="td-contador" width="20"><b>{{$n+1}}</b></td>
                  {{-- <td width="80"><a href="" class="nota-enlace" data-id="{{$cadena->id}}" ><i class="fa fa-times icon-x" aria-hidden="true"></i></a></td> --}}

                  <td width="80">
                     <a href="/bodega/alta/{{$cadena->id}}" class="validar-enlace" data-id="{{$cadena->id}}"><i style="color: #c09f77;" class="fas fa-check-square fa-lg"></i></a>
                  </td>

                  <td width="150"><b>{{$cadena->user->name}}</b></td>
                  <td width="150">{{$cadena->nuc}}</td>
                  <td class="td-descripcion" width="750" align="left">
                     @foreach($cadena->indicios as $key => $indicio)
                        <b>{{$indicio->identificador}}: </b>{{$indicio->descripcion}}<br>
                     @endforeach
                  </td>
                  <td width="80" class="td-center">
                     <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-3">
                        <i style="color: #c09f77;" class="fas fa-file-pdf fa-lg"></i>
                     </a>
                  </td>
                  <td width="80" class="td-center">
                     <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-4">
                        <i style="color: #c09f77;" class="fas fa-file-pdf fa-lg"></i>
                     </a>
                  </td>
                  <td width="80" class="td-center">
                     <a href="" class="btn-etiqueta" data-cadena-id="{{$cadena->id}}">
                        <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                     </a>   
                  </td>
               </tr>
            @empty         
               <tr>
                  <td colspan="9">
                     <blockquote class="yellow lighten-2">
                        No se encontraron coincidencias con "{{$buscar_texto}}"
                     </blockquote>
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



   <!--Modal Rechazo-->
   <div id="nota" class="modal">
      <div class="modal-content">
         <h5>Nota</h5>
         <div class="row">
            <form class="col s12" id="form-nota">
               <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
               <input type="hidden" id="id_cadena_modal" name="id_cadena" value="">
               <div class="row">
                 <div class="input-field col s12">
                   <textarea id="nota-mensaje" name="nota" class="materialize-textarea"></textarea>
                   <label for="textarea1"></label>
                 </div>
               </div>
               <div class="row">
                  <div class="col s1 offset-s11">                     
                     <a class="right-align" id="btn-nota" href=""><i class="fa fa-paper-plane" aria-hidden="true"></i></a> 
                  </div>                  
               </div>
            </form>
         </div>
      </div>
      <!--
      <div class="modal-footer">
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
      </div>
      -->
   </div>


   <!--Modal Validar-->
   <div id="modal-validar" class="modal">
      <div class="modal-content">
         <h5>Validar cadena</h5>
         <div class="row">
            <form class="col s12" id="form-validar" autocomplete="off">
               <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
               <input type="hidden" id="id_modal_validar" name="id_cadena" value="">
               <div class="row">
                 <div class="input-field col s12">
                   <input id="folio" type="text" class="validate" name="folio">
                  <label for="folio">Folio Interno Bodega</label>
                 </div>
               </div>
               <div class="row">
                  <div class="col s1 offset-s11">                     
                     <a class="right-align" id="btn-validar" href=""><i class="fa fa-check icon-check" aria-hidden="true"></i></a> 
                  </div>                  
               </div>
            </form>
         </div>
      </div>
      <!--
      <div class="modal-footer">
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
      </div>
      -->
   </div>

<!-- Modal Anexos -->
@include('modal.modal_anexos')

<!--modal etiqueta-->
@include('modal.modal_etiqueta')

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-revisar').addClass('active').css({'font-weight':'bold'});
   </script>

   <script src="{{asset('js/modal/modal.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/cadenas/anexos_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script>

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
