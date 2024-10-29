<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;

class EntradaAccionController extends Controller
{
    public function cadena_reset(Cadena $cadena){
        if( $cadena->prestamos->isNotEmpty() ){
            return response()->json([
                'status' => false
            ]); 
        }

        $cadena->entrada->delete();
        $cadena->folio_bodega = null;
        $cadena->editar = 'si';
        $cadena->estado = 'revision';
        $cadena->save();

        return response()->json([
            'status' => true
        ]);
    }
}
