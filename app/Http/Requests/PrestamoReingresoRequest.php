<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoReingresoRequest extends FormRequest
{
    public function __construct()
    {
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
            'reingreso_hora' => 'required',
            'reingreso_fecha' => 'required|date|before_or_equal:today',
            'reingreso_resguardante' => 'required',
            'reingreso_responsable_bodega' => 'required',
        ];

        $reingreso_fecha = $this->request->get('reingreso_fecha'); // Get the input value
        if($reingreso_fecha == date('Y-m-d')){
            //$reglas['reingreso_hora'] = "required|before_or_equal:".date('H:i:s');
        }
        
        return $reglas;
    }

    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            'reingreso_hora.required' => 'El campo "hora" es requerido.',
            'reingreso_hora.before_or_equal' => 'La "hora" debe ser menor o igual a '.date('H:i:s').' hrs.',
            'reingreso_fecha.required' => 'El campo "fecha" es requerido.',
            'reingreso_fecha.before_or_equal' => 'La "fecha" debe ser menor o igual a '.date('d-m-Y').'.',
            'reingreso_resguardante.required' => 'Indique el Resguardante que entrega los indicios.',
            'reingreso_responsable_bodega.required' => 'Indique al Responsable de Bodega que recibe los indicios.',
        ];
    }
}
