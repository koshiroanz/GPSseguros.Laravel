<?php

namespace gps\Policies;

use gps\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuarioPolicy
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

    public function permiso_user(User $user){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }

}
