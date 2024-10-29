{{-- {{dd('hay vamos')}} --}}

@extends('template.template')

@section('css')
<link rel="stylesheet" href="{{asset('css/table.css')}}">
@endsection

@section('title') 
@endsection

@section('header')
@endsection

@section('main')

<div class="row">
   <div class="col s12">
      <table>
         <caption>INDICIOS/EVIDENCIAS POR REGIÓN</caption>
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
            @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
               <tr>
                  <td class="td-index">{{$i +1}}</td>
                  <td style="background-color: #394049; color: #fff !important;" class="td-bold">{{$region->nombre}}</td>
                  <td class="td-numero td-bold">{{number_format($region->indicios_tipo(['indicio']))}}</td>
                  <td class="td-numero td-bold">{{number_format($region->indicios_tipo(['evidencia']))}}</td>
                  <td class="td-numero td-total">{{number_format($region->indicios_tipo(['indicio','evidencia']))}}</td>
                </tr>
            @endforeach
         </tbody>
         <tfoot>
            <tr>
               <td class="td-index">{{$i+2}}</td>
               <td class="td-total">TOTAL</td>
               <td class="td-numero td-total">{{number_format(App\Fiscalia::indicios_total(0,['indicio']))}}</td>
               <td class="td-numero td-total">{{number_format(App\Fiscalia::indicios_total(0,['evidencia']))}}</td>
               <td class="td-numero td-total-resaltar">{{number_format(App\Fiscalia::indicios_total(0,['indicio','evidencia']))}}</td>
            </tr>
         </tfoot>
      </table>
   </div>
</div>

<div class="row">
   <div class="col s12">
      <table>
         <caption>INDICIOS/EVIDENCIAS POR NATURALEZA</caption>
         <thead>
            <tr>
               <th rowspan="2" style="text-align: center;">Nº</th>
               <th rowspan="2" style="padding-left: 10px !important;">NATURALEZA</th>
               <th colspan="{{$regiones->count()}}" style="text-align: center;">REGIONES</th>
               <th rowspan="2">TOTAL</th>
            </tr>
            <tr>
               @foreach ($regiones->sortBy('nombre') as $region)
                  <th>{{$region->nombre}}</th>
               @endforeach
            </tr>
         </thead>
         <tbody>
            @foreach ($naturalezas->sortBy('nombre')->values() as $i => $naturaleza)
               <tr>
                  <td class="td-index">{{$i +1}}</td>
                  <td style="background-color: #394049; color: #fff !important;" class="td-bold">{{$naturaleza->nombre}}</td>
                  @foreach ($regiones->sortBy('nombre') as $region)
                     <td class="td-numero td-bold">{{number_format($naturaleza->indicios_region($region->id))}}</td>               
                  @endforeach
                  <td class="td-numero td-total">{{number_format(App\indicio::indicios_naturaleza($naturaleza->id))}}</td>
                </tr>
            @endforeach
         </tbody>
         <tfoot>
            <tr>
               <td class="td-index">{{$i + 2}}</td>
               <td class="td-total">TOTAL</td>
               @foreach ($regiones->sortBy('nombre') as $region)
                  <td class="td-numero td-total">{{number_format(App\Fiscalia::indicios_total($region->id,['indicio','evidencia']))}}</td>               
               @endforeach
               <td class="td-numero td-total-resaltar">{{number_format(App\indicio::indicios_naturaleza(0))}}</td>
            </tr>
         </tfoot>
      </table>
   </div>
</div>


@endsection

@section('js')
@endsection
