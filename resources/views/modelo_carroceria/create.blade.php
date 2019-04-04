@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('vehiculo')}}">Vehículos</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('modelo_carroceria')}}">Modelos y Carrocerías</a></li>
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
							<h3>Modelo y Carrocería</h3>
							{!!Form::open(array('url' => 'modelo_carroceria', 'method' => 'POST', 'autocomplete' => 'off'))!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="marca">Marca <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="marca" id="select_marca_carroceria" data-live-search="true">
											<option value="">Seleccione una opci&oacute;n...</option>
											@foreach($marcas as $marca)
												<option value="{{$marca->id}}" name="marca">{{$marca->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="modelo">Modelo <span class="campo-o">*</span></label>
										<select class="form-control" name="modelo" id="select_modelo_carroceria" data-live-search="true">
											<option value="">Seleccione una opci&oacute;n...</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="carroceria">Carrocería <span class="campo-o">*</span></label>
										<select class="form-control" name="carroceria" data-live-search="true">
											<option value="">Seleccione una opci&oacute;n...</option>
											@foreach($carrocerias as $carroceria)
												<option value="{{$carroceria->id}}" name="carroceria">{{$carroceria->nombre}}</option>
											@endforeach
										</select>
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
	<script src="{{asset('js/select_modelo_carroceria.js')}}"></script>

@endsection