<?php

namespace gps;

use gps\Carroceria;
use gps\Modelo;
use Illuminate\Database\Eloquent\Model;

class ModeloCarroceria extends Model
{
    protected $table = 'modelo_carroceria';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    	'carroceria_id',
    	'modelo_id',
    ];

    protected $guarder = [];

    public function Carroceria(){
        return $this->belongsTo(Carroceria::class,'carroceria_id');
    }

    public function Modelo(){
        return $this->belongsTo(Modelo::class,'modelo_id');
    }

}
