<?php

namespace gps\Http\Controllers;

use DB;
use gps\CompaniaSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use gps\Http\Requests\CompaniaSeguroFormRequest;

class CompaniaSeguroController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
		$query = trim($request->get('searchText'));

		$companias = CompaniaSeguro::where('nombre', 'LIKE', '%'.$query.'%')
		->orderBy('created_at','desc')
		->paginate(5);

        return view("comp.compseguro.index", ["companias" => $companias, "searchText" => $query]);
    }

    public function create(){
        $localidades = $this->obtenerLocalidades();

    	return view("comp.compseguro.create", ["localidades" => $localidades]);
    }

    public function store(CompaniaSeguroFormRequest $request){
    	$compSeguro = new CompaniaSeguro;
    	
        /*
            CHEQUEAR ESTO
            <input name="userfile" type="file">

            $nombre_archivo =  $_FILES['userfile']['name'];
            $tipo_archivo = $_FILES['userfile']['type'];
            $tamano_archivo = $_FILES['userfile']['size'];

            if (($tipo_archivo != 'image/jpeg' && $tipo_archivo != 'image/gif' && $tipo_archivo != 'image/png') && ($tamano_archivo < 100000)){
                echo "La extensi&oacute;n o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg</li><li>se permiten archivos de 100 Kb m&aacute;ximo.</li></td></tr></table>";
            }else{
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $nombre_archivo)){
                   echo "El archivo ha sido cargado correctamente.";
                }else{
                   echo "Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.";
                }
            }

        */

        try{
            // Comprobación para capturar imagen
            if($request->hasFile('logo_img')){
                // Obtiene el nombre del archivo con extensión 'miimagen.jpg'
                $filenameWithExt = $request->file('logo_img')->getClientOriginalName();
                // Obtiene el nombre del archivo. pathinfo: Devuelve la info acerca de la ruta del fichero
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Obtiene solo la ext.
                $extension = $request->file('logo_img')->getClientOriginalExtension();
                // Nombre para almacenar con timestamp.
                $filenameToStore = $filename.'.'.$extension;
                // Almacenar archivo
                $path = $request->file('logo_img')->storeAs('public/aseguradora_img', $filenameToStore);
            }else{
                $filenameToStore = 'noimage.jpg';
            }

            $compSeguro->nombre = strtoupper($request->get('nombre'));
            $compSeguro->etiqueta = $request->get('etiqueta');
            $compSeguro->direccion = $request->get('direccion');
            $compSeguro->telefono1 = $request->get('telefono1');
            $compSeguro->telefono2 = $request->get('telefono2');
            $compSeguro->fax = $request->get('fax');
            $compSeguro->email = mb_strtolower($request->get('email'));
            $compSeguro->paginaweb = mb_strtolower($request->get('paginaweb'));
            $compSeguro->logo_img = $filenameToStore;
            $compSeguro->localidad_id = $request->get('localidad');
            //$this->authorize('permiso_companiaseguro', $compSeguro);

            $compSeguro->save();

            return Redirect::to("comp/compseguro/create")->with('success', 'Se ha creado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/compseguro/create")->with('fail','Ha ocurrido un error al registrar la compañia de seguro: '.$e);
        }
    }

    public function show($id){
        $compSeguro = CompaniaSeguro::findOrFail($id);
        //$this->authorize('permiso_companiaseguro', $compSeguro);

        return view("comp.compseguro.show", ["compSeguro" => CompaniaSeguro::findOrFail($id)]);
    }

    public function edit($id){
    	$compSeguro = CompaniaSeguro::findOrFail($id);
        $localidades = $this->obtenerLocalidadesDistintas($compSeguro->localidad_id);
        //$this->authorize('permiso_companiaseguro', $compSeguro);

    	return view("comp.compseguro.edit", ["compSeguro" => $compSeguro, "localidades" => $localidades]);
    }

    public function update(CompaniaSeguroFormRequest $request, $id){
    	try{
            $compSeguro = CompaniaSeguro::findOrFail($id);
            //$this->authorize('permiso_companiaseguro', $compSeguro);
            if($request->hasFile('logo_img')){
                if($compSeguro->logo_img != 'noimage.jpg'){
                    $logoToDelete = $compSeguro->logo_img;
                    Storage::delete('public/aseguradora_img/'.$logoToDelete);
                }
                // Obtiene el nombre del archivo con extensión 'miimagen.jpg'
                $filenameWithExt = $request->file('logo_img')->getClientOriginalName();
                // Obtiene el nombre del archivo. pathinfo: Devuelve la info acerca de la ruta del fichero
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Obtiene solo la ext.
                $extension = $request->file('logo_img')->getClientOriginalExtension();
                // Nombre para almacenar con timestamp.
                $filenameToStore = $filename.'.'.$extension;
                // Almacenar archivo
                $path = $request->file('logo_img')->storeAs('public/aseguradora_img', $filenameToStore);

                $compSeguro->logo_img = $filenameToStore;
            }

            $compSeguro->nombre = strtoupper($request->get('nombre'));
            $compSeguro->etiqueta = $request->get('etiqueta');
            $compSeguro->direccion = $request->get('direccion');
            $compSeguro->telefono1 = $request->get('telefono1');
            $compSeguro->telefono2 = $request->get('telefono2');
            $compSeguro->fax = $request->get('fax');
            $compSeguro->email = mb_strtolower($request->get('email'));
            $compSeguro->paginaweb = mb_strtolower($request->get('paginaweb'));
            $compSeguro->localidad_id = $request->get('localidad');

            $compSeguro->update();
            

            return Redirect::to("comp/compseguro")->with('success', 'Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/compseguro")->with('fail','Ha ocurrido un error al actualizar la compañia de seguro: '.$e);
        }
    }

    public function destroy($id){
        try{
            $compSeguro = CompaniaSeguro::findOrFail($id);
            if($compSeguro->logo_img != 'noimage.jpg'){
                Storage::delete('public/aseguradora_img/'.$compSeguro->logo_img);
            }
            CompaniaSeguro::where('id', $id)->delete();

            return Redirect::to("comp/compseguro")->with('success', 'Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("comp/compseguro")->with('fail','Ha ocurrido un error al eliminar la compañia de seguro: '.$e);
        }
    }

    public function eliminarImagen(){
        
    }

    public function obtenerLocalidades(){
        $localidades = DB::table('localidad')
        ->orderby('nombre')
        ->get();

        return $localidades;
    }

    public function obtenerLocalidadesDistintas($idLocalidad){
        $localidades = DB::table('localidad')
        ->where('id','!=', $idLocalidad)
        ->orderby('nombre')
        ->get();

        return $localidades;
    }
    
}