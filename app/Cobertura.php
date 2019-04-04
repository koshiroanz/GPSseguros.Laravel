<?php

namespace gps;

use gps\CompaniaSeguro;
use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    protected $table = 'cobertura';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
    	'nombre',
    	'compSeguro_id',
    ];

    protected $guarder = [];

    public function CompaniaSeguro(){
        return $this->belongsTo(CompaniaSeguro::class,'compSeguro_id');
    }
}
