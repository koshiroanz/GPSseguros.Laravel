@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('reporte/certificado')}}">Certificado</a></li>
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
							<h3>Certificados</h3>
							@include('reporte.certificado.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">Cliente</th>
										<th class="header-table-th">Vehículo</th>
										<th class="header-table-th">Póliza</th>
										<th class="header-table-th td_center">Opciones</th>			
									</thead>
									@foreach($clientes as $cliente)
										<tr>
											<td>{{$cliente->clApellido}}, {{$cliente->clNombre}}</td>
											<td>{{$cliente->veDominio}}</td>
											<td>{{$cliente->numPoliza}}</td>
											<td class="td_center">
												<a href="{{URL::action('CertificadoController@visualizar', $cliente->poId)}}">
													<button class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-eye"></i></span>Visualizar</button>
												</a>
												<a href="{{URL::action('CertificadoController@descargar', $cliente->poId)}}">
													<button class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-download"></i></span>Descargar</button>
												</a>
											</td>
										</tr>
									@endforeach
								</table>
							</div>
							{{$clientes->render()}}
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	
@endsection