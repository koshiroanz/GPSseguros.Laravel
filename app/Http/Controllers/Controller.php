<?php

namespace gps\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function formatoDateIda($result){ // Control de fech => Verificar si $result recibe '-' o '/' antes de convertir fecha.
		if(($result != null)||(!empty($result))){
			$conversion = strpos($result, '-');	// Encuentra la posición de la 1er ocurrencia '-'..
			if($conversion){
				$fecha = explode("-", $result);
				$dia = $fecha[0];
				$mes = $fecha[1];
				$anio = $fecha[2];
				$result = $dia.'-'.$mes.'-'.$anio;
				$result = date("Y-m-d",strtotime($result));
			}else{
				$result = date("Y-m-d",strtotime($result));
			}
		}

		return $result;
	}

	public function formatoDateVuelta($result){	// Control de fech => Verificar si $result recibe '-' o '/' antes de convertir fecha.
		if(($result != null)||(!empty($result))){
			$fecha = explode("-", $result);
			if(($fecha[0] == 0000)||($fecha[0] == 1970)){
				$result = NULL;
			}else{
				$result = date("d-m-Y",strtotime($result));
			}
		}

		return $result;
	}

	// Datos constantes para impresión de reportes.
	public function getDatosEmpresa(){
		$datosEmpresa = [
			'propietario' => 'DENTE CARLOS',
			'direccion' => 'CORRIENTES Y CATAMARCA',
			'localidad' => 'POSADAS',
		];

		return $datosEmpresa;
	}

	public function microtime_float(){
        list($useg, $seg) = explode(" ", microtime());
        return ((float)$useg + (float)$seg);
    }
}
