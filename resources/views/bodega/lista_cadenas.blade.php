@extends('plantilla.template')

{{-- nombre vista --}}
@section('nombre_pagina','vista-listado-cadenas')
@section('nombre_submenu','submenu-reportes')

@section('seccion', 'LISTADO DE CADENAS')

@section('css')
<link rel="stylesheet" href="{{asset('/css/block.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">

  <style media="screen">
    .seccion-pagina{
      margin:0 !important;
      padding: 0 !important;
    }
    .seccion-pagina h5{
      padding: 0 !important;
      margin: 0 !important;
      color:#112046;
    }


    .btn{
      background-color: rgba(255,255,255,0);
      padding: 0;
    }
    .btn:hover{
      background-color: rgba(255,255,255,0) !important;
    }
    .row{
       margin-bottom: 0 !important;
    }
  </style>
@endsection


@section('contenido')



  


<form action="{{ url('/bodega/lista-cadenas-pdf') }}" method="GET" target="_blank" autocomplete="off">
   <section class="nuc-section">
      <div class="row">
         <div class="col s12">
            <blockquote>
               <h6> <b>N.U.C.</b> </h6>
            </blockquote>
         </div>
      </div>
      <div class="row" style="">
         <div class="col s12">
            <a href="" id="add-nuc" class="i-btn"><i class="fa fa-plus-circle fa-lg"></i><span> <b>- AGREGAR CAMPO</b> </span></a>
         </div>
      </div>
      <div id="div-row-nucs" class="row">
         <div class="input-field col s3">
            <a href="" class="nuc-x"><i class="fas fa-times i-x"></i></a>
            <input id="nuc" type="text" placeholder="N.U.C." class="validate" name="nucs[]">
         </div>
      </div>
   </section>

   <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>Filtros</b> </h6>
         </blockquote>
      </div>
      @if (Auth::user()->fiscalia_id == 4)
         <div class="input-field col s3">
            <select id="select-fiscalia" multiple name="buscar_fiscalias[]">
               <option id="option-fiscalias" value="0" selected>TODAS</option>
               @foreach ($fiscalias as $fiscalia)
                  <option class="option-fiscalia" disabled value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
               @endforeach
            </select>
            <label>Selecciona la(s) Fiscalia(s)</label>
         </div>
      @endif

      @if (Auth::user()->fiscalia_id == 4)
         <div class="input-field col s3">  
      @else
         <div class="input-field col s6">  
      @endif
         <select id="select-naturaleza" multiple required name="buscar_naturalezas[]">
            <option id="option-naturaleza" value="0" selected>TODAS</option>
            @foreach ($naturalezas as $naturaleza)
               <option class="option-naturaleza" disabled value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
            @endforeach
         </select>
         <label>Selecciona la(s) Naturaleza(s)</label>
      </div>

      <div class="input-field col s3">
         @isset($buscar_fecha_inicio)
            <input id="fecha-inicio" type="date" name="buscar_fecha_inicio" value="{{$buscar_fecha_inicio}}">
         @endisset
         @empty($buscar_fecha_inicio)
            <input id="fecha-inicio" type="date" name="buscar_fecha_inicio">
         @endempty
         <label class="active" for="fecha-inicio">FECHA INICIO</label>
      </div>
      
      <div class="input-field col s3">
         @isset($buscar_fecha_fin)
            <input id="fecha-fin" type="date" name="buscar_fecha_fin" value="{{$buscar_fecha_fin}}">
         @endisset
         @empty($buscar_fecha_fin)
            <input id="fecha-fin" type="date" name="buscar_fecha_fin">
         @endempty
         <label class="active" for="fecha-fin">FECHA FIN</label>
      </div>

      


      {{-- <div class="input-field col s12" id="input-buscar">
         @isset($buscar_texto)
            <input type="text" id="buscar-texto" name="buscar_texto[]" value="{{$buscar_texto}}">
         @endisset
         @empty($buscar_texto)
            <input type="text" id="buscar-texto" placeholder="Algun texto... ejemplo: 38 super" name="buscar_texto">
         @endempty
      </div> --}}
   </div>

   <section class="texto-section">
      <div class="row">
         <div class="col s12">
            <blockquote>
               <h6> <b>Puede agregar una palabra o enunciado que quiera buscar dentro de la "descripción" de los indicios/evidencias</b> </h6>
            </blockquote>
         </div>
      </div>
      <div class="row" style="">
         <div class="col s12">
            <a href="" id="add-buscar-texto" class="i-btn"><i class="fa fa-plus-circle fa-lg"></i><span> <b>- AGREGAR CAMPO</b> </span></a>
         </div>
      </div>
      <div id="div-row-textos" class="row">
         <div class="input-field col s12">
            <a href="" class="texto-x"><i class="fas fa-times i-x"></i></a>
            <input type="text" id="buscar-texto" placeholder="Algun texto... ejemplo: 38 super" name="buscar_texto[]">
         </div>
      </div>
   </section>

   <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>Tipo de listado</b> </h6>
         </blockquote>
      </div>
      <div class="col s12">
         <p>
           <input type="radio" id="listado-oficio" name="listado_tipo" value="listado_oficio" checked="checked"/>
           <label for="listado-oficio">Listado o copias de Cadenas mediante Oficio</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="radio" id="listado-general" name="listado_tipo" value="listado_general"/>
           <label for="listado-general">Listado general</label>
         </p>
      </div>
      <div class="col s12">
         <p>
           <input type="radio" id="listado-folio" name="listado_tipo" value="listado_folio"/>
           <label for="listado-folio">Listado de folios (Solo se visualiza el folio interno de Bodega)</label>
         </p>
      </div>
      {{-- <div class=" col s12">
         <p>
           <input type="radio" id="listado-cadena" name="listado_tipo" value="listado_cadena" checked="checked"/>
           <label for="listado-cadena">Listado por Cadena</label>
         </p>
      </div> --}}
   </div>

   <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>Estado del indicio / evidencia</b> </h6>
         </blockquote>
      </div>
      <div class="col s12 m12 l4">
         <p>
           <input type="checkbox" id="indicio-activo" class="filled-in listado-indicio-estado" name="indicio_estado[]" value="activo" checked="checked"/>
           <label for="indicio-activo"> <b>Activo</b> </label>
         </p>
      </div>
      <div class=" col s12 m12 l4">
         <p>
           <input type="checkbox" id="indicio-prestamo" class="filled-in listado-indicio-estado" name="indicio_estado[]" value="prestamo"/>
           <label for="indicio-prestamo"> <b>Prestamo</b> </label>
         </p>
      </div>
      <div class=" col s12 m12 l4">
         <p>
           <input type="checkbox" id="indicio-baja" class="filled-in listado-indicio-estado" name="indicio_estado[]" value="baja"/>
           <label for="indicio-baja"> <b>Baja</b> </label>
         </p>
      </div>
   </div>

   <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>Campos que pueden figurar en el listado</b> </h6>
         </blockquote>
      </div>
      <div class=" col s12">
         <p>
           <input type="checkbox" id="campo-folio" class="filled-in listado-campo" name="campo_folio"/>
           <label for="campo-folio">Folio interno de la Bodega</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="checkbox" id="campo-sp-entrega" class="filled-in listado-campo" name="campo_sp_entrega"/>
           <label for="campo-sp-entrega">Servidor Público ingresa Cadena</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="checkbox" id="campo-indicio-estado" class="filled-in listado-campo" name="campo_indicio_estado"/>
           <label for="campo-indicio-estado">Estado del indicio/evidencia (activo, prestamo, baja)</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="checkbox" id="campo-indicio-resguardo" class="filled-in listado-campo" name="campo_indicio_resguardo"/>
           <label for="campo-indicio-resguardo">Resguardo del indicio/evidencia (¿En dónde se encuentra? ¿Quién lo tiene?)</label>
         </p>
      </div>
   </div>

   <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>Tipo de archivo</b> </h6>
         </blockquote>
      </div>
      <div class=" col s3">
         <p>
           <input type="radio" id="listado-pdf" class="listado-archivo" name="listado_archivo" value="listado_pdf" checked="checked"/>
           <label for="listado-pdf"><i style="color: red;" class="fas fa-file-pdf"></i> PDF</label>
         </p>
      </div>
      <div class="col s3">
         <p>
           <input type="radio" id="listado-excel" class="listado-archivo" name="listado_archivo" value="listado_excel"/>
           <label for="listado-excel"><i style="color: green;" class="fas fa-file-excel"></i> Excel</label>
         </p>
      </div>
   </div>
   
   

   <div class="row">
      <div class="col s12">
         <hr class="hr-main">
      </div>
   </div>
   
   {{-- <div class="row">
      <div class="col s1 offset-s10">
         <button class="btn-guardar-i" name="btn_listado" value="pdf"><i class="fas fa-file-pdf fa-lg i-pdf i-btn"></i></button>
      </div>
      <div class="col s1">
         <button class="btn-guardar-i" name="btn_listado" value="excel"><i class="fas fa-file-excel fa-lg i-excel i-btn"></i></button>
      </div>
   </div> --}}

   <div class="row">
      <div class="col s2 offset-s10">
         <button class="btn-guardar" name="btn_listado" value="oficio">consultar</button>
      </div>
   </div>
      
   <br>
   <br>
   <br>   
   
</form>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-prestamos').addClass('active').css({'font-weight':'bold'});
   </script>
   <script src="{{asset('js/listado_cadenas.js')}}" type="text/javascript"></script>
   {{-- <script src="{{asset('js/listado/listado_oficio.js')}}" type="text/javascript"></script> --}}
@endsection
