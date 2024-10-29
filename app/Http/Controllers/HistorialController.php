<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cadena;
use App\Bparcial;
use App\Bdefinitiva;
use App\Prestamo;

class HistorialController extends Controller
{
   public function historial(Cadena $cadena){

		// $fotos = $cadena->entrada->fotografias;
		// dd($fotos);

		return view('cadena.cadena_historial',[
			'cadena' => $cadena,
		]);
   }
}
