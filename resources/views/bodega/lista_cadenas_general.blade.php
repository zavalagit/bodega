@extends('bodega.plantilla')

@section('css')
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
  </style>
@endsection

@section('contenido')

  <div class="seccion-pagina amber" >
     <h5 class="center-align">
        <b>LISTADO DE CADENAS GENERAL</b>
     </h5>
  </div>


  


<form action="{{ url('/bodega/lista-cadenas-archivo') }}" method="GET" target="_blank" autocomplete="off">
   
   <div class="row">
      <div class="input-field col s6">
         <select id="select-fiscalia" multiple name="fiscalias[]">
            <option id="option-fiscalias" value="0" selected>TODAS</option>
            @foreach ($fiscalias as $fiscalia)
               <option class="option-fiscalia" disabled value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
            @endforeach
         </select>
         <label>Selecciona la(s) Fiscalia(s)</label>
      </div>
      <div class="input-field col s6">
         <select id="select-naturaleza" multiple name="naturalezas[]">
            <option id="option-naturaleza" value="0" selected>TODAS</option>
            @foreach ($naturalezas as $naturaleza)
               <option class="option-naturaleza" disabled value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
            @endforeach
         </select>
         <label>Selecciona la(s) Naturaleza(s)</label>
      </div>
      <div class=" col s4">
         <p>
           <input type="checkbox" id="folio" name="folio"/>
           <label for="folio">Folio</label>
         </p>
      </div>
      <div class=" col s4">
         <p>
           <input type="checkbox" id="sp_entrega" name="sp_entrega"/>
           <label for="sp_entrega">Servidor Público entrega Cadena</label>
         </p>
      </div>
      <div class=" col s4">
         <p>
           <input type="checkbox" id="indicio_estado" name="indicio_estado"/>
           <label for="indicio_estado">Estado del indicio (activo, prestamo, baja)</label>
         </p>
      </div>
  </div>

{{--
   <section class="nuc-section">
      <div class="row nuc-div">
         <div class="row" style="margin-top:60px;">
            <div class="col s12">
               <a href="" id="add-nuc"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
               <span>Agregar N.U.C., Carpeta de Investigación, otro.</span>
            </div>
         </div>
         <div class="input-field col s1">
            <a href="" class="nuc-x"><i class="fas fa-times"></i></a>
         </div>
         <div class="input-field col s6">
            <input id="nuc" type="text" placeholder="N.U.C, CARPETA DE INVESTIGACIÓN, CAUSA PENAL" class="validate" name="nuc[]">
         </div>
      </div>
   </section>
--}}

   <div class="row">
      <div class="col s3 offset-s6">
         <button class="btn waves-effect waves-light" type="submit" name="btn_archivo" value="pdf">
            pdf
         </button>
      </div>
      <div class="col s3 offset-s6">
         <button class="btn waves-effect waves-light" type="submit" name="btn_archivo" value="excel">
            excel
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
