$(document).ready(function(){
	$("#select_vehiculo").change(function(){
	    var vehiculo = $("#select_vehiculo").val();
	    if(!vehiculo){
	      	limpiarComponentes();
	    }else{
	      	$.ajax({
		        url: "/getPolizaInfo",
		        type: 'get',
		        data: {
		          idVehiculo: vehiculo
		        },

		        success: function(data){
		        	if(data.length != 0){
		        		limpiarSelectPoliza();	// En teoría debería traer la póliza activa (caso ideal 1 sola).. 
			        	$("#select_poliza").append('<option value=>Seleccione una póliza</option>');
			          	$.each(data,function(key, registro) {
			            	$("#select_poliza").append('<option value='+registro.id+'># '+registro.numPoliza+'</option>');
			          	});
		        	}else{
		        		alert("El vehículo seleccionado aún no posee póliza.");
		        	}
		        }
	      	});
	    }
  	}); // end CHANGE Function

  	$("#select_poliza").change(function(){
	    var poliza = $("#select_poliza").val();
	    if(!poliza){
	      	limpiarElementosPoliza();
	    }else{
	    	$.ajax({
		        url: "/getPolizaEstado",
		        type: 'get',
		        data: {
		          idPoliza: poliza
		        },
		        success: function(dato){
		        	$.ajax({
				        url: "/getPagoInfo",
				        type: 'get',
				        data: {
				          idPoliza: poliza
				        },
				        success: function(data){
				        	var total = 0;
				        	$("#tabla_cuotas tbody").empty();
				        	$.each(data,function(key, registro) {
						      	$("#tabla_cuotas").append('<tr><td>'+registro.numRecibo+'</td><td>'+registro.fecha+'</td><td>'+registro.numPoliza+'</td><td>'+registro.numCuota+'</td><td>$ '+registro.importe+'</td></tr>');
				          		total += registro.importe;
				          	});
				          	$("#total").val('$ '+total);
				        }
			      	});

		        	$("#estado").val(dato.estado);
		        	$("#vigencia_poliza").val(dato.vigenciaPoliza);
		        	$("#vigencia_poliza_hasta").val(dato.vigenciaPolizaHasta);
		        }
	      	});

	    }
  	}); // end CHANGE Function



  	function limpiarSelectPoliza(){
  		$("#select_poliza").empty();
  		if($("#select_poliza").prop('disabled')){
			$("#select_poliza").removeAttr('disabled');
  		}else{
  			$("#select_poliza").attr({
                'disabled': 'disabled'
            });
  		}
  	}

  	function limpiarComponentes(){
  		$("#select_poliza").empty();
  		$("#select_poliza").append('<option value=>Seleccione una póliza</option>');
  		limpiarSelectPoliza();
  		limpiarElementosPoliza();
  	}

  	function limpiarElementosPoliza(){
  		$("#estado").val("");
  		$("#vigencia_poliza").val("");
  		$("#vigencia_poliza_hasta").val("");
  		$("#tabla_cuotas tbody").empty();
  		$("#total").val("$");
  	}
}); // end READY Function
