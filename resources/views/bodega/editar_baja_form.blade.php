@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      h5{
         padding: 2px 0 !important;
         margin: 0 !important;
      }
      td{
         margin: 0 !important;
         padding: 2px 3px !important;
      }
      .tr-encabezado{
         background-color: #112046 !important;
         color: #fff;
      }
      blockquote{
         font-size: 60px !important;
         padding: 1px 10px !important;
         color: #fff !important;
         background-color: #112046 !important;
      }
      section{
         background-color: #e1f5fe !important;         
      }
      .row{
        margin: 0 !important;
        padding: 0 !important;
      }

      body{
        background-color: #e3f2fd;
      }
      blockquote{
         padding: 1px 0 !important;
         color: #fff !important;
         background-color: #112046 !important;
         font-size: 13px !important;
         text-align: center;
         margin: 0 !important; 
      }
   </style>
@endsection

@section('contenido')

   
            
   <h5 class="amber center-align">
      <b>EDITAR BAJA - CADENA {{$baja->cadena->folio_bodega}}</b>
   </h5>   

   <div class="row">
      <form class="col s12" id="form-baja-editar">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
         <input type="hidden" name="id_baja" value="{{$baja->id}}">

         <table>
            <thead>
               <tr class="tr-encabezado">
                  <th>IDENTIFICADOR</th>
                  <th>DESCRIPCIÓN</th>
                  <th>NO. INDICIOS</th>
                </tr>
               </thead>
            <tbody>
               @foreach($baja->indicios as $key => $indicio)
                  <tr class="blue accent-1">
                     <td style="text-align: center"><b>{{$indicio->identificador}}</b></td>
                     <td>{{$indicio->descripcion}}</td>
                     <td style="text-align: center">{{$indicio->numero_indicios}}</td>                     
                  </tr>
               @endforeach
            </tbody>
         </table>

         <div class="row">
            <div class="input-field col s12">
               <input id="concepto" type="text" value="{{$baja->concepto}}" name="concepto">
               <label for="concepto">Concepto de Baja</label>
            </div>
         </div>
         <div class="row">
            <div class="input-field col s2">
               <input type="text" id="numindicios" value="{{$baja->numero_indicios}}" name="numindicios">
               <label for="numindicios">Num. Indicios</label>
            </div>
            <div class="input-field col s2">
               <input type="time" id="hora" value="{{date('H:i:s',strtotime($baja->hora))}}" name="hora">
               <label class="active" for="hora">Hora</label>
            </div>
            <div class="input-field col s2">
               <input type="date" id="fecha" value="{{$baja->fecha}}" name="fecha">
               <label class="active" for="hora">Fecha</label>
            </div>
            <div class="input-field col s3">
               <select name="tipo_baja">                  
                  @if($baja->tipo == 'definitiva')
                     <option value="definitiva" selected>DEFINITIVA</option>                     
                     <option value="parcial">PARCIAL</option>
                     <option value="pertenencia">PERTENENCIA</option>
                  @elseif($baja->tipo == 'parcial')
                     <option value="definitiva">DEFINITIVA</option>                     
                     <option value="parcial" selected>PARCIAL</option>
                     <option value="pertenencia">PERTENENCIA</option>
                  @elseif($baja->tipo == 'pertenencia')
                     <option value="definitiva">DEFINITIVA</option>                     
                     <option value="parcial">PARCIAL</option>
                     <option value="pertenencia" selected>PERTENENCIA</option>
                  @endif
               </select>
               <label>Tipo de Baja</label>
            </div>
            <div class="input-field col s3">
               <select name="estado_cadena">
                  @if($baja->estado_cadena == 'x')
                     <option value='x' selected>Entregada</option>
                     <option value='o'>No entregada</option>
                  @else
                     <option value='x'>Entregada</option>
                     <option value='o' selected>No entregada</option>
                  @endif
               </select>
               <label>Estado de la cadena</label>
            </div>
            <div class="input-field col s12">
               <textarea id="textarea1" class="materialize-textarea" name="observaciones"></textarea>
               <label for="textarea1">OBSERVACIONES</label>
            </div>
            <div class="input-field col s12">
               <textarea id="textarea1" class="materialize-textarea" name="embalaje">{{$baja->embalaje}}</textarea>
               <label for="textarea1">EMBALAJE</label>
            </div>
         </div>

         <blockquote style="margin-bottom: 10px !important"><b>QUIEN RECIBE</b></blockquote>
         <section id="section-recibe">
            @isset($baja->perito_id)
               <div class="right-align">                  
                  <a href="" id='cambiar-a-ciudadano' class="tooltipped" data-position="left" data-delay="50" data-tooltip="
            Cambiar a Perito"><i class="fa fa-times" aria-hidden="true" fa-lg></i></a>
               </div>
               <div class=row id="datos_perito">
                  <input type="hidden" id="" name="id_perito" value="{{$baja->perito->id}}">
                  <div class="input-field col s2">
                     <input type="text" disabled value="{{$baja->perito->folio}}">
                     <label>Folio credencial</label>
                  </div>
                  <div class="input-field col s4">
                     <input type="text" disabled value="{{$baja->perito->nombre}}">
                     <label>Nombre</label>
                  </div>
                  <div class="input-field col s3">
                     <input type="text" disabled value="{{$baja->perito->cargo->nombre}}">
                     <label>Cargo</label>
                  </div>
                  <div class="input-field col s3">
                     <a href="" id="borrar_perito"><i class="fa fa-times" aria-hidden="true"></i></a>
                  </div>
               </div>
            @endisset

            @isset($baja->quien_recibe)
               <div class="right-align">                  
                  <a href="" id='cambiar-a-perito'><i class="fa fa-times" aria-hidden="true" fa-lg></i></a>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <input id="quien-recibe" type="text" value="{{$baja->quien_recibe}}" name="quien_recibe">
                     <label for="quien-recibe">Quien recibe</label>
                  </div>
               </div>
               <div class="row">
                  <div class="input-field col s12">
                     <input id="identificacion" type="text" value="{{$baja->identificacion}}" placeholder="IFE, INE, etc." name="identificacion">
                     <label for="identificacion">IDENTIFICACIÓN</label>
                  </div>
               </div>
            @endisset            
         </section>


         <blockquote><b>RESPONSABLE BODEGA ENTREGA</b></blockquote>
         <div>          
            <div class="input-field col s3" id="rb-buscar">
               <input id="rb-input" type="text">
               <label for="rb-input">RESPONSABLE BODEGA</label>
            </div>
            <div class="input-field col s6" id="div-rb-lista">
               <ul id="rb-lista">

               </ul>
            </div>
         </div>

         <div class="row">
            <div class="input-field col s11" id="rb-datos">
               <input type="hidden" name="rb_id" value="{{$baja->user->id}}">
               <input id="rb-entrega" type="text" disabled value="{{$baja->user->name}}">
               <label for="rb-entrega">NOMBRE</label>
            </div>
            <div class="input-field col s1" id="icon-delete">
               <a id="rb-delete" href=""><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
         </div>

         <div class="row">
            <div class="col s2 offset-s10">         
               <button class="btn waves-effect waves-light" type="submit" id="btn-baja-editar">
                  Realizar baja parcial
               </button>
            </div>                       
         </div>
      
      </form>

@endsection

@section('js')
   <script src="{{asset('js/rb_cambiar.js')}}"></script>
   <script src="{{asset('js/baja_editar.js')}}"></script>
@endsection
