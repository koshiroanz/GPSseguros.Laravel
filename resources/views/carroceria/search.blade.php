{!! Form::open(array('url' => 'carroceria','method' => 'GET', 'autocomplete' => 'off', 'role' => 'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Búsqueda por nombre" value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}