<div id="panel-uno" class="carousel-item panel" href="#one!">
   <div class="row" style="margin-top: 10px !important">
      <!--previo-->
      <div class="col s12 left-align {{!$previo ? 'ocultar' : ''}}" style="padding-left: 40px !important;">
         <a href="" class="atras"><i class="fas fa-chevron-circle-left fa-lg"></i> <span style="color: #152f4a; font-weight:bold;">Previo</span></a>
      </div>
      <!--siguiente-->
      <div class="col s12 right-align {{!$siguiente ? 'ocultar' : ''}}" style="padding-right: 40px !important;">
         <a href="" class="adelante"><span style="color: #152f4a; font-weight:bold;">Siguiente</span> <i class="fas fa-chevron-circle-right fa-lg"></i></a>
      </div>

      <div class="col s12">
         <hr class="hr-main" style="margin: 10px 0;">
      </div>

      {{ $slot }}      

   </div>
</div>