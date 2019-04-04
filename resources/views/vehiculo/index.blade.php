@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('vehiculo')}}">Vehículos</a></li>
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
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<h3>Vehículos <a href="/vehiculo/create">
											<button type="button" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>Nuevo</button>
										</a>
							</h3>
							@include('vehiculo.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">Dominio</th>
										<th class="header-table-th">Marca</th>
										<th class="header-table-th">Modelo</th>
										<th class="header-table-th">Carrocería</th>
										<th class="header-table-th">Propietario</th>
										@can('privilegio-alto',Auth::user())
										<th class="header-table-th td_center">Opciones</th>
										@endcan		
									</thead>
									@foreach($vehiculos as $vehiculo)
										<tr>
											<td>{{$vehiculo->dominio}}</td>
											<td>{{$vehiculo->maNombre}}</td>
											<td>{{$vehiculo->moNombre}}</td>
											<td>{{$vehiculo->caNombre}}</td>
											<td>{{$vehiculo->clApellido}}, {{$vehiculo->clNombre}}</td>
											@can('privilegio-alto',Auth::user())
											<td class="td_center">
												<a href="{{URL::action('VehiculoController@edit', $vehiculo->id)}}">
													<button class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</button>
												</a>
												<a href="" data-target="#modal-delete-{{$vehiculo->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Eliminar</button>
												</a>
											</td>
											@endcan
										</tr>
										@include('vehiculo.modal')
									@endforeach
								</table>
							</div>
							{{$vehiculos->render()}}
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	
@endsection