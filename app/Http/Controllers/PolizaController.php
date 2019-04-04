<?php

namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Poliza;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\PolizaFormRequest;

class PolizaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
		$query = trim($request->get('searchText'));

        if(Auth::user()->privilegio != 'BAJO'){
            $polizas = DB::table('poliza as po')
            ->join('categoria as cat','po.categoria_id', '=', 'cat.id')
            ->join('vehiculo as ve', 'po.vehiculo_id', '=', 've.id')
            ->join('cobertura as co','po.cobertura_id','=','co.id')
            ->join('companiaseguro as comp','co.compSeguro_id','=','comp.id')
            ->join('cliente as cl', 've.cliente_id','=','cl.id')
            ->join('users as pro','cl.users_id','=','pro.id')
            ->select('po.id','po.numPoliza','po.estado','ve.dominio', 'pro.apellido as proApellido', 'pro.nombre as proNombre', 'po.vigenciaPoliza', 'po.vigenciaPolizaHasta')
            ->where('po.numPoliza', 'LIKE', '%'.$query.'%')
            ->orwhere('ve.dominio', 'LIKE', '%'.$query.'%')
            ->orderBy('po.numPoliza','asc')
            ->paginate(5);
        }else{
            $polizas = DB::table('poliza as po')
            ->join('categoria as cat','po.categoria_id', '=', 'cat.id')
            ->join('vehiculo as ve', 'po.vehiculo_id', '=', 've.id')
            ->join('cobertura as co','po.cobertura_id','=','co.id')
            ->join('companiaseguro as comp','co.compSeguro_id','=','comp.id')
            ->join('cliente as cl', 've.cliente_id','=','cl.id')
            ->join('users as pro','cl.users_id','=','pro.id')
            ->select('po.id','po.numPoliza', 'po.estado','ve.dominio', 'pro.apellido as proApellido', 'pro.nombre as proNombre', 'po.vigenciaPoliza', 'po.vigenciaPolizaHasta')
            ->where([
                    ['pro.id', '=', Auth::user()->id],
                    ['po.numPoliza', 'LIKE', '%'.$query.'%'],
                    ])
            ->orwhere([
                    ['pro.id', '=', Auth::user()->id],
                    ['ve.dominio', 'LIKE', '%'.$query.'%'],
                    ])
            ->orderBy('po.numPoliza','asc')
            ->paginate(5);
        }

        $polizas = $this->conversionFechaPolizas($polizas);

        return view('poliza.index',["polizas" => $polizas, "searchText" => $query]);
    }

    public function create(){
        $vehiculos = $this->obtenerVehiculos();
        $categorias = $this->obtenerCategorias();
        $companias = $this->obtenerCompanias();

    	return view("poliza.create", ["vehiculos" => $vehiculos, "categorias" => $categorias, "companias" => $companias]);
    }

    public function store(PolizaFormRequest $request){
    	
    	try{
            $poliza = new Poliza;
            
            $poliza->numPoliza = strtoupper($request->get('numPoliza'));
            $poliza->vigenciaPedida = Helper::formatoDateIda($request->get('vigenciaPedida'));
            $poliza->vigenciaPedidaHasta = Helper::formatoDateIda($request->get('vigenciaPedidaHasta'));
            $poliza->vigenciaPoliza = Helper::formatoDateIda($request->get('vigenciaPoliza'));
            $poliza->vigenciaPolizaHasta = Helper::formatoDateIda($request->get('vigenciaPolizaHasta'));
            $poliza->costoPoliza = $request->get('costoPoliza');
            $poliza->numPolizaVida = $request->get('numPolizaVida');
            $poliza->costoPolizaVida = $request->get('costoPolizaVida');
            $poliza->endoso = strtoupper($request->get('endoso'));
            $poliza->sumaAsegurada = $request->get('sumaAsegurada');
            $poliza->estado = $request->get('estado');
            $poliza->destino = $request->get('destino');
            $poliza->vehiculo_id = $request->get('vehiculo');
            $poliza->categoria_id = $request->get('categoria');
            $poliza->compSeguro_id = $request->get('comp_seguro');
            $poliza->cobertura_id = $request->get('cobertura');
            $poliza->observacion = strtoupper($request->get('observacion'));
            $poliza->save();

            return Redirect::to('poliza/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('poliza/create')->with('fail','Ha ocurrido un error al registrar la póliza: '.$e);
        }
    }

    public function show($id){
        $poliza = Poliza::findOrFail($id);
        //$this->authorize('permiso_poliza', $poliza);

        return view('poliza.show', ["poliza" => Poliza::findOrFail($id)]);
    }

    public function edit($id){
    	$poliza = Poliza::findOrFail($id);
        //$this->authorize('permiso_poliza', $poliza);

        $poliza->vigenciaPedida = Helper::formatoDateVuelta($poliza->vigenciaPedida);
        $poliza->vigenciaPedidaHasta = Helper::formatoDateVuelta($poliza->vigenciaPedidaHasta);
        $poliza->vigenciaPoliza = Helper::formatoDateVuelta($poliza->vigenciaPoliza);
        $poliza->vigenciaPolizaHasta = Helper::formatoDateVuelta($poliza->vigenciaPolizaHasta);
        $estados = Helper::obtenerPolizaEstados($poliza->estado);
        $destinos = Helper::obtenerPolizaDestinos($poliza->destino);
        $vehiculoCliente = $this->obtenerVehiculoPoliza($poliza->vehiculo_id); // Se obtiene una consulta con el ve.id, ve.dominio, cl.apellido, cl.nombre
        $vehiculosFiltrado = $this->obtenerVehiculosFiltrado($poliza->vehiculo_id); // Obtiene todos los vehículos menos el del cliente.
        $categoriasFiltrada = $this->obtenerCategoriasFiltrada($poliza->categoria_id); // Obtiene todas las categorías menos la del cliente.
        $companiasFiltrada = $this->obtenerCompaniasFiltrada($poliza->compSeguro_id);
        $coberturasFiltrada = $this->obtenerCoberturasFiltrada($poliza->cobertura_id, $poliza->compSeguro_id);
        return view("poliza.edit", [
            "poliza" => $poliza,
            "estados" => $estados,
            "destinos" => $destinos,
            "vehiculoCliente" => $vehiculoCliente,
            "vehiculosFiltrado" => $vehiculosFiltrado,
            "categoriasFiltrada" => $categoriasFiltrada,
            "companiasFiltrada" => $companiasFiltrada,
            "coberturasFiltrada" => $coberturasFiltrada
        ]);
    }

    public function update(PolizaFormRequest $request, $id){
    	try{
            $poliza = Poliza::findOrFail($id);
            //$this->authorize('permiso_poliza', $poliza);

            $poliza->numPoliza = strtoupper($request->get('numPoliza'));
            $poliza->vigenciaPedida = Helper::formatoDateIda($request->get('vigenciaPedida'));
            $poliza->vigenciaPedidaHasta = Helper::formatoDateIda($request->get('vigenciaPedidaHasta'));
            $poliza->vigenciaPoliza = Helper::formatoDateIda($request->get('vigenciaPoliza'));
            $poliza->vigenciaPolizaHasta = Helper::formatoDateIda($request->get('vigenciaPolizaHasta'));
            $poliza->costoPoliza = $request->get('costoPoliza');
            $poliza->numPolizaVida = $request->get('numPolizaVida');
            $poliza->costoPolizaVida = $request->get('costoPolizaVida');
            $poliza->endoso = strtoupper($request->get('endoso'));
            $poliza->sumaAsegurada = $request->get('sumaAsegurada');
            $poliza->estado = $request->get('estado');
            $poliza->destino = $request->get('destino');
            $poliza->vehiculo_id = $request->get('vehiculo');
            $poliza->categoria_id = $request->get('categoria');
            $poliza->compSeguro_id = $request->get('comp_seguro');
            $poliza->cobertura_id = $request->get('cobertura');
            $poliza->observacion = strtoupper($request->get('observacion'));
            $poliza->update();

            return Redirect::to('poliza')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('poliza')->with('fail','Ha ocurrido un error al actualizar la póliza: '.$e);
        }
    }

    public function destroy($id){
        try{
            Poliza::where('id', $id)->delete();

            return Redirect::to('poliza')->with('success', 'Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('poliza')->with('fail','Ha ocurrido un error al eliminar la póliza: '.$e);
        }
    }

    public function obtenerClientes(){
        $clientes = DB::table('cliente')
        ->select('id','apellido','nombre','dni')
        ->orderBy('apellido')
        ->get();

        return $clientes;
    }

    public function obtenerVehiculos(){
        if(Auth::user()->privilegio == 'BAJO'){
            $idProductor = Auth::user()->id;
            $vehiculos = DB::table('vehiculo as ve')
            ->join('cliente as cli','ve.cliente_id','=','cli.id')
            ->select('ve.id','ve.dominio','cli.apellido as cliApellido','cli.nombre as cliNombre')
            ->where('cli.users_id', Auth::user()->id)
            ->orderBy('ve.dominio')
            ->get();
        }else{
            $vehiculos = DB::table('vehiculo as ve')
            ->join('cliente as cli','ve.cliente_id','=','cli.id')
            ->select('ve.id','ve.dominio','cli.apellido as cliApellido','cli.nombre as cliNombre')
            ->orderBy('ve.dominio')
            ->get();
        }

        return $vehiculos;
    }

    public function obtenerVehiculoPoliza($idVehiculo){
        $vehiculo = DB::table('vehiculo as ve')
        ->select('ve.id as veId','ve.dominio as veDominio','cl.apellido','cl.nombre')
        ->join('cliente as cl', 've.cliente_id','=','cl.id')
        ->where('ve.id','=', $idVehiculo)
        ->first();

        return $vehiculo;
    }

    public function obtenerVehiculosFiltrado($idVehiculoCliente){   // Todos los vehículos menos el del cliente..
        $vehiculosFiltrado = DB::table('vehiculo as ve')
        ->join('cliente as cl', 've.cliente_id','=','cl.id')
        ->select('ve.id','ve.dominio','cl.apellido','cl.nombre')
        ->where('ve.id','<>', $idVehiculoCliente)
        ->orderBy('ve.dominio')
        ->get();

        return $vehiculosFiltrado;
    }

    public function obtenerCategoriasFiltrada($idCategoria){
        $categoriasFiltrada = DB::table('categoria')
        ->select('id','nombre')
        ->where('id','<>', $idCategoria)
        ->orderBy('nombre')
        ->get();

        return $categoriasFiltrada;
    }

    public function obtenerCompaniasFiltrada($idCompaniaSeguro){
        $companiaFiltrada = DB::table('companiaseguro')
        ->select('id','nombre')
        ->where('id','<>', $idCompaniaSeguro)
        ->get();

        return $companiaFiltrada;
    }

    public function obtenerCoberturasFiltrada($idCobertura, $idCompSeguro){
        $coberturaFiltrada = DB::table('cobertura as co')
        ->join('companiaseguro as cs','co.compSeguro_id','=','cs.id')
        ->select('co.id','co.nombre')
        ->where('co.id','!=', $idCobertura)
        ->where('cs.id','=', $idCompSeguro)
        ->get();

        return $coberturaFiltrada;
    }

    public function obtenerCategorias(){
        $categorias = DB::table('categoria')
        ->select('id','nombre')
        ->orderBy('nombre', 'ASC')
        ->get();

        return $categorias;
    }

    public function obtenerCompanias(){
        $companias = DB::table('companiaseguro')
        ->select('id','nombre')
        ->orderBy('nombre', 'ASC')
        ->get();

        return $companias;
    }

    public function getVehiculo(Request $request){       // $request = idVehiculo
        $data = DB::table('vehiculo as ve')
        ->join('cliente as cli','ve.cliente_id','=','cli.id')
        ->select('ve.id','ve.dominio','cli.apellido','cli.nombre')
        ->where('ve.dominio', 'LIKE', '%'.$request->value.'%')
        ->orwhere('cli.apellido', 'LIKE', '%'.$request->value.'%')
        ->get();

        return response()->json($data);
    }

    public function getVehiculos(){       // $request = idVehiculo
        $data = DB::table('vehiculo as ve')
        ->join('cliente as cli','ve.cliente_id','=','cli.id')
        ->select('ve.id','ve.dominio','cli.apellido','cli.nombre')
        ->orderBy('ve.dominio','ASC')
        ->get();
        
        return response()->json($data);
    }

    public function getCoberturas(Request $request){       // $request = idCompSeguro
        $idCompseguro = $request->value;
        $data = DB::table('cobertura as co')
        ->select('co.id','co.nombre')
        ->join('companiaseguro as cs', function ($join) use ($request){
            $join->on('cs.id', '=', 'co.compSeguro_id')
            ->where('co.compSeguro_id', '=', $request->id);
        })
        ->get();

        return response()->json($data);
    }

    public function conversionFechaPolizas($polizas){
        for($i = 0; $i < count($polizas); $i++){
            $polizas[$i]->vigenciaPoliza = Helper::formatoDateVuelta($polizas[$i]->vigenciaPoliza);
            $polizas[$i]->vigenciaPolizaHasta = Helper::formatoDateVuelta($polizas[$i]->vigenciaPolizaHasta);
        }

        return $polizas;
    }

}