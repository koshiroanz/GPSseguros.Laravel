@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('productor')}}">Productor</a></li>
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
							<h3>Editar Productor: <span class="label label-warning">{{$productor->apellido}}, {{$productor->nombre}}</span></h3>
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li class="icono-error"><i class="fa fa-times-circle"> {{$error}}</i></li>
									@endforeach
								</ul>
							</div>
							@endif
							{!!Form::model($productor, ['method' => 'PATCH', 'route' => ['productor.update', $productor->id]])!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="dni">DNI <span class="campo-o">*</span></label>
										<input type="text" name="dni" class="form-control" value="{{$productor->dni}}" placeholder="">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="apellido">Apellido <span class="campo-o">*</span></label>
										<input type="text" name="apellido" class="form-control" value="{{$productor->apellido}}" placeholder="">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="nombre">Nombre <span class="campo-o">*</span></label>
										<input type="text" name="nombre" class="form-control" value="{{$productor->nombre}}" placeholder="">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="direccion">Dirección <span class="campo-o">*</span></label>
										<input type="text" name="direccion" class="form-control" value="{{$productor->direccion}}" placeholder="">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono1">Teléfono 1 <span class="campo-o">*</span></label>
										<input type="text" name="telefono1" class="form-control" value="{{$productor->telefono1}}" placeholder="">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono2">Teléfono 2</label>
										<input type="text" name="telefono2" class="form-control" value="{{$productor->telefono2}}" placeholder="">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="localidad">Localidad <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="localidad" data-live-search="true">
											<option value="{{$productor->localidad->id}}">{{$productor->localidad->nombre}}</option>
											@foreach($localidades as $localidad)
												<option value="{{$localidad->id}}">{{$localidad->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="privilegio">Privilegio <span class="campo-o">*</span></label>
										<select class="form-control" name="privilegio">
											{!!$selectPrivilegio!!}
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="estado">Estado <span class="campo-o">*</span></label>
										<select class="form-control" name="estado">
											{!!$selectEstado!!}
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="estado">E-mail <span class="campo-o">*</span></label>
										<input type="email" name="email" class="form-control" value="{{$productor->email}}" placeholder="">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="password">Password <span class="campo-o">*</span></label>
										<input type="password" name="password" class="form-control" value="{{$productor->password}}" placeholder="">
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
										<a href="{{url('productor')}}"><button class="btn btn-labeled btn-danger" type="button"><span class="btn-label"><i class="fa fa-undo"></i></span>Atrás</button></a>
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