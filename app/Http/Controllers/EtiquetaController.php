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
use App\Indicio;
use App\Prestamo;
use App\User;

class EtiquetaController extends Controller
{
    public function etiqueta_get_indicios(Request $request, $id_cadena){
    	$cadena = Cadena::find($id_cadena);
    	return view('modal.formulario_para_modal_etiqueta',['cadena' => $cadena]);
    }

    public function etiqueta_pdf(Request $request,$id_cadena){
        // dd($request->all());

        $mensajes = [
            'etiqueta_general.required_without_all' => 'Indique el tipo de etiqueta.',
            'etiqueta_identificador.required_without_all' => 'Indique el tipo de etiqueta.',
            'etiqueta_indicios.required_without_all' => 'Indique el tipo de etiqueta.',
            'etiqueta_tamano.required' => 'Indique el tamaño de la etiqueta.',
        ];

        $request->validate([
            'etiqueta_general' => 'required_without_all:etiqueta_identificador,etiqueta_indicios',
            'etiqueta_identificador' => 'required_without_all:etiqueta_general,etiqueta_indicios',
            'etiqueta_indicios' => 'required_without_all:etiqueta_general,etiqueta_identificador',
            'etiqueta_tamano' => 'required',
        ],$mensajes);

        $cadena = Cadena::find($id_cadena);

        if($request->filled('etiqueta_general')){            
            switch ($request->etiqueta_tamano) {
                case 'chica':
                    $pdf = PDF::loadView('etiqueta.etiqueta_chica', compact('cadena'));            
                    break;
                case 'mediana':
                    $pdf = PDF::loadView('etiqueta.etiqueta_mediana', compact('cadena'));
                    break;
                case 'grande':
                    $pdf = PDF::loadView('etiqueta.etiqueta_grande', compact('cadena'));
                    break;
            }
        }
        else if($request->filled('etiqueta_identificador')){
            switch ($request->etiqueta_tamano) {
                case 'chica':
                    $pdf = PDF::loadView('etiqueta.etiqueta_chica_identificador', compact('cadena'));            
                    break;
                case 'mediana':
                    $pdf = PDF::loadView('etiqueta.etiqueta_mediana_identificador', compact('cadena'));
                    break;
                case 'grande':
                    $pdf = PDF::loadView('etiqueta.etiqueta_grande_identificador', compact('cadena'));
                    break;
            }
        }
        else if($request->filled('etiqueta_indicios')){
            $indicios = $request->etiqueta_indicios;
            
            switch ($request->etiqueta_tamano) {
                case 'chica':
                    $pdf = PDF::loadView('etiqueta.etiqueta_personalizada_chica', compact('cadena','indicios'));            
                    break;
                case 'mediana':
                    $pdf = PDF::loadView('etiqueta.etiqueta_personalizada_mediana', compact('cadena','indicios'));
                    break;
                case 'grande':
                    $pdf = PDF::loadView('etiqueta.etiqueta_personalizada_grande', compact('cadena','indicios'));
                    break;
            }
        }

        return $pdf->stream();
        
    }

    public function etiqueta_crear(Request $request){

    	$validator = Validator::make($request->all(), [
               'etiqueta_tamano' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
                'satisfactorio' => false,
                'error' => $validator->errors()->all(),
			]);
      	}


        //ETIQUETA GENERAL
        if($request->has('etiqueta_general')){            
            switch ($request->etiqueta_tamano) {
                case 'chica':
                    $pdf = PDF::loadView('pdf.etiqueta_chica', compact('data'));            
                    break;
                case 'mediana':
                    return response()->json([
                        'satisfactorio' => true,
                        'etiqueta' => 2,
                    ]);
                    break;
                case 'grande':
                    return response()->json([
                        'satisfactorio' => true,
                        'etiqueta' => 3,
                    ]);
                    break;    
                
                default:
                    # code...
                    break;
            }
        }
        elseif ($request->has('etiqueta_identificador')) {
            switch ($request->etiqueta_tamano) {
                case 'chica':
                    return response()->json([
                        'satisfactorio' => true,
                        'etiqueta' => 4,
                    ]);
                    break;
                case 'mediana':
                    return response()->json([
                        'satisfactorio' => true,
                        'etiqueta' => 5,
                    ]);
                    break;
                case 'grande':
                    return response()->json([
                        'satisfactorio' => true,
                        'etiqueta' => 6,
                    ]);
                    break;    
                
                default:
                    # code...
                    break;
            }
        }


/*
    	$data = Cadena::find($request->id);
		QrCode::format('png');
		QrCode::size(100);
		QrCode::color(255,0,255);
		QrCode::errorCorrection('M');
		QrCode::generate("http://201.116.252.147:8000/codigoQR/{$data->id}", '../public/codigoQr/codigoqr.png');


    	if(!$request->has('etiqueta_general')){
    		if(!$request->has('etiqueta_identificador')) {
    			
    		}
    		else{

    		}

    	}
    	else{
    		switch ($request->etiqueta_tamano) {
    			case 'chica':
    				$pdf = PDF::loadView('pdf.etiqueta_chica', compact('data'));
    				break;
    			case 'mediana':
    				$pdf = PDF::loadView('pdf.etiqueta_mediana', compact('data'));
    				break;
    			case 'grande':
    				$pdf = PDF::loadView('pdf.etiqueta_grande', compact('data'));
    				break;
    			default:
    				# code...
    				break;
    		}

    	}

    	return $pdf->stream();
*/	
    }//etiqueta_crear


    public function etiqueta_personalizada(Request $request){



        //ETIQUETA GENERAL
        if($request->has('etiqueta_general')){            
            $data = Cadena::find($request->id_cadena);

            switch ($request->etiqueta_tamano) {
                case 'chica':
                    $pdf = PDF::loadView('pdf.etiqueta_chica', compact('data','request'));
                    break;
                case 'mediana':
                    $pdf = PDF::loadView('pdf.etiqueta_mediana', compact('data','request'));
                    break;
                case 'grande':
                    $pdf = PDF::loadView('pdf.etiqueta_grande', compact('data'));
                    break;    
                
                default:
                    # code...
                    break;
            }
        }
        elseif ($request->has('etiqueta_identificador')){
            $data = Cadena::find($request->id_cadena);

            switch ($request->etiqueta_tamano) {
                case 'chica':
                    $pdf = PDF::loadView('pdf.etiqueta_chica_identificador', compact('data'));
                    break;
                case 'mediana':
                    $pdf = PDF::loadView('pdf.etiqueta_mediana_identificador', compact('data'));
                    break;
                case 'grande':
                    $pdf = PDF::loadView('pdf.etiqueta_grande_identificador', compact('data'));
                    break;    
                
                default:
                    # code...
                    break;
            }
        }
        else{
            $data = Cadena::find($request->id_cadena);

            switch ($request->etiqueta_tamano) {
                case 'chica':
                    $pdf = PDF::loadView('pdf.etiqueta_chica_personalizada', compact('data','request'));
                    break;
                case 'mediana':
                    $pdf = PDF::loadView('pdf.etiqueta_mediana_personalizada', compact('data','request'));
                    break;
                case 'grande':
                    $pdf = PDF::loadView('pdf.etiqueta_grande_personalizada', compact('data','request'));
                    break;    
                
                default:
                    # code...
                    break;
            }
        }


        return $pdf->stream();

    }

}
