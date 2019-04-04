<?php

namespace gps\Policies;

use gps\User;
use gps\Modelo;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModeloPolicy
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

    public function permiso_modelo(User $user, Modelo $modelo){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
