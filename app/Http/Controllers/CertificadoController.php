<?php

namespace gps\Http\Controllers;

use DB;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CertificadoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query = trim($request->get('searchText'));
    		$clientes = DB::table('cliente as cl')
            ->join('vehiculo as ve', 've.cliente_id', '=', 'cl.id')
            ->join('poliza as po', 'po.vehiculo_id','=','ve.id')
            ->join('companiaseguro as cs','po.compSeguro_id','=','cs.id')
    		->select('po.id as poId','po.numPoliza','ve.dominio as veDominio', 'cl.id as clId','cl.apellido as clApellido', 'cl.nombre as clNombre')
    		->where('cl.apellido', 'LIKE', '%'.$query.'%')
    		->orwhere('ve.dominio', 'LIKE', '%'.$query.'%')
    		->orderBy('cl.apellido','asc')
    		->paginate(10);
            
            return view("reporte.certificado.index", ["clientes" => $clientes, "searchText" => $query]);
    	}
    }

    public function show($id){
        $a = 'a';
        return view('reporte.certificado.show', ["a" => $a]);
    }

    public function visualizar($idPoliza){
        try{
            $datosCertificado = $this->obtenerDatosCertificado($idPoliza);
            $datosCertificado = $this->conversionFechaPolizas($datosCertificado);
            $datosCertificado->loNombre = ucwords(strtolower($datosCertificado->loNombre));
            
            $fechaActual = date('d-m-Y');

            $view = view('reporte.certificado.reporte_certificado', ["datosCertificado" => $datosCertificado, "fechaActual" => $fechaActual])->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('A4','portrait');
            $fechaActual = date('d-m-y');
            $certificado = 'Certificado_Poliza_'.$datosCertificado->numPoliza.'_'.$fechaActual.'.pdf';
        }catch(Exception $e){
            $error = $e;
        }

        return $pdf->stream($certificado);
    }

    public function descargar($idPoliza){
        try{
            $datosCertificado = $this->obtenerDatosCertificado($idPoliza);
            $datosCertificado = $this->conversionFechaPolizas($datosCertificado);
            $datosCertificado->loNombre = ucwords(strtolower($datosCertificado->loNombre));

            $fechaActual = date('d-m-Y');

            $view = view('reporte.certificado.reporte_certificado', ["datosCertificado" => $datosCertificado, "fechaActual" => $fechaActual])->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('A4','portrait');

            $certificado = 'Certificado_Poliza_'.$datosCertificado->numPoliza.'_'.$fechaActual.'.pdf';
        }catch(Exception $e){
            $error = $e;
        }

        return $pdf->download($certificado);
    }

    public function obtenerDatosCertificado($idPoliza){
        $datosCertificado = DB::table('poliza as po')
        ->join('companiaseguro as cs','po.compSeguro_id','=','cs.id')
        ->join('vehiculo as ve','po.vehiculo_id','=','ve.id')
        ->join('modelo as mo','ve.modelo_id','=','mo.id')
        ->join('marca as ma','mo.marca_id','=','ma.id')
        ->join('cliente as cl','ve.cliente_id','=','cl.id')
        ->join('localidad as loc','cl.localidad_id','=','loc.id')
        ->join('localidad as lo','cs.localidad_id','=','lo.id')
        ->select('po.numPoliza','po.vigenciaPoliza','po.vigenciaPolizaHasta','cl.apellido','cl.nombre','cl.direccion as clienteDireccion','loc.nombre as localidadNombre','ma.nombre as marcaNombre','mo.nombre as modeloNombre','ve.anio','ve.motor','ve.chasis','ve.dominio','lo.nombre as loNombre','cs.nombre as compNombre','cs.etiqueta','cs.direccion','cs.telefono1','cs.telefono2','cs.email','cs.paginaweb','cs.logo_img')
        ->where('po.id', $idPoliza)
        ->first(); 

        return $datosCertificado;
    }

    public function conversionFechaPolizas($datos){
            $datos->vigenciaPoliza = parent::formatoDateVuelta($datos->vigenciaPoliza);
            $datos->vigenciaPolizaHasta = parent::formatoDateVuelta($datos->vigenciaPolizaHasta);

        return $datos;
    }

}