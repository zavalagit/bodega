@if ($accion == 'registrar')
   @php $plantilla = 'plantilla.template' @endphp
@else
   @php $plantilla = 'plantilla.template_sin_menu'; @endphp
@endif

@extends($plantilla)

{{--item menu selected--}}
@section('nombre_pagina','vista-colectivo-registrar')
@section('nombre_submenu','submenu-colectivos')

@section('seccion',"Toma de muestras a colectivos ($accion)")

@section('css')
   <link rel="stylesheet" href="{{asset('css/hr.css')}}">
   <link rel="stylesheet" href="{{asset('css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">

   <style>
      .colectivo-parentesco {
         background-color: rgba(192, 159, 119, 0.3);
         margin: 0 12px;
      }

      [type="checkbox"].filled-in:disabled:checked+span:not(.lever):after {
    background-color: green;
    border-color: green;
}
   </style>
@endsection

@section('contenido')
   <section>
      <div class="row" style="margin: 0 !important; line-height: 0 !important">
         <div class="col s12 m12 l12">
            <p class="right-align">
               <i class="fas fa-asterisk" style="color: tomato;"></i> <b>Campos obligatorios</b>
            </p>
            @if ( in_array($accion,['registrar','editar','clonar']) )
               <p class="right-align">
                  <i class="fas fa-asterisk" style="color: tomato;"></i><i class="fas fa-asterisk" style="color: tomato;"></i><b>[número]</b> - <b>Indicar al menos un campo, puede ser ambos</b>
               </p>
            @endif
         </div>
         <div class="col s12">
            <hr class="hr-3">
         </div>
      </div>   
   </section> 

   {{-- <i class="fas fa-square"
                                 style="color: {{$colectivo->colectivo_estado == 'revision' ? '#ffea00;' : ''}}
                                    {{$colectivo->colectivo_estado == 'validada' ? 'orange;' : ''}}
                                    {{$colectivo->colectivo_estado == 'entregada' ? '#76ff03;' : ''}}
                                 "
                              ></i> <strong style="color: #c6c6c6;">{{ucfirst($colectivo->colectivo_estado)}}</strong> --}}
   

         <form id="form-colectivo" action="{{ route('colectivo_save',['accion'=>$accion,'colectivo' => (isset($colectivo)) ? $colectivo : null]) }}" {{--action="/colectivo-save/{{$accion}}{{ (isset($colectivo)) ? "/$colectivo->id" : '' }}"--}} method="POST">
            @php
               $acceso_elementos = in_array($accion,['validar','entregar']) || in_array($colectivo->colectivo_estado,['validada','entregada']) ? true : false;                
               $acceso_editar_registrar = $colectivo->colectivo_estado == 'revision' && date('Y-m-d') != date('Y-m-d', strtotime($colectivo->created_at)) ? true : false;
               $acceso_editar_validar = date('Y-m-d') != $colectivo->colectivo_validacion_fecha ? true : false;
               $acceso_editar_entregar = date('Y-m-d') != $colectivo->colectivo_emision_fecha ? true : false;
            @endphp

            {{ csrf_field() }}
            <input type="hidden" name="colectivo_accion" value="{{$accion}}">
            <!--section ~ datos generales-->
            <section>
               @include('colectivo.colectivo_form_1_datos_generales')
            </section>
            <!--section ~ datos muestreo-->
            <section>
               @include('colectivo.colectivo_form_2_datos_muestreo')
            </section>
            <!--section ~ datos parentesco-->
            <section id="seccion-colectivo-parentesco">
               @include('colectivo.colectivo_form_3_datos_parentesco')
            </section>
            <!--section ~ datos pruebas-->
            <section>
               @include('colectivo.colectivo_form_4_datos_pruebas')
            </section>

            @if( in_array(Auth::user()->tipo,['coordinador_colectivos','admin_colectivos']) ) 
               <!--section ~ documento a emitir-->
               @if ( /*accion*/$accion == 'validar' || /*estado*/in_array($colectivo->colectivo_estado,['validada','entregada']) )
                  <section>
                     @include('colectivo.colectivo_form_5_documento_emitido')
                  </section>           
                  <!--section ~ datos entrega-->
                  <section>
                     @include('colectivo.colectivo_form_6_datos_entrega')
                  </section>
               @endif
            @endif

            <div class="row">
               <div class="input-field col s12 m12 l2 offset-l10">
                  <button type="submit" id="btn-colectivo" class="btn-guardar">{{$accion}}</button>
               </div>
            </div>
            
         </form>

@endsection

@section('js')
{{-- <script src="{{asset('js/materialize/materialize_select.js')}}"></script> --}}
   <script src="{{asset('js/colectivo/colectivo_form.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_form_objeto_aportado.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_form_lugar_procedencia.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_form_pruebas.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_form_prueba_otro.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_parentesco.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_parentesco_otro.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_funciones_globales.js')}}"></script>
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
   <script src="{{asset('js/modelo/get_modelo2.js')}}"></script>
   <script src="{{asset('js/modelo/autocomplete_reset.js')}}"></script>
   
	<script>
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>
@endsection