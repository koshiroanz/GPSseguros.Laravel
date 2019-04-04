$(document).ready(function(){
	$("#in_email").focusout(function(){
		var dato = document.getElementById("in_email").value;
		if(dato.length > 0){
		 	$.ajax({
		        url: '/getEm',
		        type: 'get',
		        data: {
		          dato: dato
		        },
		        success: function(data){
		        	$.each(data, function(key, registro) {
	            		if(registro.count > 0){
	            			$("#alert-msn").text('Este email ya se encuentra registrado en la base de datos.');
	            		}
	         	 	});
		        },
		        error: function(data){
		        }
	      	});
		}
	});
	
	$("#in_email").focusin(function(){
		var dato = document.getElementById("in_email").value;
		if(dato.length > 0){
		 	$("#in_email").keydown(function(event) {
                if (event.keyCode == 8) {
                    $("#alert-msn").text('');
                }
            });
		}
	});
});