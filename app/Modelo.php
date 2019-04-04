<?php

namespace gps;

use gps\Marca;
use gps\Vehiculo;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'modelo';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    	'nombre',
    	'marca_id',
    ];

    protected $guarder = [];

    public function Marca(){
        return $this->belongsTo(Marca::class,'marca_id');
    }

    public function Vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }

}
