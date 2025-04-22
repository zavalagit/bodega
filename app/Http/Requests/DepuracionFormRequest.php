<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepuracionFormRequest extends FormRequest
{
    public function __construct(){
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
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
            'indicios' => 'required_if:depuracion_accion,registrar',
            'indicios_baja_tipo' => 'required_if:depuracion_accion,registrar',
            'baja_parcial_descripcion.*' => 'sometimes|required',
            'baja_parcial_cantidad_indicios.*' => 'sometimes|required',
            'baja_descripcion_disponible.*' => 'sometimes|required',
            'solicitud_id' => 'required',
            'registro_fecha' => 'required|date|before_or_equal:today',
        ];

        return $reglas;
    }

    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            'indicios.required_if' => 'Seleccione al menos un indicio para Depuracion.',
            'solicitud_id.required' => 'La solicitud es requerido.',
            'registro_fecha.required' => 'La fecha de la Depuracion es requerida.',
            'registro_fecha.before_or_equal' => 'Fecha de la Depuracion no valida, debe ser una fecha menor o igual a '.date('d-m-Y').'.',
        ];
    }
}
