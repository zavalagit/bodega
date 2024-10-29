
 
 @php
     $n = 1;
 @endphp

 <table class="tabla-modal bordered">
   <caption class="" style="background-color:#c09f77 !important;color:#152f4a;"> <b>N.U.C.: {{$peticion->nuc}}</b> </caption>
  @if ( in_array(Auth::user()->tipo,["director_unidad","director_fiscalia"]) )
    <tr>
      <th style="background-color: #152f4a; color: #fff;">{{$n++}}.- PERITO</th>
      <td style="background-color: #152f4a; color: #fff !important;"><b>{{$peticion->user->name}}</b></td>
    </tr>
  @endif
   <tr>
     <th style="background-color: #152f4a; color: #fff;">{{$n++}}.- ESTADO DE LA SOLICITUD</th>
     <td style="background-color: #152f4a; color: #fff !important;"><b>{{strtoupper($peticion->estado)}}</b></td>
   </tr>
   <tr>
    <th style="color: #c09f77;">{{$n++}}.- FECHA DE REGISTRO EN SISTEMA</th>
    <td><b>{{date('H:i:s',strtotime($peticion->created_at))}} ~ {{date('d-m-Y',strtotime($peticion->created_at))}}<b></td>
  </tr>
  @if (in_array($peticion->estado,['atendida','entregada']))
  <tr>
    <th style="color: #c09f77;">{{$n++}}.- FECHA EN QUE SE REPORTÓ CÓMO ATENDIDA-ELABORADA EN SISTEMA</th>
    <td><b>{{date('d-m-Y',strtotime($peticion->fecha_sistema))}}</b></td>
  </tr>
    @if (in_array($peticion->solicitud_id,[61,62]))
    <tr>
      <th style="color: #c09f77;">{{$n++}}.- DÍA AL QUE PERTENECE LA NECROPSIA</th>
      <td><b>{{date('d-m-Y',strtotime($peticion->fecha_necropsia))}}</b></td>
    </tr>
    @endif
  @endif
   <tr>
     <th>{{$n++}}.- N.U.C.</th>
     <td>{{$peticion->nuc}}</td>
   </tr>
   <tr>
     <th>{{$n++}}.- FECHA DE LA SOLICITUD</th>
     <td>{{date('d-m-Y',strtotime($peticion->fecha_peticion))}}</td>
   </tr>
   <tr>
     <th>{{$n++}}.- FECHA DE RECEPCIÓN</th>
     <td>{{date('d-m-Y',strtotime($peticion->fecha_recepcion))}}</td>
   </tr>
   <tr>
    <th>{{$n++}}.- NÚMERO DE OFICIO</th>
    <td>
      @isset($peticion->oficio_numero)
        {{$peticion->oficio_numero}}
      @endisset
      @empty($peticion->oficio_numero)
        ---
      @endempty
   </td>
 </tr>
 <tr>
    <th>{{$n++}}.- FOLIO INTERNO, NÚMERO INTERNO O NÚMERO DE LIBRO</th>
    <td>
      @isset($peticion->oficio_numero)
        {{$peticion->oficio_numero}}
      @endisset
      @empty($peticion->oficio_numero)
        ---
      @endempty
   </td>
 </tr>
   
   <tr>
     <th>{{$n++}}.- REGIÓN A LA QUE PERTENECE LA SOLICITUD</th>
     <td>{{$peticion->fiscalia1->nombre}}</td>
   </tr>
   <tr>
     <th>{{$n++}}.- REGIÓN EN LA QUE SE ATIENDE LA SOLICITUD</th>
     <td>{{$peticion->fiscalia2->nombre}}</td>
   </tr>
   <tr>
     <th>{{$n++}}.- UNIDAD EN LA QUE SE ATIENDE LA SOLICITUD</th>
     <td>{{$peticion->unidad->nombre}}</td>
   </tr>
   <tr>
     <th>{{$n++}}.- ESPECIALIDAD</th>
     <td>{{mb_strtoupper($peticion->solicitud->especialidad->nombre)}}</td>
   </tr>
   <tr>
     <th>{{$n++}}.- SOLICITUD</th>
     <td>{{mb_strtoupper($peticion->solicitud->nombre)}}</td>
   </tr>
   @if (in_array($peticion->solicitud_id,[61,62]))
    <tr>
      <th>{{$n++}}.- CLASIFICACIÓN DE LA NECROPSIA</th>
      <td>{{mb_strtoupper($peticion->necropsia->necropsia_tipo)}}</td>
    </tr>
    <tr>
      <th>{{$n++}}.- CAUSA DE LA CLASIFICACIÓN</th>
      <td>{{mb_strtoupper($peticion->necropsia->nombre)}}</td>
    </tr>
   @endif
   
 <tr>
  <th>{{$n++}}.- M.P. O SERVIDOR PÚBLICO QUE SOLICITA</th>
  <td>{{$peticion->sp_solicita}}</td>
</tr>
 <tr>
  <th>{{$n++}}.- FISCALÍA A LA QUE PERTENECE EL M.P. O SERVIDOR PÚBLICO</th>
  <td>{{$peticion->petfiscalia->nombre}}</td>
</tr>
<tr>
  <th>{{$n++}}.- LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO </th>
  <td>
    @isset($peticion->petadscripcion_id)
      {{$peticion->petadscripcion->nombre}}
    @endisset
    @empty($peticion->petadscripcion_id)
      ---
    @endempty
 </td>
</tr>

@if (in_array($peticion->estado,['atendida','entregada']))
    <tr>
      <th>{{$n++}}.- FECHA DE ELABORACIÓN</th>
      <td>{{date('d-m-Y',strtotime($peticion->fecha_elaboracion))}}</td>
    </tr>
    
    
    <tr>
      <th>{{$n++}}.- DOCUMENTO EMITIDO</th>
      <td>{{$peticion->documento_emitido}}</td>
    </tr>
    <tr>
      <th>{{$n++}}.- CANTIDAD ESTUDIOS</th>
      <td>{{$peticion->cantidad_estudios}}</td>
    </tr>
@endif

@if ($peticion->estado === 'entregada')
    <tr>
      <th>{{$n++}}.- FECHA DE ENTREGA</th>
      <td>{{date('d-m-Y',strtotime($peticion->fecha_entrega))}}</td>
    </tr>
    <tr>
      <th>{{$n++}}.- M.P. O SERVIDOR PÚBLICO QUE RECIBE</th>
      <td>{{$peticion->sp_recibe}}</td>
    </tr>
@endif


   
   
 </table>
