<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Necropsia extends Model
{
    protected $table = 'bodega.necropsias';
    protected $fillable = ['id','nombre','necropsia_tipo'];

    public function necropsia_clasificacion()
    {
        return $this->belongsTo('App\NecropsiaClasificacion','necropsia_clasificacion_id');
    }
}
