<?php

namespace gps;

use gps\Localidad;
use gps\Cliente;
use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $table = 'beneficiario';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
    	'dni',
    	'apellido',
    	'nombre',
        'direccion',
    	'telefono1',
        'telefono2',
        'parentesco',
        'localidad_id',
        'cliente_id',
    ];

    protected $guarder = [];

    public function Localidad(){
        return $this->belongsTo(Localidad::class,'localidad_id');
    }

    public function Cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
}
