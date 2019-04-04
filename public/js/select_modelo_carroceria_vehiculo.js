function changeMarca(){
  var marca = document.getElementById('select_marca').value;
  var modelo = document.getElementById('select_modelo');
  if(marca){
    $.ajax({
      url : '/getModelo',
      type : 'get',
      data:{
        value: marca
      },
      success:function(data){
        clearOptions(modelo);
        for (var i = 0; i < data.length; i++) {
          var opt = document.createElement('option');
            opt.value = data[i].id;
            opt.text = data[i].nombre;
          modelo.appendChild(opt);
        }
      }
    });
  }else{
    clearOptions(modelo);
  }
}

function changeModelo(){
  var modelo = document.getElementById('select_modelo').value;
  var carroceria = document.getElementById('select_carroceria');
  if(modelo){
    $.ajax({
      url : '/getCarroceria',
      type : 'get',
      data:{
        value: modelo
      },
      success:function(data){
        clearOptions(carroceria);
        for (var i = 0; i < data.length; i++) {
          var opt = document.createElement('option');
            opt.value = data[i].id;
            opt.text = data[i].nombre;
          carroceria.appendChild(opt);
        }
      }
    });
  }else{
    clearOptions(carroceria);
  }
}

function clearOptions(select){
  var opt = document.createElement('option');
  select.options.length = 0;
  
    opt.value = "";
    opt.text = "Seleccione una opción";
  select.appendChild(opt);
}