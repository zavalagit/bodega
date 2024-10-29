<?php

namespace App\Http\Controllers\PDF;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use PDF;
use QrCode;
use App\Baja;
use App\Cadena;
use App\Entrada;
use App\Prestamo;
use App\User;

class AnexosController extends Controller
{
    public function anexo3(Request $request, $id_cadena = 0){
        set_time_limit(0);
        $cadena = Cadena::find($id_cadena);
        //QrCode::generate('Transfórmame en un QrCode!', public_path('codigoQr/codigoqr.png'));
        // QrCode::format('png');
        // QrCode::size(100);
        // QrCode::color(0,0,0);
        // QrCode::errorCorrection('M');
        // QrCode::generate("http://201.116.252.147/codigoQR/{$cadena->id}", '../public/codigoQr/codigoqr.png');
        
        
        $pdf = PDF::loadView('pdf.anexos.anexo3', compact('cadena'));
        if($request->hoja_tipo === 'oficio')
            $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function anexo4(Request $request, $id_cadena = 0){
        set_time_limit(0);
        $cadena = Cadena::find($id_cadena);
        // QrCode::format('png');
        // QrCode::size(100);
        // QrCode::color(0,0,0);
        // QrCode::errorCorrection('M');
        // QrCode::generate("http://201.116.252.147/codigoQR/{$cadena->id}", '../public/codigoQr/codigoqr.png');

        $pdf = PDF::loadView('pdf.anexos.anexo4', compact('cadena'));
        if($request->hoja_tipo === 'oficio')
            $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
