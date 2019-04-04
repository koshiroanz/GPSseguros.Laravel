@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('siniestro')}}">Siniestros</a></li>
			    	<li class="breadcrumb-item active" aria-current="page">Editar</li>
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
							<h3>Editar Siniestro: <span class="label label-warning"></span></h3>
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li class="icono-error"><i class="fa fa-times-circle"> {{$error}}</i></li>
									@endforeach
								</ul>
							</div>
							@endif
							{!!Form::model($siniestro, ['method' => 'PATCH', 'route' => ['siniestro.update', $siniestro->id]])!!}
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="panel panel-primary">
								  		<div class="panel-heading" style="font-size: 18px;">DATOS ASEGURADO</div>
								  		<div class="panel-body">
								    		
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="categoria">Póliza <span class="campo-o">*</span></label>
														<select class="form-control" name="poliza">
															<option value="{{$siniestro->poliza_id}}">{{$siniestro->poliza->numPoliza}}</option>
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="cliente">Cliente <span class="campo-o">*</span></label>
														<select class="form-control" name="cliente">
															<option value="{{$siniestro->cliente_id}}">{{$siniestro->cliente->apellido}}, {{$siniestro->cliente->nombre}}</option>
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="vehiculo">Vehículo <span class="campo-o">*</span></label>
														<select class="form-control" name="vehiculo">
															<option value="{{$siniestro->vehiculo_id}}">{{$siniestro->vehiculo->dominio}}</option>
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="conductor">Conductor <span class="campo-o">*</span></label>
														<input class="form-control" type="text" name="conductor" value="{{$siniestro->conductor}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="fechaSiniestro">Fecha siniestro <span class="campo-o">*</span></label>
														<input class="form-control" type="text" name="fechaSiniestro" id="datepicker" value="{{$siniestro->fechaSiniestro}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="fechaDenunciaInterna">Fecha denuncia interna <span class="campo-o">*</span></label>
														<input class="form-control" type="text" name="fechaDenunciaInterna" id="datepicker2" value="{{$siniestro->fechaDenunciaInterna}}">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="exposicionPolicial">Exposición policial</label>
														<select class="form-control" name="exposicionPolicial">
															{!!$exposicionPolicial!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="fotocopiaDni">Fotocopia DNI</label>
														<select class="form-control" name="fotocopiaDni">
															{!!$fotocopiaDni!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="fotocopiaCV">Fotocopia cédula verde</label>
														<select class="form-control" name="fotocopiaCV">
															{!!$fotocopiaCV!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="fotocopiaCC">Fotocopia carnet conductor</label>
														<select class="form-control" name="fotocopiaCC">
															{!!$fotocopiaCC!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="fotocopiaVTV">Fotocopia VTV</label>
														<select class="form-control" name="fotocopiaVTV">
															{!!$fotocopiaVTV!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="otros">otros (informe de transito)</label>
														<select class="form-control" name="otros">
															{!!$otros!!}
														</select>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12 label-combo-siniestro" for="fotosAsegurado">Fotos asegurado</label>
														<input type="file" class="form-control" name="fotosAsegurado[]" id="fotosA" multiple disabled>
														<!--<div class="form-control" style="width: 100%; padding: 15px 0px 15px 0px; border-right: 1px solid #d2d6de; border-bottom: 1px solid #d2d6de; border-left: 1px solid #d2d6de;"> -->
															@foreach($imagenesSiniestroCliente as $imagenSiniestro)
																@if($imagenSiniestro->asegurado == 1)
																	<div class="col-sm-12 col-md-6 col-lg-4" style="margin-top: 20px !important; padding-left: 0 !important;">
																	    <div class="thumbnail">
																	      	<img src="{{asset($ruta)}}/fotosAsegurado/{{$imagenSiniestro->filename}}" style="width: 150px; height: 150px;" alt="">
																	      	<div class="caption">
																	        	<h3 style="text-align: center;">{{$imagenSiniestro->filename}}</h3>
																	        	<p style="text-align: center;"><a href="#" class="btn btn-primary" role="button">Ver</a></p>
																	      	</div>
																	    </div>
																	    <!-- <div style="width: 90%; height: 120px; margin: 0 auto; border: 1px solid #000;"></div> -->
																	</div>
																@endif
															@endforeach
														<!--</div>-->
													</div>
												</div>
											</div>
											
								  		</div>
									</div>
									<div class="panel panel-primary">
								  		<div class="panel-heading" style="font-size: 18px;">DATOS TERCERO</div>
								  		<div class="panel-body">
								  			<div class="row">
							  					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="tercero">Tercero <span class="campo-o">*</span></label>
														<input type="text" class="form-control" name="terceroUno" value="{{$siniestro->terceroUno}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="dominioTercero">Dominio tercero <span class="campo-o">*</span></label>
														<input type="text" class="form-control" name="dominioUno" value="{{$siniestro->dominioUno}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="conductorTercero">Conductor tercero <span class="campo-o">*</span></label>
														<input type="text" class="form-control" name="conductorUno" value="{{$siniestro->conductorUno}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="terceroDos">Tercero(2)</label>
														<input type="text" class="form-control" name="terceroDos" value="{{$siniestro->terceroDos}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="dominioDos">Dominio(2)</label>
														<input type="text" class="form-control" name="dominioDos" value="{{$siniestro->dominioDos}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="conductorDos">Conductor(2)</label>
														<input type="text" class="form-control" name="conductorDos" value="{{$siniestro->conductorDos}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="fechaReclamoTercero">Fecha reclamo 3° <span class="campo-o">*</span></label>
														<input type="text" class="form-control" name="fechaReclamoTercero" id="datepicker3" value="{{$siniestro->fechaReclamoTercero}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="exposicionPolicialTercero">Exposición policial 3°</label>
														<select class="form-control" name="exposicionPolicialTercero">
															{!!$exposicionPolicialTercero!!}
														</select>
													</div>
												</div>
								  			</div>
								  			<div class="row">
								  				
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="fotocopiaCVTercero">Fotocopia CV tercero</label>
														<select class="form-control" name="fotocopiaCVTercero">
															{!!$fotocopiaCVTercero!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="fotocopiaCCTercero">Fotocopia CC tercero</label>
														<select class="form-control" name="fotocopiaCCTercero">
															{!!$fotocopiaCCTercero!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="boletaCompra">Boleta compra</label>
														<select class="form-control" name="boletaCompra">
															{!!$boletaCompra!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="certificadoCobertura">Certificado de cobertura</label>
														<select class="form-control" name="certificadoCobertura">
															{!!$certificadoCobertura!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="denunciaAdministrativa">Denuncia administrativa</label>
														<select class="form-control" name="denunciaAdministrativa">
															{!!$denunciaAdministrativa!!}
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="presupuesto">Presupuesto</label>
														<input type="text" class="form-control" name="presupuesto" value="{{$siniestro->presupuesto}}">
													</div>
												</div>
								  			</div>

											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="presupuestoDos">Presupuesto(2)</label>
														<input type="text" class="form-control" name="presupuestoDos" value="{{$siniestro->presupuestoDos}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="totalPresupuesto">Total presupuesto</label>
														<input type="text" class="form-control" name="totalPresupuesto" value="{{$siniestro->totalPresupuesto}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="gastosMedicos">Gastos médicos</label>
														<input type="text" class="form-control" name="gastosMedicos" value="{{$siniestro->gastosMedicos}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label class="col-xs-12" style="padding-left: 0px !important" for="informeMedico">Informe médico</label>
														<select class="form-control" name="informeMedico">
															{!!$informeMedico!!}
														</select>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="fotosTercero">Fotos 3° <span class="campo-o">*</span></label>
														<input type="file" class="form-control" name="fotosTercero[]" disabled>
														@foreach($imagenesSiniestroCliente as $imagenSiniestro)
															@if($imagenSiniestro->asegurado == 0)
																<div class="col-sm-12 col-md-6 col-lg-4" style="margin-top: 20px !important; padding-left: 0 !important;">
																    <div class="thumbnail">
																      	<img src="{{asset($ruta)}}/fotosTercero/{{$imagenSiniestro->filename}}" style="width: 150px; height: 150px;" alt="">
																      	<div class="caption">
																        	<h3 style="text-align: center;">{{$imagenSiniestro->filename}}</h3>
																        	<p style="text-align: center;"><a href="#" class="btn btn-primary" role="button">Ver</a></p>
																      	</div>
																    </div>
																    <!-- <div style="width: 90%; height: 120px; margin: 0 auto; border: 1px solid #000;"></div> -->
																</div>
															@endif
														@endforeach
													</div>
												</div>
												
											</div>
							  			</div>
						  			</div>
						  			<div class="panel panel-primary">
								  		<div class="panel-heading" style="font-size: 18px;">DATOS COMPAÑIA</div>
								  		<div class="panel-body">
								  			<div class="row">
								  				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="fechaEnvioDI">Fecha de envío denuncia interna</label>
														<input type="text" class="form-control" name="fechaEnvioDI" id="datepicker4" value="{{$siniestro->fechaEnvioDI}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="fechaEnvioRT">Fecha de envío reclamo 3°</label>
														<input type="text" class="form-control" name="fechaEnvioRT" id="datepicker5" value="{{$siniestro->fechaEnvioRT}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="fechaDictamen">Fecha dictamen</label>
														<input type="text" class="form-control" name="fechaDictamen" id="datepicker6" value="{{$siniestro->fechaDictamen}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="ofrecimiento">Ofrecimiento</label>
														<input type="text" class="form-control" name="ofrecimiento" value="{{$siniestro->ofrecimiento}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="vencimientoReclamo">Vencimiento reclamo</label>
														<input type="text" class="form-control" name="vencimientoReclamo" id="datepicker7" value="{{$siniestro->vencimientoReclamo}}">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="dictamen">Dictamen</label>
														<span data-toggle="tooltip" data-placement="bottom" title="máx. 190 caracteres">
															<textarea class="form-control" name="dictamen">{{$siniestro->dictamen}}</textarea>
														</span>
													</div>
												</div>
								  			</div>
							  			</div>
						  			</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
										<a href="{{url('siniestro')}}"><button class="btn btn-labeled btn-danger" type="button"><span class="btn-label"><i class="fa fa-undo"></i></span>Atrás</button></a>
									</div>
								</div>
							{!!Form::close()!!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection