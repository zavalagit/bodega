<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','5. DOCUMENTO EMITIDO ~ ')
      @slot('icono','far fa-file-alt')
   @endcomponent

   <div class="col s12">
      <p style="font-size: 20px; padding-left: 10px;"><b>{{($accion == 'validar') ? 'Documento a emitir:' : 'Documento emitido:'}}  <span style="color: green; text-decoration-line:underline;">Caravana</span></b></p>
   </div>

   <div class="col s12">
      <hr class="hr-3">
   </div>
</div>