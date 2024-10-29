@component('componentes.componente_modal')
   @slot('modal_nombre','modal-grupo-familiar')

   @slot('header')
      <p class="header-titulo">{{$colectivo->fiscalia->nombre}}</p>
      <p class="header-titulo"> - </p>
      <p class="header-titulo">{{$colectivo->colectivo_donante}}</p>
   @endslot

   @slot('main')
      <div class="row">
         <form id="form-grupo-familiar" class="col s12" action="{{route('colectivo_grupo_familiar_save')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="colectivo_id" value="{{$colectivo->id}}">
            <div class="row">
               <div class="input-field col s12">
                  <input type="text" id="colectivo-grupo-familiar" required name="colectivo_grupo_familiar" value="{{$colectivo->colectivo_grupo_familiar ?? '' }}">
                  <label for="colectivo-grupo-familiar"><i class="fas fa-users"></i> ~ GRUPO FAMILIAR*</label>
               </div>
               <div class="input-field col s12 m12 l4 offset-l8">
                  <button type="submit" class="btn-guardar">GUARDAR</button>
               </div>
            </div>
         </form>
      </div>
   @endslot

   @slot('footer','')
@endcomponent