<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoRequest extends FormRequest
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
    public function rules(){
        //prestamo_etapa [prestamo,reingreso,editar] (mandar por el request -> siempre se manda)
        //prestamo_estado (mandar por el request -> mandar solo cuando la etapa es editar)

        // $reglas = [
        //     #prestamo
        //     'prestamo_hora' => 'required_unless:prestamo_etapa,reingreso',
        //     'prestamo_fecha' => 'required_unless:prestamo_etapa,reingreso|date|before_or_equal:today',
        //     'prestamo_autoriza' => 'required_unless:prestamo_etapa,reingreso',
        //     'prestamo_resguardante' => 'required_unless:prestamo_etapa,reingreso',
        //     'prestamo_responsable_bodega' => 'required_unless:prestamo_etapa,reingreso',
        //     #reingreso
        //     'reingreso_hora' => 'required',
        //     'reingreso_fecha' => 'required|date|before_or_equal:today',
        //     'reingreso_resguardante' => 'required',
        //     'reingreso_responsable_bodega' => 'required',
        // ];

        

        $prestamo_etapa = $this->request->get('prestamo_etapa');

        if($prestamo_etapa == 'prestamo'){
            $reglas = [
                #prestamo
                'indicios' => 'required_without:cadenas',
                'cadenas' => 'required_without:indicios',
                'prestamo_hora' => 'required',
                'prestamo_fecha' => 'required|date|before_or_equal:today',
                'prestamo_autoriza' => 'required',
                'prestamo_resguardante' => 'required',
                'prestamo_responsable_bodega' => 'required',
            ];

            $prestamo_fecha = $this->request->get('prestamo_fecha'); // Get the input value
            if($prestamo_fecha == date('Y-m-d')){
                $reglas['prestamo_hora'] = "required|before_or_equal:".date('H:i:s');
            }
        }
        else if($prestamo_etapa == 'reingreso'){
            $reglas = [
                #reingreso
                'reingreso_hora' => 'required',
                'reingreso_fecha' => 'required|date|before_or_equal:today',
                'reingreso_resguardante' => 'required',
                'reingreso_responsable_bodega' => 'required',
            ];

            $reingreso_fecha = $this->request->get('reingreso_fecha'); // Get the input value
            if($reingreso_fecha == date('Y-m-d')){
                $reglas['reingreso_hora'] = "required|before_or_equal:".date('H:i:s');
            }
        }
        else if($prestamo_etapa == 'editar'){
            $reglas = [
                #prestamo
                'prestamo_hora' => 'required',
                'prestamo_fecha' => 'required|date|before_or_equal:today',
                'prestamo_autoriza' => 'required',
                'prestamo_resguardante' => 'required',
                'prestamo_responsable_bodega' => 'required',
                #reingreso
                'reingreso_hora' => 'required_if:prestamo_estado,concluso',
                'reingreso_fecha' => 'required_if:prestamo_estado,concluso|date|after_or_equal:prestamo_fecha|before_or_equal:today',
                'reingreso_resguardante' => 'required_if:prestamo_estado,concluso',
                'reingreso_responsable_bodega' => 'required_if:prestamo_estado,concluso',
            ];
            
            $prestamo_fecha = $this->request->get('prestamo_fecha'); // Get the input value
            if($prestamo_fecha == date('Y-m-d')){
                $reglas['prestamo_hora'] = "required|before_or_equal:".date('H:i:s');
            }

            if($this->request->get('prestamo_estado') == 'concluso'){
                $reingreso_fecha = $this->request->get('reingreso_fecha'); // Get the input value
                if($reingreso_fecha == date('Y-m-d')){
                    $reglas['reingreso_hora'] = "required|before_or_equal:".date('H:i:s');
                }
            }
        }


        //prestamo_etapa
        //prestamo_estado

        //Si es solo prestamo no se requieren los datos de reingreso
        //Si es solo reingreso no se requieren datos de prestamo
        //si es editar no es requerido indicios y cadenas
        //Si es editar y el prestamo esta activo no se requieren los datos de reingreso        

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
