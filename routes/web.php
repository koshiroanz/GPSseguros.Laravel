<?php

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/error404','HomeController@error404');

// URL -> Home
Route::Resource('/', 'HomeController');
Route::Resource('/home', 'HomeController');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('info/vehiculo={id}', 'HomeController@info');
Route::get('/getNotificaciones', 'HomeController@getNotificaciones');
Route::get('/getPolizaInfo', 'HomeController@getPolizaInfo');
Route::get('/getPolizaEstado', 'HomeController@getPolizaEstado');
Route::get('/getPagoInfo', 'HomeController@getPagoInfo');
//Route::get('home/{slug?}', 'HomeController@info');

//PRIVI-BAJO
// URL -> LOCALIDAD
//Route::resource('localidad','LocalidadController'); 								//	RUTA GRAL - CRUD LOCALIDAD
Route::get('localidad','LocalidadController@index');
Route::get('localidad/create','LocalidadController@create');
Route::post('localidad','LocalidadController@store');

// URL -> BENFICIARIO
//Route::resource('beneficiario','BeneficiarioController');							//	RUTA GRAL - CRUD BENFICIARIO
Route::get('beneficiario','BeneficiarioController@index');
Route::get('beneficiario/create','BeneficiarioController@create');
Route::post('beneficiario','BeneficiarioController@store');

// URL -> CLIENTE
//Route::resource('cliente','ClienteController');									//	RUTA GRAL - CRUD CLIENTE
Route::get('cliente','ClienteController@index');
Route::get('cliente/create','ClienteController@create');
Route::post('cliente','ClienteController@store');

// URL -> VEHICULO
//Route::resource('vehiculo','VehiculoController');									//	RUTA GRAL - CRUD VEHICULO
Route::get('vehiculo','VehiculoController@index');
Route::get('vehiculo/create','VehiculoController@create');
Route::post('vehiculo','VehiculoController@store');
Route::get('/getModelo','VehiculoController@getModelo');	// Recibe datos a través de ajax y el método obtenerModelo() devuelve datos a la vista.
Route::get('/getCarroceria','VehiculoController@getCarroceria');

// URL -> CARROCERIA
//Route::resource('carroceria','CarroceriaController');								//	RUTA GRAL - CRUD CARROCERIA
Route::get('carroceria','CarroceriaController@index');
Route::get('carroceria/create','CarroceriaController@create');
Route::post('carroceria','CarroceriaController@store');

// URL -> MARCA
//Route::resource('marca','MarcaController');										//	RUTA GRAL - CRUD MARCA
Route::get('marca','MarcaController@index');
Route::get('marca/create','MarcaController@create');
Route::post('marca','MarcaController@store');

// URL -> MODELO
//Route::resource('modelo','ModeloController');										//	RUTA GRAL - CRUD MODELO
Route::get('modelo','ModeloController@index');
Route::get('modelo/create','ModeloController@create');
Route::post('modelo','ModeloController@store');

// URL -> MODELOCARROCERIA
//Route::resource('modelo_carroceria','ModeloCarroceriaController');				//	RUTA GRAL - CRUD MODELOCARROCERIA
Route::get('modelo_carroceria','ModeloCarroceriaController@index');
Route::get('modelo_carroceria/create','ModeloCarroceriaController@create');
Route::post('modelo_carroceria','ModeloCarroceriaController@store');
Route::get('/getModeloCarroceria','ModeloCarroceriaController@getModeloCarroceria');
//Route::get('/getCliente','VehiculoController@getCliente');
//Route::get('/getClientes','VehiculoController@getClientes');

// URL -> POLIZA
//Route::resource('poliza','PolizaController');										//	RUTA GRAL - CRUD POLIZA
Route::get('poliza','PolizaController@index');
Route::get('poliza/create','PolizaController@create');
Route::post('poliza','PolizaController@store');
Route::get('/getCoberturas','PolizaController@getCoberturas');
//Route::get('/getVehiculo','PolizaController@getVehiculo');
//Route::get('/getVehiculos','PolizaController@getVehiculos');

// URL -> PAGO
//Route::resource('pago','PagoController');											//	RUTA GRAL - CRUD PAGO
Route::get('pago','PagoController@index');
Route::get('pago/create','PagoController@create');
Route::post('pago','PagoController@store');
Route::get('/getPago','PagoController@getPago');
Route::get('/getVehiculo','PagoController@getVehiculo');
Route::get('/getPoliza','PagoController@getPoliza');
Route::get('/getCantidadCuotaPoliza','PagoController@getCantidadCuotaPoliza');
Route::get('/getCuotaPoliza','PagoController@getCuotaPoliza');
Route::get('/getImportePoliza','PagoController@getImportePoliza');
Route::get('/getComprobarRecibo','PagoController@getComprobarRecibo');
Route::get('/getPagoCuota','PagoController@getPagoCuota');

// URL -> SINIESTRO
//Route::resource('siniestro','SiniestroController');								//	RUTA GRAL - CRUD SINIESTRO
Route::get('siniestro','SiniestroController@index');
Route::get('siniestro/create','SiniestroController@create');
Route::post('siniestro','SiniestroController@store');
Route::get('/getClienteVehiculo','SiniestroController@getClienteVehiculo');
Route::get('/getVehiculoPoliza','SiniestroController@getVehiculoPoliza');
Route::get('/getImagenesSiniestro', 'SiniestroController@getImagenesSiniestro');
Route::get('/getRouteImagenSiniestro', 'SiniestroController@getRouteImagenSiniestro');

// URL -> REPORTE
Route::get('reporte/carnetprovisorio','CarnetProvisorioController@index');
Route::get('reporte/carnetprovisorio/visualizar/{id}','CarnetProvisorioController@visualizar');
Route::get('reporte/carnetprovisorio/descargar/{id}','CarnetProvisorioController@descargar');

Route::get('reporte/certificado','CertificadoController@index');
Route::get('reporte/certificado/visualizar/{id}','CertificadoController@visualizar');
Route::get('reporte/certificado/descargar/{id}','CertificadoController@descargar');

// URL -> PEDIDO
//Route::resource('pedido','PedidoController');
Route::get('pedido','PedidoController@index');
Route::patch('pedido/{id}','PedidoController@update')->name('pedido.update');
Route::get('pedido/{id}','PedidoController@show');

Route::group(['middleware' => ['privilegio:privilegio-alto']], function() {
	// URL -> LOCALIDAD 
    Route::patch('localidad/edit/{id}','LocalidadController@update')->name('localidad.update');
    Route::get('localidad/edit/localidad={id}','LocalidadController@edit');
	Route::delete('localidad/{id}','LocalidadController@destroy');
	Route::get('localidad/{id}','LocalidadController@show');
	// URL -> BENFICIARIO
	Route::patch('beneficiario/edit/{id}','BeneficiarioController@update')->name('beneficiario.update');
    Route::get('beneficiario/edit/beneficiario={id}','BeneficiarioController@edit');
	Route::delete('beneficiario/{id}','BeneficiarioController@destroy');
	Route::get('beneficiario/{id}','BeneficiarioController@show');
	// URL -> CLIENTE
	Route::patch('cliente/edit/{id}','ClienteController@update')->name('cliente.update');
    Route::get('cliente/edit/cliente={id}','ClienteController@edit');
	Route::delete('cliente/{id}','ClienteController@destroy');
	Route::get('cliente/{id}','ClienteController@show');
	// URL -> VEHICULO
	Route::patch('vehiculo/edit/{id}','VehiculoController@update')->name('vehiculo.update');
    Route::get('vehiculo/edit/vehiculo={id}','VehiculoController@edit');
	Route::delete('vehiculo/{id}','VehiculoController@destroy');
	Route::get('vehiculo/{id}','VehiculoController@show');
	// URL -> CARROCERIA
	Route::patch('carroceria/edit/{id}','CarroceriaController@update')->name('carroceria.update');
    Route::get('carroceria/edit/carroceria={id}','CarroceriaController@edit');
	Route::delete('carroceria/{id}','CarroceriaController@destroy');
	Route::get('carroceria/{id}','CarroceriaController@show');
	// URL -> MARCA
	Route::patch('marca/edit/{id}','MarcaController@update')->name('marca.update');
    Route::get('marca/edit/marca={id}','MarcaController@edit');
	Route::delete('marca/{id}','MarcaController@destroy');
	Route::get('marca/{id}','MarcaController@show');
	// URL -> MODELO
	Route::patch('modelo/edit/{id}','ModeloController@update')->name('modelo.update');
    Route::get('modelo/edit/modelo={id}','ModeloController@edit');
	Route::delete('modelo/{id}','ModeloController@destroy');
	Route::get('modelo/{id}','ModeloController@show');
	// URL -> MODELOCARROCERIA
	Route::patch('modelo_carroceria/edit/{id}','ModeloCarroceriaController@update')->name('modelo_carroceria.update');
    Route::get('modelo_carroceria/edit/modelo_carroceria={id}','ModeloCarroceriaController@edit');
	Route::delete('modelo_carroceria/{id}','ModeloCarroceriaController@destroy');
	Route::get('modelo_carroceria/{id}','ModeloCarroceriaController@show');
	// URL -> POLIZA
	Route::patch('poliza/edit/{id}','PolizaController@update')->name('poliza.update');
    Route::get('poliza/edit/poliza={id}','PolizaController@edit');
	Route::delete('poliza/{id}','PolizaController@destroy');
	Route::get('poliza/{id}','PolizaController@show');
	// URL -> PAGO
	Route::patch('pago/edit/{id}','PagoController@update')->name('pago.update');
    Route::get('pago/edit/pago={id}','PagoController@edit');
	Route::delete('pago/{id}','PagoController@destroy');
	Route::get('pago/{id}','PagoController@show');
	// URL -> SINIESTRO
	Route::patch('siniestro/edit/{id}','SiniestroController@update')->name('siniestro.update');
    Route::get('siniestro/edit/siniestro={id}','SiniestroController@edit');
	Route::delete('siniestro/{id}','SiniestroController@destroy');
	Route::get('siniestro/{id}','SiniestroController@show');
	// URL -> COMPAÑIAS DE SEGURO
	Route::resource('comp/compseguro','CompaniaSeguroController');
	Route::resource('comp/categoria','CategoriaController');
	Route::resource('comp/cobertura','CoberturaController');
	// URL -> PRODUCTOR
	Route::get('productor','UsuarioController@index');
	Route::patch('productor/edit/{id}','UsuarioController@update')->name('productor.update');
	Route::get('productor/edit/productor={id}','UsuarioController@edit');
	Route::get('productor/create','UsuarioController@create');
	Route::post('productor','UsuarioController@store');
	Route::delete('productor/{id}','UsuarioController@destroy');
	Route::get('productor/{id}','UsuarioController@show');
});

