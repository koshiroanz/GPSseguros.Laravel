<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GPSseguros | Carnet Provisorio</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
    </style>
</head>
<body>
	<div style="width: 100%; padding: 20px; margin-top: 40px">
        <!-- CARNET PARTE 1 -->
        <div style="width: 345px; height: 160px; border: 1px solid #000; display: inline-block; margin-left: 10px;">
        	<div style="width: 120px; height: 154px; padding-top: 5px;">
                <div style="width: 60px; height: 60px; margin: auto; padding: 0px 0px 5px 0px;">
                    <img style="width: 100%; height: 100%;" src="storage/aseguradora_img/{{$datosCarnetProvisorio->logo_img}}">
                </div>
                <!-- Contenedor empresa y su etiqueta -->
        		<div style="width: 100%; height: 90px; padding: 0px; margin: 0px; display: inline-block;">
                    <div style="width: 99%;height: 50px; padding: 0px; margin: 0px;">
                        <p style="font-size: 1.1em; text-align: center;"><strong>{{$datosCarnetProvisorio->compNombre}}</strong></p>
                        <p style="font-size:0.6em; text-align: center; margin-bottom: 10px">{{$datosCarnetProvisorio->etiqueta}}</p>
                    </div>
                    <div style="width: 99%;height: 35px; padding: 0px; margin: 0 auto;">
                        <p style="font-size: 0.65em; text-align: center;">{{$datosCarnetProvisorio->direccion}} {{$datosCarnetProvisorio->localidadNombre}} - Argentina</p>
                    </div>
				</div>
        	</div>
        	<div style="width: 224px; height: 160px; margin-left: 3px; position: absolute; top: 15; left: 112;">
                <div style="width: 99.8%; height: 45px; border-left: 1px solid #000; border-bottom: 1px solid #000;">
                    <div style="width: 95%; margin: 0 auto; padding-top: 15px;">
                        <p style="font-size:16px; text-align: center"><strong>POLIZA N° {{$datosCarnetProvisorio->numPoliza}}</strong></p>
                    </div>
                </div>
        		<div style="width: 99.8%; height: 35px; border-left: 1px solid #000; border-bottom: 1px solid #000;">
                    <div style="width: 90%; margin: 0px auto; padding-top: 3px;">
                        <p style="font-size:12px; text-align: center">SEGURO OBLIGATORIO AUTOMOTOR RES. S.S.N. 21.999</p>
                    </div>
                </div>
                <div style="width: 100%; height: 78px; border-left: 1px solid #000;">
                    <div style="width: 100%; height: 15px;">
                        <p style="font-size:12px; text-align: center">VIGENCIA DE COBERTURA</p>
                    </div>
                    <div style="width: 100%; height: 50px;  padding-top: 12px;">
                        <div style="width: 49%; height: 62px; padding: 0px; margin: 0px; display: inline-block;">
                            <p style="font-size:12px; text-align: center">Desde 12hs. día</p>
                        </div>
                        <div style="width: 48.2%; height: 62px; border-left: 1px solid #000; display: inline-block;">
                            <p style="font-size:12px; text-align: center">Hasta 12hs. día</p>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
        <!-- FIN CARNET PARTE 1 -->

        <!-- CARNET PARTE 2 -->
        <div style="width: 345px; height: 160px; border: 1px solid #000; display: inline-block; margin-left: 30px;">
            <div style="width: 100%; height: 20px;">
                <p style="font-size:12px; text-align: left; padding-top: 2px; padding-left: 20px;">DATOS DEL VEHICULO ASEGURADO</p>
            </div>
            <div style="width: 62%; height: 95px; border-bottom: 1px solid #000;">
                <ul>
                    <li style="list-style: none; font-size: 12px; margin-left: 2px; margin-top: 4px; margin-bottom: 5px;">MARCA: {{$datosCarnetProvisorio->maNombre}}</li>
                    <li style="list-style: none; font-size: 12px; margin-left: 2px; margin-top: 4px; margin-bottom: 5px;">CHASIS: {{$datosCarnetProvisorio->chasis}}</li>
                    <li style="list-style: none; font-size: 12px; margin-left: 2px; margin-top: 4px; margin-bottom: 5px;">MOTOR: {{$datosCarnetProvisorio->motor}}</li>
                    <li style="list-style: none; font-size: 12px; margin-left: 2px; margin-top: 4px; margin-bottom: 5px;">MODELO: {{$datosCarnetProvisorio->moNombre}}</li>
                </ul>
            </div>
            <div style="width: 37.3%; height: 95px; border-bottom: 1px solid #000; position: absolute; top:30.75; left:469.3;">
                <ul>
                    <li style="list-style: none; font-size: 12px; margin-left: 2px; margin-top: 4px; margin-bottom: 5px;">DOMINIO: {{$datosCarnetProvisorio->dominio}}</li>
                    <li style="list-style: none; font-size: 12px; margin-left: 2px; margin-top: 4px; margin-bottom: 5px;">USO: </li>
                </ul>
            </div>
            <div style="width: 50%; height: 39px; padding-top: 4px; float: right">
                <p style="font-size:10px; text-align: center;">{{$datosEmpresa['propietario']}}</p>
                <p style="font-size:10px; text-align: center;">OFICINA {{$datosEmpresa['localidad']}}</p>
                <p style="font-size:10px; text-align: center;">{{$datosEmpresa['direccion']}}</p>
            </div>
        </div>
        <!-- FIN CARNET PARTE 2 -->
	</div>
</body>
</html>
