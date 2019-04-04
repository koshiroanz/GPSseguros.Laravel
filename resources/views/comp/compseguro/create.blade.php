@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('comp/compseguro')}}">Compañias de seguro</a></li>
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
							<h3>Compañia de seguro</h3>
							{!!Form::open(array('url' => 'comp/compseguro', 'method' => 'POST', 'enctype' => 'multipart/form-data','autocomplete' => 'off'))!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="nombre">Nombre <span class="campo-o">*</span></label>
										<input type="text" name="nombre" class="form-control" placeholder="Aquí el nombre...">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="etiqueta">Etiqueta <span class="campo-o">*</span></label>
										<input type="text" name="etiqueta" class="form-control" placeholder="Compañia General de Seguros S.A...">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="direccion">Dirección <span class="campo-o">*</span></label>
										<input type="text" name="direccion" class="form-control" placeholder="Aquí la dirección...">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono">Teléfono 1 <span class="campo-o">*</span></label>
										<input type="text" name="telefono1" class="form-control" placeholder="Aquí el teléfono...">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="telefono">Teléfono 2</label>
										<input type="text" name="telefono2" class="form-control" placeholder="Aquí el teléfono...">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="fax">Fax</label>
										<input type="text" name="fax" class="form-control" placeholder="Aquí el fax...">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="email">Email <span class="campo-o">*</span></label>
										<input type="text" name="email" class="form-control" placeholder="email@email.com">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="paginaweb">Página web <span class="campo-o">*</span></label>
										<input type="text" name="paginaweb" class="form-control" placeholder="www.paginaweb.com">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="imagen">Imagen/Logo <span class="campo-o">*</span></label>
										<input type="file" name="logo_img" class="form-control" accept="image/png, image/jpeg">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="localidad">Localidad <span class="campo-o">*</span></label>
										<select class="form-control" name="localidad">
											@foreach($localidades as $localidad)
												<option value="{{$localidad->id}}" @if(old('localidad') == $localidad->id) {{ 'selected' }} @endif>{{$localidad->nombre}}</option>
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
@endsection