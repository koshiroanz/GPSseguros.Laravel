@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('pedido')}}">Pedidos</a></li>
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
							<h3>Pedidos</h3>
							@include('pedido.search')
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">N° de Póliza</th>
										<th class="header-table-th">Fecha pedida</th>
										<th class="header-table-th">Vehículo</th>
										<th class="header-table-th">Cliente</th>
										<th class="header-table-th">Productor/ra</th>
										@can('privilegio-alto',Auth::user())
										<th class="header-table-th td_center">Opciones</th>	
										@endcan		
									</thead>
									@foreach($pedidos as $pedido)
										<tr>
											<td>{{$pedido->numPoliza}}</td>
											<td>{{$pedido->vigenciaPedida}}</td>
											<td>{{$pedido->veDominio}}</td>
											<td>{{$pedido->clApellido}}, {{$pedido->clNombre}}</td>
											<td>{{$pedido->proApellido}}, {{$pedido->proNombre}}</td>
											@can('privilegio-alto',Auth::user())
											<td class="td_center">
												<a href="" data-target="#modal-act-{{$pedido->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Actualizar</button>
												</a>
											</td>
											@endcan
										</tr>
										@include('pedido.modal')
									@endforeach
								</table>
							</div>
							{{$pedidos->render()}}
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	
@endsection