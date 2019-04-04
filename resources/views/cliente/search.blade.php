{!! Form::open(array('url' => 'cliente','method' => 'GET', 'autocomplete' => 'off', 'role' => 'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="buscarCliente" placeholder="Búsqueda por apellido o dni." value="{{$buscarCliente}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}