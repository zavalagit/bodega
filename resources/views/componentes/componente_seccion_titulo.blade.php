{{-- 
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','3. DATOS DE LA PERSONA DESAPARECIDA (PARENTESCO: RELCIÓN DE PARENTESCO DEL DONADOR CON RESPECTO A LA PERSONA DESAPARECIDA)')
      @slot('icono','fas fa-edit')
   @endcomponent
--}}

<div class="col s12"">
   <p style="text-align: justify; margin-bottom: 25px;">
      <span style="border: 3px solid #152f4a; border-left: 10px solid #152f4a; padding: 5px; background-color: rgba(192,159,119,0.7); color:#152f4a;">
         <b>{{ $mensaje }}</b> <i class="{{ $icono }}"></i>
      </span>
   </p>
</div>