@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('comp/compseguro')}}">Compañias de seguro</a></li>
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
							<h3>Editar Compañia de seguro: <span class="label label-warning">{{$compSeguro->nombre}}</span></h3>
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li class="icono-error"><i class="fa fa-times-circle"> {{$error}}</i></li>
									@endforeach
								</ul>
							</div>
							@endif
							{!!Form::model($compSeguro, ['method' => 'PATCH', 'enctype' => 'multipart/form-data', 'route' => ['compseguro.update', $compSeguro->id]])!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="nombre">Nombre <span class="campo-o">*</span></label>
										<input type="text" name="nombre" class="form-control" value="{{$compSeguro->nombre}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="etiqueta">Etiqueta <span class="campo-o">*</span></label>
										<input type="text" name="etiqueta" class="form-control" value="{{$compSeguro->etiqueta}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="direccion">Dirección <span class="campo-o">*</span></label>
										<input type="text" name="direccion" class="form-control" value="{{$compSeguro->direccion}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono">Teléfono 1 <span class="campo-o">*</span></label>
										<input type="text" name="telefono1" class="form-control" value="{{$compSeguro->telefono1}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono">Teléfono 2</label>
										<input type="text" name="telefono2" class="form-control" value="{{$compSeguro->telefono2}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="fax">Fax</label>
										<input type="text" name="fax" class="form-control" value="{{$compSeguro->fax}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="email">Email <span class="campo-o">*</span></label>
										<input type="text" name="email" class="form-control" value="{{$compSeguro->email}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="paginaweb">Página web <span class="campo-o">*</span></label>
										<input type="text" name="paginaweb" class="form-control" value="{{$compSeguro->paginaweb}}">
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="logo_img">Imagen/logo <span class="campo-o">*</span></label>
										<input type="file" name="logo_img" class="form-control" accept="image/png, image/jpeg">
										<div class="thumbnail">
									      <img src="{{asset('storage/aseguradora_img/'.$compSeguro->logo_img)}}" width="50px" height="50" class="img-thumbnail">
									      <div class="caption" style="padding-top: 0 !important; padding-bottom: 0 !important;">
									        <h3 style="text-align: center;">{{$compSeguro->logo_img}} <!--<button class="btn btn-danger">x</button>--></h3>
									      </div>
									    </div>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="localidad">Localidad <span class="campo-o">*</span></label>
										<select class="form-control" name="localidad">
											<option value="{{$compSeguro->localidad->id}}">{{$compSeguro->localidad->nombre}}</option>
											@foreach($localidades as $localidad)
												<option value="{{$localidad->id}}">{{$localidad->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
										<a href="{{url('comp/compseguro')}}"><button class="btn btn-labeled btn-danger" type="button"><span class="btn-label"><i class="fa fa-undo"></i></span>Atrás</button></a>
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