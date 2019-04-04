<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GPSseguros | Certificado</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/reportes.css">
</head>
<body>
    <header>
        <div class="div-header">
            <p class="texto-encabezado">CONSTANCIA DE COBERTURA PARA VEHÍCULOS DE USO PARTICULAR CON PATENTE EXTRANJERA</p>
        </div>
    </header>
    <div class="contenedor-paralelo">
        <p class="texto-contenedor-paralelo">Original Asegurado, Copia Aseguradora</p>
    </div>
    <section>
        <div class="section-contenedor-1">

            <div class="contenedor-1">
                <div class="contenedor-2">
                    <div class="contenedor-logo">
                        <img class="img-comp" src="storage/aseguradora_img/{{$datosCertificado->logo_img}}">
                    </div>
                    <div class="contenedor-aseguradora">
                        <div style="width: 99%; margin: auto;">
                            <p class="aseguradora-datos-1">{{$datosCertificado->compNombre}}</p>
                            <p class="aseguradora-datos-2">{{$datosCertificado->etiqueta}}</p>
                        </div>
                    </div>
                </div>
                <div class="contenedor-datos-aseguradora">
                    <p class="p-texto-aseguradora">{{$datosCertificado->direccion}} {{$datosCertificado->loNombre}} Argentina</p>
                    <p class="p-texto-aseguradora">Tel/Fax: {{$datosCertificado->telefono1}} 
                        @if($datosCertificado->telefono2) 
                            /
                        @endif
                        {{$datosCertificado->telefono2}}
                    </p>
                    <p class="p-texto-aseguradora">E-mail: {{$datosCertificado->email}}</p>
                    <p class="p-texto-aseguradora">{{$datosCertificado->paginaweb}}</p>
                </div>
            </div>
            
            <div class="contenedor-poliza-vigencia">
                <div class="contenedor-poliza">
                    <p class="p-texto-contenedor-poliza-vigencia">PÓLIZA N°</p>
                    <div class="contenedor-interno-poliza">
                        <!-- máx. caracteres: 25 -->
                        <p class="p-texto-poliza-vigencia">{{$datosCertificado->numPoliza}}</p>
                    </div>
                </div>
                <div class="contenedor-vigencia">
                    <p class="p-texto-contenedor-poliza-vigencia">VIGENCIA</p>
                    <div class="contenedor-interno-vigencia">
                        <p class="p-texto-poliza-vigencia">{{$datosCertificado->vigenciaPoliza}} al {{$datosCertificado->vigenciaPolizaHasta}}</p>
                    </div>
                </div>
            </div>

            <div class="contenedor-datos-asegurado">
                <div class="contenedor-interno-asegurado">
                    <div class="contenedor-asegurado">
                        <p class="seccion-2-texto-1">ASEGURADO</p>
                    </div>
                    <div class="contenedor-interno-datos">
                        <div class="contenedor-datos-titulo">
                            <span>Nombre</span>
                        </div>
                        <div class="contenedor-nombre-datos">
                            <p class="p-texto-datos-asegurado">{{$datosCertificado->apellido}} {{$datosCertificado->nombre}}</p>
                        </div>
                    </div>

                    <div class="contenedor-interno-datos">
                        <div class="contenedor-datos-titulo">
                            <span>Domicilio</span>
                        </div>
                        <div style="width: 86%; height: auto; display: inline-block; border-bottom: 0.5px solid #000; margin-top: 1px;">
                            <p class="p-texto-datos-asegurado">{{$datosCertificado->clienteDireccion}}</p>
                        </div>
                    </div>

                    <div class="contenedor-interno-datos">
                        <div class="contenedor-datos-titulo">
                            <span>Localidad</span>
                        </div>
                        <div style="width: 86%; height: auto; display: inline-block; border-bottom: 0.5px solid #000; margin-top: 1px;">
                            <p class="p-texto-datos-asegurado">{{$datosCertificado->localidadNombre}}</p>
                        </div>
                    </div>

                    <div class="contenedor-interno-datos">
                        <span>Marca</span>
                        <div style="width: 23%; height: auto; display: inline-block; border-bottom: 0.5px solid #000; margin-top: 1px;">
                            <p class="p-texto-3">{{$datosCertificado->marcaNombre}}</p>
                        </div>
                        <span>Modelo</span>
                        <div style="width: 42%; height: auto; display: inline-block; border-bottom: 0.5px solid #000; margin-top: 1px;">
                            <p class="p-texto-3">{{$datosCertificado->modeloNombre}}</p>
                        </div>
                        <span>Año</span>
                        <div style="width: 12%; height: auto; display: inline-block; border-bottom: 0.5px solid #000; margin-top: 1px;">
                            <p class="p-texto-3">{{$datosCertificado->anio}}</p>
                        </div>
                    </div>

                    <div class="contenedor-interno-datos">
                        <div style="width: 15%; height: auto; display: inline-block;">
                            <span>Motor-Chasis</span>
                        </div>
                        <div style="width: 84%; height: auto; display: inline-block; border-bottom: 0.5px solid #000; margin-top: 1px;">
                            <p class="p-texto-datos-asegurado">{{$datosCertificado->motor}} - {{$datosCertificado->chasis}}</p>
                        </div>
                    </div>

                    <div class="contenedor-interno-datos">
                        <div style="width: 15%; height: auto; display: inline-block;">
                            <span>Matricula</span>
                        </div>
                        <div style="width: 84%; height: auto; display: inline-block; border-bottom: 0.5px solid #000; margin-top: 1px;">
                            <p class="p-texto-datos-asegurado">{{$datosCertificado->dominio}}</p>
                        </div>
                    </div>

                    <div style="width: 100%; height: 60px; margin-top: 7px;">
                        <p style="font-size: 13px; font-weight: bold;">Esta aseguradora certifica que el vehículo cuyos datos se detallan anteriormente se encuentra amparada en el riesgo de Responsabilidad Civil Únicamente, de acuerdo a los límites establecidos en el presente certificado.</p>
                    </div>
                    <div class="contenedor-interno-datos">
                        <span>Ciudad</span>
                        <div style="width: 23%; height: auto; display: inline-block; border-bottom: 1px solid #000; margin-top: 1px;">
                            <p class="p-texto-3">{{$datosCertificado->localidadNombre}}</p>
                        </div>
                        <span>Fecha</span>
                        <div style="width: 17%; height: auto; display: inline-block; border-bottom: 1px solid #000; margin-top: 1px;">
                            <p class="p-texto-3">{{$fechaActual}}</p>
                        </div>
                        <span>Firma Autorizada</span>
                        <div style="width: 24%; height: auto; display: inline-block; border-bottom: 1px solid #000; margin-top: 1px;">
                            <p class="p-texto-3"></p> <!-- Obtener firma digital -->
                        </div>
                    </div>
                </div>

                <div id="contenedor-subtitulo-final">
                    <p id="p-texto-subtitulo-final">LÍMITES MÁXIMOS POR VEHÍCULOS Y EVENTO DURANTE LA ESTADÍA EN ARGENTINA</p>
                </div>
                <div style="width: 100%; height: 65px; margin-top: 7px; border: 1px solid #000; padding-top: 5px;">
                    <div style="width: 100%; height: 15px;">
                        <p style="text-align: center; font-size: 10px; font-weight: bold">DAÑOS A TERCEROS NO TRANSPORTADOS</p>
                    </div>
                    <div style="width: 100%; height: 15px;">
                        <div style="width: 25%; height: auto; display: inline-block;">
                            <p style="text-align: center; font-size: 10px;">Muerte y/o Daños Personales</p>
                        </div>
                        <div style="width: 25%; height: auto; display: inline-block;">
                            <p style="text-align: center; font-size: 10px;">Límite Máximo</p>
                        </div>
                        <div style="width: 25%; height: auto; display: inline-block;">
                            <p style="text-align: center; font-size: 10px;">Daños Materiales</p>
                        </div>
                        <div style="width: 25%; height: auto; display: inline-block;">
                            <p style="text-align: center; font-size: 10px;">Límite Máximo</p>
                        </div>
                    </div>
                    <div style="width: 100%; height: 15px; margin-top: 5px;">
                        <div style="width: 25%; height: auto; display: inline-block;">
                            <p style="text-align: center; font-size: 10px;">Por Persona $20.000</p>
                        </div>
                        <div style="width: 25%; height: auto; display: inline-block;">
                            <p style="text-align: center; font-size: 10px;">Por Evento $100.000</p>
                        </div>
                        <div style="width: 25%; height: auto; display: inline-block;">
                            <p style="text-align: center; font-size: 10px;">Por Terceros $10.000</p>
                        </div>
                        <div style="width: 25%; height: auto; display: inline-block;">
                            <p style="text-align: center; font-size: 10px;">Por Evento $20.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>