<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoFormRequest extends FormRequest
{
    public $reglas;

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
        $this->set_rules();
        if ( $this->route('formAccion') == 'prestar' ) return $this->reglas['prestamo'];
        if ( $this->route('formAccion') == 'reingresar' ) return $this->route()->named('reingreso_multiple_form') ? $this->reglas['reingreso'] : array_collapse( $this->reglas );
        if ( $this->route('formAccion') == 'editar' ) {
            $prestamo = $this->route('prestamo');
            return $prestamo->estado == 'activo' ? $this->reglas['prestamo'] : array_collapse( $this->reglas );                    
        }    
    }

    public function set_rules(){
        $this->reglas = [
            'prestamo' => [
                'indicios' => $this->route('formAccion') == 'prestar' ? 'required_without:cadenas' : '',
                'cadenas' => $this->route('formAccion') == 'prestar' ? 'required_without:indicios' : '',
                'prestamo_hora' => 'required',
                'prestamo_fecha' => 'required|date|before_or_equal:today',
                'prestamo_autoriza' => 'required',
                'prestamo_resguardante' => 'required',
                'prestamo_responsable_bodega' => 'required',
            ],
            'reingreso' => [
                'prestamos' => $this->route()->named('reingreso_multiple_form') ? 'required' : '',
                'reingreso_cantidad_indicios' => 'sometimes|required',
                'reingreso_descripcion_disponible' => 'sometimes|required',
                'reingreso_hora' => $this->request->get('prestamo_fecha') == date('Y-m-d') ? 'required|after:prestamo_hora|before_or_equal:'.date('H:i:s') : '',
                'reingreso_fecha' => 'required|date|after_or_equal:prestamo_fecha|before_or_equal:today',
                'reingreso_resguardante' => 'required',
                'reingreso_responsable_bodega' => 'required',
            ],
        ];
    }

    public function messages(){
        return [
            //prestamo
            'indicios.required_without' => 'Seleccione al menos un indicio para prestamo.',
            'cadenas.required_without' => 'Seleccione al menos un indicio para prestamo.',
            'prestamo_autoriza.required' => 'El campo "autoriza" es requerido.',
            'prestamo_resguardante.required' => 'Indique el Resguardante que se lleva los indicios.',
            'prestamo_responsable_bodega.required' => 'Indique al Responsable de Bodega que entrega los indicios.',
            //reingreso
            'reingreso_hora.required' => 'El campo "hora" es requerido.',
            'reingreso_hora.before_or_equal' => 'La "hora" debe ser menor o igual a '.date('H:i:s').' hrs.',
            'reingreso_fecha.required' => 'El campo "fecha" es requerido.',
            'reingreso_fecha.before_or_equal' => 'La "fecha" debe ser menor o igual a '.date('d-m-Y').'.',
            'reingreso_resguardante.required' => 'Indique el Resguardante que entrega los indicios.',
            'reingreso_responsable_bodega.required' => 'Indique al Responsable de Bodega que recibe los indicios.',
        ];
    }
}
