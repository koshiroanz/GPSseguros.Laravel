<?php

namespace gps\Http\Controllers;

use Auth;
use DB;
use gps\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\LocalidadFormRequest;

class LocalidadController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $query = trim($request->get('searchText'));

        $localidades = Localidad::where('nombre', 'LIKE', '%'.$query.'%')
        ->orderBy('created_at','desc')
        ->paginate(5);

        return view('localidad.index',["localidades" => $localidades, "searchText" => $query]);
    }

    public function create(){
    	return view('localidad.create');
    }

    public function store(LocalidadFormRequest $request){
        
        try{
            $localidad = new Localidad;
            $localidad->nombre = strtoupper($request->get('nombre'));
            $localidad->save();

            return Redirect::to('localidad/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('localidad/create')->with('fail','Ha ocurrido un error al registrar la localidad: '.$e);
        }
    }

    public function show($id){
        $localidad = Localidad::findOrFail($id);
        //$this->authorize('permiso_localidad', $localidad);

        return view("localidad.show", ["localidad" => $localidad]);
    }

    public function edit($id){
    	$localidad = Localidad::findOrFail($id);
        //$this->authorize('permiso_localidad', $localidad);

    	return view("localidad.edit", ["localidad" => $localidad]);
    }

    public function update(LocalidadFormRequest $request, $id){
    	try{
            $localidad = Localidad::findOrFail($id);
            //$this->authorize('permiso_localidad', $localidad);
            $localidad->nombre = strtoupper($request->get('nombre'));
            $localidad->update();

            return Redirect::to('localidad')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('localidad')->with('fail','Ha ocurrido un error al actualizar la localidad: '.$e);
        }
    }

    public function destroy($id){
        try{
            Localidad::where('id', $id)->delete();
            
            return Redirect::to('localidad')->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('localidad')->with('fail','Ha ocurrido un error al eliminar la localidad: '.$e);
        }
    }
}
