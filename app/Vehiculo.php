<?php

namespace gps;

use gps\Carroceria;
use gps\Modelo;
use gps\Marca;
use gps\Cliente;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculo';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
    	'dominio',
    	'anio',
    	'chasis',
    	'motor',
    	'color',
    	'valor',
    	'combustible',
        'marca_id',
        'modelo_id',
    	'carroceria_id',
        'cliente_id',
    ];

    protected $guarder = [];

    public function Carroceria(){
        return $this->belongsTo(Carroceria::class);
    }

    public function Modelo(){
        return $this->belongsTo(Modelo::class);
    }

    public function Marca(){
        return $this->belongsTo(Marca::class);
    }

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
