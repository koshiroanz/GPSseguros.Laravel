<?php

namespace gps\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Redirect;

class Handler extends ExceptionHandler{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception){
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

    public function render($request, Exception $exception){ 
        if($exception instanceof \Illuminate\Database\QueryException){
            dd($exception);
            return Redirect::to('/')->withErrors(['Ha ocurrido un error en la carga de datos.']);
        }else if ($exception instanceof NotFoundHttpException) {
            return Redirect::to('/')->with('fail','No existe la URL.');
        }else if($exception instanceof AuthorizationException){
            return Redirect::to('/')->withErrors(['Acción no autorizada.']);
        }else if($this->isHttpException($exception)){
            switch ($exception->getStatusCode()){
                case '404': // No existe(Not found)
                    return Redirect::to('/')->withErrors(['URL inexistente.']);
                    break;
                case '500': // Error interno del servidor(internal error)
                    return Redirect::to('/')->withErrors(['Error interno del servidor.']);
                    break;
                default:
                    return Redirect::to('/')->withErrors(['Error interno del servidor.']);
                    //return $this->renderHttpException($exception);
                break;
            }
        }

        return parent::render($request, $exception);
    }
}
