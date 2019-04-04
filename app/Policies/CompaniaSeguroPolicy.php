<?php

namespace gps\Policies;

use gps\User;
use gps\CompaniaSeguro;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompaniaSeguroPolicy
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

    public function permiso_companiaseguro(User $user, CompaniaSeguro $compSeguro){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
