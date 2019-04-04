<?php

namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Cliente;
use gps\Vehiculo;
use gps\Poliza;
use gps\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request){
            $query = trim($request->get('searchText'));
            if(Auth::user()->privilegio != 'BAJO'){
                //$vehiculosClientes = Vehiculo::all();
                $clientesInicio = DB::table('cliente as cl')
                ->join('vehiculo as ve', 've.cliente_id', '=', 'cl.id')
                ->join('marca as ma', 've.marca_id', '=', 'ma.id')
                ->join('modelo as mo', 've.modelo_id', '=', 'mo.id')
                ->select('cl.id as clId','cl.apellido as clApellido','cl.nombre as clNombre', 'cl.dni as clDni', 've.id as veId', 've.dominio', 'ma.nombre as maNombre', 'mo.nombre as moNombre')
                ->where('cl.apellido', 'LIKE', '%'.$query.'%')
                ->orwhere('ve.dominio', 'LIKE', '%'.$query.'%')
                ->orderBy('cl.apellido','asc')
                ->paginate(10);
            }else{
                //$user_id = Auth::user()->id; 
                $clientesInicio = DB::table('cliente as cl')
                ->join('vehiculo as ve', 've.cliente_id', '=', 'cl.id')
                ->join('marca as ma', 've.marca_id', '=', 'ma.id')
                ->join('modelo as mo', 've.modelo_id', '=', 'mo.id')
                ->select('cl.id as clId','cl.apellido as clApellido','cl.nombre as clNombre', 'cl.dni as clDni', 've.id as veId', 've.dominio', 'ma.nombre as maNombre', 'mo.nombre as moNombre')
                ->where([
                        ['cl.users_id', '=', Auth::user()->id],
                        ['cl.apellido', 'LIKE', '%'.$query.'%'],
                        ])
                ->orwhere([
                        ['cl.users_id', '=', Auth::user()->id],
                        ['ve.dominio', 'LIKE', '%'.$query.'%'],
                        ])
                ->orderBy('cl.apellido','asc')
                ->paginate(10);
            }
            
            return view('inicio.index', ["clientesInicio" => $clientesInicio, "searchText" => $query]);
        }
    }

    public function info($vehiculo_id){
        $vehiculosCliente = Vehiculo::where('id', $vehiculo_id)->first();

        return view("inicio.info", ["vehiculosCliente" => $vehiculosCliente]);
    }

    public function show($idCliente){
        return view('inicio.show', ["cliente" => Cliente::findOrFail($idCliente)]);
    }

    public function error404(){
        return view('errores.error404');
    }

    public function obtenerCliente($idCliente){
        $localidades = DB::table('localidad')
        ->select('id','nombre')
        ->where('id','<>', $idLocalidad)
        ->orderBy('nombre')
        ->get();

        return $localidades;
    }

    public function getPolizaInfo(Request $request){
        $data = DB::table('poliza')
        ->where('vehiculo_id', $request->idVehiculo)
        /*->where('estado','ACTIVO')*/
        ->select('id','numPoliza')
        ->get();

        return response()->json($data);
    }

    public function getPolizaEstado(Request $request){
        $data = DB::table('poliza')
        ->where('id', $request->idPoliza)
        ->select('estado','vigenciaPoliza','vigenciaPolizaHasta')
        ->first();

        $resultado = [
            'estado'              => $data->estado,
            'vigenciaPoliza'      => Helper::formatoDateVuelta($data->vigenciaPoliza),
            'vigenciaPolizaHasta' => Helper::formatoDateVuelta($data->vigenciaPolizaHasta)
        ];

        return response()->json($resultado);
    }

    public function getPagoInfo(Request $request){
        $data = DB::table('poliza as po')
        ->join('pago_cuota_poliza as cp','cp.poliza_id','=','po.id')
        ->join('pago as pa','cp.pago_id','=','pa.id')
        ->where('cp.poliza_id', $request->idPoliza)
        ->select('pa.numRecibo','pa.fecha','po.numPoliza','cp.numCuota','cp.importe')
        ->get();

        for($i = 0; $i < count($data); $i++){
            $data[$i]->fecha = Helper::formatoDateVuelta($data[$i]->fecha);
        }

        return response()->json($data);
    }

    // RESPUESTA JSON "AUTOMATICA" DE NOTIFICACIONES.. Arreglar y utilizar o eliminar?
    /*public function getNotificaciones(Request $request){
        set_time_limit(0); //Establece el número de segundos que se permite la ejecución de un script.
        $fecha_ac = isset($request->timestamp) ? $request->timestamp:0;
                    /*
                        if(isset($_POST['timestamp'])){
                            $fecha_ac = $_POST['timestamp'];
                        }else{
                            $fecha_ac = 0;
                        }
                    */

        //$fecha_bd = $datos_query->created_at;

        /*while($fecha_bd <= $fecha_ac){
            $data = DB::table('poliza')
            ->where('numPoliza','E/E')
            ->count('numPoliza as count')
            ->select('created_at')
            ->get();

            usleep(100000);//anteriormente 10000
            clearstatcache();
            $fecha_bd  = $data->created_at;
        }
        $data = DB::table('poliza')
        ->where('numPoliza','=','E/E')
        ->select(DB::raw('COUNT(*) as count'))
        ->get();

        return response()->json($data);
    }*/
    

    public function getNotificaciones(Request $request){
        $privilegio = Auth::user()->privilegio;
        if($privilegio != 'BAJO'){
            $data = DB::table('poliza')
            ->where('numPoliza','=','E/E')
            ->select(DB::raw('COUNT(*) as count'))
            ->get();
        }else{
            $idProductor = Auth::user()->id;
            $data = DB::table('poliza as po')
            ->join('vehiculo as ve','po.vehiculo_id','=','ve.id')
            ->join('cliente as cl','ve.cliente_id','=','cl.id')
            ->select(DB::raw('COUNT(*) as count'))
            ->where([
                ['cl.users_id', '=', $idProductor],
                ['numPoliza', '=', 'E/E'],
            ])
            ->get();
        }

        return response()->json($data);
    }
    
}
