<?php

namespace gps\Http\Middleware;

use Auth;
use Closure;

class CheckPrivilegio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if (Auth::check()){ // Verifica si el usuario esta autenticado.
            if(Auth::user()->privilegio == 'ALTO')
                return $next($request); // Continúa la petición
            else if(Auth::user()->privilegio == 'MEDIO')
                return $next($request); // Continúa la petición
            else
                return redirect('/')->with('fail','Acción no autorizada.'); // Si privilegio es distinto de ALTO redirije al home.
            
        }else{
            return redirect()->route('login');
        }
        
    }
}
