@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('productor')}}">Productores</a></li>
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
							<h3>Productores/as <a href="/productor/create">
											<button type="button" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>Nuevo</button>
										</a>
							</h3>
							@include('productor.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">Apellido</th>
										<th class="header-table-th">Nombre</th>
										<th class="header-table-th">DNI</th>
										<th class="header-table-th">Teléfono 1</th>
										<th class="header-table-th">Dirección</th>
										<th class="header-table-th">Localidad</th>
										<th class="header-table-th">Email</th>
										<th class="header-table-th">Estado</th>
										<th class="header-table-th">Privilegio</th>
										<th class="header-table-th td_center">Opciones</th>			
									</thead>
									@foreach($productores as $productor)
										<tr>
											<td>{{$productor->apellido}}</td>
											<td>{{$productor->nombre}}</td>
											<td>{{$productor->dni}}</td>
											<td>{{$productor->telefono1}}</td>
											<td>{{$productor->direccion}}</td>
											<td>{{$productor->localidad->nombre}}</td>
											<td>{{$productor->email}}</td>
											<td>{{$productor->estado}}</td>
											<td>{{$productor->privilegio}}</td>
											<td class="td_center">
												<a href="{{URL::action('UsuarioController@edit', $productor->id)}}">
													<button class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</button>
												</a>
												@if($idUser != $productor->id)
													<a href="" data-target="#modal-delete-{{$productor->id}}" data-toggle="modal">
														<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Eliminar</button>
													</a>
												@else
													<a href="" data-target="#modal-delete-{{$productor->id}}" data-toggle="modal">
														<button class="btn btn-labeled btn-danger" disabled><span class="btn-label"><i class="fa fa-trash"></i></span>Eliminar</button>
													</a>
												@endif
											</td>
										</tr>
										@include('productor.modal')
									@endforeach
								</table>
							</div>
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	
@endsection