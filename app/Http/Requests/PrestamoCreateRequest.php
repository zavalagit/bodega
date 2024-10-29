<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $reglas = [
            'indicios' => 'required_without:cadenas',
            'cadenas' => 'required_without:indicios',
            'prestamo_fecha' => 'required|date|before_or_equal:today',
            'prestamo_autoriza' => 'required',
            'prestamo_autoriza' => 'required',
            'prestamo_resguardante' => 'required',
            'prestamo_responsable_bodega' => 'required',
        ];

        $prestamo_fecha = $this->request->get('prestamo_fecha'); // Get the input value
        if($prestamo_fecha == date('Y-m-d')){
            $reglas['prestamo_hora'] = "required|before_or_equal:".date('H:i:s');
        }

        return $reglas;
    }

    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            'indicios.required_without' => 'Seleccione al menos un indicio para prestamo.',
            'cadenas.required_without' => 'Seleccione al menos un indicio para prestamo.',
            'prestamo_autoriza.required' => 'El campo "autoriza" es requerido.',
            'prestamo_resguardante.required' => 'Indique el Resguardante que se lleva los indicios.',
            'prestamo_responsable_bodega.required' => 'Indique al Responsable de Bodega que entrega los indicios.',
        ];
    }
}
