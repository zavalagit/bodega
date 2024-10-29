<div class="row">
   <div class="col s4 acciones-enlace">
      <a href="/bodega/editar/{{$cadena->id}}" target="_blank" style="font-size: 14px" class="link-editar-ingreso">
         <i class="fas fa-pen-square fa-lg"></i> <span>Editar ingreso</span>
      </a>
   </div>
   <div class="col s4 acciones-enlace">
      <a href="/bodega/historial-cadena/{{$cadena->id}}" target="_blank" style="font-size: 14px" class="link-historial">
         <i class="fas fa-clock fa-lg"></i> <span>Historial</span>
      </a>
   </div>
   <div class="col s4 acciones-enlace">
      <a href="/bodega/prestamo-form/prestar/{{$cadena->id}}" target="_blank" style="font-size: 14px" class="link-prestamo">
         <i class="fas fa-arrow-circle-left fa-lg"></i> <span>Prestamo</span>
      </a>
   </div>
   <div class="col s4 acciones-enlace">
      <a href="/bodega/baja-form/registrar/{{$cadena->id}}" target="_blank" style="font-size: 14px" class="link-baja">
         <i class="fas fa-arrow-circle-down fa-lg"></i> <span>Baja</span>
      </a>
   </div>
   <div class="col s4 acciones-enlace">
      <a href="/ubicacion-asignar/{{$cadena->id}}" target="_blank" style="font-size: 14px" class="link-baja">
         <i class="fas fa-map-marker-alt fa-lg"></i> <span>Resguardo</span>
      </a>
   </div>
   
   
   @if (Auth::user()->tipo == 'administrador')
      <div class="col s4 acciones-enlace">
         <a href="" class="btn-cadena-editar" style="font-size: 14px" data-cadena-id="{{$cadena->id}}">
            <i class="{{ ($cadena->editar == 'si') ? 'fas fa-thumbs-down fa-lg' : 'fas fa-thumbs-up fa-lg' }}"></i> <span> {{ ($cadena->editar == 'si') ? 'Inhabilirar': 'Habilitar' }}</span>
         </a>
      </div>
      
      <div class="col s4 acciones-enlace">
         <a href="" class="btn-cadena-reset" style="font-size: 14px" data-cadena-id="{{$cadena->id}}">
            <i class="fas fa-backspace"></i> <span>Restaurar</span>
         </a>
      </div>
   @endif
</div>