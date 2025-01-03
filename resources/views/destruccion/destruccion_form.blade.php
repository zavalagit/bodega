@extends('plantilla.template_sin_menu2')

@section('titulo')
   FORMULARIO
@endsection

@section('css')
   <link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
   <link rel="stylesheet" href="{{asset('/css/block.css')}}">
   <link rel="stylesheet" href="{{asset('/css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('/css/hr.css')}}">
   <link rel="stylesheet" href="{{asset('/css/colores.css')}}">

   <style>
      .ocultar{
         display: none !important;
      }
   </style>

@endsection

@section('seccion')
    REGISTRAR PARA LISTADO DESTRUCCION {{$cadena->folio_bodega}}
@endsection

@section('contenido')
<section>
   <div class="row" style="margin-bottom:0; line-height: 0 !important">
      <div class="col s12 m12 l12">
         @include('include.include_form_campo_obligatorio_asterisco')          
      </div>
   </div>    
   <div class="row">
      <div class="col s12 m12 l12">
         <hr class="hr-4">
      </div>
   </div>        
</section>

   <div class="row">
      <form id="form-prestamo" autocomplete="off" action="{{route('prestamo_save',['formAccion'=>$formAccion])}}" method="POST">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
         {{-- <input type="hidden" name="id_cadena" value="{{$cadena->id}}"> --}}
         <input type="hidden" id="prestamo-tipo" name="prestamo_unico" value="prestamo_unico" data-prestamo-tipo="prestamo-unico">
         {{-- <input type="hidden" id="prestamo-etapa" name="prestamo_etapa" value="prestamo"> --}}

         <div class="col s12">
            <table>
               {{-- @if ($cadena->indicios->count() > 3)
                  <thead>
                     <tr>
                        <th width="6%" class="th-center">
                           <label for="select-indicios">
                              <input class="filled-in" type="checkbox" id="select-indicios" data-cantidad-identificadores="{{$cadena->indicios->count()}}" data-num="{{$cadena->indicios->sum('numero_indicios')}}" name=""/>
                              <span></span>
                           </label>
                        </th>
                        <th colspan="4"><b>SELECCIONA TODOS LOS INDICIO/EVIDENCIAS</b></th>
                     </tr>
                  </thead>
               @endif --}}
               <thead>
                  <tr>
                     <th class="th-center">SELECCIONAR</th>
                     <th>ESTADO</th>
                     <th>IDENTIFICADOR</th>
                     <th>DESCRIPCIÓN</th>
                     <th class="th-center">NO. INDICIOS</th>
                     {{-- <th>ESTADO</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach($cadena->indicios as $key => $indicio)
                        @php $rowspan = isset($indicio->indicio_descripcion_disponible) ? 2 : 1; @endphp
                     <tr>
                        <td rowspan="{{$rowspan}}" width="6%" class="td-center">
                           <label for="indicio-{{$indicio->id}}">
                              <input type="checkbox"
                                 id="indicio-{{$indicio->id}}"
                                 class="indicio-checkbox filled-in"
                                 data-num="{{$indicio->numero_indicios}}"
                                 name="indicios[]" value={{$indicio->id}}
                                 {{in_array($indicio->list_destru,[1]) ? 'disabled' : ''}}
                              />
                              <span></span>
                           </label>
                        </td>
                        <!--indicio_estado-->
                        <td rowspan="{{$rowspan}}"> @include('indicio.indicio_estado') </td>
                        <!--identificador-->
                        <td rowspan="{{$rowspan}}" width="10%">{{$indicio->identificador}}</td>
                        <!--descripcion-->
                        <td>
                           {{$indicio->descripcion}}
                           {{-- @isset ($indicio->indicio_descripcion_disponible)
                              <hr> 
                              <span style="color: green;"><b>Disponible:</b></span>
                              <span>{{$indicio->indicio_descripcion_disponible}}</span>
                           @endisset --}}
                        </td>
                        <td width="6%" class="td-center">
                           {{$indicio->numero_indicios}}
                        </td>
                     </tr>
                     @isset($indicio->indicio_descripcion_disponible)
                        <tr>
                           <td><span style="color: green;"><b>Disponible:</b></span> {{$indicio->indicio_descripcion_disponible}}</td>
                           <td class="td-center"><span style="color: green;">{{$indicio->indicio_cantidad_disponible}}</span></td>
                        </tr>                         
                     @endisset
                  @endforeach
               </tbody>
            </table>
         </div>

         <section id="section-prestamo">
            @include('prestamo.prestamo_datos')
         </section>
         

      </form>
   </div>

   
   <div class="row">
      <div class="col s12 l1 offset-l10 center-align ocultar">
         <a href="" class="a-btn" id="btn-realizar-reingreso" data-cadena-id="{{$cadena->id}}" style="display: inline-block !important; width:100%;">
            <span>R. REINGRESO</span>
         </a> <br><br>
      </div>
      <!--Boton pdf-->
      <div class="col s12 l1 center-align ocultar">
         <a class="a-btn" id="btn-prestamo-pdf" style="display: inline-block !important; width:100%;" href="" target="_blank">
            <span>PDF</span> ~ <i class="fas fa-file-pdf"></i>
         </a>
      </div>
   </div>


@endsection

@section('js')
   <script src="{{asset('js/numero_indicios.js')}}"></script>
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
   <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
   <script src="{{asset('js/modelo/input_autocomplete.js')}}"></script>
   <script src="{{asset('js/indicio/indicios_select_todo.js')}}"></script>
   <script src="{{asset('js/prestamo/prestamo_form.js')}}"></script>
@endsection
