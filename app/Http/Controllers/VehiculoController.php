<?php

namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Vehiculo;
use gps\Cliente;
use gps\Modelo;
use gps\Carroceria;
use gps\ModeloCarroceria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\VehiculoFormRequest;

class VehiculoController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
        $query = trim($request->get('searchText'));

        if(Auth::user()->privilegio != 'BAJO'){
            $vehiculos = DB::table('vehiculo as ve')
            ->join('cliente as cl','ve.cliente_id','=','cl.id')
            ->join('marca as ma','ve.marca_id','=','ma.id')
            ->join('modelo as mo','ve.modelo_id','=','mo.id')
            ->join('carroceria as ca','ve.carroceria_id','=','ca.id')
            ->select('ve.id','ve.dominio','ma.nombre as maNombre','mo.nombre as moNombre','cl.apellido as clApellido','cl.nombre as clNombre','ca.nombre as caNombre')
            ->where('ve.dominio', 'LIKE', '%'.$query.'%')
            ->orwhere('cl.apellido', 'LIKE', '%'.$query.'%')
            ->orderBy('ve.dominio','asc')
            ->paginate(10);
        }else{
            /*$vehiculos = DB::table('vehiculo as ve')
            ->join('cliente as cl','ve.cliente_id','=','cl.id')
            ->join('marca as ma','ve.marca_id','=','ma.id')
            ->join('modelo as mo','ve.modelo_id','=','mo.id')
            ->join('carroceria as ca','ve.carroceria_id','=','ca.id')
            ->select('ve.id','ve.dominio','ma.nombre as maNombre','mo.nombre as moNombre','cl.apellido as clApellido','cl.nombre as clNombre','ca.nombre as caNombre')
            ->where([
                    ['cl.users_id', '=', Auth::user()->id],
                    ['ve.dominio', 'LIKE', '%'.$query.'%'],
                    ])
            ->orwhere([
                    ['cl.users_id', '=', Auth::user()->id],
                    ['cl.apellido', 'LIKE', '%'.$query.'%'],
                    ])
            ->orderBy('ve.dominio','asc')
            ->paginate(10);*/

            $vehiculos = Vehiculo::join('cliente as cl','vehiculo.cliente_id','=','cl.id')
            ->join('marca as ma','vehiculo.marca_id','=','ma.id')
            ->join('modelo as mo','vehiculo.modelo_id','=','mo.id')
            ->join('carroceria as ca','vehiculo.carroceria_id','=','ca.id')
            ->where([
                    ['cl.users_id', '=', Auth::user()->id],
                    ['vehiculo.dominio', 'LIKE', '%'.$query.'%'],
                    ])
            ->orwhere([
                    ['cl.users_id', '=', Auth::user()->id],
                    ['cl.apellido', 'LIKE', '%'.$query.'%'],
                    ])
            ->orderBy('vehiculo.created_at','desc')
            ->paginate(5);
        }

        return view('vehiculo.index',["vehiculos" => $vehiculos, "searchText" => $query]);
    }

    public function create(){
        $marcas = $this->obtenerMarcas();
        $carrocerias = Carroceria::All();
        $clientes = $this->obtenerClientes();

    	return view("vehiculo.create", ["marcas" => $marcas, "carrocerias" => $carrocerias, "clientes" => $clientes]);
    }

    public function store(VehiculoFormRequest $request){
        try{
            $vehiculo = new Vehiculo;

            $vehiculo->dominio = strtoupper($request->get('dominio'));
            $vehiculo->anio = $request->get('anio');
            $vehiculo->chasis = strtoupper($request->get('chasis'));
            $vehiculo->motor = strtoupper($request->get('motor'));
            $vehiculo->color = strtoupper($request->get('color'));
            $vehiculo->valor = $request->get('valor');
            $vehiculo->combustible = strtoupper($request->get('combustible'));
            $vehiculo->carroceria_id = $request->get('carroceria');
            $vehiculo->modelo_id = $request->get('modelo');
            $vehiculo->marca_id = $request->get('marca');
            $vehiculo->cliente_id = $request->get('cliente');
            $vehiculo->save();

            return Redirect::to('vehiculo/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('vehiculo/create')->with('fail','Ha ocurrido un error al registrar el vehículo: '.$e);
        }
    }

    public function show($id){
        $vehiculo = Vehiculo::findOrFail($id);
        //$this->authorize('permiso_vehiculo', $vehiculo);

        return view("vehiculo.show", ["vehiculo" => Vehiculo::findOrFail($id)]);
    }

    public function edit($id){
    	$vehiculo = Vehiculo::findOrFail($id);
        //$this->authorize('permiso_vehiculo', $vehiculo);

        $clientes = $this->obtenerClientesDistintos($vehiculo->cliente_id);
        $marcas = $this->obtenerMarcasDistintas($vehiculo->marca_id);

    	return view("vehiculo.edit", ["vehiculo" => $vehiculo, "clientes" => $clientes, "marcas" => $marcas]);
    }

    public function update(VehiculoFormRequest $request, $id){
    	try{
            $vehiculo = Vehiculo::findOrFail($id);
            //$this->authorize('permiso_vehiculo', $vehiculo);

            $vehiculo->dominio = strtoupper($request->get('dominio'));
            $vehiculo->anio = $request->get('anio');
            $vehiculo->chasis = strtoupper($request->get('chasis'));
            $vehiculo->motor = strtoupper($request->get('motor'));
            $vehiculo->color = strtoupper($request->get('color'));
            $vehiculo->valor = $request->get('valor');
            $vehiculo->combustible = strtoupper($request->get('combustible'));
            $vehiculo->carroceria_id = $request->get('carroceria');
            $vehiculo->modelo_id = $request->get('modelo');
            $vehiculo->marca_id = $request->get('marca');
            $vehiculo->cliente_id = $request->get('cliente');
            $vehiculo->update();

            return Redirect::to('vehiculo')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('vehiculo')->with('fail','Ha ocurrido un error al actualizar el vehículo: '.$e);
        }
    }

    public function destroy($id){
        try{
            Vehiculo::where('id', $id)->delete();

            return Redirect::to('vehiculo')->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('vehiculo')->with('fail','Ha ocurrido un error al eliminar el vehículo: '.$e);
        }
    }

    public function obtenerMarcas(){
        $marcas = DB::table('marca')
        ->select('id','nombre')
        ->orderBy('nombre')
        ->get();

        return $marcas;
    }

    public function obtenerClientes(){
        if(Auth::user()->privilegio == 'BAJO'){
            $clientes = DB::table('cliente')
            ->select('id','apellido','nombre','dni')
            ->where('users_id', Auth::user()->id)
            ->orderBy('apellido')
            ->get();
        }else{
            $clientes = DB::table('cliente')
            ->select('id','apellido','nombre','dni')
            ->orderBy('apellido')
            ->get();
        }

        return $clientes;
    }

    public function getModelo(Request $request){        // $request = $idMarca
        $data = Modelo::select('id','nombre')
        ->where('marca_id', $request->value)
        ->get();

        return response()->json($data);
    }

    public function getCarroceria(Request $request){        // $request = $idModelo
        $idModelo = $request->value;
        
        $data = DB::table('carroceria')
        ->select('carroceria.id','carroceria.nombre')
        ->join('modelo_carroceria', function ($join) use ($idModelo){
            $join->on('carroceria.id', '=', 'modelo_carroceria.carroceria_id')
            ->where('modelo_carroceria.modelo_id', $idModelo);
        })
        ->get();
        
        return response()->json($data);
    }

    public function getCliente(Request $request){       // $request = idCliente
        $data = DB::table('cliente')
        ->select('id','apellido','nombre','dni')
        ->where('apellido', 'LIKE', '%'.$request->value.'%')
        ->orwhere('dni', 'LIKE', '%'.$request->value.'%')
        ->get();

        return response()->json($data);
    }

    public function getClientes(){       // $request = idCliente
        $data = DB::table('cliente')
        ->select('id','apellido','nombre','dni')
        ->get();
        
        return response()->json($data);
    }

    public function obtenerClientesDistintos($idCliente){
        $clientes = DB::table('cliente')
        ->select('id','dni','apellido','nombre')
        ->where('id', '!=', $idCliente)
        ->get();

        return $clientes;
    }

    public function obtenerMarcasDistintas($idMarca){
        $marcas = DB::table('marca')
        ->select('id','nombre')
        ->where('id', '!=', $idMarca)
        ->get();

        return $marcas;
    }
    
}