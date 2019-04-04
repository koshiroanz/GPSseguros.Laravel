@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('siniestro')}}">Siniestros</a></li>
			    	<li class="breadcrumb-item active" aria-current="page">Nuevo</li>
			  	</ol>
			</nav>
  			<div class="box-tools pull-right div-box-tools">
    			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body" id="div-box-body">
  			<div class="row">
      			<div class="col-md-12">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3>Siniestro</h3>
							{!!Form::open(array('url' => 'siniestro', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off'))!!}
								<div class="col-xs-12">
									<div class="panel panel-primary panel-square">
								  		<div class="panel-heading panel-header-square" style="color: #b8c7ce;">Datos asegurado</div>
								  		<div class="panel-body" style="border: 0 !important;">
											<div class="row">
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="cliente">Cliente <span class="campo-o">*</span></label>
														<select class="form-control selectpicker" name="cliente" id="select-cliente" data-live-search="true">
															<option value="">Seleccione un cliente</option>
															@foreach($clientes as $cliente)
																<option value="{{$cliente->id}}" @if(old('cliente') == $cliente->id) {{ 'selected' }} @endif>{{$cliente->apellido}}, {{$cliente->nombre}} - {{$cliente->dni}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="vehiculo">Vehículo <span class="campo-o">*</span></label>
														<select class="form-control" name="vehiculo" id="select-vehiculo">
															<option value="">Seleccione un vehículo</option>
														</select>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="categoria">Póliza <span class="campo-o">*</span></label>
														<select class="form-control" name="poliza" id="select-poliza">
															<option value="">Seleccione una póliza</option>
														</select>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="conductor">Conductor <span class="campo-o">*</span></label>
														<input class="form-control" type="text" name="conductor" id="input-conductor">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="fechaSiniestro">Fecha siniestro <span class="campo-o">*</span></label>
														<input class="form-control" type="text" name="fechaSiniestro" id="datepicker" placeholder="dd-mm-aaaa">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="fechaDenunciaInterna">Fecha denuncia interna <span class="campo-o">*</span></label>
														<input class="form-control" type="text" name="fechaDenunciaInterna" id="datepicker2" placeholder="dd-mm-aaaa">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="exposicionPolicial">Exposición policial</label>
														<select class="form-control" name="exposicionPolicial">
															<option value="1">SI</option>
															<option value="0">NO</option >
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="fotocopiaDni">Fotocopia DNI</label>
														<select class="form-control" name="fotocopiaDni">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="fotocopiaCV">Fotocopia cédula verde</label>
														<select class="form-control" name="fotocopiaCV">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="fotocopiaCC">Fotocopia carnet conductor</label>
														<select class="form-control" name="fotocopiaCC">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="fotocopiaVTV">Fotocopia VTV</label>
														<select class="form-control" name="fotocopiaVTV">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>

												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="otros">otros (informe de transito)</label>
														<select class="form-control" name="otros">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												
												<div class="col-xs-12">
													<div class="form-group" id="div-container-img-cliente">
														<label class="col-xs-12 label-combo-siniestro" for="fotosAsegurado">Fotos asegurado</label>
														<input type="file" class="form-control" name="fotosAsegurado[]" id="fotosA" multiple>
													</div>
												</div>
											</div>
								  		</div>
									</div>
									<div class="panel panel-primary panel-square">
										<div class="panel-heading panel-header-square" style="color: #b8c7ce;">Datos tercero</div>
								  		<div class="panel-body" style="border: 0 !important;">
								  			<div class="row">
							  					<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="terceroUno">Tercero <span class="campo-o">*</span></label>
														<input type="text" class="form-control" name="terceroUno" placeholder="">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="dominioUno">Dominio tercero <span class="campo-o">*</span></label>
														<input type="text" class="form-control" name="dominioUno" placeholder="">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="conductorTercero">Conductor tercero <span class="campo-o">*</span></label>
														<input type="text" class="form-control" name="conductorUno" placeholder="">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="terceroDos">Tercero(2)</label>
														<input type="text" class="form-control" name="terceroDos" placeholder="">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="dominioDos">Dominio(2)</label>
														<input type="text" class="form-control" name="dominioDos" placeholder="">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="conductorDos">Conductor(2)</label>
														<input type="text" class="form-control" name="conductorDos" placeholder="">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="fechaReclamoTercero">Fecha reclamo 3° <span class="campo-o">*</span></label>
														<input type="text" class="form-control" name="fechaReclamoTercero" id="datepicker3" placeholder="dd-mm-aaaa">
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="exposicionPolicialTercero">Exposición policial 3°</label>
														<select class="form-control" name="exposicionPolicialTercero">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="fotocopiaCVTercero">Fotocopia CV tercero</label>
														<select class="form-control" name="fotocopiaCVTercero">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="fotocopiaCCTercero">Fotocopia CC tercero</label>
														<select class="form-control" name="fotocopiaCCTercero">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="boletaCompra">Boleta compra</label>
														<select class="form-control" name="boletaCompra">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="certificadoCobertura">Certificado de cobertura</label>
														<select class="form-control" name="certificadoCobertura">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="denunciaAdministrativa">Denuncia administrativa</label>
														<select class="form-control" name="denunciaAdministrativa">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="presupuesto">Presupuesto</label>
														<input type="text" class="form-control" name="presupuesto" placeholder="$">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="presupuestoDos">Presupuesto(2)</label>
														<input type="text" class="form-control" name="presupuestoDos" placeholder="$">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="totalPresupuesto">Total presupuesto</label>
														<input type="text" class="form-control" name="totalPresupuesto" placeholder="$">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="gastosMedicos">Gastos médicos</label>
														<input type="text" class="form-control" name="gastosMedicos" placeholder="$">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="informeMedico">Informe médico</label>
														<select class="form-control" name="informeMedico">
															<option value="1">SI</option>
															<option value="0">NO</option>
														</select>
													</div>
												</div>
								  			</div>

											<div class="row">
												<div class="col-sm-12">
													<div class="form-group" id="div-container-img-tercero">
														<label for="fotosTercero">Fotos 3° <span class="campo-o">*</span></label>
														<input type="file" class="form-control" name="fotosTercero[]" id="fotos3" multiple>
													</div>
												</div>
											</div>
							  			</div>
						  			</div>
						  			<div class="panel panel-primary panel-square">
						  				<div class="panel-heading panel-header-square" style="color: #b8c7ce;">Datos compañia</div>
								  		<div class="panel-body" style="border: 0 !important;">
								  			<div class="row">
								  				<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="fechaEnvioDI">Fecha de envío denuncia interna</label>
														<input type="text" class="form-control" name="fechaEnvioDI" id="datepicker4" placeholder="dd-mm-aaaa">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="fechaEnvioRT">Fecha de envío reclamo 3°</label>
														<input type="text" class="form-control" name="fechaEnvioRT" id="datepicker5" placeholder="dd-mm-aaaa">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="fechaDictamen">Fecha dictamen</label>
														<input type="text" class="form-control" name="fechaDictamen" id="datepicker6" placeholder="dd-mm-aaaa">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="ofrecimiento">Ofrecimiento</label>
														<input type="text" class="form-control" name="ofrecimiento" placeholder="">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="vencimientoReclamo">Vencimiento reclamo</label>
														<input type="text" class="form-control" name="vencimientoReclamo" id="datepicker7" placeholder="dd-mm-aaaa">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="dictamen">Dictamen</label>
														<span data-toggle="tooltip" data-placement="bottom" title="máx. 190 caracteres">
															<textarea class="form-control" name="dictamen"></textarea>
														</span>
													</div>
												</div>
								  			</div>
							  			</div>
						  			</div>
								</div>
								<div class="col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Guardar</button>
										<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-eraser"></i></span>Reset</button>
									</div>
								</div>
							{!!Form::close()!!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="myModal" class="popup">
     	<!-- Modal content -->
     	<div class="popup-content">
	        <div class="popup-header">
	           <span class="end">x</span>
	           <h2>Mensaje</h2>
	        </div>
	        <div class="popup-body">
	           <h3>Máximo de fotos permitidos: 4</h3>
	        </div>
     	</div>
  	</div>

  	<style>
         .popup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F1F1F1;
            background-color: rgba(0,0,0,0.4);
            -webkit-animation-name: fadeIn;
            -webkit-animation-duration: 0.4s;
            animation-name: fadeIn;
            animation-duration: 0.4s
         }
         .popup-content {
            position: fixed;
            bottom: 0;
            background-color: #ffffff;
            width: 100%;
            margin: 0 auto;
            -webkit-animation-name: slideIn;
            -webkit-animation-duration: 0.5s;
            animation-name: slideIn;
            animation-duration: 0.5s
         }
         .end {
            color: white;
            float: right;
            font-size: 15px;
            font-weight: bold;
         }
         .end:hover,
         .end:focus {
            color: #000;
            text-decoration: underline;
            cursor: pointer;
         }
         .popup-header {
            padding: 1px 10px;
            background-color: #f5a633;
            color: white;
         }
         .popup-body {padding: 1px 5px;}
         @-webkit-keyframes slideIn {
            from {bottom: -300px; opacity: 0}
            to {bottom: 0; opacity: 1}
         }
         @keyframes slideIn {
            from {bottom: -300px; opacity: 0}
            to {bottom: 0; opacity: 1}
         }
         @-webkit-keyframes fadeIn {
            from {opacity: 0}
            to {opacity: 1}
         }
         @keyframes fadeIn {
            from {opacity: 0}
            to {opacity: 1}
         }
  	</style>
	<script type="text/javascript">

		$(document).ready(function(){

			$("#fotosA").on("change", function(){
				var numFilesCliente = $("#div-container-img-cliente > div").length;
				var numFiles = $(this).get(0).files.length;

				if(numFilesCliente > 0){	// #container-img-1 => DIV PADRE
		    		for(var j = 0; j < numFilesCliente; j++)
			            $("#container-img-cliente").remove();
		    	}

				if(numFiles > 4){
					popUpCall();
					/*var popup = document.getElementById('myModal');
			        var span = document.getElementsByClassName("end")[0*/
	              	$("#fotosA").val('');
	              	
		            /*popup.style.display = "block";
			        span.onclick = function() {
			            popup.style.display = "none";
			        }
			        window.onclick = function(event) {
			            if (event.target == popup) {
			               popup.style.display = "none";
			            }
			        }*/
				}else{
					readURL(this, '#div-container-img-cliente', 'container-img-cliente');
				}
			});

	        $("#fotos3").on("change", function(){
	        	var numFilesTercero = $("#div-container-img-tercero > div").length;
				var numFiles = $(this).get(0).files.length;

				if(numFilesTercero > 0){	// #container-img-1 => DIV PADRE
		    		for(var j = 0; j < numFilesTercero; j++)
			            $("#container-img-tercero").remove();
		    	}

				if(numFiles > 4){
	              	alert("Seleccione nuevamente. Máximo de fotos permitidos: 4");	// Imprimir mensaje en ventana modal dinamicamente
	              	$("#fotos3").val('');
	           	}else{
					readURL(this, '#div-container-img-tercero', 'container-img-tercero');
				}
	        });

	        function readURL(input, divContainer, containerImg) {
		        if (input.files && input.files[0]) {
		            for(var i = 0; i < input.files.length; i++){
		            	var reader = new FileReader();
		            	reader.fileName = input.files[i].name;

		            	reader.onload = function (e, name) {
		            		$(divContainer).append('<div class="col-sm-12 col-md-6 col-lg-4" id="'+containerImg+'" style="margin-top: 20px !important; padding-left: 0 !important;"><div class="thumbnail"><img src="'+e.target.result+'" style="width: 150px; height: 150px;"><div class="caption"><h3 style="text-align: center;">'+e.target.fileName+'</h3></div></div></div>');		            	
			            }

			            reader.readAsDataURL(input.files[i]);
	            	}
		        }
		    }

		    function popUpCall(){
		    	var popup = document.getElementById('myModal');
		        var span = document.getElementsByClassName("end")[0];

	            popup.style.display = "block";
		        span.onclick = function() {
		            popup.style.display = "none";
		        }
		        window.onclick = function(event) {
		            if (event.target == popup) {
		               popup.style.display = "none";
		            }
		        }
		    }
		    
        });
    </script>

    <script type="text/javascript">
    	$(document).ready(function(){

	        $('#select-cliente').change(function(){
				var cliente = $('#select-cliente').val();
				var datosCliente = $('#select-cliente option:checked').text();
				var apellidoNombre = datosCliente.split('-');
				
				if(cliente != ''){
					$.ajax({
						url: "/getClienteVehiculo",
			          	type: 'get',
			          	data: {
			            	cliente: cliente
			          	},

			          	success: function(data){
			          		$('#select-vehiculo').empty();
			          		$("#input-conductor").val('');
			          		$('#input-conductor').val(apellidoNombre[0]);
			          		$("#select-vehiculo").append('<option value="">Seleccione un vehículo</option>');

			          		$.each(data,function(key, registro) {
				            	$("#select-vehiculo").append('<option value='+registro.id+'>'+registro.dominio+'</option>');
				          	});			          		
			          	},
			          	error: function(data){
			          	}
					});
				}else{
					alert('Debe seleccionar una opción válida.');	// Imprimir mensaje en ventana modal dinamicamente
				}
			});

			$('#select-vehiculo').change(function(){
				var vehiculo = $('#select-vehiculo').val();

				if(vehiculo != ''){
					$.ajax({
						url: "/getVehiculoPoliza",
			          	type: 'get',
			          	data: {
			            	vehiculo: vehiculo
			          	},

			          	success: function(data){
			          		$('#select-poliza').empty();
			          		$("#select-poliza").append('<option value="">Seleccione una póliza</option>');

			          		$.each(data,function(key, registro) {
				            	$("#select-poliza").append('<option value='+registro.id+'>'+registro.numPoliza+'</option>');
				          	});
			          	},
			          	error: function(data){
			          	}
					});
				}else{
					alert('Debe seleccionar una opción válida.');	// Imprimir mensaje en ventana modal dinamicamente
				}
			});
		});
	</script>
@endsection