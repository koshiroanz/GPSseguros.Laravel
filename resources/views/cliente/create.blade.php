@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('cliente')}}">Clientes</a></li>
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
						<div class="col-xs-12">
							<h3>Cliente</h3>
							{!!Form::open(array('url' => 'cliente', 'method' => 'POST', 'autocomplete' => 'off'))!!}
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label for="dni">DNI <span class="campo-o">*</span></label>
										<input type="text" name="dni" class="form-control" placeholder="DNI..." value="{{ old('dni') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="apellido">Apellido <span class="campo-o">*</span></label>
										<input type="text" name="apellido" class="form-control" placeholder="Apellido..." value="{{ old('apellido') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="nombre">Nombre <span class="campo-o">*</span></label>
										<input type="text" name="nombre" class="form-control" placeholder="Nombre..." value="{{ old('nombre') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="fechaNacimiento">Fecha de nacimiento <span class="campo-o">*</span></label>
										<input type="text" name="fechaNacimiento" id="datepicker" class="form-control" placeholder="DD-MM-AAAA" value="{{ old('fechaNacimiento') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="cuit">CUIT/CUIL <span class="campo-o">*</span></label>
										<input type="text" name="cuit" class="form-control" placeholder="CUIT/CUIL..." value="{{ old('cuit') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="direccion">Dirección <span class="campo-o">*</span></label>
										<input type="text" name="direccion" class="form-control" placeholder="Dirección..." value="{{ old('direccion') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="telefono1">Teléfono 1 <span class="campo-o">*</span></label>
										<input type="text" name="telefono1" class="form-control" placeholder="Teléfono..." value="{{ old('telefono1') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="telefono2">Teléfono 2</label>
										<input type="text" name="telefono2" class="form-control" placeholder="Teléfono..." value="{{ old('telefono2') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
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
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="estadoCivil">Estado civil <span class="campo-o">*</span></label>
										<select class="form-control" name="estadoCivil">
											<option value="">Seleccione un estado civil</option>
											<option value="SOLTERO/A" {{ old('estadoCivil') == 'SOLTERO/A' ? 'selected' : '' }}>SOLTERO/A</option>
											<option value="CASADO/A" {{ old('estadoCivil') == 'CASADO/A' ? 'selected' : '' }}>CASADO/A</option>
											<option value="DIVORCIADO/A" {{ old('estadoCivil') == 'DIVORCIADO/A' ? 'selected' : '' }}>DIVORCIADO/A</option>
											<option value="VIUDO/A" {{ old('estadoCivil') == 'VIUDO/A' ? 'selected' : '' }}>VIUDO/A</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="fechaBaja">Fecha baja</label>
										<input type="text" name="fechaBaja" id="datepicker2" class="form-control" placeholder="DD-MM-AAAA" value="{{ old('fechaBaja') }}">
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="estado">Estado <span class="campo-o">*</span></label>
										<select class="form-control" name="estado">
											<option value="ACTIVO" {{ old('estado') == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
											<option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-xs-12">
									<div class="form-group">
										<label for="productor">Productor/ra <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="productor" data-live-search="true">
											@foreach($productores as $productor)
												<option value="{{$productor->id}}" @if(old('productor') == $productor->id) {{ 'selected' }} @endif>{{$productor->apellido}}, {{$productor->nombre}} / {{$productor->dni}}</option>
											@endforeach
										</select>
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

	<script type="text/javascript">
		/*$(document).ready(function(){
           	$.ajax({
              	url: "/getProductor",
              	type: 'get',
              	data: {},
              	success: function(data){
					for (var i = 0; i < data.length; i++) {
						$("#select_productor").append('<option value="'+data[i].id+'">'+data[i].apellido+', '+data[i].nombre+' / '+data[i].dni+'</option>');
					}
              	}
          	});
        });*/
	</script>
@endsection