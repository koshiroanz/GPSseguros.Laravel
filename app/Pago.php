<?php

namespace gps;

use gps\Cliente;
use gps\Vehiculo;
use gps\Poliza;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    	'numRecibo',
    	'fecha',
    	'total',
        'reciboGrua',
    	'importeGrua',
    	'observacion',
        'vehiculo_id',
        'poliza_id',
    ];

    protected $guarder = [];

    public function Vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id');
    }

    public function Poliza(){
        return $this->belongsTo(Poliza::class,'poliza_id');
    }

}
