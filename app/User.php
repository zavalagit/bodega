<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'bodega.users';
    protected $fillable = [
        'folio', 'name', 'tipo', 'password', 'institucion_id','fiscalia_id','unidad_id','cargo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   //Todos los prestamos que a realizado dicho responsable de bodega
   public function prestamos1(){
      return $this->hasMany('App\Prestamo','user1_id');
   }

   //Todos los prestamos que recibe el responsable de bodega
   public function prestamos2(){
      return $this->hasMany('App\Prestamo','user2_id');
   }

    public function institucion(){
      return $this->belongsTo('App\Institucion');
    }

    public function fiscalia(){
      return $this->belongsTo('App\Fiscalia');
    }

    public function unidad(){
      return $this->belongsTo('App\Unidad');
    }

   public function cargo(){
      return $this->belongsTo('App\Cargo','cargo_id');
   }

   public function cadenas(){
      return $this->belongsToMany('App\Cadena');
   }


   public function scopeAutocompletar($query,$busqueda){
      return $query->where('folio','like',"%{$busqueda}%")->orWhere('name','like',"%{$busqueda}%");
   }

   public function scopeRepetir($query,$busaqueda){
      return $query->where("folio",'<>',Auth::user()->folio);
   }

   public function scopeTipoautocompletar($query){
    return $query->where('tipo','usuario');
   }
}
