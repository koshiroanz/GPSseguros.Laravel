<?php

namespace gps\Http\Controllers;

use DB;
use gps\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\MarcaFormRequest;

class MarcaController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
		$query = trim($request->get('searchText'));

		$marcas = Marca::where('nombre', 'LIKE', '%'.$query.'%')
		->orderBy('created_at','desc')
		->paginate(5);

        return view('marca.index',["marcas" => $marcas, "searchText" => $query]);
    }

    public function create(){
    	return view('marca.create');
    }

    public function store(MarcaFormRequest $request){
        $marca = new Marca;
        try{            
            $marca->nombre = strtoupper($request->get('nombre'));
            $marca->save();

            return Redirect::to('marca/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('marca/create')->with('fail','Ha ocurrido un error al registrar la marca: '.$e);
        }
    }

    public function show($id){
        $marca = Marca::findOrFail($id);
        //$this->authorize('permiso_marca', $marca);

        return view("marca.show", ["marca" => Marca::findOrFail($id)]);
    }

    public function edit($id){
    	$marca = Marca::findOrFail($id);
        //$this->authorize('permiso_marca', $marca);

    	return view("marca.edit", ["marca" => $marca]);
    }

    public function update(Request $request, $id){
    	try{
            $marca = Marca::findOrFail($id);
            //$this->authorize('permiso_marca', $marca);

            $marca->nombre = strtoupper($request->get('nombre'));
            $marca->update();
            
            return Redirect::to('marca')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('marca')->with('fail','Ha ocurrido un error al actualizar la marca: '.$e);
        }
    }

    public function destroy($id){
    	try{
            Marca::where('id', $id)->delete();
            
            return Redirect::to('marca')->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('marca')->with('fail','Ha ocurrido un error al eliminar la marca: '.$e);
        }
    }
    
}