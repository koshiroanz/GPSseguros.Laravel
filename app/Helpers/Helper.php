<?php

namespace App\Helpers;

class Helper{

    public static function formatoDateIda($result){
        if($result != null){
            $conversion = strpos($result, '-');
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

    public static function formatoDateVuelta($result){
        if($result != null){
            $fecha = explode("-", $result);
            if(($fecha[0] == 0000)||($fecha[0] == 1970)){
                $result = NULL;
            }else{
                $result = date("d-m-Y",strtotime($result));
            }
        }

        return $result;
    }

    public static function obtenerEstadosCivil($estadoCivil){
        $array = array('SOLTERO/A','CASADO/A','DIVORCIADO/A','VIUDO/A');
        if(in_array($estadoCivil, $array)){
            $indice = array_search($estadoCivil, $array);
        }

        unset($array[$indice]);

        return $array;
    }

    public static function obtenerClienteEstados($estado){
        $array = array('ACTIVO','INACTIVO');
        if(in_array($estado, $array)){
            $indice = array_search($estado, $array);
        }

        unset($array[$indice]);

        return $array;
    }

    public static function obtenerPolizaEstados($estado){
        $array = array('ACTIVO','BAJA TEMPORAL','BAJA PERMANENTE');
        if(in_array($estado, $array)){
            $indice = array_search($estado, $array);
        }

        unset($array[$indice]);

        return $array;
    }

    public static function obtenerPolizaDestinos($destino){
        $array = array('PARTICULAR','COMERCIAL');
        if(in_array($destino, $array)){
            $indice = array_search($destino, $array);
        }

        unset($array[$indice]);

        return $array;
    }

    public static function notificacionMensaje($tipo, $mensaje){
        Session::put($tipo, $mensaje);
    }
}