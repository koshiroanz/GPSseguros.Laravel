@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('productor')}}">Productor</a></li>
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
							<h3>Productor</h3>
							{!!Form::open(array('url' => 'productor', 'method' => 'POST', 'autocomplete' => 'off'))!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="dni">DNI <span class="campo-o">*</span></label>
										<input type="text" name="dni" class="form-control" placeholder="Aquí su DNI..." value="{{ old('dni') }}" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="apellido">Apellido <span class="campo-o">*</span></label>
										<input type="text" name="apellido" class="form-control" placeholder="Aquí su apellido..." value="{{ old('apellido') }}" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="nombre">Nombre <span class="campo-o">*</span></label>
										<input type="text" name="nombre" class="form-control" placeholder="Aquí su nombre..." value="{{ old('nombre') }}" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="direccion">Dirección <span class="campo-o">*</span></label>
										<input type="text" name="direccion" class="form-control" placeholder="Aquí su dirección..." value="{{ old('direccion') }}" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono">Teléfono 1 <span class="campo-o">*</span></label>
										<input type="text" name="telefono1" class="form-control" placeholder="Aquí teléfono 1°..." value="{{ old('telefono1') }}" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono2">Teléfono 2</label>
										<input type="text" name="telefono2" class="form-control" placeholder="Aquí teléfono 2°..." value="{{ old('telefono2') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="localidad">Localidad <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="localidad" data-live-search="true" required>
											<option value="">Seleccione una opción</option>
											@foreach($localidades as $localidad)
												<option value="{{$localidad->id}}" @if(old('localidad') == $localidad->id) {{ 'selected' }} @endif>{{$localidad->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="privilegio">Privilegio <span class="campo-o">*</span></label>
										<select class="form-control" name="privilegio">
											<option value="ALTO" {{ old('privilegio') == 'ALTO' ? 'selected' : '' }}>ALTO</option>
											<option value="MEDIO" {{ old('privilegio') == 'MEDIO' ? 'selected' : '' }}>MEDIO</option>
											<option value="BAJO" {{ old('privilegio') == 'BAJO' ? 'selected' : '' }}>BAJO</option>
										</select>
									</div>
								</div>								
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="estado">Estado <span class="campo-o">*</span></label>
										<select class="form-control" name="estado">
											<option value="ACTIVO" {{ old('estado') == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
											<option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="email">E-mail <span class="campo-o">*</span></label>
										<input type="text" name="email" class="form-control" placeholder="ejemplo@ejemplo.com" id="in_email" value="{{ old('email') }}" required>
										<span class="invalid-feedback" id="alert-msn" style="font-size: 13px !important; font-weight: 400 !important; color:red" role="alert"></span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="email">Password <span class="campo-o">*</span></label>
										<input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
										<small id="emailHelp" class="form-text text-muted">Min. caracteres: <strong><span id="span-contador-ca">6</span></strong></small>
									</div>
								</div>

								 <div class="form-group row">
		                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Password <span class="campo-o">*</span></label>
									<div class="col-md-6">
		                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
		                                <small id="emailHelp" class="form-text text-muted">Min. caracteres: <strong><span id="span-contador-ca">6</span></strong></small>
		                            </div>
		                        </div>
								
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
	<script src="{{asset('js/check-em.js')}}"></script>
@endsection