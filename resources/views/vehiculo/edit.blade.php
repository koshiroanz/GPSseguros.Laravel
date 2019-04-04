@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('vehiculo')}}">Vehículos</a></li>
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
							<h3>Editar Vehículo: <span class="label label-warning">{{$vehiculo->dominio}}</span></h3>
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li class="icono-error"><i class="fa fa-times-circle"> {{$error}}</i></li>
									@endforeach
								</ul>
							</div>
							@endif
							{!!Form::model($vehiculo, ['method' => 'PATCH', 'route' => ['vehiculo.update', $vehiculo->id]])!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="dominio">Dominio <span class="campo-o">*</span></label>
										<input type="text" name="dominio" class="form-control" value="{{$vehiculo->dominio}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="marca">Marca <span class="campo-o">*</span></label>
										<select class="form-control" name="marca">
											<option value="{{$vehiculo->marca->id}}">{{$vehiculo->marca->nombre}}</option>
											@foreach($marcas as $marca)
												<option value="{{$marca->id}}">{{$marca->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="modelo">Modelo <span class="campo-o">*</span></label>
										<select class="form-control" name="modelo">
											<option value="{{$vehiculo->modelo->id}}">{{$vehiculo->modelo->nombre}}</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="nombre">Carrocería <span class="campo-o">*</span></label>
										<select class="form-control" name="carroceria">
											<option value="{{$vehiculo->carroceria->id}}">{{$vehiculo->carroceria->nombre}}</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="cliente">Propietario <span class="campo-o">*</span></label>
										<select class="form-control" name="cliente">
											<option value="{{$vehiculo->cliente->id}}">{{$vehiculo->cliente->apellido}}, {{$vehiculo->cliente->nombre}} / {{$vehiculo->cliente->dni}}</option>
											@foreach($clientes as $cli)
												<option value="{{$cli->id}}">{{$cli->apellido}}, {{$cli->nombre}} / {{$cli->dni}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="anio">Año <span class="campo-o">*</span></label>
										<input type="numeric" name="anio" class="form-control" value="{{$vehiculo->anio}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="chasis">Chasis <span class="campo-o">*</span></label>
										<input type="text" name="chasis" class="form-control" value="{{$vehiculo->chasis}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="motor">Motor <span class="campo-o">*</span></label>
										<input type="text" name="motor" class="form-control" value="{{$vehiculo->motor}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="valor">Valor <span class="campo-o">*</span></label>
										<input type="text" name="valor" class="form-control" value="{{$vehiculo->valor}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="combustible">Combustible</label>
										<input type="text" name="combustible" class="form-control" value="{{$vehiculo->combustible}}">
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
										<a href="{{url('vehiculo')}}"><button class="btn btn-labeled btn-danger" type="button"><span class="btn-label"><i class="fa fa-undo"></i></span>Atrás</button></a>
									</div>
								</div>
							{!!Form::close()!!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{asset('js/select_modelo_carroceria_vehiculo.js')}}"></script>
@endsection