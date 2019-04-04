<?php

namespace gps\Http\Controllers;

use DB;
use gps\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\ModeloFormRequest;

class ModeloController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
		$query = trim($request->get('searchText'));

		$modelos = Modelo::where('nombre', 'LIKE', '%'.$query.'%')
		->orderBy('created_at','desc')
		->paginate(5);

        return view("modelo.index",["modelos" => $modelos, "searchText" => $query]);
    }

    public function create(){
        $marcas = $this->obtenerMarcas();

    	return view("modelo.create", ["marcas" => $marcas]);
    }

    public function store(ModeloFormRequest $request){
        try{    
            $modelo = new Modelo;
            $modelo->nombre = strtoupper($request->get('nombre'));
            $modelo->marca_id = $request->get('marca');
            $modelo->save();

            return Redirect::to('modelo/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('modelo/create')->with('fail','Ha ocurrido un error al registrar el modelo: '.$e);
        }
    }

    public function show($id){
        $modelo = Modelo::findOrFail($id);

        return view("modelo.show", ["modelo" => Modelo::findOrFail($id)]);
    }

    public function edit($id){
    	$modelo = Modelo::findOrFail($id);

    	return view("modelo.edit", ["modelo" => $modelo]);
    }

    public function update(ModeloFormRequest $request, $id){
    	try{
            $modelo = Modelo::findOrFail($id);

            $modelo->nombre = strtoupper($request->get('nombre'));
            $modelo->update();

            return Redirect::to("modelo")->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('modelo')->with('fail','Ha ocurrido un error al actualizar el modelo: '.$e);
        }
    }

    public function destroy($id){
    	try{
            Modelo::where('id', $id)->delete();

            return Redirect::to('modelo')->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('modelo')->with('fail','Ha ocurrido un error al eliminar el modelo: '.$e);
        }
    }

    public function obtenerMarcas(){
        $marcas = DB::table('marca')
        ->select('id','nombre')
        ->orderBy('nombre')
        ->get();

        return $marcas;
    }

    public function obtenerMarcasDistintas($idMarca){

    }
    
}