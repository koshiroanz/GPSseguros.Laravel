<?php
namespace gps\Http\Controllers;

use App;
use DB;
use PDF;
use Auth;
use gps\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CarnetProvisorioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query = trim($request->get('searchText'));

            if(Auth::user()->privilevio != 'BAJO'){
                $polizasClienteVehiculo = DB::table('poliza as pol')
                ->join('vehiculo as ve', 'pol.vehiculo_id','=', 've.id')
                ->join('cliente as cl', 've.cliente_id','=', 'cl.id')
                ->select('ve.dominio as veDominio', 'cl.id as clId','cl.apellido as clApellido', 'cl.nombre as clNombre', 'pol.id as polId','pol.numPoliza')
                ->where('cl.apellido', 'LIKE', '%'.$query.'%')
                ->orwhere('ve.dominio', 'LIKE', '%'.$query.'%')
                ->orwhere('pol.numPoliza', 'LIKE', '%'.$query.'%')
                ->orderBy('cl.apellido','asc')
                ->paginate(10);    
            }else{
                $polizasClienteVehiculo = DB::table('poliza as pol')
                ->join('vehiculo as ve', 'pol.vehiculo_id','=', 've.id')
                ->join('cliente as cl', 've.cliente_id','=', 'cl.id')
                ->select('ve.dominio as veDominio', 'cl.id as clId','cl.apellido as clApellido', 'cl.nombre as clNombre', 'pol.id as polId','pol.numPoliza')
                ->where([
                        ['cl.users_id','=', Auth::user()->id],
                        ['cl.apellido', 'LIKE', '%'.$query.'%'],
                        ])
                ->orwhere([
                        ['cl.users_id','=', Auth::user()->id],
                        ['ve.dominio', 'LIKE', '%'.$query.'%'],
                        ])
                ->orwhere([
                        ['cl.users_id','=', Auth::user()->id],
                        ['pol.numPoliza', 'LIKE', '%'.$query.'%'],
                        ])
                ->orderBy('cl.apellido','asc')
                ->paginate(10);
            }
            
            return view("reporte.carnetprovisorio.index", ["polizasClienteVehiculo" => $polizasClienteVehiculo, "searchText" => $query]);
    	}
    }

    public function show($id){
        $cliente = Cliente::findOrFail($id);
        return view('reporte.carnetprovisorio.show', ["cliente" => $cliente]);
    }

    public function visualizar($idPoliza){
        try{
            $datosCarnetProvisorio = $this->obtenerDatosCarnet($idPoliza);
            $datosCarnetProvisorio->localidadNombre = ucwords(strtolower($datosCarnetProvisorio->localidadNombre));
            $datosEmpresa = parent::getDatosEmpresa();

            $view = view('reporte.carnetprovisorio.reporte_carnetprovisorio', ['datosCarnetProvisorio' => $datosCarnetProvisorio, "datosEmpresa" => $datosEmpresa])->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('A4','portrait');
            $fechaActual = date('d-m-y');
            $carnetprovisorio = 'Carnet_prov_poliza_'.$datosCarnetProvisorio->numPoliza.'_'.$fechaActual.'.pdf';
        }catch(Exception $e){
            $error = $e;
        }
        
        return $pdf->stream($carnetprovisorio);
    }

    public function descargar($idPoliza){
        $datosCarnetProvisorio = $this->obtenerDatosCarnet($idPoliza);
        $datosCarnetProvisorio->localidadNombre = ucwords(strtolower($datosCarnetProvisorio->localidadNombre));
        $datosEmpresa = parent::getDatosEmpresa();

        $view = view('reporte.carnetprovisorio.reporte_carnetprovisorio', ['datosCarnetProvisorio' => $datosCarnetProvisorio, "datosEmpresa" => $datosEmpresa])->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('A4','portrait');

        $fechaActual = date('d-m-y');
        $archivoNombre = 'Carnet_prov_poliza_'.$datosCarnetProvisorio->numPoliza.'_'.$fechaActual.'.pdf';

        return $pdf->download($archivoNombre);
    }

    public function obtenerDatosCarnet($idPoliza){
        $datosCarnetProvisorio = DB::table('poliza as pol')
        ->join('companiaseguro as cs','pol.compSeguro_id','=','cs.id')
        ->join('vehiculo as ve','pol.vehiculo_id','=','ve.id')
        ->join('marca as ma','ve.marca_id','=', 'ma.id')
        ->join('modelo as mo','ve.modelo_id','=', 'mo.id')
        ->join('cliente as cl','ve.cliente_id','=','cl.id')
        ->join('localidad as lo','cs.localidad_id','=','lo.id')
        ->where('pol.id','=', $idPoliza)
        ->select('pol.numPoliza','ma.nombre as maNombre','ve.dominio','ve.chasis','ve.motor','mo.nombre as moNombre','cs.nombre as compNombre','cs.etiqueta','cs.direccion','cs.logo_img','lo.nombre as localidadNombre')
        ->first();

        return $datosCarnetProvisorio;
    }

    

}