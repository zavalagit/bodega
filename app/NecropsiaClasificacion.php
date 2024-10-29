<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NecropsiaClasificacion extends Model
{
    protected $table = 'bodega.necropsia_clasificaciones';

    protected $fillable = ['nombre'];

    public function necropsia_causas(){
        return $this->hasMany('App\Necropsia','necropsia_clasificacion_id');
     }
}
