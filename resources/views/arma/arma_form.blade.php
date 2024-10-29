@if ($formAccion == 'registrar')
   @php $plantilla = 'plantilla.template' @endphp
@else
   @php $plantilla = 'plantilla.template_sin_menu'; @endphp
@endif

@extends($plantilla)

{{--item menu selected--}}
,'vista-arma-registrar')
@section('nombre_submenu','submenu-armas')

@section('seccion',"Toma de muestras a colectivos ($formAccion)")

@section('css')
   <link rel="stylesheet" href="{{asset('css/hr.css')}}">
   <link rel="stylesheet" href="{{asset('css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
<style>

</style>
@endsection

@section('contenido')
   <section>
      <div class="row" style="margin: 0 !important;">
         <div class="col s12">
            <p class="right-align">
               <i class="fas fa-asterisk" style="color: tomato;"></i> <b>Campos obligatorios</b> <br><br>
            </p>
         </div>
         <div class="col s12">
            <hr class="hr-3">
         </div>
      </div>   
   </section> 
   

         <form id="form-arma" action="/arma-save/{{$formAccion}}/cadena/{{$cadena->id}}" method="POST">
            {{ csrf_field() }}
            {{-- <input type="hidden" name="arma_accion" value="{{$formAccion}}"> --}}
           
            <section id="seccion-formulario-armas">
               <div class="row">
                  @component('componentes.componente_seccion_titulo')
                     @slot('mensaje','1. DATOS EXTENDIDOS DE LOS INDICIOS DE ARMA DE FUEGO ~ ')
                     @slot('icono','fas fa-edit')
                  @endcomponent
               </div>
               <div class="row">
                  <div class="col s12">
                     N.U.C.: {{$cadena->nuc}}
                  </div>
               </div>

               <div class="row">
                  @if ($modelo == 'cadena')
                     @foreach ($cadena->indicios->where('indicio_is_arma',true) as $indicio)
                        @php $arma = $indicio->arma; @endphp
                        @include('arma.arma_form_1_datos')  

                        @if (!$loop->last)
                           <div class="col s12">
                              <hr class="hr-1">
                           </div>
                        @endif
                     @endforeach
                  @endif
               </div>
            </section>
           
            <div class="row">
               <div class="col s12">
                  <hr class="hr-4">
               </div>
            </div>

            <div class="row">
               <div class="input-field col s12 m12 l2 offset-l10">
                  <button type="submit" id="btn-arma" class="btn-guardar">{{$formAccion}}</button>
               </div>
            </div>
            
         </form>

@endsection

@section('js')
   <script src="{{asset('js/arma/arma_form.js')}}"></script>
   {{-- <script src="{{asset('js/colectivo/colectivo_form_pruebas.js')}}"></script> --}}
   {{-- <script src="{{asset('js/colectivo/colectivo_parentesco.js')}}"></script> --}}
   {{-- <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script> --}}
@endsection