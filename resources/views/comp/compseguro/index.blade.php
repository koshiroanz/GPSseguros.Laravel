@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('comp/compseguro')}}">Compañias de seguro</a></li>
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
							<h3>Compañias de seguro <a href="compseguro/create">
											<button type="button" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>Nuevo</button>
										</a>
							</h3>
							@include('comp.compseguro.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">Nombre</th>
										<th class="header-table-th">Dirección</th>
										<th class="header-table-th">Teléfono 1</th>
										<th class="header-table-th">Email</th>
										<th class="header-table-th">Localidad</th>
										<th class="header-table-th">Imagen</th>
										@can('privilegio-alto',Auth::user())
										<th class="header-table-th td_center">Opciones</th>		
										@endcan	
									</thead>
									@foreach($companias as $compania)
										<tr>
											<td>{{$compania->nombre}}</td>
											<td>{{$compania->direccion}}</td>
											<td>{{$compania->telefono1}}</td>
											<td>{{$compania->email}}</td>
											<td>{{$compania->localidad->nombre}}</td>
											<td>
												<img src="{{asset('storage/aseguradora_img/'.$compania->logo_img)}}" width="50px" height="50" class="img-thumbnail">
											</td>
											@can('privilegio-alto',Auth::user())
											<td class="td_center">
												<a href="{{URL::action('CompaniaSeguroController@edit', $compania->id)}}">
													<button class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</button>
												</a>
												<a href="" data-target="#modal-delete-{{$compania->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Eliminar</button>
												</a>
											</td>
											@endcan
										</tr>
										@include('comp.compseguro.modal')
									@endforeach
								</table>
							</div>
							{{$companias->render()}}
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	
@endsection