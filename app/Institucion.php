<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
	protected $table = 'bodega.instituciones';

   	protected $fillable = ['nombre'];

   	public function users(){
  		return $this -> hasMany('App\User');
   	}
}
