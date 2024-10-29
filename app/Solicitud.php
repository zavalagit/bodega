<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'bodega.solicitudes';

    protected $fillable = [
      'nombre',
      'especialidad_id',
    ];

    public function peticiones(){
      return $this->hasMany('App\Peticion');
    }

    public function especialidad(){
      return $this->belongsTo('App\Especialidad');
    }

}
