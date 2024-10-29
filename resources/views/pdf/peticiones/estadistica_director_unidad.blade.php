<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.css">
    <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/tablas.css">

    <style>
        @page{
          margin-left: 1.5cm !important;
          margin-right: 1.5cm !important;
          margin-top: 10% !important;
          margin-bottom: 10% !important;
        }
        html{
          margin:0;
        }
        body{
          margin: 0;
          padding: 0;
          margin-top: 1%;
          margin-bottom: 2%
        }
        header{
          margin: 0;
          padding: 0;
          position: fixed;
          top: -8%;
          right:0;
          left: 0%;
          bottom: 0;

        }
        header h3{
          background-color: #152F4A ;
          color: white;
          padding-top: 7px ;
          padding-bottom: 7px ;
          text-align: right;
          padding-right: 7px;
          font-size: 15px;
        }
        .header-img{
          position: fixed;
          top: -8%;
          right:0;
          left: 4%;
          bottom: 0;

        }
        .fecha-encabezado{
            margin: 0 !important;
        }
        .fecha-encabezado h5{
            text-align: center;
            background-color: #152f4a;
            color: #c09f77;
            padding-top: 6px;
            padding-bottom: 6px;
        }

        #titulo h3 {

          background-color: #c09f77;
          color: #152F4A;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;
          margin: 0 !important;
        }
      
        
        .encabezado h6{

          background-color: #394049;
          color: #c6c6c6;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;

        }

        table th,table td{
            border: 1px solid #394049 !important;
            font-size: 10px !important;
        }
        
        caption{
            border: 1px solid #394049 !important;
  background-color: #c09f77 !important;
  color: #c09f77;
}

.td-izq{
        width: 80% !important;
        text-align:left;
        padding-left:3% !important;
    }
    .td-der{
        width:20% !important;
        text-align:right;
        padding-right:10% !important;
    }
    .td-izq-total{
        text-align:center;
        
        color:#394049 !important;
    }
    .td-der-total{
      
        text-align:right;
        padding-right:10% !important;
        color:#394049 !important;
    }
    .td-sub{
      background-color: #c6c6c6;
      color: white;
    }

    section{
  page-break-inside:avoid !important;
}

    </style>
  </head>

<body >
    <header>
      <h3><b>FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN</b></h3>
    </header>

    <div class="header-img">
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_fge_pdf.png" alt=""  width="100">
    </div>


    <main>
      <div id="titulo">
        @if ($lugar === 'unidad')
          <h3><b>{{$unidad->nombre}}</b></h3>
        @elseif($lugar === 'fiscalia')
          <h3><b>{{$fiscalia->nombre}}</b></h3>
        @endif
        <h3><b>PETICIONES {{$fecha_encabezado}}</b></h3>
      </div>

      @include('peticiones.include_peticiones')

      @include('peticiones.include_rezago')
      
      @include('peticiones.include_documento_emitido')
      

      @php
          $n = 1;
          $array_especialidades = [];
          $otro_array = [];
          $total_documento_emitido= 0;
          foreach ($especialidades as $key => $especialidad){
              $array_especialidades[$especialidad->nombre] = [
                      'dictamen'=>0,
                      'informe'=>0,
                      'certificado'=>0,
                      'salida_juzgado'=>0,
                      'atendidas'=>0,
                      'cantidad_estudios'=>0,
              ];   
          }

          foreach ($peticiones_recibidas->whereIn('estado',['atendida','entregada']) as $peticion){
              if ( array_key_exists($peticion->solicitud->especialidad->nombre,$array_especialidades) ){
                      $array_especialidades[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;
                      $array_especialidades[$peticion->solicitud->especialidad->nombre]['atendidas'] += 1;
                      $array_especialidades[$peticion->solicitud->especialidad->nombre]['cantidad_estudios'] += $peticion->cantidad_estudios;
              }
              else {
                      array_push($otro_array,$peticion);
              }
          }
      @endphp
      <section>
        @include('peticiones.include_peticiones_especialidad')
      </section>
      
      
      
      @if ( (($lugar === 'unidad') && ($unidad->id == 2)) || ($lugar === 'fiscalia') )
        <section>
          @include('peticiones.include_necropsias_table')
        </section>
      @endif
      
{{--      
        @php
            $array_necropsia_tipo = array(
               'suicidio' => 0,
               'dolosa' => 0,
               'hecho_transito' => 0,
               'patologia_otra' => 0
            );
        @endphp
        @foreach ($peticiones_total as $peticion)
           @isset($peticion->necropsia_id)
               @php
                   $array_necropsia_tipo[$peticion->necropsia->necropsia_tipo] += 1;
               @endphp
           @endisset
        @endforeach

      
      @if ($unidad->id == 2)
        <table>
          <caption><b>NECROPSIAS</b></caption>
          <tbody>
              @foreach ($array_necropsia_tipo as $key => $necropsia_tipo)
                <tr>
                    <td class="td-izq td-sub"><b>{{strtoupper($key)}}</b></td>
                    <td class="td-der td-sub"><b>{{$necropsia_tipo}}</b></td>
                </tr>
                    @foreach ($necropsias->where('necropsia_tipo',$key) as $necropsia)
                        <tr>
                            <td class="td-izq">{{$necropsia->nombre}}</td>
                            <td class="td-der">{{$peticiones_total->where('necropsia_id',$necropsia->id)->count()}}</td>
                        </tr>
                    @endforeach                
              @endforeach

              <tr>
                <td class="td-izq-total"><b>Total necropsias</b></td>
                <td class="td-der-total"><b>{{$peticiones_total->where('solicitud_id',61)->count()}}</b></td>
              </tr>

          </tbody>
        </table>
      @endif
   


        <table>
          <caption><b>PETICIONES POR ESPECIALIDAD</b></caption>
          <thead>
              <tr>
                  <th style="text-align:center;">Nº</th>
                  <th style="text-align:center;">Especialidad</th>
                  <th style="text-align:center;">Dictamen</th>
                  <th style="text-align:center;">Informe</th>
                  <th style="text-align:center;">Certificado</th>
                  <th style="text-align:center;">Salida a Juzgado</th>
                  <th style="text-align:center;">Total</th>
                  <th style="text-align:center;">Atendidas</th>
              </tr>
          </thead>
          <tbody>
              @php
                  $n = 1;
                  $especialidades_array = [];
                  $otro_array = [];
                  $total_atendidas = 0;
                  foreach ($especialidades as $key => $especialidad) {
                      $especialidades_array[$especialidad->nombre] = ['dictamen'=>0,'informe'=>0,'certificado'=>0,'salida_juzgado'=>0,'atendidas'=>0];   
                  }

                  foreach ($peticiones_total->whereIn('estado',['atendida','entregada']) as $peticion){
                      if ( array_key_exists($peticion->solicitud->especialidad->nombre,$especialidades_array) ){
                          $especialidades_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += $peticion->cantidad_estudios;
                          $especialidades_array[$peticion->solicitud->especialidad->nombre]['atendidas'] += 1;
                      }
                      else {
                          array_push($otro_array,$peticion);
                      }
                  }
              @endphp

              @foreach ($especialidades as $especialidad)
                  <tr>
                      <td style="text-align:center">{{$n++}}</td>
                      <td style="text-align:left; padding-left:3% !important;">{{$especialidad->nombre}}</td>
                      <td style="text-align:right; padding-right:3% !important;">{{$especialidades_array[$especialidad->nombre]['dictamen']}}</td>
                      <td style="text-align:right; padding-right:3% !important;">{{$especialidades_array[$especialidad->nombre]['informe']}}</td>
                      <td style="text-align:right; padding-right:3% !important;">{{$especialidades_array[$especialidad->nombre]['certificado']}}</td>
                      <td style="text-align:right; padding-right:3% !important;">{{$especialidades_array[$especialidad->nombre]['salida_juzgado']}}</td>
                      <td style="text-align:right; padding-right:3% !important;""><b>{{array_sum($especialidades_array[$especialidad->nombre]) - $especialidades_array[$especialidad->nombre]['atendidas']}}</b></td>
                      <td style="text-align:right; padding-right:3% !important;">{{$especialidades_array[$especialidad->nombre]['atendidas']}}</td>
                  </tr>
                  @php
                      $total_atendidas = $total_atendidas + array_sum($especialidades_array[$especialidad->nombre]) - $especialidades_array[$especialidad->nombre]['atendidas']; 
                  @endphp
              @endforeach
              <tr style="background-color:#c09f77;">
                  <td colspan="2" style="text-align:center"> <b>TOTAL</b> </td>
                  <td style="text-align:right; padding-right:3% !important;"><b>{{array_sum(array_column($especialidades_array,'dictamen'))}}</b></td>
                  <td style="text-align:right; padding-right:3% !important;"><b>{{array_sum(array_column($especialidades_array,'informe'))}}</b></td>
                  <td style="text-align:right; padding-right:3% !important;"><b>{{array_sum(array_column($especialidades_array,'certificado'))}}</b></td>
                  <td style="text-align:right; padding-right:3% !important;"><b>{{array_sum(array_column($especialidades_array,'salida_juzgado'))}}</b></td>
                  <td style="text-align:right; padding-right:3% !important;"><b>{{array_sum(array_column($especialidades_array,'atendidas'))}}</b></td>
                  <td style="text-align:right; padding-right:3% !important;"> <b>{{$total_atendidas}}</b> </td>
              </tr>
          </tbody>
      </table>


                    
      @if (!empty($otro_array))
        <table>
          <caption><b>OTROS</b></caption>
          <thead>
            <tr>
                <th style="text-align:center;">N°</th>
                <th style="text-align:center;">Especialidad</th>
                <th style="text-align:center;">Dictamen</th>
                <th style="text-align:center;">Informe</th>
                <th style="text-align:center;">Certificado</th>
                <th style="text-align:center;">Salida a Juzgado</th>
                <th style="text-align:center;">Total</th>
            </tr>
          </thead>
          <tbody>
            @php
              $n = 1;
              $total_atendidas_otras = 0;
              $especialidades_otras_array = [];
              foreach ($otro_array as $key => $peticion) {
                if ( !array_key_exists($peticion->solicitud->especialidad->nombre,$especialidades_otras_array) ){
                  $especialidades_otras_array[$peticion->solicitud->especialidad->nombre] = ['dictamen'=>0,'informe'=>0,'certificado'=>0,'salida_juzgado'=>0];
                  $especialidades_otras_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;
                }
                else{
                  $especialidades_otras_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;
                }
              }
            @endphp
            @foreach ($especialidades_otras_array as $key => $peticion)
              <tr>
                <td>{{$n++}}</td>
                <td>{{$key}}</td>
                <td>{{$peticion['dictamen']}}</td>
                <td>{{$peticion['informe']}}</td>
                <td>{{$peticion['certificado']}}</td>
                <td>{{$peticion['salida_juzgado']}}</td>
                <td>{{array_sum($especialidades_otras_array[$key])}}</td>
              </tr>
              @php
                $total_atendidas_otras += array_sum($especialidades_otras_array[$key]);
              @endphp
            @endforeach
              <tr style="background-color:#c09f77;">
                <td colspan="2"> <b>TOTAL</b> </td>
                <td>{{array_sum(array_column($especialidades_otras_array,'dictamen'))}}</td>
                <td>{{array_sum(array_column($especialidades_otras_array,'informe'))}}</td>
                <td>{{array_sum(array_column($especialidades_otras_array,'certificado'))}}</td>
                <td>{{array_sum(array_column($especialidades_otras_array,'salida_juzgado'))}}</td>
                <td>{{$total_atendidas_otras}}</td>
              </tr>
          </tbody>
        </table>
      @endif


--}}


  </main>

      
</body>
</html>
