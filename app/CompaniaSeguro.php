<?php

namespace gps;

use gps\Localidad;
use Illuminate\Database\Eloquent\Model;

class CompaniaSeguro extends Model
{
    protected $table = 'companiaseguro';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    	'nombre',
        'etiqueta',
    	'direccion',
    	'telefono1',
    	'telefono2',
    	'fax',
    	'email',
    	'web',
        'logo_img',
    	'localidad_id',
    ];

    protected $guarder = [];

    public function Localidad(){
        return $this->belongsTo(Localidad::class,'localidad_id');
    }
}
