
@extends('plantilla.template_sin_menu2')

@section('titulo')
CADENA-INGRESO
@endsection

@section('seccion', 'INGRESO DE CADENA DE CUSTODIA')

@section('css')
  <link rel="stylesheet" href="{{asset('/css/block.css')}}">
  <link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
  <style media="screen">
    body{
      padding: 0 !important;
      margin: 0 !important;
    }
    textarea{
        padding: 0 !important;
        padding-top: 0px !important;
    }
   </style>
   
   <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
@endsection

@section('contenido')

   <div class="row" x-data="data()">
    <form class="col s12" id="form-alta">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
      <input type="hidden" name="id_cadena" value="{{$cadena->id}}">
      <input type="hidden" name="folio_bodega" value="{{$cadena->folio_bodega}}">

      <div class="row">
         <div class="input-field col s12">
            <input id="folio" type="text" autofocus name="folio">
            <label for="folio">FOLIO</label>
         </div>
      </div>

      <div class="row">
         <div class="input-field col s3">
            <input id="nuc" type="text" disabled value="{{$cadena->nuc}}">
            <label for="nuc">N.U.C.</label>
         </div>
         <div class="input-field col s3">
           <select name="delegacion" id="select-entidad">
               <option disabled selected></option>
               @foreach ($entidades as $key => $entidad)
                  @if($entidad->id == 16)
                    <option selected value={{$entidad->id}}>{{$entidad->nombre}}</option>
                  @else
                    <option value={{$entidad->id}}>{{$entidad->nombre}}</option>  
                  @endif  
               @endforeach
            </select>
            <label>Entidad\Estado</label>
        </div>
         <div class="input-field col s3">
            <select name="delegacion" id="select-delegacion">
               <option disabled selected></option>
               @foreach ($delegaciones as $key => $delegacion)
                  @if($delegacion->id == 782)
                    <option selected value={{$delegacion->id}}>{{$delegacion->nombre}}</option>
                  @else
                    <option value={{$delegacion->id}}>{{$delegacion->nombre}}</option>
                  @endif  
               @endforeach
            </select>
            <label>Delegación\Municipio</label>
         </div>
        <div class="input-field col s3">
            <select disabled>
               <option value={{$cadena->unidad->id}}>{{$cadena->unidad->nombre}}</option>
            </select>
            <label>Unidad administrativa</label>
        </div>   
      </div>
      <div class="row">
         <div class="input-field col s3">
            <input id="hora" type="time" name="hora">
            <label class="active" for="hora">Hora*</label>
         </div>
         <div class="input-field col s3">
            <input id="fecha" type="date" name="fecha">
            <label class="active" for="fecha">Fecha*</label>
         </div>
         <div class="input-field col s3">
            <select x-model="naturaleza_id" name="naturaleza">
               <option disabled selected></option>
               @foreach ($naturalezas as $key => $naturaleza)
                  <option value={{$naturaleza->id}}>{{$naturaleza->nombre}}</option>
               @endforeach
            </select>
            <label>Naturaleza*</label>
         </div>
         <div class="input-field col s3">
          <select name="embalaje">
               <option disabled selected></option>
               <option value="bolsa">BOLSA</option>
               <option value="caja">CAJA</option>
               <option value="recipiente">RECIPIENTE</option>
            </select>
            <label>EMBALAJE*</label>
         </div>
      </div>
      <div class="row">
        <p class="col s4"><b>TIPO:</b></p>
        <p class="col s4">
		{{--
            <input name="tipo" type="radio" id="indicio" value="indicio"/>
            <label for="indicio">Indicio</label>
		--}}
			
            <label for="indicio">
				<input name="tipo" type="radio" id="indicio" value="indicio"/>
				<span>Indicio</span>
			</label>
         </p>
         <p class="col s4">
		 {{--
			<input name="tipo" type="radio" id="evidencia" value="evidencia"/>
            <label for="evidencia">Evidencia</label>
		 --}}
		 
			
            <label for="evidencia">
				<input name="tipo" type="radio" id="evidencia" value="evidencia"/>
				<span>Evidencia</span>
			</label>
         </p>
      </div>
      <div class="row">
         <div class="input-field col s12">
            <textarea id="observacion" class="materialize-textarea" name="observacion"></textarea>
            <label for="observacion">Observación</label>
         </div>
      </div>

      <!--INDICIOS-->
      <div class="row">
        <blockquote>
          <h6><b>INDICIOS/EVIDENCIAS</b></h6>
       </blockquote>
        <table class="highlight">
          <thead>
            <tr>
              <th class="th-center">Nº</th>
              <th>IDENTIFICADOR</th>
              <th>DESCRIPCIÓN</th>
              <th>NÚMERO DE INDICIOS</th>
            </tr>
          </thead>
          <tbody>
            @php $n = 1 @endphp
            @foreach($cadena->indicios as $key => $indicio)
              <tr>
                <td width="3%" class="td-contador">{{$n++}}</td>
                <td width="8  %">{{$indicio->identificador}}</td>
                <td>{{$indicio->descripcion}}</td>
                <td>
                  <div class="input-field">
                    <input type="number" min="1" name="numero_indicios[]" autocomplete="off">
                  </div>
                </td>
              </tr>
            @endforeach  
          </tbody>
        </table>
      </div>
	  
	  <div class="row" x-show="is_naturaleza_arma()">
			<div class="col s12">
               <blockquote>
                  <h6><b>Oficios de notificación de aseguramiento de las armas</b></h6>
               </blockquote>
            </div>
			
			{{--
			<div class="col s12"
			<span style="color:red;">Estoy añadiendo este apartado, aún no funciona, pero pueden registrar sin problema, solo ignoren este apartado.</span>
			</div>
			--}}
			
			<div class="col s12 switch">
				{{--
					<input type="checkbox" id="oficio-fgr" class="filled-in" name="tiene_oficio_fgr" />
					<label for="oficio-fgr">Oficio FGR</label>
				--}}
					<label for="oficio-fgr">
					  No
					  <input type="checkbox" id="oficio-fgr" name="tiene_oficio_fgr">
					  <span class="lever"></span>
					  Sí
					</label>
					~ Oficio FGR
				
			</div>
			<div class="col s12 switch">
				
				{{--
					<input type="checkbox" id="oficio-sedena" class="filled-in" name="tiene_oficio_sedena" />
					<label for="oficio-sedena">Oficio SEDENA</label>
				--}}
					<label for="oficio-sedena">
					  No
					  <input type="checkbox" id="oficio-sedena" name="tiene_oficio_sedena">
					  <span class="lever"></span>
					  Sí
					</label>
					~ Oficio SEDENA
			</div>
		 </div>


      <div class="row">
        <blockquote>
          <h6><b>SERVIDOR PÚBLICO - ENTREGA</b></h6>
       </blockquote>
       <div class="input-field col s11">
        <input type="hidden" id="input-hidden-perito" name="perito"">
        <input type="text" class="autocomplete" id="input-text-perito" data-input-hidden="input-hidden-perito" data-tabla="peritos">
        <label for="input-text-perito">Servidor público</label>
      </div>
      <div class="input-field col s1">
          <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="input-text-perito" data-input-hidden="input-hidden-perito">
            <i class="fas fa-times-circle fa-lg" ></i>
          </a>
      </div>
      </div>


      <div class="row">
        <blockquote>
          <h6><b>RESPONSABLE BODEGA - RECIBE</b></h6>
        </blockquote>
        <div class="input-field col s11">
          <input type="hidden" id="input-hidden-responsable-bodega" name="responsable_bodega" value="{{Auth::user()->id}}">
          <input type="text" class="autocomplete" id="input-text-responsable-bodega" data-input-hidden="input-hidden-responsable-bodega" data-tabla="users" data-user-tipo="responsable_bodega" value="{{Auth::user()->folio}} - {{Auth::user()->name}}">
          <label for="input-text-perito">Responsable de bodega</label>
       </div>
       <div class="input-field col s1">
          <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="input-text-responsable-bodega" data-input-hidden="input-hidden-responsable-bodega">
             <i class="fas fa-times-circle fa-lg" ></i>
          </a>
       </div>
      </div>


      <div class="right-align">
         <button class="btn waves-effect waves-light" type="submit" id="btn-guardar-cedula">
            Guardar
         </button>
      </div>

    </form>
  </div>

@endsection

@section('js')
<script src="{{asset('js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('js/modelo/input_autocomplete.js')}}"></script>
  <script src="{{asset('js/cedula.js')}}"></script>
  
  
  <script>
   function data() {
        return {
           naturaleza_id : '',
           is_naturaleza_arma(){
              return ['1','2'].includes(this.naturaleza_id) ? true : false;
           },
        };
     }
</script>
@endsection
