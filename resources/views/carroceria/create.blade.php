@extends('layouts.admin')
@section('contenido')
@include('alert.alert')
	<div class="box">
		<div class="box-header with-border" id="div-with-border">
  			<nav aria-label="breadcrumb">
		  		<ol class="breadcrumb">
			    	<li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('vehiculo')}}">Vehículos</a></li>
			    	<li class="breadcrumb-item"><a href="{{url('carroceria')}}">Carrocerías</a></li>
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
							<h3>Carrocería</h3>
							{!!Form::open(array('url' => 'carroceria', 'method' => 'POST', 'autocomplete' => 'off', 'id' => 'formCarroceria'))!!}
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="nombre">Nombre <span class="campo-o">*</span></label>
										<input type="text" name="nombre" class="form-control" id="input_nombre" placeholder="Aquí nombre carrocería..." value="{{ old('nombre') }}" autofocus>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Guardar</button>
										<!--<button class="btn btn-labeled btn-danger" id="btn_reset"><span class="btn-label"><i class="fa fa-eraser"></i></span>Reset</button>-->
										<a href="#" class="btn btn-labeled btn-danger" id="btn_reset"><span class="btn-label"><i class="fa fa-eraser"></i></span>Reset</a>
									</div>
								</div>
							{!!Form::close()!!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$('#btn_reset').click(function(){
					if($('#input_nombre').val() != ''){
						var cont = 0;
						var cant = $('#formCarroceria').elements;
						console.log(cant);

						$.each($("#formCarroceria").elements, function(){ 
					    	console.log($(this));
					    });
						$('#formCarroceria :input').each(function(){
							console.log(cont++);
						 	//var input = $(this); // This is the jquery object of the input, do what you will
						});
						$('#input_nombre').val('');
						$('#input_nombre').focus();
						
					}
				});

				/*$("form#formCarroceria :input").each(function(){
				 var input = $(this); // This is the jquery object of the input, do what you will
				});*/
			});
		</script>
	</div>
@endsection