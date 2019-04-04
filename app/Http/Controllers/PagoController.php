<?php

namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Pago;
use gps\Poliza;
use gps\Helper;
use gps\PagoCuotaPoliza;
use Illuminate\Http\Request;
use gps\Http\Requests\PagoFormRequest;
use Illuminate\Support\Facades\Redirect;

class PagoController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $query = trim($request->get('searchText'));

        if(Auth::user()->privilegio != 'BAJO'){
            $cuotasPoliza = PagoCuotaPoliza::orderBy('created_at','desc')->get()->unique('pago_id');

            /*foreach($cuotasPoliza as $pago){
                if(($pago->pago->numRecibo == $query)||($pago->pago->poliza->numPoliza == $query)){
                    $cuotasPoliza = $pago;
                }
            }       */
            /*$pagos = DB::table('pago as pa')
            ->join('vehiculo as ve','pa.vehiculo_id','=','ve.id')
            ->join('poliza as po','po.vehiculo_id','=','ve.id')
            ->join('cliente as cl','ve.cliente_id','=','cl.id')
            ->join('pago_cuota_poliza as cp', 'pa.id','=','cp.pago_id')
            ->select('pa.id', 'pa.numRecibo', 'pa.fecha', 'pa.total','pa.reciboGrua', 'pa.importeGrua','po.numPoliza', 've.dominio', 'cl.apellido as cliApellido', 'cl.nombre as cliNombre', 'pa.observacion')
            ->where('pa.numRecibo', 'LIKE', '%'.$query.'%')
            ->orwhere('po.numPoliza', 'LIKE', '%'.$query.'%')
            ->orderBy('pa.created_at','desc')
            ->groupBy('pa.id','pa.numRecibo','pa.fecha','total','pa.reciboGrua','pa.importeGrua','po.numPoliza','ve.dominio','cl.apellido','cl.nombre','pa.observacion')
            ->paginate(10);*/
        }else{
            $cuotasPoliza = PagoCuotaPoliza::all();
            foreach($pagos as $pago){
                if( (($pago->pago->vehiculo->cliente->users->id == Auth::user()->id) && ($pago->pago->numRecibo == $query)) ||
                (($pago->pago->vehiculo->cliente->users->id == Auth::user()->id) && ($pago->pago->poliza->numPoliza == $query)) ){
                    $pagos = $pago;
                }
            }
            /*$pagos = DB::table('pago as pa')
            ->join('vehiculo as ve','pa.vehiculo_id','=','ve.id')
            ->join('poliza as po','po.vehiculo_id','=','ve.id')
            ->join('cliente as cl','ve.cliente_id','=','cl.id')
            ->select('pa.id','pa.numRecibo','pa.fecha','pa.total','pa.reciboGrua','pa.importeGrua','po.numPoliza','ve.dominio','cl.apellido as cliApellido','cl.nombre as cliNombre','pa.observacion')
            ->where([
                    ['cl.users_id', '=', Auth::user()->id],
                    ['po.numPoliza', 'LIKE', '%'.$query.'%'],
                    ])
            ->orwhere([
                    ['cl.users_id', '=', Auth::user()->id],
                    ['pa.numRecibo', 'LIKE', '%'.$query.'%'],
                    ])
            ->orderBy('pa.created_at','desc')
            ->paginate(10);*/
        }
        //$group = $pagos->groupBy('pago_id','poliza_id','created_at','updated_at');
        //$cuotasPoliza = $this->conversionFechaPagos($cuotasPoliza);

        return view('pago.index',["cuotasPoliza" => $cuotasPoliza, "searchText" => $query]);
    }

    public function create(){
        $clientes = $this->obtenerClientes();

    	return view('Pago.create', ["clientes" => $clientes]);
    }

    public function store(PagoFormRequest $request){
        if(count($request->cuota) == count($request->importes)){
            if($this->verificarImportes($request->importes)){
                try{
                    DB::beginTransaction();

                    $pago = new Pago;
                    $pago->numRecibo = $request->get('numRecibo');
                    $pago->fecha = Helper::formatoDateIda($request->get('fecha'));
                    $pago->reciboGrua = $request->get('reciboGrua');
                    $pago->importeGrua = $request->get('importeGrua');
                    $pago->vehiculo_id = $request->get('vehiculo');
                    $pago->poliza_id = $request->get('poliza');
                    $pago->total = $request->get('total');
                    $pago->observacion = $request->get('observacion');
                    
                    $pago->save();

                    $cuota = $request->get('cuota');
                    $importes = $request->get('importes');
                    $poliza = $request->get('poliza');

                    $cont = 0;

                    while($cont < count($cuota)){
                        $cuotapoliza = new PagoCuotaPoliza;

                        $cuotapoliza->numCuota = $cuota[$cont];
                        $cuotapoliza->importe = $importes[$cont];
                        $cuotapoliza->pago_id = $pago->id;
                        $cuotapoliza->poliza_id = $poliza;

                        $cuotapoliza->save();
                        $cont++;
                    }

                    DB::commit();
                    return Redirect::to('pago/create')->with('success','Se ha registrado exitosamente.');
                }catch(Exception $e){
                    //DB::rollback();
                    return Redirect::to('pago/create')->with('fail','Ha ocurrido un error al registrar el pago: '.$e);
                }
            }else{
                return Redirect::to('pago/create')->with('fail','Es necesario cargar un valor en precio de cuota.');
            }
        }else{
            return Redirect::to('pago/create')->with('fail','Las cantidades de Cuotas e Importes deben coincidir.');
        }
        
    }
    // Verifica si en array $importes existe algún valor vacío.
    private function verificarImportes($importes){
        $check = true;
        if(in_array(NULL, $importes)){
            $check = false;
        }

        return $check;
    }

    public function show($id){
        $pago = Pago::findOrFail($id);
        //$this->authorize('permiso_pago', $pago);

        return view("pago.show", ["pago" => Pago::findOrFail($id)]);
    }

    public function edit($id){  // $id => idPago
        $pago = Pago::findOrFail($id);
        //$this->authorize('permiso_pago', $pago);
        
    	$cuotasPoliza = $this->obtenerCuotasPoliza($id);
        $pago->fecha = Helper::formatoDateVuelta($pago->fecha);

    	return view("pago.edit", ["pago" => $pago, "cuotasPoliza" => $cuotasPoliza]);
    }

    public function update(Request $request, $id){
        try{
            $pago = Pago::findOrFail($id);
            //$this->authorize('permiso_pago', $pago);

            $pago->numRecibo = $request->get('numRecibo');
            $pago->fecha = Helper::formatoDateIda($request->get('fecha'));
            $pago->reciboGrua = $request->get('reciboGrua');
            $pago->importeGrua = $request->get('importeGrua');
            $pago->observacion = $request->get('observacion');
            $pago->update();

            return Redirect::to('pago')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('pago')->with('fail','Ha ocurrido un error al actualizar el pago: '.$e);
        }
    }

    public function destroy($idPago){
        try{
            PagoCuotaPoliza::where('pago_id', $idPago)->get()->each->delete();
            Pago::where('id', $idPago)->delete();

            return Redirect::to("pago")->with('success','Se ha eliminado exitosamente.');
        }catch(Exception $e){
            return Redirect::to("pago")->with('fail','Ha ocurrido un error al eliminar el pago: '.$e);
        }
    }

    public function obtenerClientes(){
        if(Auth::user()->privilegio == 'BAJO'){
            $idProductor = Auth::user()->id;
            $clientes = DB::table('cliente')
            ->select('id','apellido','nombre','dni')
            ->where('estado', 'ACTIVO')
            ->where([
                    ['estado', '=', 'ACTIVO'],
                    ['users_id', '=', Auth::user()->id],
                    ])
            ->orderBy('apellido')
            ->get();
        }else{
            $clientes = DB::table('cliente')
            ->select('id','apellido','nombre','dni')
            ->where('estado', 'ACTIVO')
            ->orderBy('apellido')
            ->get();
        }

        return $clientes;
    }

    public function obtenerCuotasPoliza($idPago){
        $cuotasPoliza = DB::table('pago_cuota_poliza as cp')
        ->join('poliza as po','cp.poliza_id','=','po.id')
        ->where('cp.pago_id',$idPago)
        ->select('cp.*','po.numPoliza as numPoliza')
        ->get();

        return $cuotasPoliza;
    }

    public function obtenerPolizas(){
    	$polizas = DB::table('poliza as po')
        ->join('vehiculo as ve','po.vehiculo_id','=','ve.id')
		->select('po.id','po.numPoliza','ve.dominio')
		->where('po.estado', 'ACTIVO')
		->orderBy('po.vigenciaPolizaHasta')
        ->get();

		return $polizas;
    }

    // RESPUESTA JSON

    public function getPago(Request $request){   // Recibe como parametro $request->idPago
        $data = DB::table('pago_cuota_poliza as cp')
        ->join('pago as pa','cp.pago_id','=','pa.id')
        ->join('poliza as po','pa.poliza_id','=','po.id')
        ->join('vehiculo as ve','pa.vehiculo_id','=','ve.id')
        ->join('cliente as cl','pa.cliente_id','=','cl.id')
        ->where('cp.pago_id', $request->idPago)
        ->select('pa.numRecibo as numRecibo','pa.fecha as fecha','cp.numCuota as numCuota','cp.importe as importe','cl.dni as dni','cl.apellido as apellido','cl.nombre as nombre','ve.dominio as dominio','po.numPoliza as numPoliza')
        ->get();

        return response()->json($data);
    }

    public function getPagoCuota(Request $request){   // Recibe como parametro $request->idPago
        $data = DB::table('pago_cuota_poliza')
        ->where('pago_id', $request->idPago)
        ->select('numCuota','importe')
        ->get();

        return response()->json($data);
    }

    public function getVehiculo(Request $request){   // Recibe como parametro $request->idCliente
        $data = DB::table('vehiculo')
        ->where('cliente_id', $request->idCliente)
        ->select('id','dominio')
        ->get();

        return response()->json($data);
    }

    public function getPoliza(Request $request){   // Recibe como parametro $request->idVehiculo
        $data = Poliza::where('estado', 'ACTIVO')->where('vehiculo_id', $request->idVehiculo)->select('id','numPoliza')->get();

        return response()->json($data);
    }

    public function getCantidadCuotaPoliza(Request $request){   // Recibe como parametro $request->idPoliza
        $data = DB::table('pago_cuota_poliza')
        ->where('poliza_id', $request->idPoliza) 
        ->select(DB::raw('count(numCuota) as cantidad'))        // Cuenta la cantidad de cuotas(pagadas) que posee una póliza
        ->get();

        return response()->json($data);
    }

    public function getCuotaPoliza(Request $request){   // Recibe como parametro $request->idPoliza
        $data = DB::table('pago_cuota_poliza')
        ->where('poliza_id', $request->idPoliza)
        ->select('numCuota')                            // Trae el n° de cuotas(ordenadas ascendentemente) pagadas. 
        ->get();

        return response()->json($data);
    }

    public function getImportePoliza(Request $request){   // Recibe como parametro $request->idPoliza
        $data = DB::table('poliza')
        ->where('id', $request->idPoliza)
        ->select('costoPoliza')
        ->get();

        return response()->json($data);
    }

    public function getComprobarRecibo(Request $request){   // Recibe como parametro $request->numeroRecibo
        $result = DB::table('pago')
        ->where('numRecibo',$request->numeroRecibo)
        ->select(DB::raw('count(numRecibo) as cant'))
        ->get();

        return response()->json($result);
    }
    
}