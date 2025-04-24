<div class="row">
   <div class="col s11">
      <div class="input-field col s12">
         <input type="hidden" id="{{$input_hidden}}" name="user_id" value="{{ ($formAccion == 'editar') ? $baja->user_id : Auth::user()->id}}">
         <input type="text" class="autocomplete" id="{{$input_text}}"
            autocomplete="off"
            data-input-hidden="{{$input_hidden}}"
            data-tabla="users"
            data-user-tipo="{{$user_tipo}}"
            value="{{ ($formAccion == 'editar') ? "{$baja->user->folio} - {$baja->user->name}" : Auth::user()->folio." - ".Auth::user()->name}}"
         >
         <label for="autocomplete-input">Responsable de bodega registra</label>
      </div>
   </div>
   <div class="input-field col s1">
      <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="{{$input_text}}" data-input-hidden="{{$input_hidden}}">
         <i class="fas fa-times-circle fa-lg" ></i>
      </a>
   </div>
</div>