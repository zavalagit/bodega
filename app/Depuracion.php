<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depuracion extends Model
{
  protected $table = 'bodega.listdepuraciones';

  protected $fillable = [
      'fecha',
      'hora',
      'depuracion_numindicios',
      'observaciones',
      'soldepuracion',
      'cadena_id',
      'user_id',//User responsable de la creacion del registro
    ];

    public function indicios(){
      return $this->belongsToMany('App\Indicio','indicio_listdepuracion','indicio_id','listdepuracion_id')
                  ->withPivot('id','listdepuracion_tipo')
                  ->withTimestamps();
   }

    public function solicitud(){
      return $this->belongsTo('App\Depuracion');
    }

    public function cadena(){
      return  $this->belongsTo('App\Cadena');
    }

    public function user(){
      return $this->belongsTo('App\User');
    }
}
