<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use QrCode;
use App\Baja;
use App\Cadena;
use App\Entrada;
use App\Fiscalia;
use App\Prestamo;
use App\User;

class EstadisticaController extends Controller
{

  public function estadistica_mensual(Request $request){

    $year;
    $month;
    $mes;

    if ($request->has('fecha')) {
      $year = substr($request->fecha,0,4);
      $month = substr($request->fecha,5);
    }else{
      $year = date('Y') ;
      $month = date('m') ;
    }

    $fiscalias = Fiscalia::all();
    $entradas = Entrada::whereMonth('fecha',$month)->whereYear('fecha',$year)->get();
    $prestamos = Prestamo::whereMonth('prestamo_fecha',$month)->whereYear('prestamo_fecha',$year)->get();
    $bajas = Baja::whereMonth('fecha',$month)->whereYear('fecha',$year)->get();

    switch ($month) {
      case '01':
        $mes = 'ENERO';
        break;
      case '02':
        $mes = 'FEBRERO';
        break;
      case '03':
        $mes = 'MARZO';
        break;
      case '04':
        $mes = 'ABRIL';
        break;
      case '05':
        $mes = 'MAYO';
        break;
      case '06':
        $mes = 'JUNIO';
        break;
      case '07':
        $mes = 'JULIO';
        break;
      case '08':
        $mes = 'AGOSTO';
        break;
      case '09':
        $mes = 'SEPTIEMBRE';
        break;
      case '10':
        $mes = 'OCTUBRE';
        break;
      case '11':
        $mes = 'NOVIEMBRE';
        break;
      case '12':
        $mes = 'DICIEMBRE';
        break;

      default:
        // code...
        break;
    }



     return view('bodega.estadistica',[
       'fiscalias' => $fiscalias,
       'entradas' => $entradas,
       'prestamos' => $prestamos,
       'bajas' => $bajas,
       'mes' => $mes,
       'year' => $year,
     ]);
  }


    public function estadistica_entradas(Request $request){

      dd($request->all());



      /*
//      dd($entradas);
      $pdf = PDF::loadView('pdf.estadistica_entradas', compact(['entradas']));
      $pdf->setPaper('A4', 'landscape');
      return $pdf->stream();
      */
   }

   public function estadistica_baja(Request $request){
      $fecha1 = $request->fecha1;
      $fecha2 = $request->fecha2;
      $bajas = collect();

      $bajas_algo = Baja::whereBetween('fecha',[$fecha1,$fecha2])->get();
//      $bajas->load(['cadena->entrada' => function($query) {
//         $query->where('naturaleza_id',1)->orWhere('naturaleza_id',2)->get();
//      }]);
      foreach ($bajas as $key => $baja) {
         if($baja->cadena->entrada->naturaleza_id == 1 || $baja->cadena->entrada->naturaleza_id == 2){
            $bajas->push($baja);
         }
      }


      $pdf = PDF::loadView('pdf.estadistica_baja', compact(['bajas']));
      $pdf->setPaper('A4', 'landscape');
      return $pdf->stream();
   }

   public function estadistica_totales(Request $request){
      $fecha1 = $request->fecha1;
      $fecha2 = $request->fecha2;
      $suma = 0;
      $nprestamo = 0;
      $nbajas = 0;

      $entradas = Entrada::whereBetween('fecha',[[$fecha1,$fecha2]])->get();
      foreach ($entradas as $key => $entrada) {
         foreach ($entrada->cadena->indicios as $key => $indicio) {
            $suma = $suma + $indicio->numero_indicios;
         }
      }
      $prestamos = Prestamo::whereBetween('prestamo_fecha',[[$fecha1,$fecha2]])->get();
      foreach ($prestamos as $key => $prestamo) {
         $nprestamo = $nprestamo + $prestamo->prestamo_numindicios;
      }
      $bajas = Baja::whereBetween('fecha',[[$fecha1,$fecha2]])->get();
      foreach ($bajas as $key => $baja) {
         $nbajas = $nbajas + $baja->numero_indicios;
      }
      $nentrada = count($entradas);

    //  dd($suma);
      $pdf = PDF::loadView('pdf.estadistica_total', compact(['suma','nentrada','nbajas','nprestamo']));
      return $pdf->stream();

   }

}
