$(document).ready(function(){
  $('#select_marca_carroceria').change(function(){
    	var id = $('#select_marca_carroceria option:selected').val(), select_modelo_carroceria = $('#select_modelo_carroceria');
     	$.ajax({
        	url: "/getModeloCarroceria",
        	type: 'get',
        	data: {
           	id: id
        	},
        	success: function(data){
        		select_modelo_carroceria.empty();
        		$.each(data, function(key, registro) {
      			$("#select_modelo_carroceria").append('<option value="'+registro.id+'">'+registro.nombre+'</option>');
   	 	});
        	}
    	});
 	});
});