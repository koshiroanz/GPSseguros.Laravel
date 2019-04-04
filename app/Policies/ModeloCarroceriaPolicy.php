<?php

namespace gps\Policies;

use gps\User;
use gps\ModeloCarroceria;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModeloCarroceriaPolicy
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

    public function permiso_modelocarroceria(User $user, ModeloCarroceria $modelocarroceria){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
