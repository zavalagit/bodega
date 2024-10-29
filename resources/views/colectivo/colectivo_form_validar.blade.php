@extends('plantilla.template')

{{--item menu selected--}}
@section('nombre_pagina','vista-colectivo-registrar')
@section('nombre_submenu','submenu-colectivos')

@section('seccion','Toma de muestras a colectivos')

@section('css')
   <link rel="stylesheet" href="{{asset('css/hr.css')}}">
   <link rel="stylesheet" href="{{asset('css/btn.css')}}">
<style>

</style>
@endsection

@section('contenido')
   <section>
      <div class="row" style="margin: 0 !important;">
         <div class="col s12 m12 l2 offset-l10">
            <p class="right-align">
               <i class="fas fa-asterisk" style="color: tomato;"></i> <b>Campos obligatorios</b> <br><br>
            </p>
         </div>
         <div class="col s12">
            <hr class="hr-3">
         </div>
      </div>   
   </section> 
   

         <form id="form-colectivo-validar" action="/colectivo-save/{{$accion}}/{{ (isset($colectivo)) ? $colectivo->id : '0' }}" method="POST">
            {{ csrf_field() }}
            <!--section-->
            <section>
               <div class="row">
                  @component('componentes.seccion_form')
                     @slot('mensaje','1. DATOS GENERALES')
                  @endcomponent
                  <!--control interno de muestra (cim)-->
                  <div class="input-field col s12 m12 l3">
                     <input type="text" id="colectivo-cim" {{($validar) ? 'disabled' : ''}} name="colectivo_cim" value="{{ isset($colectivo) ? $colectivo->colectivo_cim : '' }}">
                     <label for="colectivo-cim"><i class="fas fa-flask"></i> ~ CONTROL INTERNO DE MUESTRA (CIM){{($validar) ? '' : '*'}}</label>
                  </div>
                  <!--región en don se realiza el registro-->
                  <div class="input-field col s12 m12 l3">
                     <select {{($validar) ? 'disabled' : ''}} name="colectivo_fiscalia">
                        @foreach ($fiscalias->sortBy('nombre')->values() as $i => $fiscalia)
                           <option value="{{$fiscalia->id}}" {{ ( ($accion == 'registrar') && (Auth::user()->fiscalia_id == $fiscalia->id) ) ? 'selected' : '' }} {{ ( ($accion != 'registrar') && ($colectivo->fiscalia_id == $fiscalia->id) ) ? 'selected' : '' }}>{{$i+1}}.- {{$fiscalia->nombre}}</option>
                        @endforeach
                     </select>
                     <label><i class="fas fa-map-marker"></i> ~ REGIÓN EN DONDE SE REALIZA EL MUESTREO{{($validar) ? '' : '*'}}</label>
                  </div>

                  <div class="col s12">
                     <hr class="hr-3">
                  </div>
               </div>
            </section>
            <!--section-->
            <section>
               <div class="row">
                  @component('componentes.seccion_form')
                     @slot('mensaje','2. DATOS DE LA PERSONA A LA QUE SE LE REALIZÓ EL MUESTREO')
                  @endcomponent
                  <div class="input-field col s12 m12 l2">
                     <input type="date" id="colectivo-fecha-muestreo" class="{{($accion == 'registrar') ? 'fecha-actual' : ''}}" name="colectivo_fecha_muestreo" value="{{ (isset($colectivo)) ? $colectivo->colectivo_fecha_muestreo : '' }}">
                     <label class="active" for="colectivo-fecha-muestreo">FECHA DEL MUESTRO{{($validar) ? '' : '*'}}</label>
                  </div>
                  <div class="input-field col s12 m12 l6">
                     <input type="text" id="colectivo-persona-muestreo" name="colectivo_persona_muestreo" value="{{ (isset($colectivo)) ? $colectivo->colectivo_persona_muestreo : '' }}">
                     <label for="colectivo-persona-muestreo"><i class="fas fa-user"></i> ~ NOMBRE DE LA PERSONA A LA QUE SE LE REALIZÓ EL MUESTREO{{($validar) ? '' : '*'}}</label>
                  </div>
                  <div class="input-field col s12 m12 l4">
                     <select  name="colectivo_procedencia">
                       <option value="" selected>Selecciona el lugar de procedencia{{($validar) ? '' : '*'}}</option>
                       @foreach ($entidades->sortBy('nombre')->values() as $i => $entidad)
                           <option value="{{$entidad->id}}" {{ ($accion == 'registrar' && $entidad->id == 16) ? 'selected' : '' }} {{ (isset($colectivo) && $entidad->id == $colectivo->entidad_id) ? 'selected' : '' }}>{{$i+1}}.- {{$entidad->nombre}}</option>
                       @endforeach
                     </select>
                     <label><i class="fas fa-map-marker"></i> ~ LUGAR DE PROCEDENCIA DE LA PERSONA{{($validar) ? '' : '*'}}</label>
                  </div>

                  <div class="col s12">
                     <hr class="hr-3">
                  </div>
               </div>
            </section>
            <!--section-->
            <section id="seccion-colectivo-parentesco">
               <div class="row" style="margin: 0 !important;">
                  @component('componentes.seccion_form')
                     @slot('mensaje','3. DATOS DE LA PERSONA DESAPARECIDA')
                  @endcomponent
                  <div class="col s12 m12 l2">
                     <a href="" id="colectivo-parentesco-agregar" style="color: #152f4a;"><i class="fas fa-plus-circle" style="color: #c09f77;"></i><b> - Agregar parentesco</b></a>
                  </div>
                  <div class="col s12">
                     <hr class="hr-1">
                  </div>
               </div>
               @if ($accion == 'registrar')
                  @include('colectivo.colectivo_parentesco_form')
               @elseif( in_array($accion,['editar','clonar']) )
                  @foreach ($colectivo->parentescos as $parentesco)
                     @include('colectivo.colectivo_parentesco_form')
                  @endforeach
               @endif
               <div class="row">
                  <div class="col s12">
                     <hr class="hr-3">
                  </div>
               </div>
            </section>
            <!--section-->
            <section>
               <div class="row">
                  @component('componentes.seccion_form')
                     @slot('mensaje','4. INDIQUE LAS MUESTRAS RECOLECTADAS')
                  @endcomponent
                  <div class="col s12">
                     <table>
                        <thead>
                           <tr>
                              <th>Seleccionar</th>
                              <th>Tipo de muestra</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($pruebas as $prueba)
                              <tr>
                                 @isset($colectivo)
                                 <td>
                                    <input type="checkbox" id="prueba-{{$prueba->id}}" class="prueba-checkbox filled-in" {{ ( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? 'checked' : '' ) }} data-prueba-id="{{$prueba->id}}" name="colectivo_pruebas[]" value="{{$prueba->id}}" />
                                    <label for="prueba-{{$prueba->id}}"></label>
                                 </td>
                                 <td width="80%">{{$prueba->nombre}}</td>
                                 {{-- <td>
                                    <input type="number" id="cantidad-estudios-{{$prueba->id}}" class="cantidad-estudios"  {{ ( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? '' : 'disabled' ) }} max="100" min="0" name="colectivo_estudios[]" value="{{ ( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ? $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->first()->pivot->cantidad_estudios : 0 ) }}">
                                 </td> --}}
                                 @endisset
                                 @empty($colectivo)
                                 <td>
                                    <input type="checkbox" id="prueba-{{$prueba->id}}" class="prueba-checkbox filled-in" data-prueba-id="{{$prueba->id}}" name="colectivo_pruebas[]" value="{{$prueba->id}}" />
                                    <label for="prueba-{{$prueba->id}}"></label>
                                 </td>
                                 <td width="80%">{{$prueba->nombre}}</td>
                                 {{-- <td>
                                    <input type="number" id="cantidad-estudios-{{$prueba->id}}" class="cantidad-estudios" disabled max="100" min="0" name="colectivo_estudios[]" value=0>
                                 </td> --}}
                                 @endempty
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
   
                  <div class="col s12">
                     <hr class="hr-3">
                  </div>
               </div>
            </section>

            <div class="row">
               <div class="input-field col s12 m12 l1 offset-l11">
                  <button type="submit" id="btn-colectivo" class="btn-guardar">{{$accion}}</button>
               </div>
            </div>
            
         </form>

@endsection

@section('js')
   <script src="{{asset('js/colectivo/colectivo_form.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_parentesco.js')}}"></script>
   <script src="{{asset('js/colectivo/colectivo_cantidad_estudios.js')}}"></script>
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
@endsection