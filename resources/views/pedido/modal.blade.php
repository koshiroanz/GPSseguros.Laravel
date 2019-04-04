<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-act-{{$pedido->id}}">
	{!!Form::model($pedido, ['method' => 'PATCH', 'route' => ['pedido.update', $pedido->id]])!!}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" id="table_header">
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true" style="color: #fff !important;">x</span>
					</button>
					<h4>Pedido de Póliza</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="cliente">Cliente</label>
						<input type="text" class="form-control" value="{{$pedido->clApellido}}, {{$pedido->clNombre}}" disabled>
					</div>
					<div class="form-group">
						<label for="vehiculo">Vehículo</label>
						<input type="text" class="form-control" value="{{$pedido->veDominio}}" disabled>
					</div>
					<div class="form-group">
						<label for="numPoliza">N° de Póliza actual</label>
						<input type="text" class="form-control" name="numPolizaActual" value="{{$pedido->numPoliza}}" disabled>
					</div>
					<div class="form-group">
						<label for="numPoliza">Nuevo N° de Póliza <span class="campo-o">*</span></label>
						<input type="text" class="form-control" name="numPoliza" value="{{$pedido->numPoliza}}">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-labeled btn-success" style="margin-bottom: 0 !important;"><span class="btn-label"><i class="fa fa-check"></i></span>Actualizar</button>
					<button class="btn btn-labeled btn-danger" data-dismiss="modal"><span class="btn-label"><i class="fa fa-times"></i></span>Cancelar</button>
				</div>
			</div>
		</div>
	{{Form::close()}}
</div>