<?php
namespace App\Traits;
use App\Especialidad;
use App\Fiscalia;
use App\Unidad;
use App\User;

trait TraitEstadistica{
    // protected $modelo,$modelo_id;
    // protected $user,$unidad,$region;
    // public $peticiones;
    // public $necro_peticiones;
    // public $fecha_hoy;
    // public $especialidades;
    // protected $vista;

    // public function set_modelo(){
    //     switch ( $this->modelo) {
    //         case 'user':
    //             $this->user = User::find($this->modelo_id);
    //             break;
    //         case 'unidad':
    //             $this->unidad = Unidad::find($this->modelo_id);
    //             break;
    //         case 'region':
    //             $this->region = Fiscalia::find($this->modelo_id);
    //             break;
    //         // case 'administrador':
                
    //         //     break;
    //         default:
    //             # code...
    //             break;
    //     }
    // }

    // public function set_propiedades_metodos($request,$modelo,$modelo_id){
    //     /*** $modelo -> deber ser user, unidad o fiscalia */
    //     #set_modelo
    //     $this->modelo = $request->filled('b_modelo') ? $request->b_modelo : $modelo;
    //     // dd($request->b_modelo);
    //     #set_modelo_id
    //     $this->modelo_id = isset($modelo_id) ? $modelo_id : ($request->filled('b_modelo_id') ? $request->b_modelo_id : null);
    //     #set_fecha_hoy
    //     $this->fecha_hoy = date('Y-m-d');
    //     #set_modelo()
    //     $this->set_modelo();
    //     #set_formato_fecha
    //     $request->filled('b_fecha_fin') ? $this->set_fecha_formato($request->b_fecha_inicio, $request->b_fecha_fin) : ( $request->filled('b_fecha_inicio') ? $this->set_fecha_formato($request->b_fecha_inicio) : $this->set_fecha_formato($this->fecha_hoy) );
    // }
}