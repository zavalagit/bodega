<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','3. DATOS DE LA PERSONA DESAPARECIDA (PARENTESCO: RELCIÓN DE PARENTESCO DEL DONADOR CON RESPECTO A LA PERSONA DESAPARECIDA) ~ ')
      @slot('icono','fas fa-edit')
   @endcomponent

   @if( in_array($accion,['registrar','editar','clonar']) )
      <div class="col s12">
         @component('componentes.componente_nota')
            Debe indicar el <strong><em>parentesco relacionado</em></strong> entre el <strong><em>donador</em></strong> y la <strong><em>persona desaparecida</em></strong>.
         @endcomponent
         @component('componentes.componente_nota')
            Puede indicar los <strong><em>objetos donados</em></strong> necesarios dando clic en el botón <q><strong>añadir objeto</strong></q>.
         @endcomponent
		 {{--
         @component('componentes.componente_nota')
            Debe indicar al menos la <strong><em>fecha de nacimiento</em></strong> o la <strong><em>edad</em></strong>, puede ser ambos.
         @endcomponent
		 --}}
         <hr class="hr-1">
      </div>       
   @endif

   <!--btn añadir parentesco-->
   @if ( in_array($accion, ['registrar','clonar']) || ($accion == 'editar' && $colectivo->colectivo_estado == 'revision') )
   <div class="col s12 m12 l12">
      <a href="" style="color: #152f4a; display: block;" class="right-align" id="colectivo-parentesco-agregar" data-accion="{{$accion}}"><i class="fas fa-plus-circle fa-2x" style="color: #c09f77;"></i><b><span style="vertical-align: super !important"> - AÑADIR PARENTESCO</span></b></a>
   </div>
   <!--hr-->
   <div class="col s12">
      <hr class="hr-1">
   </div>
   @endif
</div>

@if ($accion == 'registrar')
   @include('colectivo.colectivo_form_parentesco')
@elseif( in_array($accion,['editar','clonar','validar','entregar']) )
   @foreach ($colectivo->parentescos->values() as $i => $parentesco)
      @include('colectivo.colectivo_form_parentesco')
   @endforeach
@endif
<div class="row">
   <div class="col s12">
      <hr class="hr-3">
   </div>
</div>