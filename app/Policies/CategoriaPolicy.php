<?php

namespace gps\Policies;

use gps\User;
use gps\Categoria;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriaPolicy
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

    public function permiso_categoria(User $user, Categoria $categoria){
        if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
            return true;
        }
        return false;
    }
}
