<?php

namespace gps;

use Illuminate\Database\Eloquent\Model;

class Poliza extends Model{
    protected $table = 'poliza';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
    	'numPoliza',
    	'vigenciaPedida',
    	'vigenciaPedidaHasta',
    	'vigenciaPoliza',
    	'vigenciaPolizaHasta',
    	'costoPoliza',
    	'endoso',
    	'estado',
    	'sumaAsegurada',
    	'numPolizaVida',
    	'costoPolizaVida',
    	'destino',
        'observacion',
    	'vehiculo_id',
    	'categoria_id',
        'compSeguro_id',
    	'cobertura_id',
    ];

    protected $guarder = [];

    public function Vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id');
    }

    public function Categoria(){
        return $this->belongsTo(Categoria::class,'categoria_id');
    }

    public function CompaniaSeguro(){
        return $this->belongsTo(CompaniaSeguro::class,'compSeguro_id');
    }

    public function Cobertura(){
        return $this->belongsTo(Cobertura::class,'cobertura_id');
    }

}
