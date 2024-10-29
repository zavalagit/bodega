<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Prestamo;

class QrController extends Controller
{
    public function codigo_qr($id){
    	$id = (int)$id;
    	$cadena = Cadena::find($id);

    	$link="";

    	if($cadena->estado == 'validada'){
    		$link = "http://201.116.252.147:8000/bodega/entradas?filtro=3&buscar={$cadena->folio_bodega}";
    	}
    	elseif($cadena->estado == 'revision') {
    		$link = "http://201.116.252.147:8000/bodega/revisar?buscar={$cadena->id}";
    	}
        elseif ($cadena->estado == 'espera') {
            $link = "http://201.116.252.147:8000/bodega/cadenas-espera?buscar={$cadena->folio_bodega}";   
        }

    	return redirect($link);
    }


    public function codigo_qr_prestamo($id){
        $prestamo = Prestamo::find($id);

        $link="";

        if($prestamo->estado == 'activo'){
            $link = "http://201.116.252.147:8000/bodega/reingreso/{$prestamo->id}";   
        }
        elseif ($prestamo->estado == 'conluso') {
            $link = "http://201.116.252.147:8000/bodega/editar-prestamo/{$prestamo->id}";      
        }

        return redirect($link);
    }

}
