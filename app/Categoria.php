<?php

namespace gps;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    	'nombre',
    ];

    protected $guarder = [];
}
