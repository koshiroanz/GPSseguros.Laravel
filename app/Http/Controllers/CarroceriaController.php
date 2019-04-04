<?php

namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Carroceria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\CarroceriaFormRequest;

class CarroceriaController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
		$query = trim($request->get('searchText'));
        
		$carrocerias = Carroceria::where('nombre', 'LIKE', '%'.$query.'%')
		->orderBy('created_at','desc')
		->paginate(5);

        return view('carroceria.index',["carrocerias" => $carrocerias, "searchText" => $query]);
    }

    public function create(){
    	return view('carroceria.create');
    }

    public function store(CarroceriaFormRequest $request){

    	try{   
            $carroceria = new Carroceria; 
            
            $carroceria->nombre = strtoupper($request->get('nombre'));
            $carroceria->save();

            return Redirect::to('carroceria/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('carroceria/create')->with('fail','Ha ocurrido un error al registrar la carrocería: '.$e);
        }
    }

    public function show($id){
        $carroceria = Carroceria::findOrFail($id);
        //$this->authorize('permiso_carroceria', $carroceria);

        return view("carroceria.show", ["carroceria" => Carroceria::findOrFail($id)]);
    }

    public function edit($id){
    	$carroceria = Carroceria::findOrFail($id);
        //$this->authorize('permiso_carroceria', $carroceria);

    	return view("carroceria.edit", ["carroceria" => $carroceria]);
    }

    public function update(CarroceriaFormRequest $request, $id){
    	try{
            $carroceria = Carroceria::findOrFail($id);
            //$this->authorize('permiso_carroceria', $carroceria);

            $carroceria->nombre = strtoupper($request->get('nombre'));

            $carroceria->update();

            return Redirect::to('carroceria')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('carroceria')->with('fail','Ha ocurrido un error al actualizar la carrocería: '.$e);
        }
    }

    public function destroy($idCarroceria){
        try{
            Carroceria::where('id', $idCarroceria)->delete();

            return Redirect::to('carroceria')->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('carroceria')->with('fail','Ha ocurrido un error al eliminar la carrocería: '.$e);    
        }        
    }
    
}