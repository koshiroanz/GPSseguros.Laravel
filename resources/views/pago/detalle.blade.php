<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="detalle-{{$cuotaPoliza->pago->id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" id="table_header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true" style="color: white !important">x</span>
				</button>
				<h4>Información de Pago: Recibo #<label for="cuotas"> {{$cuotaPoliza->pago->numRecibo}}</label></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
				  	<div class="form-group">
				    	<label for="inputEmail3" class="col-sm-2 control-label">Recibo #</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cuotaPoliza->pago->numRecibo}}" id="input_numRecibo" disabled>
				    	</div>
				    	<label for="inputPassword3" class="col-sm-2 control-label">Fecha</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{Helper::formatoDateVuelta($cuotaPoliza->pago->fecha)}}" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputEmail3" class="col-sm-2 control-label">Recibo de Grua #</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cuotaPoliza->pago->reciboGrua}}" disabled>
				    	</div>
				    	<label for="inputPassword3" class="col-sm-2 control-label">Importe de Grua</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cuotaPoliza->pago->importeGrua}}" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cuotaPoliza->pago->vehiculo->cliente->apellido}}, {{$cuotaPoliza->pago->vehiculo->cliente->nombre}}" disabled>
				    	</div>
				    	<label for="inputPassword3" class="col-sm-2 control-label">Vehículo</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cuotaPoliza->pago->vehiculo->dominio}}" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Póliza</label>
				    	<div class="col-lg-4 col-md-4 col-sm-4">
				      		<input type="text" class="form-control" value="{{$cuotaPoliza->pago->poliza->numPoliza}}" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Cuotas</label>
				    	<div class="col-sm-10">
				      		<table id="example1" data-columns="2" class="table table-bordered table-striped">
				              	<thead id="table_header">
				                	<tr>
				                  		<th class="header-table-th" style="text-align: center !important;">N° de Cuota</th>
				                  		<th class="header-table-th" style="text-align: center !important;">Importe</th>                       
				                	</tr>
				              	</thead>
				              	<tbody id="tbody-{{$cuotaPoliza->pago->id}}" data-table="{{$cuotaPoliza->pago->id}}">
				              	</tbody>
				            </table>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Total</label>
				    	<div class="col-lg-3 col-md-3 col-sm-4">
				      		<input type="text" class="form-control" value="$ {{$cuotaPoliza->pago->total}}" disabled>
			    		</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="observacion" class="col-sm-2 control-label">Observación</label>
				    	<div class="col-lg-10 col-md-8 col-sm-10">
				    		<textarea type="text" class="form-control" disabled>{{$cuotaPoliza->pago->observacion}}</textarea>
			    		</div>
				  	</div>
				</form>
      		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-lg btn-block" style="font-size: 16px !important" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>