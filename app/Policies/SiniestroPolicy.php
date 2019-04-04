<?php

namespace gps\Policies;

use gps\User;
use gps\Siniestro;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiniestroPolicy
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

    public function permiso_siniestro(User $user, Siniestro $siniestro){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
