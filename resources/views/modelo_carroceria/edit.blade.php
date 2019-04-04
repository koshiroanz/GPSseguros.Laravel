@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('vehiculo')}}">Vehículos</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('modelo_carroceria')}}">Modelos y Carrocerías</a></li>
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
							<h3>Editar Modelo y Carrocería: <span class="label label-warning">{{$modelo_carroceria->modelo->nombre}}</span> <span class="label label-warning">{{$modelo_carroceria->carroceria->nombre}}</span></h3>
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li class="icono-error"><i class="fa fa-times-circle"> {{$error}}</i></li>
									@endforeach
								</ul>
							</div>
							@endif
							{!!Form::model($modelo_carroceria, ['method' => 'PATCH', 'route' => ['modelo_carroceria.update', $modelo_carroceria->id]])!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="marca">Marca <span class="campo-o">*</span></label>
										<input class="form-control" type="text" name="marca" value="{{$marca->maNombre}}" disabled>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="modelo">Modelo <span class="campo-o">*</span></label>
										<select class="form-control" name="modelo">
											<option value="{{$modelo_carroceria->modelo_id}}">{{$modelo_carroceria->modelo->nombre}}</option>
											@foreach($modelos as $modelo)
												<option>{{$modelo->nombre}}</option>
											@endforeach 
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="carroceria">Carrocería <span class="campo-o">*</span></label>
										<select class="form-control" name="carroceria">
											<option value="{{$modelo_carroceria->carroceria_id}}">{{$modelo_carroceria->carroceria->nombre}}</option>
											@foreach($carrocerias as $carroceria)
												<option value="{{$carroceria->id}}">{{$carroceria->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
										<a href="{{url('modelo_carroceria')}}"><button class="btn btn-labeled btn-danger" type="button"><span class="btn-label"><i class="fa fa-undo"></i></span>Atrás</button></a>
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