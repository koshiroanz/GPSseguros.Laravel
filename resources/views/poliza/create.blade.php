@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('poliza')}}">Pólizas</a></li>
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
							<h3>Póliza</h3>
							{!!Form::open(array('url' => 'poliza', 'method' => 'POST', 'autocomplete' => 'off'))!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="numPoliza">N° póliza <span class="campo-o">*</span></label>
										<input type="text" name="numPoliza" class="form-control" placeholder="Aquí número de póliza..." value="{{ old('numPoliza') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="vigenciaPedida">Vig. pedida <span class="campo-o">*</span></label>
										<input type="text" name="vigenciaPedida" id="datepicker" class="form-control" placeholder="DD-MM-AAAA" value="{{ old('vigenciaPedida') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="vigenciaPedidaHasta">Vig. pedida hasta <span class="campo-o">*</span></label>
										<input type="text" name="vigenciaPedidaHasta" id="datepicker2" class="form-control" placeholder="DD-MM-AAAA" value="{{ old('vigenciaPedidaHasta') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="vigenciaPoliz">Vig. póliza</label>
										<input type="text" name="vigenciaPoliza" id="datepicker3" class="form-control" placeholder="DD-MM-AAAA" value="{{ old('vigenciaPoliza') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="vigenciaPolizaHasta">Vig. póliza hasta</label>
										<input type="text" name="vigenciaPolizaHasta" id="datepicker4" class="form-control" placeholder="DD-MM-AAAA" value="{{ old('vigenciaPolizaHasta') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="costoPoliza">Costo de póliza <span class="campo-o">*</span></label>
										<input type="text" name="costoPoliza" class="form-control" placeholder="$" value="{{ old('costoPoliza') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="numPolizaVida">N° póliza de vida</label>
										<input type="text" name="numPolizaVida" class="form-control" placeholder="Aquí número de póliza de vida..." value="{{ old('numPolizaVida') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="costoPolizaVida">Costo de póliza de vida</label>
										<input type="text" name="costoPolizaVida" class="form-control" placeholder="$" value="{{ old('costoPolizaVida') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="endoso">Endoso</label>
										<input type="text" name="endoso" class="form-control" placeholder="N° de endoso" value="{{ old('endoso') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="sumaAsegurada">Suma asegurada</label>
										<input type="text" name="sumaAsegurada" class="form-control" placeholder="$" value="{{ old('sumaAsegurada') }}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="estado">Estado <span class="campo-o">*</span></label>
										<select class="form-control" name="estado">
											<option value="ACTIVO" @if(old('estado') == 'ACTIVO') {{ 'selected' }} @endif>ACTIVO</option>
											<option value="BAJA TEMPORAL" @if(old('estado') == 'BAJA TEMPORAL') {{ 'selected' }} @endif>BAJA TEMPORAL</option>
											<option value="BAJA PERMANENTE" @if(old('estado') == 'BAJA PERMANENTE') {{ 'selected' }} @endif>BAJA PERMANENTE</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="destino">Destino <span class="campo-o">*</span></label>
										<select class="form-control" name="destino">
											<option value="PARTICULAR" @if(old('destino') == 'PARTICULAR') {{ 'selected' }} @endif>PARTICULAR</option>
											<option value="COMERCIAL" @if(old('destino') == 'COMERCIAL') {{ 'selected' }} @endif>COMERCIAL</option>
										</select>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="vehiculo">Vehículo <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="vehiculo" id="select_vehiculo" data-live-search="true">
											<option value="">Seleccione una opci&oacute;n...</option>
											@foreach($vehiculos as $ve)
												<option value="{{$ve->id}}" @if(old('vehiculo') == $ve->id) {{ 'selected' }} @endif>{{$ve->dominio}} / {{$ve->cliApellido}}, {{$ve->cliNombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="categoria">Categoría <span class="campo-o">*</span></label>
										<select class="form-control" name="categoria">
											<option value="">Seleccione una opción</option>
											@foreach($categorias as $cat)
												<option value="{{$cat->id}}" @if(old('categoria') == $cat->id) {{ 'selected' }} @endif>{{$cat->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="comp_seguro">Compañia aseguradora <span class="campo-o">*</span></label>
										<select class="form-control selectpicker" name="comp_seguro" id="select_compseguro" data-live-search="true">
											<option value="">Seleccione una opci&oacute;n...</option>
											@foreach($companias as $comp)
												<option value="{{$comp->id}}" @if(old('comp_seguro') == $comp->id) {{ 'selected' }} @endif>{{$comp->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="cobertura">Cobertura <span class="campo-o">*</span></label>
										<select class="form-control" name="cobertura" id="select_cobertura">
											<option value="">Seleccione una opci&oacute;n...</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="observacion">Observación</label>
										<textarea class="form-control" name="observacion" value="{{ old('observacion') }}" rows="3" cols="50" placeholder="Aquí su observación..."></textarea>
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

	<script type="text/javascript">
		$(document).ready(function(){
            $('#select_compseguro').change(function(){
              	var id = $('#select_compseguro option:selected').val(), select_cobertura = $('#select_cobertura');
               	$.ajax({
                  	url: "/getCoberturas",
                  	type: 'get',
                  	data: {
                     	id: id
                  	},
                  	success: function(data){
                  		select_cobertura.empty();
                  		$("#select_cobertura").append('<option>Seleccione una opción...</option>');
						for (var j = 0; j < data.length; j++) {
							$("#select_cobertura").append('<option value="'+data[j].id+'">'+data[j].nombre+'</option>');
						}
                  	}
              	});
           	});
        });            
	</script>

@endsection