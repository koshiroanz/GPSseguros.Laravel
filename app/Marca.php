<?php

namespace gps;

use gps\Vehiculo;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marca';
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
