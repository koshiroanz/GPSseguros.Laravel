<?php

namespace gps\Policies;

use gps\User;
use gps\Carroceria;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarroceriaPolicy
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

    public function permiso_carroceria(User $user, Carroceria $carroceria){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
