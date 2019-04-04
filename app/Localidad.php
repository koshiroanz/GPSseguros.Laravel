<?php

namespace gps;

use gps\Productor;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidad';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    	'nombre',
    ];

    protected $guarder = [];

    /*public function Productor(){
    	return $this->hasMany(Productor::class, 'localidad_id');
    }*/
}
