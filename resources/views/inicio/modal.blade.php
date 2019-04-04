<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="info-{{$cliente->clId}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" id="table_header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: white !important">x</span>
				</button>
				<h4>Información del Cliente:</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
				  	<div class="form-group">
				    	<label for="inputEmail3" class="col-sm-2 control-label">Apellido</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cliente->clApellido}}" id="input_numRecibo" disabled>
				    	</div>
				    	<label for="inputPassword3" class="col-sm-2 control-label">Nombre</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cliente->clNombre}}" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputEmail3" class="col-sm-2 control-label">DNI</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cliente->clDni}}" disabled>
				    	</div>
				    	<label for="inputPassword3" class="col-sm-2 control-label">Vehículos</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<select class="form-control" id="select_vehiculo">
	  							<option value="0">Seleccione una opción</option>
	  							@foreach($vehiculosCliente as $ve)
	  								<option value="{{$ve->id}}">{{$ve->dominio}}</option>
	  							@endforeach
	    					</select>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputEmail3" class="col-sm-2 control-label">Pólizas</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<select class="form-control" id="select_poliza">
	    						<option value="0">Seleccione una opción</option>
	    					</select>
				    	</div>
				    	<label for="inputPassword3" class="col-sm-2 control-label">Estado</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" name="estado" value="" id="estado" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Póliza</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$pa->numPoliza}}" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Vigencia de Póliza desde</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" name="vigenciaPoliza" value="" id="vigencia_poliza" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Vigencia de Póliza hasta</label>
				    	<div class="col-lg-3 col-md-3 col-sm-4">
				      		<input type="text" class="form-control" name="vigenciaPolizaHasta" value="" id="vigencia_poliza_hasta" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
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
				  	</div>
				</form>
      		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-lg btn-block class_button" style="font-size: 16px !important" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>