@extends('plantillas.peticiones.plantilla_coordinador')

@section('seccion', "concentrado")
@section('titulo','CONSULTAR-CADENA')

@section('css')

    <link rel="stylesheet" href="{{asset('css/botones/btn_icon.css')}}">
   <style media="screen">
      .fa-search{
         color: #4db6ac;
      }

      .fa-file-pdf-o{
         color: #b71c1c;
      }






     .div-buscador{
      margin: 0 !important;
      padding: 0 !important;
     }
     .fa-file-pdf{
       color: red;
     }
     .fa-copy{
       color: #607d8b;
     }
     .fa-file-pdf:hover,.fa-copy:hover,.fa-pen:hover{
       font-size: 117%;
     }




     table {
      /*width: 220% !important;*/
      overflow-x: scroll;
      overflow-y: hidden;
   }

   caption{
       color: #c09f77;
   }

   </style>
@endsection

@section('contenido')

   <span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

   <section>
      <form class="col s12">
         <div class="row">
                <div class="input-field col s2 offset-s7">
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
                        <button class="btn waves-effect waves-light" type="submit" name="buscar_btn"
                            value="buscar"><i style="color:#394049;" class="fas fa-search"></i></button>
                    </div>
         </div>
      </form>
    </section>


   <div class="row">
      <div class="col s12">
         <table class="highlight bordered centered">
            <thead>
                <tr>
                    <th>UNIDAD</th>
                    <th>P. RECIBIDAS</th>
                    <th>P. ATENDIDAS</th>
                    <th>P. PENDIENTES</th>
                    <th>DICTAMEN</th>
                    <th>INFORME</th>
                    <th>CERTIFICADO</th>
                    <th>SALIDA JUZGADO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unidades as $unidad)
                    <tr>
                        <td>{{$unidad->nombre}}</td>
                        <td>{{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->count()}}</td>
                        <td>{{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->whereIn('estado',['atendida','entregada'])->count()}}</td>
                        <td>{{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('estado','pendiente')->count()}}</td>
                        <td>{{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','dictamen')->count()}}</td>
                        <td>{{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','informe')->count()}}</td>
                        <td>{{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','certificado')->count()}}</td>
                        <td>{{$peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','salida_juzgado')->count()}}</td>
                    </tr>
                @endforeach 
                <tr>
                    <td>TOTAL</td>
                    <td>{{$peticiones->where('fiscalia2_id',4)->count()}}</td>
                    <td>{{$peticiones->where('fiscalia2_id',4)->whereIn('estado',['atendida','entregada'])->count()}}</td>
                    <td>{{$peticiones->where('fiscalia2_id',4)->where('estado','pendiente')->count()}}</td>
                    <td>{{$peticiones->where('fiscalia2_id',4)->where('documento_emitido','dictamen')->count()}}</td>
                    <td>{{$peticiones->where('fiscalia2_id',4)->where('documento_emitido','informe')->count()}}</td>
                    <td>{{$peticiones->where('fiscalia2_id',4)->where('documento_emitido','certificado')->count()}}</td>
                    <td>{{$peticiones->where('fiscalia2_id',4)->where('documento_emitido','salida_juzgado')->count()}}</td>
                </tr> 
            </tbody>
         </table>

         <table class="highlight bordered centered">
            <thead>
                <tr>
                    <th>FISCALÍA</th>
                    <th>P. RECIBIDAS</th>
                    <th>P. ATENDIDAS</th>
                    <th>P. PENDIENTES</th>
                    <th>DICTAMEN</th>
                    <th>INFORME</th>
                    <th>CERTIFICADO</th>
                    <th>SALIDA JUZGADO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fiscalias as $fiscalia)
                    @if ($fiscalia->id != 4)
                        <tr>
                            <td>{{$fiscalia->nombre}}</td>
                            <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->count()}}</td>
                            <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('estado',['atendida','entragada'])->count()}}</td>
                            <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->where('estado','pendiente')->count()}}</td>
                            <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->where('documento_emitido','dictamen')->count()}}</td>
                            <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->where('documento_emitido','informe')->count()}}</td>
                            <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->where('documento_emitido','certificado')->count()}}</td>
                            <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->where('documento_emitido','salida_juzgado')->count()}}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td>TOTAL</td>
                    <td>{{$peticiones->whereNotIn('fiscalia2_id',[4])->count()}}</td>
                    <td>{{$peticiones->whereNotIn('fiscalia2_id',[4])->whereIn('estado',['atendida','entragada'])->count()}}</td>
                    <td>{{$peticiones->whereNotIn('fiscalia2_id',[4])->where('estado','pendiente')->count()}}</td>
                    <td>{{$peticiones->whereNotIn('fiscalia2_id',[4])->where('documento_emitido','dictamen')->count()}}</td>
                    <td>{{$peticiones->whereNotIn('fiscalia2_id',[4])->where('documento_emitido','informe')->count()}}</td>
                    <td>{{$peticiones->whereNotIn('fiscalia2_id',[4])->where('documento_emitido','certificado')->count()}}</td>
                    <td>{{$peticiones->whereNotIn('fiscalia2_id',[4])->where('documento_emitido','salida_juzgado')->count()}}</td>    
                </tr> 
            </tbody>
         </table>
         
         <table class="highlight bordered centered">
            <thead>
                <tr>
                    <th>P. RECIBIDAS</th>
                    <th>P. ATENDIDAS</th>
                    <th>P. PENDIENTES</th>
                    <th>DICTAMEN</th>
                    <th>INFORME</th>
                    <th>CERTIFICADO</th>
                    <th>SALIDA JUZGADO</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{$peticiones->count()}}</td>
                        <td>{{$peticiones->whereIn('estado',['atendida','entragada'])->count()}}</td>
                        <td>{{$peticiones->where('estado','pendiente')->count()}}</td>
                        <td>{{$peticiones->where('documento_emitido','dictamen')->count()}}</td>
                        <td>{{$peticiones->where('documento_emitido','informe')->count()}}</td>
                        <td>{{$peticiones->where('documento_emitido','certificado')->count()}}</td>
                        <td>{{$peticiones->where('documento_emitido','salida_juzgado')->count()}}</td>
                    </tr>
            </tbody>
         </table>
         

         

{{--

         <table class="highlight bordered centered">
             <caption> <b>TOTAL</b> </caption>
                <tr>
                    <td>P. RECIBIDAS</td>
                    <td>P. ATENDIDAS</td>
                    <td>P. PENDIENTES</td>
                    <td>DICTAMEN</td>
                    <td>INFORME</td>
                    <td>CERTIFICADO</td>
                    <td>SALIDA JUZGADO</td>
                </tr>
                    
                <tr>                        
                    <td>{{$unidad_peticiones}}</td>
                    <td>{{$unidad_atendidas}}</td>
                    <td>{{$unidad_pendientes}}</td>
                    <td>{{$unidad_dictamen}}</td>
                    <td>{{$unidad_informe}}</td>
                    <td>{{$unidad_certificado}}</td>
                    <td>{{$unidad_salida}}</td>
                </tr>
                    <tr>
                        
                 <td>{{$fiscalia_peticiones}}</td>
                 <td>{{$fiscalia_atendidas}}</td>
                 <td>{{$fiscalia_pendientes}}</td>
                 <td>{{$fiscalia_dictamen}}</td>
                 <td>{{$fiscalia_informe}}</td>
                 <td>{{$fiscalia_certificado}}</td>
                 <td>{{$fiscalia_salida}}</td>
             </tr>
                    
             <tr style="background-color:#c09f77; color:white;">
                        
                 <td> <b> {{$unidad_peticiones + $fiscalia_peticiones}}</b></td>
                 <td> <b>{{$unidad_atendidas + $fiscalia_atendidas}}</b></td>
                 <td><b>{{$unidad_pendientes + $fiscalia_pendientes}}</b></td>
                 <td><b>{{$unidad_dictamen + $fiscalia_dictamen}}</b></td>
                 <td><b>{{$unidad_informe + $fiscalia_informe}}</b></td>
                 <td><b>{{$unidad_certificado + $fiscalia_certificado}}</b></td>
                 <td><b>{{$fiscalia_salida + $fiscalia_salida}}</b></td>
             </tr>
         </table>
         
--}}



      </div>
   </div>





@endsection

@section('js')
   <script type="text/javascript">
      $('.li-registrar-cadena').removeClass('active');
      $('.li-consultar-cadena').addClass('active');
      $('.a-disabled').bind('click', false);
   </script>

   <script type="text/javascript" src="{{asset('js/etiqueta.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script>
  
   <script type="text/javascript" src="{{asset('js/peticiones/peticion_diaria.js')}}" ></script>


@endsection
