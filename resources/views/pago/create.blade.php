@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('pago')}}">Pagos</a></li>
			    	<li class="breadcrumb-item active" aria-current="page">Nuevo</li>
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
							<h3>Nuevo pago</h3>
							{!!Form::open(array('url' => 'pago', 'method' => 'POST', 'autocomplete' => 'off'))!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="numRecibo">N° de recibo <span class="campo-o">*</span></label>
										<input type="numeric" name="numRecibo" id="numRecibo" class="form-control" placeholder="N° de recibo" value="{{ old('numRecibo') }}" autofocus>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="fecha">Fecha <span class="campo-o">*</span></label>
										<input type="text" name="fecha" class="form-control" id="datepicker" placeholder="DD-MM-AAAA" value="{{ old('fecha') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="reciboGrua">Recibo de grua</label>
										<input type="numeric" name="reciboGrua" id="reciboGrua" class="form-control" placeholder="N° de recibo grua" value="{{ old('reciboGrua') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="importeGrua">Importe de grua</label>
										<input type="text" name="importeGrua" id="importeGrua" class="form-control" placeholder="$" value="{{ old('importeGrua') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="cliente">Cliente <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="cliente" id="select_cliente" data-live-search="true">
											<option value="">Seleccione una opci&oacute;n</option>
											@foreach($clientes as $cliente)
												<option value="{{$cliente->id}}" @if(old('cliente') == $cliente->id) {{ 'selected' }} @endif>{{$cliente->apellido}}, {{$cliente->nombre}} - {{$cliente->dni}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="vehiculo">Vehículo <span class="campo-o">*</span></label>
										<select class="form-control" name="vehiculo" id="select_vehiculo">
											<option value="">Seleccione una opci&oacute;n</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="poliza">Póliza <span class="campo-o">*</span></label>
										<select class="form-control" name="poliza" id="select_poliza">
											<option value="">Seleccione una opci&oacute;n</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label for="cuotas">Cuota/s a pagar <span class="campo-o">*</span></label>
									<div class="panel-body" id="div-panel-body">
										<div class="col-lg-12 col-md-9 col-sm-9 col-xs-9" id="div-add-cuotas">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="div-select-cuotas">
												<select class="form-control" name="select_cuotas" id="select_cuotas"></select>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
												<button class="btn btn-primary class_button" type="button" id="btn_agregar" disabled="disabled">Agregar</button>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-condensed table-hover" id="tabla_cuotas">
													<thead id="table_header">
														<th class="header-table-th">N° Cuota</th>
														<th class="header-table-th">N° Póliza</th>
														<th class="header-table-th">Precio</th>
														<th class="header-table-th">Vehículo</th>
														<th class="td_center header-table-th">Opción</th>
													</thead>
													<tbody id="table-body"></tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="total" id="label_total">Total $ </label>
										<input type="text" name="total" id="input_total" style="width: 70px !important">
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="observacion">Observación</label>
										<textarea class="form-control" type="text" name="observacion"></textarea>
										<small id="emailHelp" class="form-text text-muted">Máx. caracteres: <strong><span id="span-contador-ca">190</span></strong></small>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Guardar</button>
										<button class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-eraser"></i></span>Reset</button>
									</div>
								</div>
							{!!Form::close()!!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{asset('js/pago-script.js')}}"></script>

@endsection