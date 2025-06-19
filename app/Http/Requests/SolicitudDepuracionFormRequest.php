<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudDepuracionFormRequest extends FormRequest
{
    public function __construct(){
        setlocale(LC_TIME,"es_MX.UTF-8");
        // no tiene zona horario de verano
        date_default_timezone_set('America/Regina');
     
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $reglas = [
            'nuc' => 'required',
            'fecha_solicitud' => 'required|date|before_or_equal:today',
            'M_P_solicitud' => 'required',
            'cargo_M_P' => 'required',
            'unidad_solicitud' => 'required',
            'fecha_recepcion_solicitud' => 'required|date|after_or_equal:fecha_solicitud|before_or_equal:today',
            'registro_observaciones' => 'required',
        ];

        return $reglas;
    }
    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            'nuc.required' => 'Indique el N.U.C.',
            'fecha_solicitud.before_or_equal' => 'Fecha de la Solicitud no valida, debe ser una fecha menor o igual a '.date('d-m-Y').'.',
            'M_P_solicitud.required' => 'Indique el nombre M.P. que lo solicita',
            'cargo_M_P.required' => 'Indique el cargo del M.P.',
            'unidad_solicitud.required' => 'Indique la unidad del M.P.',
            'fecha_recepcion_solicitud.after_or_equal' => 'Fecha de la Recepcion no valida, debe ser una fecha menor o igual a fecha de la solicitud',
            'registro_observaciones.required' => 'Indique observaciones',
        ];
    }
}
