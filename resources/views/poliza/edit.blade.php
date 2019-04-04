@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('poliza')}}">Pólizas</a></li>
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
							<h3>Editar Póliza: <span class="label label-warning">#{{$poliza->numPoliza}}</span></h3>
							
							{!!Form::model($poliza, ['method' => 'PATCH', 'route' => ['poliza.update', $poliza->id]])!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="numPoliza">N° de Póliza <span class="campo-o">*</span></label>
										<input type="text" name="numPoliza" class="form-control" value="{{$poliza->numPoliza}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="vigenciaPedida">Vig. pedida <span class="campo-o">*</span></label>
										<input type="text" name="vigenciaPedida" class="form-control" id="datepicker" value="{{$poliza->vigenciaPedida}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="vigenciaPedidaHasta">Vig. pedida hasta <span class="campo-o">*</span></label>
										<input type="text" name="vigenciaPedidaHasta" class="form-control" id="datepicker2" value="{{$poliza->vigenciaPedidaHasta}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="vigenciaPoliza">Vig. Póliza</label>
										<input type="text" name="vigenciaPoliza" class="form-control" id="datepicker3" value="{{$poliza->vigenciaPoliza}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="vigenciaPolizaHasta">Vig. Póliza hasta</label>
										<input type="text" name="vigenciaPolizaHasta" class="form-control" id="datepicker4" value="{{$poliza->vigenciaPolizaHasta}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="costoPoliza">Costo de Póliza <span class="campo-o">*</span></label>
										<input type="text" name="costoPoliza" class="form-control" value="{{$poliza->costoPoliza}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="numPolizaVida">N° de Póliza de vida</label>
										<input type="text" name="numPolizaVida" class="form-control" value="{{$poliza->numPolizaVida}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="costoPolizaVida">Costo de póliza de vida</label>
										<input type="text" name="costoPolizaVida" class="form-control" placeholder="$" value="{{$poliza->costoPolizaVida}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="endoso">Endoso</label>
										<input type="text" name="endoso" class="form-control" value="{{$poliza->endoso}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="sumaAsegurada">Suma asegurada</label>
										<input type="text" name="sumaAsegurada" class="form-control" value="{{$poliza->sumaAsegurada}}">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="estado">Estado <span class="campo-o">*</span></label>
										<select class="form-control" name="estado">
											<option value="{{$poliza->estado}}">{{$poliza->estado}}</option>
											@foreach($estados as $estado)
												<option value="{{$estado}}">{{$estado}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="destino">Destino <span class="campo-o">*</span></label>
										<select class="form-control" name="destino">
											<option value="{{$poliza->destino}}">{{$poliza->destino}}</option>
											@foreach($destinos as $destino)
												<option value="{{$destino}}">{{$destino}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="vehiculo">Vehículo <span class="campo-o">*</span></label>
										<select class="form-control" name="vehiculo">
											<option value="{{$poliza->vehiculo->id}}">{{$poliza->vehiculo->dominio}} / {{$vehiculoCliente->apellido}}, {{$vehiculoCliente->nombre}}</option>
											@foreach($vehiculosFiltrado as $ve)
												<option value="{{$ve->id}}">{{$ve->dominio}} / {{$ve->apellido}}, {{$ve->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="categoria">Categoría <span class="campo-o">*</span></label>
										<select class="form-control" name="categoria">
											<option value="{{$poliza->categoria->id}}">{{$poliza->categoria->nombre}}</option>
											@foreach($categoriasFiltrada as $cat)
												<option value="{{$cat->id}}">{{$cat->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="comp_seguro">Compañia aseguradora <span class="campo-o">*</span></label>
										<select class="form-control" name="comp_seguro" id="select_compseguro">
											<option value="{{$poliza->companiaSeguro->id}}">{{$poliza->companiaSeguro->nombre}}</option>
											@foreach($companiasFiltrada as $compania)
												<option value="{{$compania->id}}">{{$compania->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
									<div class="form-group">
										<label for="cobertura">Cobertura <span class="campo-o">*</span></label>
										<select class="form-control" name="cobertura" id="select_cobertura">
											<option value="{{$poliza->cobertura->id}}">{{$poliza->cobertura->nombre}}</option>
											@foreach($coberturasFiltrada as $cobertura)
												<option value="{{$cobertura->id}}">{{$cobertura->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="observacion">Observación</label>
										<textarea type="text" name="observacion" class="form-control" rows="3" cols="50" placeholder="Aquí su observación">{{$poliza->observacion}}</textarea>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
										<a href="{{url('poliza')}}"><button class="btn btn-labeled btn-danger" type="button"><span class="btn-label"><i class="fa fa-undo"></i></span>Atrás</button></a>
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