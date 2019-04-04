$(document).ready(function(){
	$(document).on('click', 'button[data-id]', function (e) {
	    var request_id = $(this).attr('data-id');
	    $.ajax({
			url : '/getPagoCuota',
			type : 'get',
			data:{
				idPago: request_id
			},
			success:function(data){
				if(jQuery('#tbody-'+request_id+' tr').length > 0){
					$('#tbody-'+request_id+' tr').remove();	//Si existe elementos tr en este tbody remueve.
				}
				
				$.each(data, function(key,registro){
					$('#tbody-'+request_id).append('<tr><td>'+registro.numCuota+'</td><td>$ '+registro.importe+'</td></tr>');
				});
			},
			fail:function(){
				
			}
	    });
	});
});