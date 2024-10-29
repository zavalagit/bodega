<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Colectivo extends Model
{
    protected $table = 'bodega.colectivos';

    protected $fillable = [
        // 'colectivo_grupo_familiar',
        'colectivo_donante',
        'colectivo_fecha',
        'documento_emitido',
        'colectivo_validacion_fecha',
        'colectivo_emision_fecha',
        'colectivo_emision_persona',
        'colectivo_estado',
        'entidad_id',
        'delegacion_id',
        'user_id',
        'fiscalia_id',
    ];

    public function entidad(){
        return $this->belongsTo('App\Entidad');
    }
    public function delegacion(){
        return $this->belongsTo('App\Delegacion');
    }
    public function user1(){
        return $this->belongsTo('App\User','user1_id');
    }
    public function user2(){
        return $this->belongsTo('App\User','user2_id');
    }
    public function fiscalia(){
        return $this->belongsTo('App\Fiscalia');
    }
    public function objetos(){
        return $this->hasMany('App\Objeto');
    }
    public function parentescos(){
        return $this->belongsToMany('App\Parentesco')
                    ->withPivot('id',
                                'parentesco_id',
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
    public function pruebas(){
        return $this->belongsToMany('App\Prueba')->withPivot('id','prueba_id','prueba_otro','prueba_cim','prueba_estudios')->withTimestamps();
    }

    #SCOPES
    public function scopeColectivos($query, $request){
        return $query
        ->where(function($q) use($request) { 
            if( $request->filled('b_fecha_fin') ){

            }
            elseif( $request->filled('b_fecha_inicio') ){
                $q->whereDate('created_at',$request->b_fecha_inicio)
                ->orWhere('colectivo_validacion_fecha',$request->b_fecha_inicio);
            }
            else{
                $q->whereDate('created_at',$this->fecha_hoy)
                ->orWhere('colectivo_validacion_fecha',$this->fecha_hoy);
            }

        })
        ->where( function($q){
            #user
            if ( Auth::user()->tipo == 'usuario' ) {
                $q->where('user1_id',Auth::id())
                    ->orWhere('user2_id',Auth::id());
            }
        });
    }
}
