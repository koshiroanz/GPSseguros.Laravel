@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('vehiculo')}}">Vehículos</a></li>
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
							<h3>Vehículo</h3>
							{!!Form::open(array('url' => 'vehiculo', 'method' => 'POST', 'autocomplete' => 'off'))!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="dominio">Dominio <span class="campo-o">*</span></label>
										<input type="text" name="dominio" class="form-control" placeholder="Aquí el dominio..." value="{{ old('dominio') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="marca">Marca <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="marca" id="select_marca" data-live-search="true" onchange="changeMarca()">
											<option value="">Seleccione una opci&oacute;n</option>
											@foreach($marcas as $marca)
												<option value="{{$marca->id}}" name="marca" @if(old('marca') == $marca->id) {{ 'selected' }} @endif>{{$marca->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="modelo">Modelo <span class="campo-o">*</span></label>
										<select class="form-control" name="modelo" id="select_modelo" onchange="changeModelo()">
											<option value="">Seleccione una opci&oacute;n</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="carroceria">Carrocería <span class="campo-o">*</span></label>
										<select class="form-control" name="carroceria" id="select_carroceria">
											<option value="">Seleccione una opci&oacute;n</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="cliente">Propietario <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="cliente" id="select_cliente" data-live-search="true">
											<option value="">Seleccione una opci&oacute;n</option>
											@foreach($clientes as $cliente)
												<option value="{{$cliente->id}}" @if(old('cliente') == $cliente->id) {{ 'selected' }} @endif>{{$cliente->apellido}}, {{$cliente->nombre}} / {{$cliente->dni}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="color">Color <span class="campo-o">*</span></label>
										<input type="text" name="color" class="form-control" placeholder="Aquí el color..." value="{{ old('color') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="anio">Año <span class="campo-o">*</span></label>
										<input type="numeric" name="anio" class="form-control" placeholder="2018.." value="{{ old('anio') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="chasis">Chasis <span class="campo-o">*</span></label>
										<input type="text" name="chasis" class="form-control" placeholder="Aquí el chasis..." value="{{ old('chasis') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="motor">Motor <span class="campo-o">*</span></label>
										<input type="text" name="motor" class="form-control" placeholder="Aquí el motor..." value="{{ old('motor') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="valor">Valor <span class="campo-o">*</span></label>
										<input type="text" name="valor" class="form-control" placeholder="$" value="{{ old('valor') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="combustible">Combustible</label>
										<input type="text" name="combustible" class="form-control" placeholder="Diesel.." value="{{ old('combustible') }}">
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
	<script src="{{asset('js/select_modelo_carroceria_vehiculo.js')}}"></script>

	<script type="text/javascript">
		/*$(document).ready(function(){
			$('#busqueda_cliente').on('keyup',function(){
				var value = $(this).val();
				if(value != null){
					var select_cliente = $('#select_cliente');
					$.ajax({
						url : '/getCliente',
						type : 'get',
						data:{
							value: value
						},
						success:function(data){
							select_cliente.empty();
							for (var i = 0; i < data.length; i++) {
								$("#select_cliente").append('<option value="'+data[i].id+'">'+data[i].apellido+', '+data[i].nombre+' / '+data[i].dni+'</option>');
							}
						}
					});
				}else{
					$.ajax({
						url : '/getClientes',
						type : 'get',
						data:{},
						success:function(data){
							select_cliente.empty();
							for (var i = 0; i < data.length; i++) {
								$("#select_cliente").append('<option value="'+data[i].id+'">'+data[i].apellido+', '+data[i].nombre+' / '+data[i].dni+'</option>');
							}
						}
					});
				}
			});
		});*/
	</script>

@endsection