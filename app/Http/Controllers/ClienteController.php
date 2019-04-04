<?php
namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Cliente;
use gps\Localidad;
use gps\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\ClienteFormRequest;

class ClienteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $query = trim($request->get('buscarCliente'));

        if(Auth::user()->privilegio != 'BAJO'){
            $clientes = Cliente::where('apellido', 'LIKE', '%'.$query.'%')
            ->orwhere('dni', 'LIKE', '%'.$query.'%')
            ->orderBy('created_at','desc')
            ->paginate(5);           
        }else{
            $clientes = Cliente::where([
                    ['users_id', '=', Auth::user()->id],
                    ['apellido', 'LIKE', '%'.$query.'%'],
                    ])
            ->orwhere([
                    ['users_id', '=', Auth::user()->id],
                    ['dni', 'LIKE', '%'.$query.'%'],
                    ])
            ->orderBy('created_at','desc')
            ->paginate(5);
        }

        return view('cliente.index', ["clientes" => $clientes, "buscarCliente" => $query]);
    }

    public function create(){
        $localidades = $this->obtenerLocalidades();
        if((Auth::user()->privilegio === 'ALTO')||(Auth::user()->privilegio === 'MEDIO')){
            $productores = $this->obtenerProductores();
        }else{
            $productores = $this->obtenerProductorCliente(Auth::user()->id);
        }
        
    	return view("cliente.create", ["localidades" => $localidades, "productores" => $productores]);
    }

    public function store(ClienteFormRequest $request){

        try{
            $cliente = new Cliente;

            $cliente->dni = $request->get('dni');
            $cliente->apellido = strtoupper($request->get('apellido'));
            $cliente->nombre = strtoupper($request->get('nombre'));
            $cliente->fechaNacimiento = Helper::formatoDateIda($request->get('fechaNacimiento')); // INGRESA "DD/MM/AAAA"
            $cliente->direccion = strtoupper($request->get('direccion'));
            $cliente->telefono1 = $request->get('telefono1');
            $cliente->telefono2 = $request->get('telefono2');
            $cliente->cuit = $request->get('cuit');
            $cliente->estadoCivil = $request->get('estadoCivil');
            $cliente->fechaBaja = Helper::formatoDateIda($request->get('fechaBaja'));
            $cliente->estado = $request->get('estado');
            $cliente->localidad_id = $request->get('localidad');
            $cliente->users_id = $request->get('productor');
            $cliente->save();
            
            return Redirect::to('cliente/create')->with('success', 'Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('cliente/create')->with('fail','Ha ocurrido un error al registrar el Cliente: '.$e);
        }
    }

    public function show($id){
        $cliente = Cliente::findOrFail($id);
        //$this->authorize('permiso_cliente', $cliente);
        
        return view("cliente.show", ["cliente" => Cliente::findOrFail($id)]);
    }

    public function edit($id){
    	$cliente = Cliente::find($id);
        //$this->authorize('permiso_cliente', $cliente)
        $fechaNac = Helper::formatoDateVuelta($cliente->fechaNacimiento);
        $fechaBaja = Helper::formatoDateVuelta($cliente->fechaBaja);
        $localidades = $this->obtenerLocalidadesDistintas($cliente->localidad_id);
    	$estadosCivil = Helper::obtenerEstadosCivil($cliente->estadoCivil);
        $estados = Helper::obtenerClienteEstados($cliente->estado);
        $productores = $this->obtenerProductoresDistintos($cliente->users_id);

        return view("cliente.edit", ["cliente" => $cliente, "fechaNac" => $fechaNac, 'fechaBaja' => $fechaBaja, "localidades" => $localidades, "estadosCivil" => $estadosCivil, "estados" => $estados, "productores" => $productores]);
    }

    public function info($id){
        $cliente = Cliente::find($id);
        //$this->authorize('permiso_cliente', $cliente);

        $fechaNac = Helper::formatoDateVuelta($cliente->fechaNacimiento);
        $localidades = $this->obtenerLocalidadesDistintas($cliente->localidad_id);
        $estadosCivil = Helper::obtenerEstadosCivil($cliente->estadoCivil);
        $estados = Helper::obtenerEstados($cliente->estado);
        $productores = $this->obtenerProductoresDistintos($cliente->users_id);

        return view("cliente.edit", ["cliente" => $cliente, "fechaNac" => $fechaNac, "localidades" => $localidades, "estadosCivil" => $estadosCivil, "estados" => $estados, "productores" => $productores]);
    }

    public function update(Request $request, $id){
        try{
            $cliente = Cliente::findOrFail($id);
            
            $cliente->dni = $request->get('dni');
            $cliente->apellido = strtoupper($request->get('apellido'));
            $cliente->nombre = strtoupper($request->get('nombre'));
            $cliente->fechaNacimiento = Helper::formatoDateIda($request->get('fechaNacimiento'));
            $cliente->direccion = strtoupper($request->get('direccion'));
            $cliente->cuit = $request->get('cuit');
            $cliente->telefono1 = $request->get('telefono1');
            $cliente->telefono2 = $request->get('telefono2');
            $cliente->fechaBaja = Helper::formatoDateIda($request->get('fechaBaja'));
            $cliente->estadoCivil = strtoupper($request->get('estadoCivil'));
            $cliente->estado = $request->get('estado');
            $cliente->users_id = $request->get('productor');
            $cliente->localidad_id = $request->get('localidad');

            $cliente->update();
            return Redirect::to('cliente')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('cliente')->with('fail','Ha ocurrido un error al actualizar el Cliente: '.$e);
        }
    }

    public function destroy($idCliente){
        try{
            $cliente = Cliente::findOrFail($idCliente);
            $cliente->estado = 'INACTIVO';
            $cliente->update();

            return Redirect::to('cliente')->with('success','El cliente ha pasado a ser inactivo.');
        }catch(Exception $e){
            return Redirect::to('cliente')->with('fail','Ha ocurrido un error al eliminar el Cliente: '.$e);
        }
    }

    public function obtenerLocalidadCliente($idLocalidad){
        $localidad = DB::table('localidad')
        ->select('id','nombre')
        ->where('id','=', $idLocalidad)
        ->first();

        return $localidad;
    }

    public function obtenerLocalidadesDistintas($idLocalidad){
        $localidades = DB::table('localidad')
        ->select('id','nombre')
        ->where('id','<>', $idLocalidad)
        ->orderBy('nombre')
        ->get();

        return $localidades;
    }

    public function obtenerLocalidades(){
        $localidades = Localidad::all();

        return $localidades;
    }

    public function obtenerProductorCliente($idProductor){
        $productor = DB::table('users')
        ->select('id','apellido','nombre','dni')
        ->where('id','=', $idProductor)
        ->get();

        return $productor;
    }

    public function obtenerProductoresDistintos($idProductor){
        $productores = DB::table('users')
        ->where('id','<>', $idProductor)
        ->select('id','apellido','nombre','dni')
        ->orderBy('apellido')
        ->get();

        return $productores;
    }

    public function obtenerProductores(){
        /*$productores = DB::table('users')
        ->select('id','apellido','nombre','dni')
        ->orderBy('apellido')
        ->get();*/

        $productores = User::all();

        return $productores;
    }

    public function getProductor(){
        $productores = Productor::where('id', Auth::user()->id)->first();

        return response()->json($productores);
    }

    public function obtenerClientesProductor($idProductor){
        $clientesProductor = DB::table('cliente as c')
        ->join('localidad as lo','c.localidad_id','lo.id')
        ->select('c.id','c.apellido','c.nombre','c.dni','c.direccion','c.telefono')
        ->where('c.productor_id','=', Auth::user()->id)
        ->orderBy('c.apellido')
        ->get();

        return $clientesProductor;
    }

}