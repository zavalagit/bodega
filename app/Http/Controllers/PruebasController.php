<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use QrCode;
use App\Baja;
use App\Cadena;
use App\Cedula;
use App\Entrada;
use App\Prestamo;
use App\User;
use App\Indicio;


class PruebasController extends Controller
{

    public function peritos(){

		$users = User::where('unidad_id','=',1)->get();

		return view('bodega.pruebas',[
			'users' => $users,
		]);
    }


    public function balistico(){


        $cadenas = Cadena::where('estado','validada')->with('entrada')->whereHas('entrada',function($q){
            $q->where('naturaleza_id',4);
         })->get();



        $no=0;

        foreach ($cadenas as $key => $cadena) {

            foreach ($cadena->indicios as $key => $indicio) {
                $no = $no + $indicio->numero_indicios;
            }
        }

        echo "No. balistico = {$no}";





    }


    public function informe(){

        //$fiscalia


    	$cadenas = Cadena::where('fiscalia_id',3)->with('entrada')->whereHas('entrada',function($q){
            $q->where('tipo','indicio')->whereBetween('fecha',['2018-10-31','2018-11-30']);
         })->get();

         $n_indicios = 0;
         foreach ($cadenas as $key => $cadena) {

         	foreach ($cadena->indicios as $key => $indicio) {
         		# code...
         		$n_indicios = $n_indicios + $indicio->numero_indicios;
         	}
         }

         echo "Indicios: {$n_indicios}";

         echo "<br>";


         $cadenas = Cadena::where('fiscalia_id',3)->with('entrada')->whereHas('entrada',function($q){
            $q->where('tipo','evidencia')->whereBetween('fecha',['2018-10-31','2018-11-30']);
         })->get();


		$n_evidencias = 0;
         foreach ($cadenas as $key => $cadena) {

         	foreach ($cadena->indicios as $key => $indicio) {
         		# code...
         		$n_evidencias = $n_evidencias + $indicio->numero_indicios;
         	}
         }

         echo "Evidencias: {$n_evidencias}";

         echo "<br>";


         $cadenas = Cadena::where('fiscalia_id',3)->with('entrada')->whereHas('entrada',function($q){
            $q->whereBetween('fecha',['2018-10-31','2018-11-30']);
         })->get();

        $total = 0;
         foreach ($cadenas as $key => $cadena) {

         	foreach ($cadena->indicios as $key => $indicio) {
         		# code...
         		$total = $total + $indicio->numero_indicios;
         	}
         }

         echo "Total: {$total}";
         echo "<br>";
         echo "<br>";




         $prestamos = Prestamo::whereBetween('prestamo_fecha',['2018-10-31','2018-11-30'])->with('cadena')->whereHas('cadena',function($q){
         		$q->where('fiscalia_id',3);
         })->get();

         $n_ip= $prestamos->sum('prestamo_numindicios');

         echo "No. indicios prestamo = {$n_ip}";
         echo "<br>";


      $reingresos = Prestamo::whereBetween('reingreso_fecha',['2018-10-31','2018-11-30'])->with('cadena')->whereHas('cadena',function($q){
         		$q->where('fiscalia_id',3);
         })->get();

         $n_ir= $reingresos->sum('reingreso_numindicios');

         echo "No. indicios reingreso = {$n_ir}";
         echo "<br>";
         echo "<br>";


         $bajas = Baja::whereBetween('fecha',['2018-10-31','2018-11-30'])->with('cadena')->whereHas('cadena',function($q){
                $q->where('fiscalia_id',3);
         })->get();

         $n_bajas = $bajas->sum('numero_indicios');


         echo "Bajas = {$n_bajas}";
    }


    public function andres(){

        set_time_limit(0);

      $indicios = Indicio::where('descripcion','like','% 9%')->with('cadena')->whereHas('cadena',function($q){
          $q->where('fiscalia_id',4)->where('folio_bodega','like','19-%')->with('entrada')->whereHas('entrada',function($c){
              $c->where('naturaleza_id',4);
          });
       })->get();

/*
        $indicios = Indicio::where('descripcion','like','%38 super%')->with('cadena')->whereHas('cadena',function($q){
            $q->where('fiscalia_id',4)->with('entrada')->whereHas('entrada',function($c){
                $c->where('naturaleza_id',4);
            });
         })->orWhere('descripcion','like','%38 auto%')->with('cadena')->whereHas('cadena',function($q){
            $q->where('fiscalia_id',4)->with('entrada')->whereHas('entrada',function($c){
                $c->where('naturaleza_id',4);
            });
         })->take(600)->get();
*/

        $indicios = $indicios->sortBy(function($indicio){
            return $indicio->cadena->folio_bodega;
        });


         $pdf = PDF::loadView('pdf.223', compact('indicios'));

         return $pdf->stream();
    }

    public function geolocalizacion(){

      return view('pruebas.geolocalizacion');

    }



    public function contador(){
       
/*
        $cadenas = Cadena::where('estado','validada')
                            ->where('fiscalia_id',1)
                            ->whereHas('entrada',function($q){
                                $q->where('naturaleza_id',1)
                                ->whereBetween('fecha',['2017-01-01','2019-12-31']);
                            })
                            
                            ->whereHas('indicios',function($q){
                                $q->whereIn('estado',['baja']);
                            })
                            ->whereHas('bajas',function($q){
                                $q->where('concepto','like',"%fgr%")
                                ->orWhere('concepto','like',"%pgr%");
                            })
                            ->get();

*/


            $cadenas = Cadena::where('estado','validada')
                            //->where('fiscalia_id',1)
                            ->whereHas('entrada',function($q){
                                $q->where('naturaleza_id',2)
                                ->whereBetween('fecha',['2017-01-01','2019-12-31']);
                            })

                            ->whereHas('indicios',function($q){
                                $q->whereIn('estado',['baja']);
                            })
                            /*
                            ->whereHas('bajas',function($q){
                                $q->where('concepto','like',"%militar%");
                            })
                            */
                            ->get();

            
        

        
        //dd('Baja de cadenas de Armas Cortas: '.$cadenas->count());
        echo "Total Cadenas = {$cadenas->unique()->count()} <br><br>";

        $n = 1;
        foreach ($cadenas as $key => $cadena) {
            foreach ($cadena->bajas as $key => $baja) {
                echo "{$n}.- {$cadena->folio_bodega} - {$baja->concepto} <br>";
                ++$n;
            }
        }

    }




    

}
