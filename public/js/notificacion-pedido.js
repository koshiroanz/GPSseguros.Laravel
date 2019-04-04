$(document).ready(function(){
	function notificarPedidos(){
		$.ajax({
		    url: "/getNotificaciones",
		    type: 'get',

		    success: function(data){
		    	if($("#notificacion").children().length > 0){											// Si es > a 0 tiene un elemento cargado (hijo)
		    		if(parseInt($("#notificacion").children().text()) !== parseInt(data[0].count)){ 	// Si los valores son distintos se actualiza.
		    			$("#notificacion").children().remove();											// Eliminar el value del elemento hijo para luego cargar el nuevo valor.
		    			$("#notificacion").append('<span id="not_span" value="'+data[0].count+'">'+data[0].count+'</span>');
		    		}																					// Si los valores son iguales no se actualiza.
		    	}else{
		    		$("#notificacion").append('<span id="not_span" value="'+parseInt(data[0].count)+'">'+data[0].count+'</span>');
		    	}
		    	setTimeout(notificarPedidos, 20000);
		    },
		    error: function(){
		    	setTimeout(notificarPedidos, 10000);
		    }
		});
	}
	
	if($("#notificacion").children().length == 0){ // Si #notificacion no tiene hijo => entra la primera vez. Luego se ejecutará cada 10 seg. sin refrescar la web.
		notificarPedidos();
	}

	//setTimeout(notificarPedidos, 10000);	// 600000 = 10min - 1000 = 1seg	
});
