<?php

namespace gps\Policies;

use gps\User;
use gps\Vehiculo;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiculoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function permiso_vehiculo(User $user, Vehiculo $vehiculo){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
