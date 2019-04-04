@extends('layouts.admin')
@section('contenido')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('pago')}}">Pagos</a></li>
			    	<li class="breadcrumb-item active" aria-current="page">Editar</li>
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
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3>Editar Pago: <span class="label label-warning">#{{$pago->numRecibo}}</span></h3>
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li class="icono-error"><i class="fa fa-times-circle"> {{$error}}</i></li>
									@endforeach
								</ul>
							</div>
							@endif
							{!!Form::model($pago, ['method' => 'PATCH', 'route' => ['pago.update', $pago->id]])!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="numRecibo">N° de recibo <span class="campo-o">*</span></label>
										<input type="numeric" name="numRecibo" class="form-control" placeholder="N° de recibo" value="{{$pago->numRecibo}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="fecha">Fecha <span class="campo-o">*</span></label>
										<input type="text" name="fecha" class="form-control" id="datepicker" placeholder="DD-MM-AAAA" value="{{$pago->fecha}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="reciboGrua">Recibo de grua</label>
										<input type="numeric" name="reciboGrua" class="form-control" placeholder="N° de recibo grua" value="{{$pago->reciboGrua}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="importeGrua">Importe de grua</label>
										<input type="text" name="importeGrua" class="form-control" placeholder="$" value="{{$pago->importeGrua}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="cliente">Cliente <span class="campo-o">*</span></label>
										<select class="form-control" name="cliente" disabled>
											<option value="{{$pago->vehiculo->cliente->id}}">{{$pago->vehiculo->cliente->apellido}}, {{$pago->vehiculo->cliente->nombre}} / {{$pago->vehiculo->cliente->dni}}</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="cliente">Vehículo <span class="campo-o">*</span></label>
										<select class="form-control" name="vehiculo" disabled>
											<option value="{{$pago->vehiculo->id}}">{{$pago->vehiculo->dominio}}</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="poliza">Póliza <span class="campo-o">*</span></label>
										<select class="form-control" name="poliza" disabled>
											<option value="{{$pago->poliza->id}}">{{$pago->poliza->numPoliza}}</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label for="cuotas">Cuotas <span class="campo-o">*</span></label>
									<div class="panel-body" id="div-panel-body">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-condensed table-hover">
													<thead id="table_header">
														<th>N° Cuota</th>
														<th>N° Póliza</th>
														<th>Precio</th>
														<th>Vehículo</th>
													</thead>
													@foreach($cuotasPoliza as $cuotaPoliza)
														<tr>
															<td>{{$cuotaPoliza->numCuota}}</td>
															<td>{{$cuotaPoliza->numPoliza}}</td>
															<td>$ {{$cuotaPoliza->importe}}</td>
															<td>{{$pago->vehiculo->dominio}}</td>
														</tr>
													@endforeach
												</table>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label for="total" id="label_total">Total $ </label>
												<input type="text" value="{{$pago->total}}" style="width: 70px !important" disabled>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label for="observacion">Observación</label>
												<textarea class="form-control" name="observacion">{{$pago->observacion}}</textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
										<a href="{{url('pago')}}"><button class="btn btn-labeled btn-danger" type="button"><span class="btn-label"><i class="fa fa-undo"></i></span>Atrás</button></a>
									</div>
								</div>
							{!!Form::close()!!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection