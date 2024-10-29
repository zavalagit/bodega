<div class="row colectivo-parentesco" style="padding-top: 0 !important; margin-top: 10px;">
   <!--acciones-->
   @if( in_array($accion,['registrar','clonar']) || ($accion == 'editar' && $colectivo->colectivo_estado == 'revision') )
      <div class="input-field col s12" style="background-color: rgba(21, 47, 74, 8); margin-top: 0;">
         <!--eliminar parentesco-->
         <a href="" style="display: block !important; padding: 5px !important;" class="colectivo-parentesco-eliminar right-align"><i class="fas fa-times-circle fa-lg"></i></a>
      </div>       
   @endif
   <!--parentesco-->
   <div class="input-field col s12 m12 l4">
      <select class="parentesco-select" data-accion="{{$accion}}" 
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="colectivo_parentesco[]"
      >
         <option value="" selected>Selecciona el parentesco{{in_array($accion, ['validar','entregar']) ? '' : '*'}}</option>
         @foreach ($parentescos as $x => $p) <!--Le puse $p debido a que ya hay una varibale ques es $parentesco de la tabal pivote colectivo_parentesco-->
            <option value="{{$p->id}}" {{ ( isset($parentesco) && ($parentesco->id == $p->id) ) ? 'selected' : '' }}>{{$x+1}}.- {{$p->nombre}}</option>
         @endforeach
      </select>
      <label><i class="fas fa-user-friends"></i> ~ RELCIÓN DE PARENTESCO DEL DONADOR CON RESPECTO A LA PERSONA DESAPARECIDA{{in_array($accion, ['validar','entregar']) ? '' : '*'}}</label>
   </div>
   <!--persona desaparesida-->
   <div class="input-field col s12 m12 l3">
      <input type="text" id="colectivo-desaparecido-persona"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         name="ausente_nombre[]"
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         value="{{ isset($parentesco) ? $parentesco->pivot->ausente_nombre : '' }}"
      >
      <label for="colectivo-desaparecido-persona"><i class="fas fa-user"></i> ~ NOMBRE DE LA PERSONA DESAPARECIDA{{in_array($accion, ['validar','entregar']) ? '' : '*'}}</label>
   </div>
   <!--sexo-->
   <div class="input-field col s12 m12 l2">
      <select name="ausente_sexo[]"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
      >
         <option value="" selected>Indique el sexo</option>
         <option value="femenino" {{ isset($parentesco) ? ($parentesco->pivot->ausente_sexo == 'femenino' ? 'selected' : '') : '' }}>1.- Femenino</option>
         <option value="masculino" {{ isset($parentesco) ? ($parentesco->pivot->ausente_sexo == 'masculino' ? 'selected' : '') : '' }}>2.- Masculino</option>
      </select>
      <label><i class="fas fa-venus-mars"></i> ~ SEXO DE LA PERSONA DESAPARECIDA {{-- {{in_array($accion, ['validar','entregar']) ? '' : '*'}}  --}}</label>
   </div>
   <!--fecha nacimiento-->
   <div class="input-field col s12 m12 l2">
      <input type="date" id="colectivo-desaparecido-fecha-nacimiento"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="ausente_fecha_nacimiento[]" value="{{ (isset($parentesco)) ? $parentesco->pivot->ausente_fecha_nacimiento : '' }}"
      >
      <label class="active" for="colectivo-desaparecido-fecha-nacimiento"><i class="fas fa-calendar-alt"></i> ~ FECHA DE NACIMIENTO {{--** [2]--}}</label>
   </div>
   <!--edad-->
   <div class="input-field col s12 m12 l2">
      <input type="number" id="colectivo-desaparecido-edad"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="ausente_edad[]"
         value="{{ (isset($parentesco)) ? $parentesco->pivot->ausente_edad : '' }}"
      >
      <label for="colectivo-desaparecido-edad"><i class="fas fa-calendar-alt"></i> ~ EDAD {{--** [2]--}}</label>
   </div>
   <!--parentesco_otro-->
   @if ( ($accion != 'registrar') && isset($parentesco->pivot->parentesco_otro) )
      @include('colectivo.colectivo_form_parentesco_otro') 
   @endif
   <!--lugar de desaparicion-->
   <div class="input-field col s12 m12 l7">
      <input type="text" id="parentesco-lugar-desaparicion"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="ausente_lugar_desaparicion[]"
		 value="{{ (isset($parentesco)) ? $parentesco->pivot->ausente_lugar_desaparicion : '' }}"
      >
      <label for="parentesco-lugar-desaparicion"> <i class="fas fa-map-marker-alt"></i> ~ LUGAR DE DESAPARICIÓN</label>
   </div>
   <!--fecha desaparición-->
   <div class="input-field col s12 m12 l2">
      <input type="date" id="colectivo-desaparecido-fecha"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="ausente_fecha_desaparicion[]"
         value="{{ (isset($parentesco)) ? $parentesco->pivot->ausente_fecha_desaparicion : '' }}"
      >
      <label class="active" for="colectivo-desaparecido-fecha"><i class="fas fa-calendar-alt"></i> ~ FECHA DE DESAPARICIÓN</label>
   </div>
  
   <div class="col s12">
      <hr class="hr-1">
   </div>

   <!--OBJETOS-->
   <!--btn agregar objeto-->
   @if ( in_array($accion, ['registrar','clonar']) || ($accion == 'editar' && $colectivo->colectivo_estado == 'revision') )
      <div class="col s12 m12 l12 class-div-btn-objeto-agregar">
         <a href="" style="color: #152f4a; display: block;" class="btn-objeto-agregar right-align" data-accion="{{$accion}}"><i class="fas fa-plus-circle" style="color: #c09f77;"></i><b><span style=""> - AÑADIR OBJETO</span></b></a>
      </div>
   @endif

   @if ( in_array($accion,['registrar','clonar','editar']) )
      @include('colectivo.colectivo_form_objeto_aportado')
   @else
      @foreach ( explode('~', $parentesco->pivot->ausente_objeto_aportado) as $j => $objeto)
         @include('colectivo.colectivo_form_objeto_aportado')
      @endforeach
   @endif
   {{-- <div class="col s12 div-objeto-aportado">
      <div class="row">
         <!--objeto donado-->
         <div class="input-field col s12 m12 l11">
            <input type="text" id="colectivo-muestreo-objeto" class="input-objeto-aportado" {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}} name="ausente_objeto_aportado[0][0]" value="{{ isset($colectivo) ? $colectivo->ausente_objeto_aportado : '' }}">
            <label for="colectivo-muestreo-objeto"><i class="fas fa-brush"></i> ~ OBJETO APORTADO{{in_array($accion, ['validar','entregar']) ? '' : '** [1]'}}</label>
         </div>
         <!--eliminar objeto-->
         @if (!in_array($accion, ['validar','entregar']))
            <div class="input-field col s12 m12 l1 div-btn-objeto-eleminar hide">
               <a href="" class="btn-objeto-eliminar right-align" style="display: block !important; margin-top:15px;"><i class="fas fa-times-circle fa-lg"></i></a>
            </div>
         @endif
      </div>
   </div> --}}

   {{-- <div class="col s12">
      <hr class="hr-1">
   </div> --}}
</div>