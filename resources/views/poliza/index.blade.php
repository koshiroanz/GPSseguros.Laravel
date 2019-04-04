@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('poliza')}}">Pólizas</a></li>
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
							<h3>Pólizas <a href="/poliza/create">
											<button type="button" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>Nuevo</button>
										</a>
							</h3>
							@include('poliza.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">N° Póliza</th>
										<th class="header-table-th">Estado</th>
										<th class="header-table-th">Dominio</th>
										<th class="header-table-th">Vig.Desde</th>
										<th class="header-table-th">Vig.Hasta</th>
										<th class="header-table-th">Productor/a</th>
										@can('privilegio-alto',Auth::user())
										<th class="header-table-th td_center">Opciones</th>
										@endcan		
									</thead>
									@foreach($polizas as $poliza)
										<tr>
											<td>{{$poliza->numPoliza}}</td>
											<td>{{$poliza->estado}}</td>
											<td>{{$poliza->dominio}}</td>
											<td>{{$poliza->vigenciaPoliza}}</td>
											<td>{{$poliza->vigenciaPolizaHasta}}</td>
											<td>{{$poliza->proApellido}}, {{$poliza->proNombre}}</td>
											@can('privilegio-alto',Auth::user())
											<td class="td_center">
												<a href="{{URL::action('PolizaController@edit', $poliza->id)}}">
													<button class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</button>
												</a>
												<a href="" data-target="#modal-delete-{{$poliza->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Eliminar</button>
												</a>
											</td>
											@endcan
										</tr>
										@include('poliza.modal')
									@endforeach
								</table>
							</div>
							{{$polizas->render()}}
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	
@endsection