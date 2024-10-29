<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'bodega.fotos';
    protected $fillable = ['nombre','fotografia_id','fotografia_type'];

    public function fotografia(){
        return $this->morphTo();
    }
}
