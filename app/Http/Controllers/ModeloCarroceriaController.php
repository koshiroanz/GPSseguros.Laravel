<?php

namespace gps\Http\Controllers;

use DB;
use gps\ModeloCarroceria;
use gps\Carroceria;
use gps\Modelo;
use gps\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\ModeloCarroceriaFormRequest;

class ModeloCarroceriaController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
		$query = trim($request->get('searchText'));

		$modeloscarrocerias = ModeloCarroceria::join('modelo as mo', 'modelo_carroceria.modelo_id', '=', 'mo.id')
        ->join('marca as ma', 'mo.marca_id', '=', 'ma.id')
        ->join('carroceria as ca', 'ca.id', '=', 'modelo_carroceria.carroceria_id')
		->select('modelo_carroceria.id as mcId','ma.nombre as maNombre','modelo_carroceria.modelo_id as mcIdModelo','mo.nombre as moNombre','modelo_carroceria.carroceria_id as mcIdCarroceria','ca.nombre as caNombre')
		->where('mo.nombre', 'LIKE', '%'.$query.'%')
        ->orwhere('ca.nombre', 'LIKE', '%'.$query.'%')
		->orderBy('modelo_carroceria.created_at','desc')
		->paginate(5);

        return view("modelo_carroceria.index",["modeloscarrocerias" => $modeloscarrocerias, "searchText" => $query]);
    }

    public function create(){
        $marcas = Marca::all();
        $carrocerias = Carroceria::All();

    	return view("modelo_carroceria.create", ["marcas" => $marcas, "carrocerias" => $carrocerias]);
    }

    public function store(ModeloCarroceriaFormRequest $request){
    	$modelo = new ModeloCarroceria;
        try{
            $modelo->modelo_id = $request->get('modelo');
            $modelo->carroceria_id = $request->get('carroceria');
            $modelo->save();

            return Redirect::to('modelo_carroceria/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('modelo_carroceria/create')->with('fail','Ha ocurrido un error al registrar el modelo carrocería: '.$e);
        }
    }

    public function show($id){
        $modelo_carroceria = ModeloCarroceria::findOrFail($id);
        //$this->authorize('permiso_modelocarroceria', $modelo_carroceria);

        return view("modelo_carroceria.show", ["modelo" => ModeloCarroceria::findOrFail($id)]);
    }

    public function edit($id){  // $id = idModeloCarroceria => idModelo(fk) y idCarroceria(fk)
    	$modelo_carroceria = ModeloCarroceria::findOrFail($id);
        //$this->authorize('permiso_modelocarroceria', $modelo_carroceria);

        $marca = DB::table('modelo as mo')
        ->join('marca as ma','mo.marca_id','=','ma.id')
        ->where('mo.id','=',$modelo_carroceria->modelo_id)
        ->select('ma.id as maId','ma.nombre as maNombre')
        ->first();

        $modelos = $this->obtenerModelosDistintos($modelo_carroceria->modelo_id, $modelo_carroceria->modelo->marca_id);
        $carrocerias = $this->obtenerCarroceriasDistintas($modelo_carroceria->carroceria_id);

        return view("modelo_carroceria.edit", ["modelo_carroceria" => $modelo_carroceria, "marca" => $marca, "modelos" => $modelos,
        "carrocerias" => $carrocerias]);
    }

    public function update(ModeloCarroceriaFormRequest $request, $id){
    	try{
            $modelo_carroceria = ModeloCarroceria::findOrFail($id);
            //$this->authorize('permiso_modelocarroceria', $modelo_carroceria);

            $modelo_carroceria->modelo_id = $request->get('modelo');
            $modelo_carroceria->carroceria_id = $request->get('carroceria');
            $modelo_carroceria->update();

            return Redirect::to("modelo_carroceria")->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('modelo_carroceria')->with('fail','Ha ocurrido un error al actualizar el modelo carrocería: '.$e);
        }
    }

    public function destroy($idModeloCarroceria){
    	try{
            ModeloCarroceria::where('id', $idModeloCarroceria)->delete();

            return Redirect::to('modelo_carroceria')->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('modelo_carroceria')->with('fail','Ha ocurrido un error al eliminar el modelo carrocería: '.$e);
        }
    }

    public function getModeloCarroceria(Request $request){        // $request = $idMarca
        $data = DB::table('modelo')
        ->select('id','nombre')
        ->where('marca_id', $request->id)
        ->get();

        return response()->json($data);
    }

    public function obtenerModelosDistintos($idModelo, $idMarca){
        $modelos = DB::table('modelo')
        ->where('id','!=', $idModelo)
        ->where('marca_id','=', $idMarca)
        ->select('id','nombre')
        ->get();

        return $modelos;
    }

    public function obtenerCarroceriasDistintas($idCarroceria){
        $carrocerias = DB::table('carroceria')
        ->where('id','!=', $idCarroceria)
        ->select('id','nombre')
        ->get();

        return $carrocerias;
    }

    public function obtenerModelos($idMarca, $idModelo){
       $modelos = DB::table('modelo')->where([
            ['marca_id', '=', $idMarca],
            ['id', '<>', $idModelo],
        ])->get();

        /*$modelos = DB::table('modelo')
        ->select('id','nombre')
        ->where(function ($query) use ($idMarca, $idModelo) {
        $query->where('idMarca_fk', $idMarca)
        ->where('id', '<>', $idModelo);
        })
        ->get();*/

       /*$modelos = DB::table('modelo')
       ->where('idMarca_fk', '=', $idMarca)
       ->where('id', '<>', $idModelo)
       ->get();*/
        return $modelos;
    }
    
}