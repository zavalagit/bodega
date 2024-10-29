<div class="row">
    <div class="s12 acciones-enlace">
       <a href="" target="_blank" style="font-size: 30px" class="link-editar-ingreso">
          <i class="fas fa-pen-square fa-lg"></i> <span>EDITAR</span>
       </a>
    </div>
    <div class="s12 acciones-enlace">
       <a href="" target="_blank" style="font-size: 30px" class="link-historial">
          <i class="fas fa-clock fa-lg"></i> <span>RECORDATORIO</span>
       </a>
    </div>
    <div class="s12 acciones-enlace">
       <a href="" target="_blank" style="font-size: 30px" class="link-prestamo">
          <i class="fas fa-arrow-circle-left fa-lg"></i> <span>ENTREGAS</span>
       </a>
    </div>
    
     
    
    {{-- @if (Auth::user()->tipo == 'administrador')
       <div class="col s4 acciones-enlace">
          <a href="" class="btn-cadena-editar" style="font-size: 14px" data-cadena-id="{{$depuracion->id}}">
             <i class="{{ ($depuracion->estado == 'pendiente') ? 'fas fa-thumbs-down fa-lg' : 'fas fa-thumbs-up fa-lg' }}"></i> <span> {{ ($depuracion->estado == 'pendiente') ? 'Inhabilirar': 'Habilitar' }}</span>
          </a>
       </div>
       
       <div class="col s4 acciones-enlace">
          <a href="" class="btn-cadena-reset" style="font-size: 14px" data-cadena-id="{{$depuracion->id}}">
             <i class="fas fa-backspace"></i> <span>Restaurar</span>
          </a>
       </div>
    @endif --}}
 </div>