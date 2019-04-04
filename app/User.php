<?php

namespace gps;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dni',
        'apellido',
        'nombre',
        'direccion',
        'telefono1',
        'telefono2',
        'privilegio',
        'estado',
        'localidad_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Localidad(){
        return $this->belongsTo('gps\Localidad', 'localidad_id');
    }
}
