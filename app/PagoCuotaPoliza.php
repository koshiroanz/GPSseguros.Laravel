<?php

namespace gps;

use gps\Pago;
use gps\Poliza;
use Illuminate\Database\Eloquent\Model;

class PagoCuotaPoliza extends Model
{
    protected $table = 'pago_cuota_poliza';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    	'numCuota',
        'importe',
        'pago_id',
        'poliza_id',
    ];

    protected $guarder = [];

    /*public function Pago(){
        return $this->hasMany(Pago::class,'pago_id');
    }

    public function Poliza(){
        return $this->hasMany(Poliza::class,'poliza_id');
    }*/

    public function Pago(){
        return $this->belongsTo(Pago::class,'pago_id');
    }

    public function Poliza(){
        return $this->belongsTo(Poliza::class,'poliza_id');
    }
    
}