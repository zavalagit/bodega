<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'bodega.especialidades';

    protected $fillable = [
      'nombre',
      'unidad_id',
    ];

    public function unidad(){
      return $this->belongsTo('App\Unidad');
    }
    public function solicitudes(){
      return $this->hasMany('App\Solicitud');
    }
}
