
@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      textarea{
         padding: 0 !important;
         padding-top: 0px !important;
      }

      blockquote{
         padding: 1px 0 !important;
         color: #fff !important;
         background-color: #112046 !important;
         font-size: 13px !important;
         text-align: center;
         margin: 0 !important; 
      }

      hr{
         border-color: #2196f3;
      }

      h5{
         padding: 0 !important;
         margin: 0 !important;
         color:#112046;
      }
      th,td{
         margin: 0 !important;
         padding: 2px 3px !important;
      }
      .tr-encabezado{
         background-color: #112046 !important;
         color: #fff;
         font-size: 13px;
      }
      table{
      width: 100% !important;
      margin: 0 !important;
      }

      .row{
        margin: 0 !important;
        padding: 0 !important;
      }
      #div-icon-add{
        margin-top: 5px !important;
        margin-bottom: 15px !important;
      }
   </style>
@endsection

@section('contenido')

  <div class="amber"> 
    <h5 class="center-align">
       <b>EDITAR ENTRADA - CADENA CON FOLIO {{$cadena->folio_bodega}}</b>
    </h5>
  </div>

   <div class="row">
    <form action="/bodega/editar-guardar" method="POST">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
      <input type="hidden" name="id_cadena" value="{{$cadena->id}}">
      <input type="hidden" name="id_entrada" value="{{$cadena->entrada->id}}">

      <div class="row">
         <div class="input-field col s12">
            <input id="folio" type="text" autocomplete="off" name="folio" value="{{$cadena->folio_bodega}}">
            <label for="folio">FOLIO</label>
         </div>
      </div>

      <div class="row">
         <div class="input-field col s3">
            <input id="nuc" type="text" name="nuc" value="{{$cadena->nuc}}">
            <label for="nuc">N.U.C.</label>
         </div>
        <div class="input-field col s3">
           <select name="entidad" id="select-entidad">
               <option disabled selected></option>
               @foreach ($entidades as $key => $entidad)
                  @if($entidad->id == 16)
                    <option selected value={{$entidad->id}}>{{$entidad->nombre}}</option>
                  @else
                    <option value="{{$entidad->id}}">{{$entidad->nombre}}</option>  
                  @endif  
               @endforeach
            </select>
            <label>ENTIDAD\ESTADO</label>
        </div>
         <div class="input-field col s3">
            <select name="delegacion" id="select-delegacion">
               <option disabled selected></option>
               @foreach ($delegaciones as $key => $delegacion)
                  @if($delegacion->id == $entrada->delegacion_id)
                    <option selected value="{{$delegacion->id}}">{{$delegacion->nombre}}</option>
                  @else
                    <option value="{{$delegacion->id}}">{{$delegacion->nombre}}</option>
                  @endif  
               @endforeach
            </select>
            <label>DELEGACIÓN\MUNICIPIO</label>
         </div>
        <div class="input-field col s3">
            <select name="unidad">
              <option disabled selected></option>
                @foreach ($unidades as $key => $unidad)
                  @if($unidad->id == $cadena->unidad_id)
                    <option selected value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                  @else  
                    <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                  @endif  
                @endforeach
            </select>
            <label>UNIDAD ADMINISTRATIVA</label>
        </div>
       
      </div>
      <div class="row">        
        <div class="input-field col s3">
            <input type="time" name="hora" value="{{date('H:i:s',strtotime($entrada->hora))}}">
            <label class="active" for="hora">HORA*</label>
        </div>
        <div class="input-field col s3">
            <input type="date" name="fecha" value="{{$entrada->fecha}}">
            <label class="active" for="fecha">FECHA*</label>
        </div>
        <div class="input-field col s3">
            <select name="naturaleza">
               <option disabled selected></option>
               @foreach ($naturalezas as $key => $naturaleza)
                  @if($naturaleza->id == $entrada->naturaleza_id)
                    <option selected value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
                  @else  
                    <option value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
                  @endif
               @endforeach
            </select>
            <label>NATURALEZA*</label>
         </div>
         <div class="input-field col s3">
          <select name="embalaje">
            @if($entrada->embalaje == 'bolsa')
              <option value="caja">CAJA</option>
              <option selected value="bolsa">BOLSA</option>
              <option value="recipiente">RECIPIENTE</option>
            @elseif($entrada->embalaje == 'caja')   
              <option selected value="caja">CAJA</option>
              <option value="bolsa">BOLSA</option>
              <option value="recipiente">RECIPIENTE</option>
            @elseif($entrada->embalaje == 'recipiente')               
               <option value="caja">CAJA</option>                
               <option value="bolsa">BOLSA</option>
               <option selected value="recipiente">RECIPIENTE</option>
            @endif   
            </select>
            <label>EMBALAJE*</label>
         </div>
      </div>
      <div class="row">
        <p class="col s4 m4 l4"><b>TIPO:</b></p>
        <p class="col s4 m4 l4">
          @if($cadena->entrada->tipo == 'indicio')
            <input name="tipo" type="radio" id="indicio" value="indicio" checked/>
          @else
            <input name="tipo" type="radio" id="indicio" value="indicio"/>
          @endif
          <label for="indicio">INDICIO</label>
        </p>
        <p class="col s4 m4 l4">
          @if($cadena->entrada->tipo == 'evidencia')
            <input name="tipo" type="radio" id="evidencia" value="evidencia" checked/>
          @else
            <input name="tipo" type="radio" id="evidencia" value="evidencia"/>
          @endif
          <label for="evidencia">EVIDENCIA</label>
        </p>
      </div>
      
      <div class="row">
         <div class="input-field col s12">
            <textarea id="observacion" class="materialize-textarea" name="observacion">{{$entrada->observacion}}
            </textarea>
            <label for="observacion">OBSERVACIÓN</label>
         </div>
      </div>
        

      <blockquote>
        <b>INDICIOS</b>                          
      </blockquote>
      <section id="indicios">
        <!--
        <div class="row" id="div-icon-add">
          <div class="col s2">
            <a id="add-desc" class="tooltipped" data-position="right" data-delay="50" data-tooltip="
            Agregar nvo. indicio o evidencia" href="">
              <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
            </a>
          </div>              
        </div>
        -->

        @foreach($cadena->indicios as $key => $indicio)        
        <div class="row">
          <div class="input-field col s2">
            <input id="identificador" type="text" class="center-align" value="{{$indicio->identificador}}" name="identificador[]">
            <label for="identificador">IDENTIFICADOR</label>
          </div>
          <div class="input-field col s7">
            <textarea id="descripcion" class="materialize-textarea" name="descripcion[]">{{$indicio->descripcion}}</textarea>
            <label for="descripcion">DESCRIPCIÓN</label>
          </div>
          <div class="input-field col s2">
            <input id="identificador" type="text" class="center-align" value="{{$indicio->numero_indicios}}" name="numero_indicios[]">
            <label for="identificador">NO. INDICIOS</label>
          </div>
        </div>
        @endforeach
      </section>
	  
	  
	  <div class="row" {{!in_array($cadena->naturaleza_id,[1,2]) ? 'hide' : ''}}" >
			
               <blockquote>
                  <b>Oficios de notificación de aseguramiento de las armas</b>
               </blockquote>
            
			
			<div class="col s12 switch">
				{{--
					<input type="checkbox" id="oficio-fgr" class="filled-in" name="tiene_oficio_fgr" />
					<label for="oficio-fgr">Oficio FGR</label>
				--}}
					<label for="oficio-fgr">
					  No
					  <input type="checkbox" id="oficio-fgr" {{$entrada->tiene_oficio_fgr ? 'checked' : ''}} name="tiene_oficio_fgr">
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
					  <input type="checkbox" id="oficio-sedena" {{$entrada->tiene_oficio_sedena ? 'checked' : ''}} name="tiene_oficio_sedena">
					  <span class="lever"></span>
					  Sí
					</label>
					~ Oficio SEDENA
			</div>
		 </div>

      <blockquote>
        <b>PERITO QUE ENTREGA</b>                          
      </blockquote>
      <div class="row"> 
            <div class="input-field col s11">
              <input type="hidden" id="input-hidden-perito" name="perito" value="{{$entrada->perito_id}}">
              <input type="text" class="autocomplete" id="input-text-perito" data-input-hidden="input-hidden-perito" data-tabla="peritos" value="{{$entrada->perito->folio}} - {{$entrada->perito->nombre}}">
              <label for="input-text-perito">Servidor público</label>
           </div>
           <div class="input-field col s1">
              <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="input-text-perito" data-input-hidden="input-hidden-perito">
                 <i class="fas fa-times-circle fa-lg" ></i>
              </a>
           </div>
      </div>

      
      


    <blockquote class="center-align">
      <b>RESPONSABLE DE BODEGA RECIBE</b>
    </blockquote>
      <div class="row">
        <div class="input-field col s11">
          <input type="hidden" id="input-hidden-responsable-bodega" name="responsable_bodega" value="{{$entrada->user_id}}">
          <input type="text" class="autocomplete" id="input-text-responsable-bodega" data-input-hidden="input-hidden-responsable-bodega" data-tabla="users" data-user-tipo="responsable_bodega" value="{{$entrada->user->folio}} - {{$entrada->user->name}}">
          <label for="input-text-perito">Responsable de bodega</label>
       </div>
       <div class="input-field col s1">
          <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="input-text-responsable-bodega" data-input-hidden="input-hidden-responsable-bodega">
             <i class="fas fa-times-circle fa-lg" ></i>
          </a>
       </div>
      </div>
      
	
      <div class="row">        
        <div class="input-field col s2 offset-s10">
		@if( (Auth::user()->tipo === 'administrador') || (Auth::user()->folio === 'S0502') || (Auth::user()->folio === 'S0549') || (Auth::user()->folio === 'A1183') )
           <button class="btn waves-effect waves-light" type="submit" >
              Guardar
           </button>
		@else
		<button class="btn waves-effect waves-light" disabled type="submit" >
              Guardar
           </button>
		@endif
        </div>
      </div>

    </form>
  </div>

@endsection

@section('js')
<script src="{{asset('js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('js/modelo/input_autocomplete.js')}}"></script>

  <script src="{{asset('js/indicios_agregar.js')}}"></script>

@endsection
