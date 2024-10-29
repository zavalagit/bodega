@if ($formAccion == 'registrar')
    <div class="row">
        <div class="col s12">
            @component('componentes.componente_nota_2')
            @slot('icono')
                <i style="color: tomato" class="fas fa-comment-alt"></i>
            @endslot
            @slot('mensaje')
                    Al <strong><em>registrar</em></strong> los <strong>«1. Datos de la Petición»</strong>, se habilitará el botón <strong><em>«consultar»</em></strong>, en la parte superior <i style="color: tomato;" class="fas fa-hand-point-up"></i>, el cual lo dirigirá al apartado de consultar para que pueda visualizar el registro.
            @endslot
            @endcomponent
        </div>
        <div class="col s12">
            @component('componentes.componente_nota_2')
            @slot('icono')
                <i style="color: tomato" class="fas fa-comment-alt"></i>
            @endslot
            @slot('mensaje')
                    Al <strong><em>registrar</em></strong> los <strong>«1. Datos de la Petición»</strong>, se habilitará el botón <strong><em>«guardar»</em></strong> en el apartado <strong>«2. Datos de elaboración»</strong>.
            @endslot
            @endcomponent
        </div>
        <div class="col s12">
            @component('componentes.componente_nota_2')
                @slot('icono')
                    <i style="color: tomato" class="fas fa-comment-alt"></i>
                @endslot
                @slot('mensaje')
                    Al <strong><em>registrar</em></strong> los <strong>«2. Datos de Elaboración»</strong>, se habilitará el botón <strong><em>«guardar»</em></strong> en el apartado <strong>«3. Datos de Entrega»</strong>.
                @endslot
            @endcomponent
        </div>
        <div class="col s12">
            @component('componentes.componente_nota_2')
                @slot('icono')
                    <i style="color: tomato" class="fas fa-comment-alt"></i>
                @endslot
                @slot('mensaje')
                    <strong>No</strong> es necesario realizar el registro de los 3 apartados. Posteriormente podrá continuar con el llenado de los datos, ya sea que quiera agregar los <strong>«2. Datos de elaboración»</strong> y/o los
                    <strong>«3. Datos de Entrega»</strong>, solo debe buscar el registro en el apartado de <strong>«consultar»</strong> y ahí se encontrará el enlace que lo dirigirá al formulario para continuar el proceso.
                @endslot
            @endcomponent
        </div>
    </div>
@endif