<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inaturaleza extends Model
{
    protected $table = 'bodega.inaturalezas';
    protected $fillable = [
        'indicio_activo',
        'indicio_prestamo',
        'indicio_baja',
        'naturaleza_id',
        'fiscalia_id'
    ];

    public function naturaleza(){
        return $this -> belongsTo('App\Naturaleza');
    }
    public function fiscalia(){
        return $this -> belongsTo('App\Fiscalia');
    }
}
