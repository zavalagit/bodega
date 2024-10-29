<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parentesco;

class ParentescoController extends Controller
{
    public function colectivo_form_parentesco(Request $request, $accion){
        return view('colectivo.colectivo_form_parentesco',[
            'parentescos' => Parentesco::all(),
            'accion' => $accion,
        ]);
    }

    public function colectivo_form_parentesco_otro(Request $request, $accion){
        return view('colectivo.colectivo_form_parentesco_otro', ['accion' => $accion]);
    }
}
