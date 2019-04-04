@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('siniestro')}}">Siniestros</a></li>
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
							<h3>Siniestros <a href="/siniestro/create"">
											<button type="button" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>Nuevo</button>
										</a>
							</h3>
							@include('siniestro.search')
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead id="table_header">
										<th class="header-table-th">Cliente</th>
										<th class="header-table-th">N° de póliza</th>
										<th class="header-table-th">Dominio</th>
										<th class="header-table-th">Fecha siniestro</th>
										<th class="header-table-th">Imagenes</th>
										@can('privilegio-alto',Auth::user())
										<th class="header-table-th td_center">Opciones</th>
										@endcan		
									</thead>
									@foreach($siniestros as $siniestro)
										<tr>
											<td>{{$siniestro->apellido}}, {{$siniestro->nombre}}</td>
											<td>{{$siniestro->numPoliza}}</td>
											<td>{{$siniestro->dominio}}</td>
											<td>{{$siniestro->fechaSiniestro}}</td>
											<td>{{$siniestro->cant}}</td>
											@can('privilegio-alto',Auth::user())
											<td class="td_center">
												@if($siniestro->cant > 0)
													<a href="" data-target="#modal-ver-{{$siniestro->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-primary" data-id="{{ $siniestro->id }}" data-client="{{$siniestro->cliId}}"><span class="btn-label"><i class="fa fa-eye"></i></span>Ver</button>
												</a>
													@include('siniestro.ver')
												@endif
												<a href="{{URL::action('SiniestroController@edit', $siniestro->id)}}">
													<button class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</button>
												</a>
												<a href="" data-target="#modal-delete-{{$siniestro->id}}" data-toggle="modal">
													<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>Eliminar</button>
												</a>
											</td>
											@endcan
										</tr>
										@include('siniestro.modal')
									@endforeach
								</table>
							</div>
							{{$siniestros->render()}}
						</div>
					</div>
       			</div>
    		</div>
		</div>
	</div><!-- /.row -->
	<script>
		$(document).ready(function(){
			$(document).on('click', 'button[data-id]', function (e) {
			    var request_id = $(this).attr('data-id'), idCliente = $(this).attr('data-client');
			    $.ajax({
					url : '/getImagenesSiniestro',
					type : 'get',
					data:{
						idSiniestro: request_id
					},
					success:function(file){
						$.ajax({
							url : '/getRouteImagenSiniestro',
							type : 'get',
							success:function(route){
								if(jQuery('#group-horizontal div').length > 0){
									$('#group-horizontal div').remove();	//Si existe elementos tr en este tbody remueve.
								}
								$.each(file, function(key,registro){
									$('#group-horizontal').append('<div class="row"><img src="'+route+idCliente+'/'+registro.filename+'" height="450" width="450"><h3>'+registro.filename+'</h3></div>');
									//$('#group-horizontal').append('<div class="row"><div class="thumbnail"><img src="'+route+idCliente+'/'+registro.filename+'" height="400" width="400"><div class="caption"><h3>'+registro.filename+'</h3></div></div></div>');
								});
							},
							fail:function(){
								
							}
					    });
					},
					fail:function(){
						
					}
			    });
			});
		});
	</script>
	
@endsection