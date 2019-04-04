<?php

namespace gps\Policies;

use gps\User;
use gps\Cobertura;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoberturaPolicy
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

    public function permiso_cobertura(User $user, Cobertura $cobertura){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
