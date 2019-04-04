<?php

namespace gps;

use gps\Localidad;
use gps\User;
use gps\Vehiculo;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primarykey = 'id';
    public $timestamps = true;

    protected $fillable = [
    	'dni',
    	'apellido',
    	'nombre',
    	'fechaNacimiento',
    	'direccion',
        'telefono1',
        'telefono2',
    	'cuit',
        'estadoCivil',
    	'fechaBaja',
    	'estado',
    	'localidad_id',
        'users_id',
    ];

    protected $guarder = [];

    public function Localidad(){
        return $this->belongsTo(Localidad::class,'localidad_id');
    }

    public function User(){
        return $this->belongsTo(User::class,'users_id');
    }

    public function Vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }
    
}
