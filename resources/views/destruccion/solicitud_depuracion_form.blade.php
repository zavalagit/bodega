@extends('plantilla.template_sin_menu2')

@section('titulo')
   FORMULARIO
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
    FORMULARIO DE SOLICITUD DEPURACION
@endsection

@section('contenido')

   <form id="form-solicitud" action=" {{ ($formAccion == 'editar') ? "/soldepuracion-save/$formAccion/$solicitud->id" : "/soldepuracion-save/$formAccion" }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="solicitud_accion" value="{{$formAccion}}">

      
      @include('destruccion.solicitud_depuracion_form_datos_generales')
      

      <div class="row">
         <div class="col s12">
            <hr class="hr-main">
         </div>
      </div>
      

      <div class="row">
         
         <!--Boton volver atras-->
         <div class="col s12 l2 scale-transition">
            <a href="/listado-soldepuracion"><button class="btn-guardar" id="btn-volver" style="display: inline-block !important; width:100%;" name="btn_volver" value="volver" type="button">
               VOLVER
            </button></a>
         </div>

         <!--Boton realizar el registro-->
         <div class="col s12 l2 offset-l8 scale-transition">
            <button class="btn-guardar" id="btn-depuracion" style="display: inline-block !important; width:100%;" type="submit" >
               Realizar
            </button>
         </div>
         <!--Boton Terminar-->
         <div class="col s12 l2 offset-l10 center-align scale-transition scale-out">
            <a class="a-btn" id="btn-depuracion-terminar" style="display: inline-block !important; width:100%;" href="/listado-soldepuracion">
               <span>TERMINAR</span> <i class="fas fa-reply-all"></i>
            </a>
         </div>                       
      </div>
   
      <br><br>
   </form>


@endsection

@section('js')
   <script src="{{asset('js/depuracion/solicitud_form.js')}}" charset="utf-8"></script>
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
