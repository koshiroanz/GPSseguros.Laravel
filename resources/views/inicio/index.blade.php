@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			  	</ol>
			</nav>
			<div class="box-tools pull-right div-box-tools">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="row">
	  			<div class="col-md-12">
	  				<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							@include('inicio.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">Propietario</th>
										<th class="header-table-th">DNI</th>
										<th class="header-table-th">Dominio</th>
										<th class="header-table-th">Marca</th>
										<th class="header-table-th">Modelo</th>
										<th class="header-table-th td_center">Opción</th>
									</thead>
									@foreach($clientesInicio as $cliente)
										<tr>
											<td>{{$cliente->clApellido}}, {{$cliente->clNombre}}</td>
											<td>{{$cliente->clDni}}</td>
											<td>{{$cliente->dominio}}</td>
											<td>{{$cliente->maNombre}}</td>
											<td>{{$cliente->moNombre}}</td>
											<td class="td_center">
												<a href="{{URL::action('HomeController@info', $cliente->veId)}}">
													<button class="btn btn-labeled btn-info"><span class="btn-label"><i class="fa fa-info"></i></span>Info</button>
												</a>
											</td>
										</tr>
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