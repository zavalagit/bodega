@php
   $plantilla = "";
   if(Auth::user()->tipo === 'coordinador')
      $plantilla = 'plantillas.peticiones.plantilla_coordinador';
   elseif(Auth::user()->tipo === 'director_unidad')
      $plantilla = 'plantillas.plantilla_director';
   elseif(Auth::user()->tipo === 'director_fiscalia')
      $plantilla = 'plantillas.plantilla_director';
@endphp

@extends($plantilla)

@section('seccion', "PETICIONES DEL DÍA ()")
@section('titulo','CONSULTAR-CADENA')

@section('css')

    <link rel="stylesheet" href="{{asset('css/botones/btn_icon.css')}}">
   <style media="screen">
      body{
         zoom: 72% !important;
      }
      caption{
         color: #c6c6c6 !important;
         background-color: #152F4A !important;
      }

      .col{
         margin-bottom: 2%;
      }

      .div-fiscalia{
         background-color: #394049;
         color: #c09f77;
         border-radius: 25px 25px 0 25px;
         padding: 10px 0 10px 15px;
      }
      .div-fiscalia:hover{
         background-color: #152f4a;
      }
   </style>
@endsection

@section('contenido')

   <!--buscar-->
   <section>
      <form class="col s12">
         <div class="row">
            <div class="input-field col s2">
               @isset($fecha_inicio)
                  <input type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
               @endisset
               @empty($fecha_inicio)
                  <input type="date" name="fecha_inicio" >
               @endempty
            </div>

            <div class="input-field col s2">
               @isset($fecha_fin)
                  <input type="date" name="fecha_fin" value="{{$fecha_fin}}">
               @endisset
               @empty($fecha_fin)
                  <input type="date" name="fecha_fin" >
               @endempty
            </div>
            
            <div class="input-field col s1">
                  <button class="btn waves-effect waves-light" type="submit" name="btn_buscar" value="buscar">
                     <i style="color:#394049;" class="fas fa-search"></i>
                  </button>
            </div>
           
         </div>
      </form>
   </section>
 
   <div class="row">
      <div class="col s12 m12 l6">
         <table>
            <thead>
               <tr>
                  <th>Tipo</th>
                  <th>Cantidad</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Dolosa</td>
                  <td>{{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','dolosa')->pluck('id') )->count()}}</td>
               </tr>
               <tr>
                  <td>Hecho transito</td>
                  <td>{{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','hecho_transito')->pluck('id') )->count()}}</td>
               </tr>
               <tr>
                  <td>Patologia u otra</td>
                  <td>{{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','patologia_otra')->pluck('id') )->count()}}</td>
               </tr>
               <tr>
                  <td>Suicidio</td>
                  <td>{{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','suicidio')->pluck('id') )->count()}}</td>
               </tr>
               <tr>
                  <td>Apoyo USPEC</td>
                  <td>{{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','apoyo_uspec')->pluck('id') )->count()}}</td>
               </tr>
               <tr>
                  <td>Apoyo UECS</td>
                  <td>{{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','apoyo_uecs')->pluck('id') )->count()}}</td>
               </tr>
               <tr>
                  <td>Total</td>
                  <td>{{$peticiones->count()}}</td>
               </tr>
            </tbody>
         </table>

         {{--
         <div class="div-fiscalia">
            <h6><b>TOTAL</b></h6>
            <h6><b>---</b></h6>
            <p>Total: {{$peticiones->count()}}</p>
            <p>Doloasa: {{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','dolosa')->pluck('id') )->count()}}</p>
            <p>Hecho transito: {{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','hecho_transito')->pluck('id') )->count()}}</p>
            <p>Patología u otra: {{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','patologia_otra')->pluck('id') )->count()}}</p>
            <p>Suicidio: {{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','suicidio')->pluck('id') )->count()}}</p>
            <p>Apoyo USPEC: {{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','apoyo_uspec')->pluck('id') )->count()}}</p>
            <p>Apoyo UECS: {{$peticiones->whereIn( 'necropsia_id',$necropsias->where('necropsia_tipo','apoyo_uecs')->pluck('id') )->count()}}</p>
            <p>Dictamen: {{$atendidas->where('documento_emitido','dictamen')->count()}}</p>
            <p>Certificado: {{$atendidas->where('documento_emitido','certificado')->count()}}</p>
            <p>Informe: {{$atendidas->where('documento_emitido','informe')->count()}}</p>
            <p>Juzgado: {{$atendidas->where('documento_emitido','salida_juzgado')->count()}}</p>
         </div>
         --}}
      </div>
   </div>


   <div class="row">
      @php
          $dia = $fecha_inicio;
          $dia_siguiente = date("Y-m-d", strtotime("{$dia} +1 day"));
      @endphp
      @while ( strtotime($dia) <= strtotime($fecha_fin) )
         @break( strtotime($dia) > strtotime('now') )
         <div class="col s4 m4 l2">
            <div class="div-fiscalia">
               <h6 style="font-size: 12px;"><b>{{ strtoupper(strftime('%A',strtotime($dia))) }} {{ date('d-m-Y',strtotime($dia)) }} {{-- {{ strtoupper(strftime('%A',strtotime($dia_siguiente))) }} {{ date('d-m-Y',strtotime($dia_siguiente)) }} --}}</b></h6>
               <p>Necropsias: {{$peticiones->where('created_at','>=',"{$dia} 07:00:00")->where('created_at','<=',"{$dia_siguiente} 06:59:59")->count()}}</p>
               {{--
               <p>Atendidas: {{$atendidas->where('fecha_sistema',$dia)->count()}}</p>
               <p>Dictamen: {{$atendidas->where('fecha_sistema',$dia)->where('documento_emitido','dictamen')->count()}}</p>
               <p>Certificado: {{$atendidas->where('fecha_sistema',$dia)->where('documento_emitido','certificado')->count()}}</p>
               <p>Informe: {{$atendidas->where('fecha_sistema',$dia)->where('documento_emitido','informe')->count()}}</p>
               <p>Juzgado: {{$atendidas->where('fecha_sistema',$dia)->where('documento_emitido','salida_juzgado')->count()}}</p>
               <p><a href="/" target="_blank" rel="noopener noreferrer"></a></p>
               --}}
            </div>
         </div>
         @php
             $dia = date("Y-m-d", strtotime("{$dia} +1 day"));
             $dia_siguiente = date("Y-m-d", strtotime("{$dia} +1 day"));
         @endphp
      @endwhile
   </div>
  
@endsection

@section('js')
  


@endsection
