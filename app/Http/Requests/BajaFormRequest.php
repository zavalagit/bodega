<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BajaFormRequest extends FormRequest
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
            'indicios' => 'required_if:baja_accion,registrar',
            'indicios_baja_tipo' => 'required_if:baja_accion,registrar',
            'baja_parcial_descripcion.*' => 'sometimes|required',
            'baja_parcial_cantidad_indicios.*' => 'sometimes|required',
            'baja_descripcion_disponible.*' => 'sometimes|required',
			'motivo' => 'required',
            'institucion_id' => 'required',
			'fiscalia_id' => 'required_if:institucion_id,1',
			'baja_concepto' => 'required',
            //'baja_fecha' => 'required|date|before_or_equal:today',
			'baja_fecha' => 'required|date',
            // 'baja_tipo' => 'required',
            'baja_cadena_estado' => 'required',
            'baja_entrega' => 'required',
            'baja_recibe' => 'required_if:input_radio_baja_recibe,servidor_publico',
            'baja_recibe_civil_identificacion' => 'required_if:input_radio_baja_recibe,civil',
            'baja_recibe_civil_nombre' => 'required_if:input_radio_baja_recibe,civil',
            // 'baja_recibe' => 'required',
        ];

        $baja_fecha = $this->request->get('baja_fecha'); // Get the input value
        
		/*
		if($baja_fecha == date('Y-m-d')){
            $reglas['baja_hora'] = "required|before_or_equal:".date('H:i:s');
        }
		*/

        return $reglas;
    }
    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            'indicios.required_if' => 'Seleccione al menos un indicio para Baja.',
            'baja_concepto.required' => 'El concepto de la Baja es requerido.',
            'baja_fecha.required' => 'La fecha de la Baja es requerida.',
            'baja_fecha.before_or_equal' => 'Fecha de la Baja no valida, debe ser una fecha menor o igual a hoy.',
            'baja_hora.required' => 'La hora de la Baja es requerida.',
            'baja_hora.before_or_equal' => "Hora de la Baja no valida, todavia no son las {$this->request->get('baja_hora')}",
            'baja_tipo.required' => 'El tipo de Baja es requerido.',
            'baja_cadena_estado.required' => 'El estado de la Cadena es requerido.',
            'baja_entrega.required' => "Indique al Responsable de bodega que entraga.",
            'baja_recibe.required_if' => "Indique al Servidor público que recibe.",
            'baja_recibe_civil_identificacion.required_if' => 'Indique la identificación del Civil.',
            'baja_recibe_civil_nombre.required_if' => 'Indique el nombre del Civil.',
        ];
    }
}
