$(document).ready(function(){
  $("#numRecibo").focusout(function(){
    var numRecibo = $("#numRecibo").val();
    if(numRecibo != ''){
    $.ajax({
          url: "/getComprobarRecibo",
          type: 'get',
          data: {
            numeroRecibo: numRecibo
          },

          success: function(data){
              if(data[0].cant > 0){
                alert('El recibo #'+numRecibo+' ya se encuentra registrado en la base de datos.');
              }
          },
          error: function(data){
          }
        });
    }
  });
});

$(document).ready(function(){
  var banderaCliente = false;
  $("#select_cliente").change(function(e){
    e.preventDefault();
    var idCliente = document.getElementById('select_cliente');
    if(idCliente.value != 0){
      id_cliente = document.getElementById('select_cliente').value;
      $.ajax({
        url: "/getVehiculo",
        type: 'get',
        data: {
          idCliente: id_cliente
        },

        success: function(data){
          banderaCliente = true;
          $.each(data,function(key, registro) {
            $("#select_vehiculo").append('<option value='+registro.id+'>'+registro.dominio+'</option>');
          });
        },
        error: function(data){
          alert("Ha surgido un error en la carga de datos. Intentelo nuevamente");
        }
      });
    }
  }); // end CHANGE Function

  if(banderaCliente == false){
    var cliente = document.getElementById('select_cliente').value;
    if(cliente != ""){
      $.ajax({
        url: "/getVehiculo",
        type: 'get',
        data: {
          idCliente: cliente
        },

        success: function(data){
          $.each(data,function(key, registro) {
            $("#select_vehiculo").empty();
            $("#select_vehiculo").append('<option value=>Seleccione una opción</option>');
            $("#select_vehiculo").append('<option value='+registro.id+'>'+registro.dominio+'</option>');
          });
        },
        error: function(data){
          alert("Ha surgido un error en la carga de datos. Intentelo nuevamente");
        }
      });
    }else{
      //alert('Debe seleccionar una opción válida en Cliente. Intentelo nuevamente');
    }
  }

}); // end READY Function

$(document).ready(function(){
  $("#select_vehiculo").change(function(e){
    e.preventDefault();
    var idVehiculo = document.getElementById('select_vehiculo').value;
    if(idVehiculo != 0){
      $.ajax({
        url: "/getPoliza",
        type: 'get',
        data: {
          idVehiculo: idVehiculo
        },

        success: function(data){
          $("#select_poliza").empty();
          $("#select_poliza").append('<option value=>Seleccione una opción</option>');
          if(data.length == 0){
            alert('El vehículo seleccionado aún no posee póliza.');
          }else{
            $.each(data,function(key, registro) {
              $("#select_poliza").append('<option value='+registro.id+'>'+registro.numPoliza+'</option>');
            });
          }
        }
      });
    }else{
      alert('Debe seleccionar una opción válida en Vehículo. Intentelo nuevamente');
    }
  }); // end CHANGE Function
}); // end READY Function

$(document).ready(function(){
  $("#select_poliza").change(function(e){ // CARGA LAS OPCIONES EN SELECT CUOTAS (1-6)
    e.preventDefault();
    var cont = 0;
    var idPoliza = document.getElementById('select_poliza');
    if(idPoliza.value != 0){
      id_poliza = document.getElementById('select_poliza').value;
      $.ajax({
        url: "/getCantidadCuotaPoliza",
        type: 'get',
        data: {
          idPoliza: id_poliza
        },

        success: function(data){
          var cantCuotas = data[0]['cantidad'];
          if(cantCuotas < 6){
            $.ajax({
              url: "/getCuotaPoliza",
              type: 'get',
              data: {
                idPoliza: id_poliza
              },

              success: function(data1){
                for(var cuotas = 1; cuotas < 7; cuotas++){
                  $("#select_cuotas").append('<option value='+cuotas+'_'+idPoliza.value+'>Cuota N° '+cuotas+'</option>');
                }

                for(var indice = 0; indice < cantCuotas; indice++){
                  var buscar = data1[indice].numCuota+'_'+idPoliza.value;
                  $("#select_cuotas option[value='"+buscar+"']").remove();
                }
                $("#btn_agregar").prop('disabled', false);
              } 
            });
          }else{
            alert('La póliza ha sido pagada por completo (6/6).');
          }
        }
      });
    }else{
      alert('Debe seleccionar una opción válida en Póliza. Intentelo nuevamente');
    }
  }); // end CHANGE Function
}); // end READY Function

$(document).ready(function(){
  var cont = 0;
  total = 0;
  $("#btn_agregar").click(function(e){  // AGREGA CUOTAS (1-6) A LA TABLA
    e.preventDefault();
    var poliza = document.getElementById("select_poliza");
    var vehiculo = document.getElementById("select_vehiculo");
    if(poliza.value != 0 && vehiculo.value != 0){
      var datosCuota = document.getElementById("select_cuotas").value.split('_'),
      numero_cuota = datosCuota[0],
      id_poliza = datosCuota[1];
      $.ajax({
        url: "/getImportePoliza",
        type: 'get',
        data: {
          idPoliza: id_poliza
        },

        success: function(data){
          // Sin each.. esto devuelve SOLO uno o ningún registro por click..
          $.each(data,function(key, registro) {
            cont++;
            var datosPoliza = poliza.options[poliza.selectedIndex];
            var datosVehiculo = vehiculo.options[vehiculo.selectedIndex];
            var costo = registro.costoPoliza;
            
            $("#tabla_cuotas").append('<tr id="fila'+cont+'" value="'+cont+'" name="cuota">'+
                                        '<input type="hidden" name="cuota[]" value="'+numero_cuota+'">'+
                                        '<input type="hidden" name="importes[]" id="filaHiddenInput'+cont+'">'+
                                        '<td>'+numero_cuota+'</td>'+
                                        '<td>'+datosPoliza.text+'</td>'+
                                        '<td>$'+
                                          '<input type="number" name="importe" onKeyUp="recalcularTotal('+cont+')" id="filaInput'+cont+'" style="width: 100px !important">'+
                                        '</td>'+
                                        '<td>'+datosVehiculo.text+'</td>'+
                                        '<td class="td_center">'+
                                          '<button class="btn btn-danger" id="btn_eliminar" type="button" onclick="accionRemover('+id_poliza+','+cont+','+numero_cuota+','+registro.costoPoliza+')"><i class="fa fa-trash"></i></button>'+
                                        '</td>'+
                                      '</tr>').fadeIn("slow");
            $('#select_cuotas option[value="'+numero_cuota+'_'+id_poliza+'"]').remove();
            $("#filaInput"+cont).val(registro.costoPoliza);
            $("#filaHiddenInput"+cont).val(registro.costoPoliza);
            // CARGA EL IMPORTE DE LA POLIZA EN TOTAL (SI EXISTE MAS DE UNO, ACUMULA EL TOTAL)
            if($("#input_total").val() > 0){
              total = parseInt($("#input_total").val())+parseInt(registro.costoPoliza);
              $("#input_total").val(total);
            }else{
              $("#input_total").val(registro.costoPoliza);
            }
          });
        }
      });
    }
  });
});

function recalcularTotal(cont){
  var cantidadFilas = $("#table-body tr").length;
  var inputValorActual = parseFloat($("#filaInput"+cont).val());
  if(isNaN(inputValorActual))
    inputValorActual = 0;
  
  $("#filaHiddenInput"+cont).attr("value", inputValorActual);
  var total = 0;
  for(var i = 1; i <= cantidadFilas; i++){
    if(isNaN(parseFloat($("#filaInput"+i).val())))
      total += parseFloat(0);
    else
      total += parseFloat($("#filaInput"+i).val());
  }

  $("#input_total").val(total);
}

function accionRemover(idPoliza, fila, numCuota, costoP){
  var optionValues = [];

  $('#select_cuotas option').each(function() {
      optionValues.push($(this).val());
  });

  var total = $("#input_total").val();
  total -= parseInt(costoP);
  $("#input_total").val(total);
  $("#fila"+fila).remove();
  $("#select_cuotas").prepend('<option value='+numCuota+'_'+idPoliza+'>Cuota N° '+numCuota+'</option>');
}
