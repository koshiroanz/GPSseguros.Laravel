{!! Form::open(array('url' => 'poliza','method' => 'GET', 'autocomplete' => 'off', 'role' => 'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Búsqueda por n° de póliza o dominio" value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}