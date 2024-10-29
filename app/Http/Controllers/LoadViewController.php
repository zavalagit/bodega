<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Indicio;

class LoadViewController extends Controller
{
    #foto
    public function load_foto_form($modelo, $modelo_id){
        return view('foto.foto_form_modal',compact('modelo','modelo_id'));
    }

    #baja
    public function load_view_baja_parcial_tr(Indicio $indicio){
        return view('baja.baja_parcial.baja_parcial_view_tr',compact('indicio'));
    }
    #prestamo
    public function load_view_reingreso_descripcion_disponible_tr(Indicio $indicio){
        return view('prestamo.reingreso_descripcion_disponible_view_tr',compact('indicio'));
    }
}
