@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('cliente')}}">Clientes</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('beneficiario')}}">Beneficiarios</a></li>
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
							<h3>Beneficiario</h3>
							{!!Form::open(array('url' => 'beneficiario', 'method' => 'POST', 'autocomplete' => 'off'))!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="dni">DNI <span class="campo-o">*</span></label>
										<input type="text" name="dni" class="form-control" placeholder="DNI..." value="{{ old('dni') }}" autofocus>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="apellido">Apellido <span class="campo-o">*</span></label>
										<input type="text" name="apellido" class="form-control" placeholder="Apellido..." value="{{ old('apellido') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="nombre">Nombre <span class="campo-o">*</span></label>
										<input type="text" name="nombre" class="form-control" placeholder="Nombre..." value="{{ old('nombre') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="direccion">Dirección <span class="campo-o">*</span></label>
										<input type="text" name="direccion" class="form-control" placeholder="Dirección..." value="{{ old('direccion') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono1">Teléfono 1 <span class="campo-o">*</span></label>
										<input type="text" name="telefono1" class="form-control" placeholder="Teléfono1..." value="{{ old('telefono1') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono2">Teléfono 2</label>
										<input type="text" name="telefono2" class="form-control" placeholder="Teléfono2..." value="{{ old('telefono2') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="localidad">Localidad <span class="campo-o">*</span></label>
										<select class="form-control" name="localidad">
											<option value="">Seleccione una localidad</option>
											@foreach($localidades as $localidad)
												<option value="{{$localidad->id}}" @if(old('localidad') == $localidad->id) {{ 'selected' }} @endif>{{$localidad->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="cliente">Cliente <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="cliente" id="select_cliente" data-live-search="true">
											<option value="">Seleccione un cliente</option>
											@foreach($clientes as $cliente)
												<option value="{{$cliente->id}}" @if(old('cliente') == $cliente->id) {{ 'selected' }} @endif>{{$cliente->apellido}}, {{$cliente->nombre}} - {{$cliente->dni}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="parentesco">Parentesco</label>
										<input class="form-control" type="text" name="parentesco" placeholder="Parentesco..." value="{{ old('parentesco') }}">
									</div>
								</div>
								
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px !important;">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Guardar</button>
										<a href="#" class="btn btn-labeled btn-danger" id="btn_reset"><span class="btn-label"><i class="fa fa-eraser"></i></span>Reset</a>
									</div>
								</div>
							{!!Form::close()!!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$('#btn_reset').click(function(){
					if($('#input_nombre').val() != ''){
						$('#input_nombre').val('');
						$('#input_nombre').focus();
					}
				});
			});
		</script>
	</div>
@endsection