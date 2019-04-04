<?php 
	namespace gps;
	
	class Helper{
		/**
		* conversión de formato de fecha: (ida) DD-MM-AAAA to AAAA-MM-DD y (vuelta) AAAA-MM-DD to DD-MM-AAAA
		*
		* @param $result => fecha
		*/

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
	}
	