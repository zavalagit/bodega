<div class="row">
   {{-- @component('componentes.componente_seccion_titulo')
      @slot('mensaje','1.1. DESCRIPCIÓN BAJA PARCIAL')
      @slot('icono','fas fa-check-square')
   @endcomponent --}}

   <div class="col s12">
      <table id="tabla-baja-parcial" class="{{$formAccion == 'editar' && $baja->indicios->contains('pivot.baja_tipo','parcial') ? '' : 'ocultar'}}">
         <thead>
            <tr>
               <th class="th-center">IDENTIFICADOR</th>
               <th>DESCRIPCIÓN DE BAJA</th>
               <th class="th-center">CANTIDAD DE INDICIOS BAJA</th>
               <th>DESCRIPCIÓN DE LO QUE SE QUEDA</th>
               {{-- <th class="th-center">CANTIDAD DE INDICIOS QUE SE QUEDA</th> --}}
            </tr>
         </thead>
         <tbody>
            @if ($formAccion == 'editar')
               @if ($baja->indicios->contains('pivot.baja_tipo','parcial'))
                  @foreach ($baja->indicios()->wherePivot('baja_tipo','parcial')->get() as $indicio)
                     @include('baja.baja_parcial.baja_parcial_view_tr')
                  @endforeach
               @endif
            @endif
         </tbody>
      </table>
   </div>
</div>