@if(count($errors) > 0)
	@foreach($errors->all() as $error)
		<script>
			toastr.error('<?php echo $error;?>', 'Mensaje', {timeOut: 6000});
		</script>
	@endforeach
@endif
@if(session('fail'))
	<script>
		toastr.error('<?php echo session('fail');?>', 'Mensaje', {timeOut: 5000});
	</script>
@elseif(session('success'))
	<script>
		toastr.success('<?php echo session('success');?>', 'Mensaje', {timeOut: 5000});
	</script>
@endif