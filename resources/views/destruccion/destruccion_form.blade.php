@extends('plantilla.template_sin_menu2')

@section('titulo')
   LISTDEPUR {{$cadena->folio_bodega}}
@endsection


@section('css')
<link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('/css/block.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/hr.css')}}">

<style>
  
/* 
   .row-no-margin{
      margin-bottom: 0 !important;
   }

 */
 .ocultar{
    display: none;
 }

</style>

<script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
@endsection

@section('seccion')
    LISTADO DEPURACION CON FOLIO {{$cadena->folio_bodega}}
@endsection

@section('contenido')

   <form id="form-depuracion" action=" {{ ($formAccion == 'editar') ? "/destruccion-save/$formAccion/$cadena->id/$baja->id" : "/destruccion-save/$formAccion/$cadena->id" }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="depuracion_accion" value="{{$formAccion}}">

      @include('destruccion.form_select_indicios3')
      @include('destruccion.depuracion_form_depuracion_parcial')
      @include('destruccion.depuracion_form_datos_generales')
      {{--@include('baja.baja_form_entrega')
      @include('baja.baja_form_recibe') --}}

      <div class="row">
         <div class="col s12">
            <hr class="hr-main">
         </div>
      </div>
      

      <div class="row">
         <!--Boton realizar el registro-->
         <div class="col s12 l2 offset-l10 scale-transition">
            <button class="btn-guardar" id="btn-depuracion" style="display: inline-block !important; width:100%;" type="submit" >
               Realizar
            </button>
         </div>
         <!--Boton pdf-->
         <div class="col s12 l1 offset-l11 center-align scale-transition scale-out">
            <a class="a-btn" id="btn-depuracion-pdf" style="display: inline-block !important; width:100%;" href="" target="_blank">
               <span>PDF</span> <i class="fas fa-file-pdf"></i>
            </a>
         </div>                       
      </div>
   
      <br><br>
   </form>




<!--Modal Servidor Público-->
{{-- <div id="modal-peritos" class="modal">
   <div class="row">
      <div id="modal-header" class="col s12 modal-peritos-header">
         <p class="header-titulo">Servidor público recibe</p >
      </div>
   </div>
   <div id="modal-body" class="row modal-peritos-body"> --}}
       <!--body-->
   {{-- </div>
   <div id="modal-footer" class="modal-peritos-footer"> --}}
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   {{-- </div>
</div> --}}
@endsection

@section('js')
   {{-- <script src="{{asset('js/depuracion/depuracion_form.js')}}" charset="utf-8"></script> --}}
   <script src="{{asset('js/baja/baja_recibe.js')}}"></script>
   <script src="{{asset('js/indicio/indicios_select_todo.js')}}"></script>
   <script src="{{asset('js/depuracion/depuracion_tipo.js')}}"></script>
   <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
   <script src="{{asset('js/modelo/input_autocomplete.js')}}"></script>
   
   <script>
		function regiones(){
			return {
				option_value:0,
				mostrar:false,
				mostrar_select_regiones(){
					console.log(this.option_value);
					this.mostrar = this.option_value == 1 ? true : false; 
				},
			}
		}
	</script>
   
@endsection
