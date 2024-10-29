<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'bodega.ubicaciones';

    protected $fillable = [
        'nombre',
        'anio',
        'naturaleza_id',
        'fiscalia_id',
    ];

    public function naturaleza(){
        return $this->belongsTo('App\Naturaleza');
    }
    public function indicios(){
        return $this->hasMany('App\Indicio');
    }

}
