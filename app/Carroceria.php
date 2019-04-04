<?php

namespace gps;

use gps\Vehiculo;
use Illuminate\Database\Eloquent\Model;

class Carroceria extends Model
{
    protected $table = 'carroceria';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    	'nombre',
    ];

    protected $guarder = [];

    public function Vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }

}
