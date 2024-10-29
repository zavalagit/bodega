<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
{
    protected $table = 'bodega.parentescos';

    protected $fillable = ['nombre,'];

    public function colectivo(){
        return $this->belongsToMany('App\Colectivo')
                    ->withPivot('id',
                                'colectivo_id',
                                'ausente_nombre',
                                'ausente_sexo',
                                'ausente_fecha_nacimiento',
                                'ausente_edad',
                                'ausente_lugar_desaparicion',
                                'ausente_fecha_desaparicion',
                                'parentesco_otro',
                                'ausente_objeto_aportado')
                    ->withTimestamps();
    }
}
