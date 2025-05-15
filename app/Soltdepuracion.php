<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soltdepuracion extends Model
{
    protected $table = 'bodega.sol_depuraciones';

    protected $fillable = [
      'nuc',
      'folio_interno',
      'fecha_solicitud',
      'M.P_solicitud',
      'unidad_solicitud',
      'fecha_recepcion_solicitud',
      'observaciones',
      'user_id',//User responsable de la creacion del registro
    ];

    public function user(){
        return $this->belongsTo('App\User');
      }
}
