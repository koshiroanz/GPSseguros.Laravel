<?php

namespace gps\Policies;

use gps\User;
use gps\Localidad;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocalidadPolicy
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

    public function permiso_localidad(User $user, Localidad $localidad){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
