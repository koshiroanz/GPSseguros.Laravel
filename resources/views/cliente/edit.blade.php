@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('cliente')}}">Clientes</a></li>
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
							<h3>Editar Cliente: <span class="label label-warning">{{$cliente->apellido}}, {{$cliente->nombre}}</span></h3>
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li class="icono-error"><i class="fa fa-times-circle"> {{$error}}</i></li>
									@endforeach
								</ul>
							</div>
							@endif
							{!!Form::model($cliente, ['method' => 'PATCH', 'route' => ['cliente.update', $cliente->id]])!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="dni">DNI <span class="campo-o">*</span></label>
										<input type="text" name="dni" class="form-control" value="{{$cliente->dni}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="apellido">Apellido <span class="campo-o">*</span></label>
										<input type="text" name="apellido" class="form-control" value="{{$cliente->apellido}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="nombre">Nombre <span class="campo-o">*</span></label>
										<input type="text" name="nombre" class="form-control" value="{{$cliente->nombre}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="fechaNacimiento">Fecha de nacimiento <span class="campo-o">*</span></label>
										<input type="text" name="fechaNacimiento" id="datepicker" class="form-control" value="{{$fechaNac}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="cuit">CUIT/CUIL <span class="campo-o">*</span></label>
										<input type="text" name="cuit" class="form-control" value="{{$cliente->cuit}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="direccion">Dirección <span class="campo-o">*</span></label>
										<input type="text" name="direccion" class="form-control" value="{{$cliente->direccion}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono1">Teléfono 1 <span class="campo-o">*</span></label>
										<input type="text" name="telefono1" class="form-control" value="{{$cliente->telefono1}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono2">Teléfono 2</label>
										<input type="text" name="telefono2" class="form-control" value="{{$cliente->telefono2}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="localidad">Localidad <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="localidad" data-live-search="true">
											<option value="{{$cliente->localidad->id}}">{{$cliente->localidad->nombre}}</option>
												@foreach($localidades as $localidad)
													<option value="{{$localidad->id}}">{{$localidad->nombre}}</option>
												@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="estadoCivil">Estado civil <span class="campo-o">*</span></label>
										<select class="form-control" name="estadoCivil">
											<option value="{{$cliente->estadoCivil}}">{{$cliente->estadoCivil}}</option>
											@foreach($estadosCivil as $estadoCivil)
												<option value="{{$estadoCivil}}">{{$estadoCivil}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="fechaBaja">Fecha baja</label>
										<input type="text" name="fechaBaja" id="datepicker2" class="form-control" value="{{$fechaBaja}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="estado">Estado <span class="campo-o">*</span></label>
										<select class="form-control" name="estado">
											<option value="{{$cliente->estado}}">{{$cliente->estado}}</option>
											@foreach($estados as $estado)
												<option value="{{$estado}}">{{$estado}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="productor">Productor/a <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="productor" data-live-search="true">
											<option value="{{$cliente->user->id}}">{{$cliente->user->apellido}}, {{$cliente->user->nombre}} / {{$cliente->user->dni}}</option>
											@foreach($productores as $productor)
												<option value="{{$productor->id}}">{{$productor->apellido}}, {{$productor->nombre}} / {{$productor->dni}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
										<a href="{{url('cliente')}}"><button class="btn btn-labeled btn-danger" type="button"><span class="btn-label"><i class="fa fa-undo"></i></span>Atrás</button></a>
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