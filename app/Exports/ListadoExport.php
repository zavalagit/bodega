<?php

namespace App\Exports;

use App\Cadena;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ListadoExport implements FromView
{
    public function view(): View
    {

        $cadenas = Cadena::where('fiscalia_id',6)
                        ->where('estado','validada')
                        ->whereHas('entrada',function($a){
                            $a->where('naturaleza_id',17);
                        })
                        ->get();

        $cadenas = $cadenas->sortBy('folio_bodega');

        //dd($cadenas);

        return view('excel.listado', [
            'cadenas' => $cadenas
        ]);
    }
}
