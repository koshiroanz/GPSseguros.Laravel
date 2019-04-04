<?php

namespace gps\Http\Controllers;

use DB;
use gps\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\CategoriaFormRequest;

class CategoriaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
		$query = trim($request->get('searchText'));
        
		$categorias = Categoria::where('nombre', 'LIKE', '%'.$query.'%')
		->orderBy('created_at','desc')
		->take(10)
        ->get();

        return view("comp.categoria.index", ["categorias" => $categorias, "searchText" => $query]);
    }

    public function create(){
        $clientes = $this->obtenerClientes();
        $localidades = $this->obtenerLocalidades();

    	return view("comp.categoria.create", ["clientes" => $clientes, "localidades" => $localidades]);
    }

    public function store(CategoriaFormRequest $request){
    	$categoria = new Categoria;
        try{
           	$categoria->nombre = strtoupper($request->get('nombre'));
            $categoria->save();

            return Redirect::to("comp/categoria/create")->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/categoria/create")->with('fail','Ha ocurrido un error al registrar la categoría: '.$e);
        }
    }

    public function show($id){
        $categoria = Categoria::findOrFail($id);
        //$this->authorize('permiso_categoria', $categoria);

        return view("comp.categoria.show", ["categoria" => Categoria::findOrFail($id)]);
    }

    public function edit($id){
    	$categoria = Categoria::findOrFail($id);
        //$this->authorize('permiso_categoria', $categoria);

        return view("comp.categoria.edit", ["categoria" => $categoria]);
    }

    public function update(CategoriaFormRequest $request, $id){
        try{
            $categoria = Categoria::findOrFail($id);
            //$this->authorize('permiso_categoria', $categoria);

            $categoria->nombre = strtoupper($request->get('nombre'));
            $categoria->update();

            return Redirect::to("comp/categoria")->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/categoria")->with('fail','Ha ocurrido un error al actualizar la categría: '.$e);
        }
    }

    public function destroy($idCategoria){
        try{
            Categoria::where('id', $idCategoria)->delete();

            return Redirect::to("comp/categoria")->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/categoria")->with('fail','Ha ocurrido un error al eliminar la categoría: '.$e);
        }
    }

    public function obtenerClientes(){
        $clientes = DB::table('cliente')
        ->select('id','apellido','nombre','dni')
        ->orderBy('apellido')
        ->get();

        return $clientes;
    }

    public function obtenerLocalidades(){
        $localidades = DB::table('localidad')
        ->select('id', 'nombre')
        ->orderBy('nombre')
        ->get();
        //var_dump($localidades[0]);

        return $localidades;
    }



}