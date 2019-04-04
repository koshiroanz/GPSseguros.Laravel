@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('cliente')}}">Clientes</a></li>
			  	</ol>
			</nav>
			<!--
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				@if(session('fail'))
					<div class="alert alert-danger" role="alert">
						<i class="fa fa-exclamation-circle"></i><span> {{session('fail')}}</span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
					  	</button>
					</div>
				@elseif(session('success'))
					<div class="alert alert-success" role="alert">
						<i class="fa fa-check"></i><span> {{session('success')}}</span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
					  	</button>
				    </div>
				@endif
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				@if($errors->any())
				<div class="alert alert-danger" role="alert">
					<i class="fa fa-exclamation-circle"></i><span> {{$errors->first()}}</span>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
				  	</button>
				</div>
				@endif
			</div>
			-->
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
							<h3>Clientes <a href="/cliente/create">
											<button type="button" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>Nuevo</button>
										</a>
							</h3>
							@include('cliente.search')
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
										<th class="header-table-th">Estado</th>
										<th class="header-table-th">Localidad</th>
										<th class="header-table-th">Productor/ra</th>
										@can('privilegio-alto',Auth::user())
										<th class="header-table-th td_center">Opciones</th>	
										@endcan		
									</thead>
									@foreach($clientes as $cliente)
										<tr>
											<td>{{$cliente->apellido}}</td>
											<td>{{$cliente->nombre}}</td>
											<td>{{$cliente->dni}}</td>
											<td>{{$cliente->telefono1}}</td>
											<td>{{$cliente->direccion}}</td>
											<td>{{$cliente->estado}}</td>
											<td>{{$cliente->localidad->nombre}}</td>
											<td>{{$cliente->user->apellido}}, {{$cliente->user->nombre}}</td>
											@can('privilegio-alto',Auth::user())
											<td class="td_center">
												<a href="{{URL::action('ClienteController@edit', $cliente->id)}}">
													<button class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</button>
												</a>
												<a href="" data-target="#modal-delete-{{$cliente->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Eliminar</button>
												</a>
											</td>
											@endcan
										</tr>
										@include('cliente.modal')
									@endforeach
								</table>
							</div>
							{{$clientes->render()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection