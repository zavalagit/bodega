<?php

namespace App\Exports;

use App\Cadena;
use App\Indicio;
use App\Peticion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CadenasExport implements FromView
{
    public function view(): View
    {
        $peticiones = Peticion::whereYear('fecha_sistema','2020')
        ->whereMonth('fecha_sistema','05')
        ->where('fiscalia2_id',4)
        ->where('unidad_id',1)
        ->get();

/*
        $indicios = Indicio::whereHas('cadena',function($a){
            $a->where('fiscalia_id',4)->where('estado','validada');
        })
        ->get();

        /*
        //dd($cadenas);
        $indicios = $indicios->sortBy(function($indicio, $key){
            return $indicio->cadena->folio_bodega;
        });
        //$cadenas = $cadenas->sort(function($cadena->)
        */
        return view('pdf.listado_anio', [
            'peticiones' => $peticiones
        ]);
    }
}