@extends( ( Auth::user()->tipo == 'administrador' ) ? 'administrador.plantillafiscalia' : 'bodega.plantilla')

@section('css')
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">

   <style media="screen">
      
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
      
      
      .fa:hover{
         font-size: 1.3em;
      }
      .icon-check:hover{
         font-size: 1.5em;
      }

      body {
         overflow-x: scroll; /*horizontal scroll*/
          overflow-y: scroll; /*vertical scroll*/
}
  

   

   a.accion{
      border-radius: 0 !important;
      background-color: rgba(255, 255, 255, 0) !important;
      border: 1px solid rgb(50, 162, 170) !important;
      color: black !important;
   }
   a.accion:hover{
      background-color: rgb(50, 162, 170) !important;
      color: white !important;
   }

   


   

     .btn{
         background-color: #bdbdbd;
      }

      
      #tabla-indicios, #tabla-indicios td{
         border: 1px solid #c09f77 !important;
      }
      #tabla-indicios td{
         padding-left: 5px !important;
      }

      button{
         border: none;
         background-color: rgb(255, 255, 255,0.0);
      }



   



      .loader-page {
    position: fixed;
    z-index: 25000;
    background: rgb(255, 255, 255);
    left: 0px;
    top: 0px;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition:all .3s ease;
  }
  .loader-page::before {
    content: "";
    position: absolute;
    border: 2px solid rgb(50, 150, 176);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-sizing: border-box;
    border-left: 2px solid rgba(50, 150, 176,0);
    border-top: 2px solid rgba(50, 150, 176,0);
    animation: rotarload 1s linear infinite;
    transform: rotate(0deg);
  }
  @keyframes rotarload {
      0%   {transform: rotate(0deg)}
      100% {transform: rotate(360deg)}
  }
  .loader-page::after {
    content: "";
    position: absolute;
    border: 2px solid rgba(50, 150, 176,.5);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-sizing: border-box;
    border-left: 2px solid rgba(50, 150, 176, 0);
    border-top: 2px solid rgba(50, 150, 176, 0);
    animation: rotarload 1s ease-out infinite;
    transform: rotate(0deg);
  }


  *,*::after, *::before{
     margin: 0;
     padding: 0;
     -webkit-box-sizing: border-box;
     box-sizing: border-box;
  }

  #loading-section{
     background-color: rgba(250, 240, 245, 0.9);
     height: 100%;
     width: 100%;
     position: fixed;
     -webkit-transition: all 1s ease;
     z-index: 10000;
  }

  #loading-div{
   border-top: 16px solid #152f4a;
  border-right: 16px solid #c09f77;
  border-bottom: 16px solid #394049;
  border-left: 16px solid #c6c6c6;
     height: 100px;
     width: 100px;
     border-radius: 100%;

     position: absolute;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     margin: auto;

     -webkit-animation: girar 1.5s linear infinite;
     -o-animation: girar 1.5s linear infinite;
     animation: girar 1.5s linear infinite;
  }


  @keyframes girar{
     from{ transform: rotate(0deg); }
     to{ transform: rotate(360deg); }
  }

  #loading-section{
     visibility:hidden;
     opacity:0
   }

   </style>
@endsection

@section('titulo')
   INVENTARIO INDICIOS/EVIDENCIAS
@endsection
@section('seccion', 'INVENTARIO INDICIOS/EVIDENCIAS')


@section('contenido')


<section id="loading-section">
   <div id="loading-div"></div>
</section>



{{-- <section>
   <div class="row">
      <div class="col s12 m6 l8" style="background-color:#152f4a;color:#c09f77 !important;font-size:20px !important;">
         <h6><b>Datos del día {{date_format($i_fiscalias->first()->created_at, 'd-m-Y')}} a las {{date_format($i_fiscalias->first()->created_at, 'H:i:s')}}</b></h6>
      </div>
      <div class="col s12 m6 l4" style="background-color:#394049;color:#c09f77 !important; text-align:center">
         <h6><a id="inventario-actualizar" href="/inventario-general-generar"><i style="color:#c6c6c6;" class="fas fa-redo-alt"></i></a> <span>(actualizar)</span></h6>
      </div>
   </div>
</section> --}}




{{-- Indicios/Evidencias Activos  --}}
<div class="row">
   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th style="text-align: center;">Nº</th>
               <th style="padding-left: 10px !important;">REGIÓN</th>
               <th style="text-align: center;">INDICIOS</th>
               <th style="text-align: center;">EVIDENCIAS</th>
               <th style="text-align: center;">TOTAL</th>
            </tr>
         </thead>
         <tbody>
            @php $n = 1; @endphp
            @foreach ($i_fiscalias as $i_fiscalia)
               <tr>
                  <td width="80" class="td-contador">{{$n++}}</td>
                  <td style="background-color: #152f4a; color: #fff !important; padding-left: 10px !important;"><b>{{$i_fiscalia->fiscalia->nombre}}</b></td>
                  <td class="td-numero" style="background-color: #c6c6c6;">{{number_format($i_fiscalia->indicio_activo)}}</td>
                  <td class="td-numero" style="background-color: #c6c6c6;">{{number_format($i_fiscalia->evidencia_activo)}}</td>
                  <td class="td-numero td-total"><b>{{number_format($i_fiscalia->indicio_activo + $i_fiscalia->evidencia_activo)}}</b></td>
               </tr>
            @endforeach
            <tr class="tr-total">
               <td class="td-contador">{{$n}}</td>
               <td style="padding-left: 10px !important;"><b>TOTAL</b></td>
               <td class="td-numero"><b>{{number_format( $i_fiscalias->sum('indicio_activo') )}}</b></td>
               <td class="td-numero"><b>{{number_format( $i_fiscalias->sum('evidencia_activo')  )}}</b></td>
               <td class="td-numero"><b>{{number_format( $i_fiscalias->sum('indicio_activo') + $i_fiscalias->sum('evidencia_activo') )}}</b></td>
            </tr>
         </tbody>
      </table>
      <br>
      <table>
         <thead>
            <tr>
               <th rowspan="2" style="text-align: center;">Nº</th>
               <th rowspan="2" style="padding-left: 10px !important;">NATURALEZA</th>
               <th colspan="{{$naturalezas->count()}}" style="text-align: center;">REGIÓN</th>
            </tr>
            <tr>
               @foreach ($fiscalias as $fiscalia)
                  <th style="text-align: right !important; padding-right: 10px !important;">{{$fiscalia->nombre}}</th>
               @endforeach
               <th style="text-align: right !important; padding-right: 10px !important;">TOTAL</th>
            </tr>
         </thead>
         <tbody>
            @php $n = 1; @endphp
            @foreach ($naturalezas as $naturaleza)
               <tr>
                  <td width="80" class="td-contador">{{$n++}}</td>
                  <td style="background-color: #152f4a; color: #fff !important; padding-left: 10px !important;"><b>{{$naturaleza->nombre}}</b></td>
                  @foreach ($fiscalias as $fiscalia)
                     @php
                        $registro = $i_naturalezas->where('naturaleza_id',$naturaleza->id)->where('fiscalia_id',$fiscalia->id)->first(); 
                     @endphp
                     <td style="background-color: #c6c6c6;" class="td-numero">{{number_format($registro->activo)}}</td>
                  @endforeach
                  <td class="td-numero td-total">{{number_format($i_naturalezas->where('naturaleza_id',$naturaleza->id)->sum('activo'))}}</td>
               </tr>
            @endforeach
           <tr class="tr-total">
              <td class="td-contador">{{$n++}}</td>
              <td style="padding-left: 10px !important;">TOTAL</td>
              @foreach ($fiscalias as $fiscalia)
                  <td class="td-numero">{{number_format($i_naturalezas->where('fiscalia_id',$fiscalia->id)->sum('activo'))}}</td>
              @endforeach
              <td class="td-numero">{{number_format($i_naturalezas->sum('activo'))}}</td>
           </tr>
         </tbody>
      </table>
   </div>
</div>

<div class="row">
   <div class="col s12">
      <hr class="hr-main">
   </div>
</div>

{{-- Indicios/Evidencias Prestamo  --}}
<div class="row">
   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th style="text-align: center;">Nº</th>
               <th style="padding-left: 10px !important;">REGIÓN</th>
               <th style="text-align: center;">INDICIOS</th>
               <th style="text-align: center;">EVIDENCIAS</th>
               <th style="text-align: center;">TOTAL</th>
            </tr>
         </thead>
         <tbody>
            @php $n = 1; @endphp
            @foreach ($i_fiscalias as $i_fiscalia)
               <tr>
                  <td width="80" class="td-contador">{{$n++}}</td>
                  <td style="background-color: #152f4a; color: #fff !important; padding-left: 10px !important;"><b>{{$i_fiscalia->fiscalia->nombre}}</b></td>
                  <td class="td-numero" style="background-color: #c6c6c6;">{{number_format($i_fiscalia->indicio_prestamo)}}</td>
                  <td class="td-numero" style="background-color: #c6c6c6;">{{number_format($i_fiscalia->evidencia_prestamo)}}</td>
                  <td class="td-numero td-total"><b>{{number_format($i_fiscalia->indicio_prestamo + $i_fiscalia->evidencia_prestamo)}}</b></td>
               </tr>
            @endforeach
            <tr class="tr-total">
               <td class="td-contador">{{$n}}</td>
               <td style="padding-left: 10px !important;"><b>TOTAL</b></td>
               <td class="td-numero"><b>{{number_format( $i_fiscalias->sum('indicio_prestamo') )}}</b></td>
               <td class="td-numero"><b>{{number_format( $i_fiscalias->sum('evidencia_prestamo')  )}}</b></td>
               <td class="td-numero"><b>{{number_format( $i_fiscalias->sum('indicio_prestamo') + $i_fiscalias->sum('evidencia_prestamo') )}}</b></td>
            </tr>
         </tbody>
      </table>
      <br>
      <table>
         <thead>
            <tr>
               <th rowspan="2" style="text-align: center;">Nº</th>
               <th rowspan="2" style="padding-left: 10px !important;">NATURALEZA</th>
               <th colspan="{{$naturalezas->count()}}" style="text-align: center;">REGIÓN</th>
            </tr>
            <tr>
               @foreach ($fiscalias as $fiscalia)
                  <th style="text-align: right !important; padding-right: 10px !important;">{{$fiscalia->nombre}}</th>
               @endforeach
               <th style="text-align: right !important; padding-right: 10px !important;">TOTAL</th>
            </tr>
         </thead>
         <tbody>
            @php $n = 1; @endphp
            @foreach ($naturalezas as $naturaleza)
               <tr>
                  <td width="80" class="td-contador">{{$n++}}</td>
                  <td style="background-color: #152f4a; color: #fff !important; padding-left: 10px !important;"><b>{{$naturaleza->nombre}}</b></td>
                  @foreach ($fiscalias as $fiscalia)
                     @php
                        $registro = $i_naturalezas->where('naturaleza_id',$naturaleza->id)->where('fiscalia_id',$fiscalia->id)->first(); 
                     @endphp
                     <td style="background-color: #c6c6c6;" class="td-numero">{{number_format($registro->prestamo)}}</td>
                  @endforeach
                  <td class="td-numero td-total">{{number_format($i_naturalezas->where('naturaleza_id',$naturaleza->id)->sum('prestamo'))}}</td>
               </tr>
            @endforeach
           <tr class="tr-total">
              <td class="td-contador">{{$n++}}</td>
              <td style="padding-left: 10px !important;">TOTAL</td>
              @foreach ($fiscalias as $fiscalia)
                  <td class="td-numero">{{number_format($i_naturalezas->where('fiscalia_id',$fiscalia->id)->sum('prestamo'))}}</td>
              @endforeach
              <td class="td-numero">{{number_format($i_naturalezas->sum('prestamo'))}}</td>
           </tr>
         </tbody>
      </table>
   </div>
</div>


@endsection

@section('js')
   
   <script src="{{asset('js/loading/loading.js')}}" charset="utf-8"></script>


@endsection
