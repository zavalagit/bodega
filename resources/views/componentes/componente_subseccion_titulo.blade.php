{{-- 
   @component('componentes.componente_subseccion_titulo')
      @slot('mensaje','3. DATOS DE LA PERSONA DESAPARECIDA (PARENTESCO: RELCIÓN DE PARENTESCO DEL DONADOR CON RESPECTO A LA PERSONA DESAPARECIDA)')
   @endcomponent
--}}

<div class="col s12" style="padding-left:50px;">
   <p style="text-align: justify; margin-bottom: 25px;">
      <span style="border: 3px solid #152f4a; border-left: 10px solid #152f4a; padding: 5px; background-color: rgba(192,159,119,0.7); color:#152f4a;">
         <b>{{ $mensaje }}</b>
      </span>
   </p>
</div>
{{-- <div class="col s12" style="padding-left:50px;">
   <p style="text-align: justify; margin-bottom: 25px;">
      <span style="border-left: 7px solid #c09f77; padding: 5px; background-color: rgba(21,47,74,1); color:#fff;">
         <b>{{ $mensaje }}</b>
      </span>
   </p>
</div> --}}