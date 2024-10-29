@extends('bodega.plantilla')


@section('seccion', 'LISTADO DE CADENAS')

@section('css')
<link rel="stylesheet" href="{{asset('/css/block.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/hr.css')}}">

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



  


<form action="{{ url('/bodega/listado-oficio') }}" method="GET" target="_blank" autocomplete="off">

   <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>TIPO</b> </h6>
         </blockquote>
      </div>
      <div class="col s12 m6 l6">
         <p>
           <input type="radio" id="listado-cadenas" name="oficio-tipo" value="listado_cadenas" checked="checked"/>
           <label for="listado-cadenas"> <b>Listado de Cadenas</b> </label>
         </p>
      </div>
      <div class=" col s12 m6 l6">
         <p>
           <input type="radio" id="copia-cadenas" name="oficio_tipo" value="copia_cadenas"/>
           <label for="copia-cadenas"> <b>Copia de Cadenas</b> </label>
         </p>
      </div>
   </div>
   
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
            <a href="" id="add-nuc" class="i-btn"><i class="fa fa-plus-circle fa-lg"></i> <span> <b>- AGREGAR</b> </span></a>
         </div>
      </div>
      <div id="div-row-nucs" class="row">
         <div class="input-field col s3">
            <a href="" class="nuc-x"><i class="fas fa-times i-btn i-x"></i></a>
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
   </div>

   <section class="texto-section">
      <div class="row">
         <div class="col s12">
            <blockquote>
               <h6> <b>Puede agregar una palabra o enunciado que quiera buscar en la "descripción" de los indicios/evidencias</b> </h6>
            </blockquote>
         </div>
      </div>
      <div class="row" style="">
         <div class="col s12">
            <a href="" id="add-buscar-texto" class="i-btn"><i class="fas fa-plus-circle fa-lg"></i> <span> <b>- AGREGAR</b> </span></a>
         </div>
      </div>
      <div id="div-row-textos" class="row">
         <div class="input-field col s12">
            <a href="" class="texto-x"><i class="fas fa-times i-btn i-x"></i></a>
            <input type="text" id="buscar-texto" placeholder="Algun texto... ejemplo: 38 super" name="buscar_texto[]">
         </div>
      </div>
   </section>

   <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>Estado del indicio / evidencia</b> </h6>
         </blockquote>
      </div>
      <div class="col s12 m12 l4">
         <p>
           <input type="checkbox" id="indicio-activo" name="indicio_estado[]" value="activo" checked="checked"/>
           <label for="indicio-activo"> <b>Activo</b> </label>
         </p>
      </div>
      <div class=" col s12 m12 l4">
         <p>
           <input type="checkbox" id="indicio-prestamo" name="indicio_estado[]" value="prestamo"/>
           <label for="indicio-prestamo"> <b>Prestamo</b> </label>
         </p>
      </div>
      <div class=" col s12 m12 l4">
         <p>
           <input type="checkbox" id="indicio-baja" name="indicio_estado[]" value="baja"/>
           <label for="indicio-baja"> <b>Baja</b> </label>
         </p>
      </div>
   </div>
   

   {{-- <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>Campos que puede añadir en el listado</b> </h6>
         </blockquote>
      </div>
      <div class=" col s12">
         <p>
           <input type="checkbox" id="folio" name="folio"/>
           <label for="folio">Folio</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="checkbox" id="sp_entrega" name="sp_entrega"/>
           <label for="sp_entrega">Servidor Público entrega Cadena</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="checkbox" id="indicio_estado" name="indicio_estado"/>
           <label for="indicio_estado">Estado del indicio (activo, prestamo, baja)</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="checkbox" id="indicio-resguardo" name="indicio_resguardo"/>
           <label for="indicio-resguardo">Resguardo del indicio</label>
         </p>
      </div>
   </div> --}}
   
   
   {{-- <div class="row">
      <div class="col s12">
         <blockquote>
            <h6> <b>Tipo de listado</b> </h6>
         </blockquote>
      </div>
      <div class="col s12">
         <p>
           <input type="radio" id="listado-folio" name="listado_tipo" value="listado_folio"/>
           <label for="listado-folio">FOLIOS (Solo se visualiza el folio de cadena)</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="radio" id="listado-cadena" name="listado_tipo" value="listado_cadena" checked="checked"/>
           <label for="listado-cadena">Listado por Cadena</label>
         </p>
      </div>
      <div class=" col s12">
         <p>
           <input type="radio" id="listado-indicio" disabled="disabled" name="listado_tipo" value="listado_indicio"/>
           <label for="listado-indicio">Listado por Indicio</label>
         </p>
      </div>
   </div> --}}
   

         <div class="row">
            <div class="col s12">
               <hr class="hr-main">

            </div>
         </div>

         <div class="row">
            <div class="col offset-l10 s12 m4 l2">
               <button class="btn-guardar" type="submit">
                     Consultar
                  </button>
            </div>
         </div>
      
   
</form>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-prestamos').addClass('active').css({'font-weight':'bold'});
   </script>
   <script src="{{asset('js/listado_cadenas.js')}}" type="text/javascript"></script>
@endsection
