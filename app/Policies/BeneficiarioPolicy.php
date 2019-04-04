<?php

namespace gps\Policies;

use gps\User;
use gps\Beneficiario;
use Illuminate\Auth\Access\HandlesAuthorization;

class BeneficiarioPolicy
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

    public function permiso_beneficiario(User $user, Beneficiario $beneficiario){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
