<?php

namespace gps\Http\Controllers;

use DB;
use Auth;
use gps\Poliza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use gps\Http\Requests\PedidoFormRequest;

class PedidoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query = trim($request->get('searchText'));

            if(Auth::user()->privilegio != 'BAJO'){
                $pedidos = DB::table('poliza as po')
                ->join('vehiculo as ve', 'po.vehiculo_id', '=', 've.id')
                ->join('cliente as cl', 've.cliente_id', '=', 'cl.id')
                ->join('users as pro', 'cl.users_id', '=', 'pro.id')
                ->select('po.id','po.numPoliza','po.vigenciaPedida','ve.dominio as veDominio', 'cl.apellido as clApellido', 'cl.nombre as clNombre','pro.apellido as proApellido','pro.nombre as proNombre')
                ->where('po.numPoliza', '=', 'E/E')
                ->orderBy('po.vigenciaPedida','asc')
                ->paginate(10);
            }else{
                $pedidos = DB::table('poliza as po')
                ->join('vehiculo as ve', 'po.vehiculo_id', '=', 've.id')
                ->join('cliente as cl', 've.cliente_id', '=', 'cl.id')
                ->join('users as pro', 'cl.users_id', '=', 'pro.id')
                ->select('po.id','po.numPoliza as numPoliza','po.vigenciaPedida','ve.dominio as veDominio', 'cl.apellido as clApellido', 'cl.nombre as clNombre','pro.apellido as proApellido','pro.nombre as proNombre')
                ->where([
                        ['pro.id', '=', Auth::user()->id],
                        ['po.numPoliza', '=', 'E/E'],
                        ])
                ->orderBy('po.vigenciaPedida','asc')
                ->paginate(10);
            }   

            $pedidos = $this->conversionFechaPedidos($pedidos);

            return view("pedido.index", ["pedidos" => $pedidos, "searchText" => $query]);
    	}
    }

    public function update(PedidoFormRequest $request, $id){
        try{
            $poliza = Poliza::findOrFail($id);

            $poliza->numPoliza = $request->get('numPoliza');
            $poliza->update();

            return Redirect::to('pedido')->with('success','Se ha actualizado exitosamente.');
        }catch(Exception $e){
            return Redirect::to('pedido')->with('fail','Ha ocurrido un error al actualizar el pedido: '.$e);
        }
    }

    public function show($id){
        return view('pedido.show', ["poliza" => Poliza::findOrFail($id)]);
    }

    public function conversionFechaPedidos($pedidos){
        for($i = 0; $i < count($pedidos); $i++){
            $pedidos[$i]->vigenciaPedida = parent::formatoDateVuelta($pedidos[$i]->vigenciaPedida);
        }

        return $pedidos;
    }

}