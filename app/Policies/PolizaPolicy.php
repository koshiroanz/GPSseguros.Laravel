<?php

namespace gps\Policies;

use gps\User;
use gps\Poliza;
use Illuminate\Auth\Access\HandlesAuthorization;

class PolizaPolicy
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

    public function permiso_poliza(User $user, Poliza $poliza){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
