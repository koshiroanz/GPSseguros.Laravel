<?php

namespace gps\Http\Controllers;

use DB;
use gps\Cobertura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\CoberturaFormRequest;

class CoberturaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
		$query = trim($request->get('searchText'));
        
		$coberturas = Cobertura::where('nombre', 'LIKE', '%'.$query.'%')
		->orderBy('created_at','desc')
		->paginate(5);

        return view("comp.cobertura.index", ["coberturas" => $coberturas, "searchText" => $query]);
    }

    public function create(){
        $companias = $this->obtenerCompanias();

    	return view("comp.cobertura.create", ["companias" => $companias]);
    }

    public function store(CoberturaFormRequest $request){
    	$cobertura = new Cobertura;
    	try{
            $cobertura->nombre = strtoupper($request->get('nombre'));
            $cobertura->compSeguro_id = $request->get('companiaSeguro');
            $cobertura->save();

            return Redirect::to("comp/cobertura/create")->with('success', 'Se ha creado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/cobertura/create")->with('fail','Ha ocurrido un error al registrar la cobertura: '.$e);
        }
    }

    public function show($id){
        $cobertura = Cobertura::findOrFail($id);

        return view("comp.cobertura.show", ["cobertura" => Cobertura::findOrFail($id)]);
    }

    public function edit($id){
    	$cobertura = Cobertura::findOrFail($id);

        $companiasseguro = $this->obtenerCompaniasDistintas($cobertura->compSeguro_id);

        return view("comp.cobertura.edit", ["cobertura" => $cobertura, "companiasseguro" => $companiasseguro]);
    }

    public function update(CoberturaFormRequest $request, $id){
        try{    
            $cobertura = Cobertura::findOrFail($id);
            //$this->authorize('permiso_cobertura', $cobertura);

            $cobertura->nombre = strtoupper($request->get('nombre'));
            $cobertura->update();

            return Redirect::to("comp/cobertura")->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/cobertura")->with('fail','Ha ocurrido un error al actualizar la cobertura: '.$e);
        }
    }

    public function destroy($idCobertura){
        try{
            Cobertura::where('id',$idCobertura)->delete();

            return Redirect::to("comp/cobertura")->with('success', 'Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/cobertura")->with('fail','Ha ocurrido un error al eliminar la cobertura: '.$e);
        }
    }

    public function obtenerCompanias(){
        $companias = DB::table('companiaseguro')
        ->select('id', 'nombre')
        ->orderBy('nombre')
        ->get();

        return $companias;
    }

    public function obtenerCompaniasDistintas($idCompSeguro){
        $companias = DB::table('companiaseguro')
        ->select('id', 'nombre')
        ->where('id','!=', $idCompSeguro)
        ->orderBy('nombre')
        ->get();

        return $companias;
    }



}