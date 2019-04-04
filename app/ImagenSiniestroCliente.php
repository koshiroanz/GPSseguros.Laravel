<?php

namespace gps;

use gps\Siniestro;
use Illuminate\Database\Eloquent\Model;

class ImagenSiniestroCliente extends Model
{
    protected $table = 'imagen_siniestro_cliente';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
    	'filename',
        'asegurado',
    	'siniestro_id',
    ];

    protected $guarder = [];

    public function Siniestro(){
        return $this->belongsTo(Siniestro::class,'siniestro_id');
    }
}
