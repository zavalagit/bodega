<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    protected $table = 'bodega.peticiones';

    protected $fillable = [
      'nuc',
      'oficio_numero',
      'fecha_peticion',
      'fecha_elaboracion',
      'fecha_entrega',
      'sp_solicita',
      'sp_recibe',
      'documento_emitido',
      'estado',
      'petfiscalia_id',
      'petdscripcion_id',
      'solicitud_id',
      'unidad_id',    //Unidad donde se elabora la Petición
      'fiscalia1_id', //Fiscalía de donde pertenece la Petición
      'fiscalia2_id', //Fiscalía donde se elabora la Petición
      'user_id',
      'fecha_entrega_sistema',
      'unidad1_id',
      'unidad2_id',
    ];

    public function solicitud(){
      return $this->belongsTo('App\Solicitud');
    }
    public function necropsia(){
      return $this->belongsTo('App\Necropsia');
    }
    public function user(){
      return $this->belongsTo('App\User');
    }
    public function petfiscalia(){
      return $this->belongsTo('App\Petfiscalia');
    }
    public function petadscripcion(){
      return $this->belongsTo('App\Petadscripcion');
    }
    public function unidad(){
      return $this->belongsTo('App\Unidad');
    }
    public function unidad1(){
      return $this->belongsTo('App\Unidad','unidad1_id');
    }
    public function unidad2(){
      return $this->belongsTo('App\Unidad','unidad2_id');
    }
    public function fiscalia1(){
      return $this->belongsTo('App\Fiscalia','fiscalia1_id');
    }
    public function fiscalia2(){
      return $this->belongsTo('App\Fiscalia','fiscalia2_id');
    }

  #scope
  public function scopeRecibidas($query,$fecha_inicio, $fecha_fin = null){
    return
    $query->where(function($q) use($fecha_inicio,$fecha_fin){
      if( $fecha_fin != null ) $q->whereBetween('created_at',[$fecha_inicio.' 00:00:00',$fecha_fin.' 23:59:59']);
      else $q->whereDate('created_at',$fecha_inicio);
    });
  }
  public function scopeAtendidas($query,$fecha_inicio, $fecha_fin = null){
    return
    $query->where(function($q) use($fecha_inicio,$fecha_fin){
      if( $fecha_fin != null ) $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);
      else $q->where('fecha_sistema',$fecha_inicio);
    });
  }
  public function scopePendientes($query,$fecha_inicio, $fecha_fin = null){
    return
    //peticiones que se registraron en el intervalo de fecha y estan pendientes
    $query->where(function($q) use($fecha_inicio,$fecha_fin){
      if( $fecha_fin != null ){
        $q->whereBetween('created_at',[$fecha_inicio.' 00:00:00',$fecha_fin.' 23:59:59']);
      }else{
        $q->whereDate('created_at',$fecha_inicio);
      }
    })
    ->where(function($q) use($fecha_inicio, $fecha_fin){
      $q->where('fecha_sistema','>',$fecha_fin ?? $fecha_inicio)
		->orWhere('estado','pendiente');
    });
  }
  public function scopeRezago($query,$fecha_inicio){
    // peticion_dia: peticiones que se registraron en fecha anterior al dia
    return $query->whereDate('created_at','<',$fecha_inicio);
  }
  public function scopeNecros($query,$fecha_inicio,$fecha_fin = null){
    return
    $query->where(function($q) use($fecha_inicio,$fecha_fin){
      if( $fecha_fin != null ) $q->whereBetween('fecha_necropsia',[$fecha_inicio,$fecha_fin]);
      else $q->where('fecha_necropsia',$fecha_inicio);
    });
  }
  public function scopeModelo($query,$modelo = null, $modelo_id = null){
    if ( ($modelo != null) && ($modelo_id != null) ) {
      return
      $query->where(function($q) use($modelo,$modelo_id){
        #user
        if ( $modelo == 'user' ) $q->where('user_id',$modelo_id);
        #unidad
        elseif ( $modelo == 'unidad' ) $q->where('unidad_id',$modelo_id)->where('fiscalia2_id',4);
        #region
        elseif ( $modelo == 'region' ) $q->where('fiscalia2_id',$modelo_id);
      });
    }
  }
  public function scopeNuc($query,$nuc){
    return $query->where(function($q) use($nuc){
		$q->where('nuc','like','%'.$nuc.'%')
			->orWhere('oficio_numero','like','%'.$nuc.'%');
	});
  }
  public function scopeEspecialidad($query,$especialidad_id){
    return
    $query->whereHas('solicitud',function($q) use($especialidad_id){
      $q->where('especialidad_id',$especialidad_id);
    });
  }
  public function scopeSolicitud($query,$solicitud_id){
    return
    $query->where('solicitud_id',$solicitud_id);
  }
  public function scopeEstado($query,$estado){
    return
    $query->where('estado',$estado);
  }
  public function scopeUser($query,$user_id){
    return
    $query->where('user_id',$user_id);
  }
}
