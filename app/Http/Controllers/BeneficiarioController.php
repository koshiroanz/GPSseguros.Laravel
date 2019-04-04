<?php
namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Beneficiario;
use gps\Localidad;
use gps\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\BeneficiarioFormRequest;

class BeneficiarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');  // Middleware para controlar la autenticación del usuario.
    }

    public function index(Request $request){
		$query = trim($request->get('searchText')); // TRIM = elimina espacio en blanco en el inicio y final de la cadena.

        if(Auth::user()->privilegio != 'BAJO'){
            $beneficiarios = Beneficiario::where('apellido', 'LIKE', '%'.$query.'%')
            ->orwhere('dni', 'LIKE', '%'.$query.'%')
            ->orderBy('created_at','desc')
            ->paginate(5);
        }else{
            $beneficiarios = Beneficiario::join('localidad as loc','beneficiario.localidad_id','=','loc.id')
            ->join('cliente as cl','beneficiario.cliente_id','=','cl.id')
            ->select('beneficiario.id','beneficiario.dni','beneficiario.apellido','beneficiario.nombre','beneficiario.direccion','beneficiario.telefono1','beneficiario.parentesco','loc.nombre as locNombre','cl.apellido as clApellido','cl.nombre as clNombre')
            ->where([
                    ['cl.users_id', '=', Auth::user()->id],
                    ['beneficiario.apellido', 'LIKE', '%'.$query.'%'],
                    ])
            ->orwhere([
                    ['cl.users_id', '=', Auth::user()->id],
                    ['beneficiario.dni', 'LIKE', '%'.$query.'%'],
                    ])
            ->orderBy('beneficiario.created_at','desc')
            ->paginate(5);
        }
        
        return view('beneficiario.index',["beneficiarios" => $beneficiarios, "searchText" => $query]);
    }

    public function create(){
        $clientes = $this->obtenerClientes();
        $localidades = $this->obtenerLocalidades();

    	return view('beneficiario.create', ["clientes" => $clientes, "localidades" => $localidades]);
    }

    public function store(BeneficiarioFormRequest $request){

        try{
            $beneficiario = new Beneficiario;

            $beneficiario->dni = $request->get('dni');
            $beneficiario->apellido = strtoupper($request->get('apellido'));
            $beneficiario->nombre = strtoupper($request->get('nombre'));
            $beneficiario->telefono1 = $request->get('telefono1');
            $beneficiario->telefono2 = $request->get('telefono2');
            $beneficiario->direccion = strtoupper($request->get('direccion'));
            $beneficiario->localidad_id = $request->get('localidad');
            $beneficiario->cliente_id = $request->get('cliente');
            $beneficiario->parentesco = strtoupper($request->get('parentesco'));
            $beneficiario->save();

            return Redirect::to('beneficiario/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('beneficiario/create')->with('fail','Ha ocurrido un error al registrar el Beneficiario: '.$e);
        }
    }

    public function show($id){
        $beneficiario = Beneficiario::findOrFail($id);

        return view('beneficiario.show', ["beneficiario" => Beneficiario::findOrFail($id)]);
    }

    public function edit($id){
    	$beneficiario = Beneficiario::findOrFail($id);

        $localidades = $this->obtenerLocalidadesDistinto($beneficiario->localidad_id);
        $clientes = $this->obtenerClientesDistinto($beneficiario->cliente_id);

        return view("beneficiario.edit", ["beneficiario" => $beneficiario, "localidades" => $localidades, "clientes" => $clientes]);
    }

    public function update(BeneficiarioFormRequest $request, $id){
    	try{
            $beneficiario = Beneficiario::findOrFail($id);

            $beneficiario->dni = $request->get('dni');
            $beneficiario->apellido = strtoupper($request->get('apellido'));
            $beneficiario->nombre = strtoupper($request->get('nombre'));
            $beneficiario->telefono1 = $request->get('telefono1');
            $beneficiario->telefono2 = $request->get('telefono2');
            $beneficiario->direccion = strtoupper($request->get('direccion'));
            $beneficiario->parentesco = strtoupper($request->get('parentesco'));
            $beneficiario->localidad_id = $request->get('localidad');
            $beneficiario->cliente_id = $request->get('cliente');
            $beneficiario->update();

            return Redirect::to('beneficiario')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('beneficiario')->with('fail','Ha ocurrido un error al actualizar el Beneficiario: '.$e);
        }
    }

    public function destroy($id){
        try{
            Beneficiario::where('id', $id)->delete();

            return Redirect::to('beneficiario')->with('success','Se ha eliminado exitosamente');
        }catch(Exception $e){
            return Redirect::to('beneficiario')->with('fail','Ha ocurrido un error al eliminar el Beneficiario: '.$e);
        }
    }

    public function obtenerClientes(){        
        if(Auth::user()->privilegio != 'BAJO'){
            $clientes = DB::table('cliente')
            ->select('id','apellido','nombre','dni')
            ->orderBy('apellido')
            ->get();
        }else{
            $clientes = DB::table('cliente')
            ->select('id','apellido','nombre','dni')
            ->where('users_id', Auth::user()->id)
            ->orderBy('apellido')
            ->get();
        }

        return $clientes;
    }

    public function obtenerLocalidades(){
        $localidades = DB::table('localidad')
        ->select('id', 'nombre')
        ->orderBy('nombre')
        ->get();

        return $localidades;
    }

    public function obtenerLocalidadesDistinto($idLocalidad){
        $localidades = DB::table('localidad')
        ->where('id','<>', $idLocalidad)
        ->orderBy('nombre')
        ->get();

        return $localidades;
    }

    public function obtenerClientesDistinto($idCliente){
        $clientes = DB::table('cliente')
        ->where('id','<>', $idCliente)
        ->orderBy('apellido')
        ->get();

        return $clientes;
    }

}