@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('pago')}}">Pagos</a></li>
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
							<h3>Pagos 
								<a href="/pago/create">
									<button type="button" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>Nuevo</button>
								</a>
							</h3>
							@include('pago.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">Nº Recibo</th>
										<th class="header-table-th">Fecha</th>
										<th class="header-table-th">Póliza</th>
										<th class="header-table-th">Vehículo</th>
										<th class="header-table-th">Cliente</th>
										<th class="header-table-th">Total</th>
										<th class="header-table-th td_center">Opciones</th>
									</thead>
									@foreach($cuotasPoliza as $cuotaPoliza)
										<tr>
											<td>{{$cuotaPoliza->pago->numRecibo}}</td>
											<td>{{Helper::formatoDateVuelta($cuotaPoliza->pago->fecha)}}</td>
											<td>{{$cuotaPoliza->pago->poliza->numPoliza}}</td>
											<td>{{$cuotaPoliza->pago->vehiculo->dominio}}</td>
											<td>{{$cuotaPoliza->pago->vehiculo->cliente->apellido}}, {{$cuotaPoliza->pago->vehiculo->cliente->nombre}}</td>
											<td>$ {{$cuotaPoliza->pago->total}}</td>
											<td class="td_center">
												<a href="" data-target="#detalle-{{$cuotaPoliza->pago->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-info" data-id="{{ $cuotaPoliza->pago->id }}" data-target="#tbody-{{$cuotaPoliza->pago->id}}" id="{{$cuotaPoliza->pago->id}}"><span class="btn-label"><i class="fa fa-info"></i></span>Info</button>
												</a>
												@can('privilegio-alto',Auth::user())
												<a href="{{URL::action('PagoController@edit', $cuotaPoliza->pago->id)}}">
													<button class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</button>
												</a>
												<a href="" data-target="#modal-delete-{{$cuotaPoliza->pago->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Eliminar</button>
												</a>
												@endcan
												@include('pago.detalle')
											</td>
										</tr>
										@include('pago.modal')
									@endforeach
								</table>
							</div>
							
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	<script src="{{asset('js/carga-modal-detalle.js')}}"></script>
@endsection