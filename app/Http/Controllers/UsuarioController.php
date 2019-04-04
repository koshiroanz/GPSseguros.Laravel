<?php

namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\User;
use gps\Localidad;
use gps\Http\Middleware\CheckPrivilegio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\UsuarioFormRequest;
use gps\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $idUser = Auth()->user()->id;
        $deshabilitar = 'disabled';
        
        $query = trim($request->get('searchText'));

        $productores = User::where('apellido', 'LIKE', '%'.$query.'%')
        ->orwhere('dni', 'LIKE', '%'.$query.'%')
        ->orderBy('created_at','desc')
        ->paginate(5);
        
        return view('productor.index', ["productores" => $productores, "searchText" => $query, "idUser" => $idUser]);
    }

    public function create(){
        $localidades = Localidad::all();

    	return view("productor.create", ["localidades" => $localidades]);
    }

    public function store(UsuarioFormRequest $request){
        try{
            $user = new User;

            $user->dni = $request->get('dni');
            $user->apellido = strtoupper($request->get('apellido'));
            $user->nombre = strtoupper($request->get('nombre'));
            $user->direccion = strtoupper($request->get('direccion'));
            $user->telefono1 = $request->get('telefono1');
            $user->telefono2 = $request->get('telefono2');
            $user->privilegio = $request->get('privilegio');
            $user->estado = $request->get('estado');
            $user->localidad_id = $request->get('localidad');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->save();

            return Redirect::to('productor/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('productor/create')->with('fail','Ha ocurrido un error al registrar el productor: '.$e);
        }
    }

    public function show($id){
        return view('productor.show', ["usuario" => User::findOrFail($id)]);
    }

    public function edit($id){
    	$productor = User::findOrFail($id);
        $selectPrivilegio = $this->obtenerSelectPrivilegio($productor->privilegio);
        $selectEstado = $this->obtenerSelectEstado($productor->estado);
        $localidades = $this->obtenerLocalidades($productor->localidad_id);

        return view("productor.edit", ["productor" => $productor, "localidades" => $localidades, "selectPrivilegio" => $selectPrivilegio, "selectEstado" => $selectEstado]);
    }

    public function update(Request $request, $id){
    	try{
            $productor = User::findOrFail($id);
            
            $productor->dni = $request->get('dni');
            $productor->apellido = strtoupper($request->get('apellido'));
            $productor->nombre = strtoupper($request->get('nombre'));
            $productor->direccion = strtoupper($request->get('direccion'));
            $productor->telefono1 = $request->get('telefono1');
            $productor->telefono2 = $request->get('telefono2');
            $productor->privilegio = $request->get('privilegio');
            $productor->estado = $request->get('estado');
            $productor->localidad_id = $request->get('localidad');
            $productor->email = $request->get('email');
            $productor->password = Hash::make($request->get('password'));
            $productor->update();

            return Redirect::to('productor')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('productor')->with('fail','Ha ocurrido un error al actualizar el productor: '.$e);
        }
    }

    public function destroy($id){
    	try{
            if(Auth()->user()->id == $id){
                return Redirect::to('productor')->with('fail','No es posible realizar esta acción. Contactese con su administrador');
            }
            // Hacer un método para migrar todos sus usuarios al super administrador.
            User::where('id', $id)->delete();

            return Redirect::to('productor')->with('Success','Se ha eliminado exitosamente.');
        }catch(QueryException $e){
            return Redirect::to('productor')->with('fail','Ha ocurrido un error al eliminar el productor: '.$e);
        }
    }

    public function obtenerLocalidades($localidad_id){
    	$localidades = DB::table('localidad')
    	->where('id', '!=', $localidad_id)
    	->orderBy('nombre','asc')
    	->get();

    	return $localidades;
    }

    public function obtenerSelectEstado($estado){
        if($estado == 'ACTIVO'){
            $selectEstado = '<option value="'.$estado.'">ACTIVO</option><option value="INACTIVO">INACTIVO</option>';
        }else{
            $selectEstado = '<option value="'.$estado.'">INACTIVO</option><option value="ACTIVO">ACTIVO</option>';
        }

        return $selectEstado;
    }

    public function obtenerSelectPrivilegio($privilegio){
        if($privilegio == 'ALTO'){
            $selectPrivilegio = '<option value="'.$privilegio.'">ALTO</option><option value="MEDIO">MEDIO</option><option value="BAJO">BAJO</option>';
        }else if($privilegio == 'MEDIO'){
            $selectPrivilegio = '<option value="'.$privilegio.'">MEDIO</option><option value="ALTO">ALTO</option><option value="BAJO">BAJO</option>';
        }else{
            $selectPrivilegio = '<option value="'.$privilegio.'">BAJO</option><option value="ALTO">ALTO</option><option value="MEDIO">MEDIO</option>';
        }

        return $selectPrivilegio;
    }

    public function getEm(Request $request){    // $request = email
        $data = DB::table('users')
        ->where('email','=', $request->dato)
        ->select(DB::RAW('COUNT(*) as count'))
        ->get();

        return response()->json($data);
    }
}
