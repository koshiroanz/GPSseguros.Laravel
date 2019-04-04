@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('reporte/carnetprovisorio')}}">Carnet Provisorios</a></li>
			    	<li class="breadcrumb-item active" aria-current="page">Visualizar</li>
			  	</ol>
			</nav>
  			<div class="box-tools pull-right" style="top: 13px !important;">
    			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    
    			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
  			<div class="row">
      			<div class="col-md-12">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3>Vista de Carnet Provisorio</h3>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-condensed table-hover">
										<thead id="table_header">
											<th class="header-table-th">DNI</th>
											<th class="header-table-th">Apellido</th>
											<th class="header-table-th">nombre</th>		
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection