@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item active" aria-current="page">Info</li>
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
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div-col-info">
								<div class="panel-heading panel-header-square" id="panel-header-info">
									<h5 class="panel-title"><strong id="label-strong-info">Información del Cliente</strong></h5>
								</div>
							  	<div class="panel-body" id="panel-body-info">
							  		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							  			<h5>
							  				<strong>Apellido </strong><input type="text" class="form-control" name="apellido" value="{{$vehiculosCliente->cliente->apellido}}" disabled>
							  			</h5>
						  			</div>
						  			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						  				<h5>
						  					<strong>Nombre </strong><input type="text" class="form-control" name="" value="{{$vehiculosCliente->cliente->nombre}}" disabled>
					  					<h5>
					  				</div>
					  				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					  					<h5>
					  						<strong>DNI </strong><input type="text" class="form-control" name="" value="{{$vehiculosCliente->cliente->dni}}" disabled
				  						><h5>
				  					</div>
							    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					  					<h5>
					  						<strong>Vehículos </strong> 	
					  						<select class="form-control" id="select_vehiculo">
					  							<option value="">Seleccione un dominio</option>
					  							<option value="{{$vehiculosCliente->id}}">{{$vehiculosCliente->dominio}}</option>
					    					</select>
				    					<h5>
				  					</div>
				  					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					  					<h5>
					  						<strong>Pólizas </strong> 	
					  						<select class="form-control" id="select_poliza" disabled>
					    						<option value="">Seleccione una póliza</option>
					    					</select>
				    					<h5>
				  					</div>
				  					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					  					<h5>
					  						<strong>Estado </strong>
					  						<input type="text" class="form-control" name="estado" value="" id="estado" disabled>
				    					<h5>
				  					</div>
				  					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					  					<h5>
					  						<strong>Vigencia de Póliza</strong>
					  						<input type="text" class="form-control" name="vigenciaPoliza" value="" id="vigencia_poliza" disabled>
				    					<h5>
				  					</div>
				  					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					  					<h5>
					  						<strong>Vigencia de Póliza hasta </strong>
					  						<input type="text" class="form-control" name="vigenciaPolizaHasta" value="" id="vigencia_poliza_hasta" disabled>
				    					<h5>
				  					</div>
				  					<!-- Debería generar en esta posición los datos en AJAX -->
				  					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div-poliza">
				  						<div class="table-responsive">
				  							<table class="table table-striped table-bordered table-condensed table-hover" id="tabla_cuotas">
												<thead id="table_header">
													<th class="header-table-th">N° Recibo</th>
													<th class="header-table-th">Fecha de pago</th>
													<th class="header-table-th">N° Póliza</th>
													<th class="header-table-th">N° Cuota</th>
													<th class="header-table-th">Importe</th>
												</thead>
												<tbody></tbody>
											</table>
										</div>
				  					</div>
				  					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					  					<h5>
					  						<strong>Total </strong>
					  						<input type="text" class="form-control" name="total" value="$" id="total" disabled>
				    					<h5>
				  					</div>
							  	</div>
							</div>
							
							@if(count($errors) > 0)
								<div class="alert alert-danger">
									<ul>
										@foreach($errors->all() as $error)
											<li>{{$error}}</li>
										@endforeach
									</ul>
								</div>
							@endif
							
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	<script src="{{asset('js/info_auto.js')}}"></script>
@endsection