<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$productor->id}}">
	{{Form::open(array('action' => array('UsuarioController@destroy', $productor->id), 'method' => 'delete'))}}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" id="table_header">
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true">x</span>
					</button>
					<h4>Eliminar Productor</h4>
				</div>
				<div class="modal-body">
					<p class="texto-modal">¿ Está seguro de eliminar a <strong>{{$productor->nombre}} {{$productor->apellido}}</strong> ?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-labeled btn-success" style="margin-bottom: 0 !important;"><span class="btn-label"><i class="fa fa-check"></i></span>Eliminar</button>
					<button class="btn btn-labeled btn-danger" data-dismiss="modal"><span class="btn-label"><i class="fa fa-times"></i></span>Cancelar</button>
				</div>
			</div>
		</div>
	{{Form::close()}}
</div>