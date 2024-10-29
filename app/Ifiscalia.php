<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ifiscalia extends Model
{
    protected $table = 'bodega.ifiscalias';
    protected $fillable = [
        'indicio_activo',
        'indicio_prestamo',
        'indicio_baja',
        'evidencia_activo',
        'evidencia_prestamo',
        'evidencia_baja',
        'fiscalia_id'
    ];

    public function fiscalia(){
        return $this -> belongsTo('App\Fiscalia');
    }
}
