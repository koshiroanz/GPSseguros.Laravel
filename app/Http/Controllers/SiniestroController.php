<?php
namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Cliente;
use gps\Poliza;
use gps\Siniestro;
use gps\ImagenSiniestroCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\SiniestroFormRequest;

class SiniestroController extends Controller
{
    const IMG_PATH = 'storage/siniestros/siniestro';
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query = trim($request->get('searchText'));

            if(Auth::user()->privilegio != 'BAJO'){
                $siniestros = DB::table('siniestro as si')
                ->join('imagen_siniestro_cliente as imgsin', 'imgsin.siniestro_id','=','si.id')
                ->join('poliza as po','si.poliza_id','=','po.id')
                ->join('vehiculo as ve','po.vehiculo_id','=','ve.id')
                ->join('cliente as cl','ve.cliente_id','=','cl.id')
                ->select('si.id','si.fechaSiniestro','po.numPoliza','ve.dominio','cl.id as cliId','cl.apellido','cl.nombre', DB::raw('count(si.id) as cant'))
                ->where('po.numPoliza', 'LIKE', '%'.$query.'%')
                ->orwhere('ve.dominio', 'LIKE', '%'.$query.'%')
                ->orwhere('cl.apellido', 'LIKE', '%'.$query.'%')
                ->orderBy('si.fechaSiniestro','desc')
                ->groupBy('si.id','si.fechaSiniestro','po.numPoliza','ve.dominio','cl.id','cl.apellido','cl.nombre')
                ->paginate(10);
            }else{
                $siniestros = DB::table('siniestro as si')
                ->join('poliza as po','si.poliza_id','=','po.id')
                ->join('vehiculo as ve','po.vehiculo_id','=','ve.id')
                ->join('cliente as cl','ve.cliente_id','=','cl.id')
                ->select('si.id','si.fechaSiniestro','po.numPoliza','ve.dominio','cl.apellido','cl.nombre')
                ->where([
                        ['cl.users_id', '=', Auth::user()->id],
                        ['po.numPoliza', 'LIKE', '%'.$query.'%'],
                        ])
                ->orwhere([
                        ['cl.users_id', '=', Auth::user()->id],
                        ['ve.dominio', 'LIKE', '%'.$query.'%'],
                        ])
                ->orwhere([
                        ['cl.users_id', '=', Auth::user()->id],
                        ['cl.apellido', 'LIKE', '%'.$query.'%'],
                        ])
                ->orderBy('si.fechaSiniestro','desc')
                ->paginate(10);
            }

            $siniestros = $this->conversionFechaSiniestros($siniestros);

            return view('siniestro.index', ["siniestros" => $siniestros,"searchText" => $query]);
    	}
    }

    public function create(){
        $clientes = $this->obtenerClientesActivos();

    	return view('siniestro.create', ["clientes" => $clientes]);
    }

    public function store(SiniestroFormRequest $request){
    	try{
            DB::BeginTransaction();
            $siniestro = new Siniestro;
            // DATOS CLIENTE
            $siniestro->poliza_id = $request->get('poliza');
            $siniestro->cliente_id = $request->get('cliente');
            $siniestro->vehiculo_id = $request->get('vehiculo'); 
            $siniestro->conductor = strtoupper($request->get('conductor')); 
            $siniestro->fechaSiniestro = parent::formatoDateIda($request->get('fechaSiniestro')); 
            $siniestro->fechaDenunciaInterna = parent::formatoDateIda($request->get('fechaDenunciaInterna')); 
            $siniestro->exposicionPolicial = $request->get('exposicionPolicial');
            $siniestro->fotocopiaDni = $request->get('fotocopiaDni');
            $siniestro->fotocopiaCV = $request->get('fotocopiaCV');
            $siniestro->fotocopiaCC = $request->get('fotocopiaCC');
            $siniestro->fotocopiaVTV = $request->get('fotocopiaVTV');
            $siniestro->otros = $request->get('otros');
            // DATOS TERCERO
            $siniestro->terceroUno = $request->get('terceroUno'); 
            $siniestro->dominioUno = $request->get('dominioUno'); 
            $siniestro->conductorUno = $request->get('conductorUno'); 
            $siniestro->terceroDos = $request->get('terceroDos');
            $siniestro->dominioDos = $request->get('dominioDos');
            $siniestro->conductorDos = $request->get('conductorDos');
            $siniestro->fechaReclamoTercero = parent::formatoDateIda($request->get('fechaReclamoTercero'));
            $siniestro->exposicionPolicialTercero = $request->get('exposicionPolicialTercero');
            $siniestro->fotocopiaCVTercero = $request->get('fotocopiaCVTercero');
            $siniestro->fotocopiaCCTercero = $request->get('fotocopiaCCTercero');
            $siniestro->boletaCompra = $request->get('boletaCompra');
            $siniestro->certificadoCobertura = $request->get('certificadoCobertura');
            $siniestro->denunciaAdministrativa = $request->get('denunciaAdministrativa');
            $siniestro->presupuesto = $request->get('presupuesto');
            $siniestro->presupuestoDos = $request->get('presupuestoDos');
            $siniestro->totalPresupuesto = $request->get('totalPresupuesto');
            $siniestro->gastosMedicos = $request->get('gastosMedicos');
            $siniestro->informeMedico = $request->get('informeMedico');
            // DATOS COMPAÑIA
            $siniestro->fechaEnvioDI = parent::formatoDateIda($request->get('fechaEnvioDI'));
            $siniestro->fechaEnvioRT = parent::formatoDateIda($request->get('fechaEnvioRT'));
            $siniestro->fechaDictamen = parent::formatoDateIda($request->get('fechaDictamen'));
            $siniestro->dictamen = $request->get('dictamen');
            $siniestro->ofrecimiento = $request->get('ofrecimiento');
            $siniestro->vencimientoReclamo = parent::formatoDateIda($request->get('vencimientoReclamo'));

            $siniestro->save();

            if(($request->hasFile('fotosAsegurado'))||($request->hasFile('fotosTercero'))){
                $dir = self::createSiniestroFolder($siniestro->id);    // $dir = 'public/siniestros/cliente-#id'

                if($request->hasFile('fotosAsegurado')){
                    $dirFotosAsegurado = $dir.'/fotosAsegurado';
                    if(!file_exists($dirFotosAsegurado)){
                        mkdir($dirFotosAsegurado, 0777, true);
                        chmod($dirFotosAsegurado, 0777);
                    }
                    self::createImagenSiniestroCliente($dirFotosAsegurado, $request->file('fotosAsegurado'), $siniestro->id, 1);
                }

                if($request->hasFile('fotosTercero')){
                    $dirFotosTercero = $dir.'/fotosTercero';
                    if(!file_exists($dirFotosTercero)){
                        mkdir($dirFotosTercero, 0777, true);
                        chmod($dirFotosTercero, 0777);
                    }
                    self::createImagenSiniestroCliente($dirFotosTercero, $request->file('fotosTercero'), $siniestro->id, 0);  // Llama al método pasando por párametro: directorio(donde se guardará las fotos), fotos(debería ser un array) y id del siniestro registrado anteriormente.
                }
            }

            DB::commit();            

            return Redirect::to('siniestro/create')->with('success','Se ha registrado exitosamente.');
        }catch(Exception $e){
            DB::rollback();
            return Redirect::to('siniestro/create')->with('fail','Ha ocurrido un error al registrar el siniestro: '.$e);
        }
    }

    public function createSiniestroFolder($idSiniestro){
        $pathMainSiniestroDirectory = 'public/siniestros';  // Asignar a una Constante el PATH del directorio de imagenes..
        $dir = $pathMainSiniestroDirectory.'/'.'siniestro'.$idSiniestro;
        if(!file_exists($dir)){    // Si no existe el directorio "/public/siniestros/cliente-"+id => Crea un directorio con el id del cliente donde se guardarán todos sus fotos.
            mkdir($dir, 0777, true);
            chmod($dir, 0777);
        }

        return $dir;
    }

    public function createImagenSiniestroCliente($directorio, $fotosSiniestro, $idSiniestro, $banderaAsegurado){
        foreach($fotosSiniestro as $foto){
            $fotoSiniestro = new ImagenSiniestroCliente;
            // Obtiene el nombre del archivo con extensión 'miimagen.jpg'
            $filenameWithExt = $foto->getClientOriginalName();
            // Obtiene el nombre del archivo. pathinfo: Devuelve la info acerca de la ruta del fichero
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Obtiene solo la ext.
            $extension = $foto->getClientOriginalExtension();
            // Nombre para almacenar con timestamp.
            $filenameToStore = $filename.'.'.$extension;
            // Almacenar archivo
            $foto->storeAs($directorio, $filenameToStore);

            $fotoSiniestro->filename = $filenameToStore;
            $fotoSiniestro->asegurado = $banderaAsegurado;
            $fotoSiniestro->siniestro_id = $idSiniestro;
            $fotoSiniestro->save();
        }
    }

    public function show($id){
        $siniestro = Siniestro::findOrFail($id);
        $imagenesSiniestro = ImagenSiniestroCliente::where('siniestro_id', $id)->get();
        dd($imagenesSiniestro);

        //return view('siniestro.show', ["siniestro" => $siniestro, "imagenesSiniestro" => $imagenesSiniestro]);
    }

    public function edit($id){
    	$siniestro = Siniestro::findOrFail($id);
        $imagenesSiniestroCliente = ImagenSiniestroCliente::where('siniestro_id', $id)->get();
        //$polizas = $this->obtenerPolizasDistinto($siniestro->poliza_id);
        $siniestro->fechaSiniestro = parent::formatoDateVuelta($siniestro->fechaSiniestro);
        $siniestro->fechaDenunciaInterna = parent::formatoDateVuelta($siniestro->fechaDenunciaInterna);
        $siniestro->fechaReclamoTercero = parent::formatoDateVuelta($siniestro->fechaReclamoTercero);
        $siniestro->fechaEnvioDI = parent::formatoDateVuelta($siniestro->fechaEnvioDI);
        $siniestro->fechaEnvioRT = parent::formatoDateVuelta($siniestro->fechaEnvioRT);
        $siniestro->fechaDictamen = parent::formatoDateVuelta($siniestro->fechaDictamen);
        $siniestro->vencimientoReclamo = parent::formatoDateVuelta($siniestro->vencimientoReclamo);

        $exposicionPolicial = $this->obtenerOpciones($siniestro->exposicionPolicial);
        $fotocopiaDni = $this->obtenerOpciones($siniestro->fotocopiaDni);
        $fotocopiaCV = $this->obtenerOpciones($siniestro->fotocopiaCV);
        $fotocopiaCC = $this->obtenerOpciones($siniestro->fotocopiaCC);
        $fotocopiaVTV = $this->obtenerOpciones($siniestro->fotocopiaVTV);
        $otros = $this->obtenerOpciones($siniestro->otros);

        $exposicionPolicialTercero = $this->obtenerOpciones($siniestro->exposicionPolicialTercero);
        $fotocopiaCVTercero = $this->obtenerOpciones($siniestro->fotocopiaCVTercero);
        $fotocopiaCCTercero = $this->obtenerOpciones($siniestro->fotocopiaCCTercero);
        $boletaCompra = $this->obtenerOpciones($siniestro->boletaCompra);
        $certificadoCobertura = $this->obtenerOpciones($siniestro->certificadoCobertura);
        $denunciaAdministrativa = $this->obtenerOpciones($siniestro->denunciaAdministrativa);
        $informeMedico = $this->obtenerOpciones($siniestro->informeMedico);
        $ruta = self::IMG_PATH.$siniestro->id;     // ruta = 'storage/siniestros/siniestro#id';

        return view("siniestro.edit", [
            "siniestro"                 => $siniestro,
            "exposicionPolicial"        => $exposicionPolicial,
            "fotocopiaDni"              => $fotocopiaDni,
            "fotocopiaCV"               => $fotocopiaCV,
            "fotocopiaCC"               => $fotocopiaCC,
            "fotocopiaVTV"              => $fotocopiaVTV,
            "otros"                     => $otros,
            "exposicionPolicialTercero" => $exposicionPolicialTercero,
            "fotocopiaCVTercero"        => $fotocopiaCVTercero,
            "fotocopiaCCTercero"        => $fotocopiaCCTercero,
            "boletaCompra"              => $boletaCompra,
            "certificadoCobertura"      => $certificadoCobertura,
            "denunciaAdministrativa"    => $denunciaAdministrativa,
            "informeMedico"             => $informeMedico,
            "imagenesSiniestroCliente"  => $imagenesSiniestroCliente,
            "ruta"                     => $ruta,
         ]);
    }

    public function update(SiniestroFormRequest $request, $id){
    	try{
            $siniestro = Siniestro::findOrFail($id);
            //$this->authorize('permiso_siniestro', $siniestro);
            $siniestro->poliza_id = $request->get('poliza');
            $siniestro->cliente_id = $request->get('cliente');
            $siniestro->vehiculo_id = $request->get('vehiculo');
            $siniestro->conductor = strtoupper($request->get('conductor'));
            $siniestro->fechaSiniestro = parent::formatoDateIda($request->get('fechaSiniestro'));
            $siniestro->fechaDenunciaInterna = parent::formatoDateIda($request->get('fechaDenunciaInterna'));
            $siniestro->exposicionPolicial = $request->get('exposicionPolicial');
            $siniestro->fotocopiaDni = $request->get('fotocopiaDni');
            $siniestro->fotocopiaCV = $request->get('fotocopiaCV');
            $siniestro->fotocopiaCC = $request->get('fotocopiaCC');
            $siniestro->fotocopiaVTV = $request->get('fotocopiaVTV');
            $siniestro->fotosAsegurado = $request->get('fotosAsegurado');
            $siniestro->otros = $request->get('otros');
            // DATOS TERCERO
            $siniestro->terceroUno = strtoupper($request->get('terceroUno'));
            $siniestro->dominioUno = strtoupper($request->get('dominioUno'));
            $siniestro->conductorUno = strtoupper($request->get('conductorUno'));
            $siniestro->terceroDos = strtoupper($request->get('terceroDos'));
            $siniestro->dominioDos = strtoupper($request->get('dominioDos'));
            $siniestro->conductorDos = strtoupper($request->get('conductorDos'));
            $siniestro->fechaReclamoTercero = parent::formatoDateIda($request->get('fechaReclamoTercero'));
            $siniestro->exposicionPolicialTercero = $request->get('exposicionPolicialTercero');
            $siniestro->fotocopiaCVTercero = $request->get('fotocopiaCVTercero');
            $siniestro->fotocopiaCCTercero = $request->get('fotocopiaCCTercero');
            $siniestro->boletaCompra = $request->get('boletaCompra');
            $siniestro->certificadoCobertura = $request->get('certificadoCobertura');
            $siniestro->denunciaAdministrativa = $request->get('denunciaAdministrativa');
            $siniestro->fotoCantTercero = $request->get('fotoCantTercero');
            $siniestro->presupuesto = $request->get('presupuesto');
            $siniestro->presupuestoDos = $request->get('presupuestoDos');
            $siniestro->totalPresupuesto = $request->get('totalPresupuesto');
            $siniestro->gastosMedicos = $request->get('gastosMedicos');
            $siniestro->informeMedico = $request->get('informeMedico');
            // DATOS COMPAÑIA
            $siniestro->fechaEnvioDI = parent::formatoDateIda($request->get('fechaEnvioDI'));
            $siniestro->fechaEnvioRT = parent::formatoDateIda($request->get('fechaEnvioRT'));
            $siniestro->fechaDictamen = parent::formatoDateIda($request->get('fechaDictamen'));
            $siniestro->dictamen = strtoupper($request->get('dictamen'));
            $siniestro->ofrecimiento = $request->get('ofrecimiento');
            $siniestro->vencimientoReclamo = parent::formatoDateIda($request->get('vencimientoReclamo'));
            $siniestro->update();

            return Redirect::to('siniestro')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('siniestro')->with('fail','Ha ocurrido un error al actualizar el siniestro: '.$e);
        }
    }

    public function destroy($id){
    	try{
            $pathImagenesSiniestroCliente = 'storage/siniestros/siniestro'.$id.'/fotosAsegurado';
            $pathImagenesSiniestroTercero = 'storage/siniestros/siniestro'.$id.'/fotosTercero';
            
            ImagenSiniestroCliente::where('siniestro_id', $id)->get()->each->delete();
            Siniestro::where('id', $id)->delete();

            if(file_exists($pathImagenesSiniestroCliente)){
                $ficheros = scandir($pathImagenesSiniestroCliente);
                $cant = count($ficheros);
                if($cant > 2){
                    for($i = 2; $i < $cant; $i++){
                        unlink($pathImagenesSiniestroCliente.'/'.$ficheros[$i]);
                    }

                    rmdir($pathImagenesSiniestroCliente);                    
                }
            }

            if(file_exists($pathImagenesSiniestroTercero)){
                $ficheros = scandir($pathImagenesSiniestroTercero);
                $cant = count($ficheros);
                if($cant > 2){
                    for($i = 2; $i < $cant; $i++){
                        unlink($pathImagenesSiniestroTercero.'/'.$ficheros[$i]);
                    }

                    rmdir($pathImagenesSiniestroTercero);
                }
            } 

            rmdir('storage/siniestros/siniestro'.$id);
            
            return Redirect::to('siniestro')->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('siniestro')->with('fail','Ha ocurrido un error al eliminar el siniestro: '.$e);
        }
    }

    public function conversionFechaSiniestros($siniestros){
        for($i = 0; $i < count($siniestros); $i++){
            $siniestros[$i]->fechaSiniestro = parent::formatoDateVuelta($siniestros[$i]->fechaSiniestro);
        }

        return $siniestros;
    }

    public function obtenerOpciones($var){
        if($var == 1){
            $var = '<option value="1" selected>SI</option><option value="0">NO</option>';
        }else{
            $var = '<option value="0" selected>NO</option><option value="1">SI</option>';
        }

        return $var;
    }

    public function obtenerClientesActivos(){
        if(Auth::user()->privilegio != 'BAJO'){
            /* 
            Obtener clientes activos: De Póliza (ACTIVA) con vigenciaPolizaHasta >= fechaActual y última
            cuota pagada controlando la fechaPago <= fechaActual.
            */
            $clientes = DB::table('poliza as po')->join('vehiculo as ve','po.vehiculo_id','=','ve.id')->join('cliente as cl','ve.cliente_id','=','cl.id')
            ->distinct()
            ->select('cl.id','cl.apellido','cl.nombre','cl.dni')
            ->where('cl.estado','ACTIVO')
            ->get();

            //$clientes = Poliza::all();
        }else{
            $clientes = DB::table('cliente')
            ->select('id','apellido','nombre','dni')
            ->where([
                ['estado','=','ACTIVO'],
                ['users_id', '=', Auth::user()->id],
            ])
            ->get();
        }

    	return $clientes;
    }

    public function getClienteVehiculo(Request $request){
        $respuesta = DB::table('vehiculo as ve')
        ->join('cliente as cl','ve.cliente_id','=','cl.id')
        ->join('poliza as po', 'po.vehiculo_id','=','ve.id')
        ->select('ve.id','ve.dominio')
        ->where('cl.id', $request->cliente)
        ->where('po.estado', 'ACTIVO')
        ->get();

        return response()->json($respuesta);
    }

    public function getVehiculoPoliza(Request $request){
        $respuesta = DB::table('poliza')
        ->select('id','numPoliza')
        ->where([
            ['estado', '=', 'ACTIVO'],
            ['vehiculo_id', '=', $request->vehiculo]
        ])
        ->get();

        return response()->json($respuesta);
    }

    public function getImagenesSiniestro(Request $request){
        $respuesta = ImagenSiniestro::where('siniestro_id', $request->idSiniestro)->get();

        return response()->json($respuesta);
    }

    public function getRouteImagenSiniestro(){
        return self::IMG_PATH;
    }

}
