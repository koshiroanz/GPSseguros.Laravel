<?php

namespace gps;

use gps\Poliza;
use gps\Cliente;
use gps\Vehiculo;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    protected $table = 'siniestro';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'poliza_id',
        'cliente_id',
        'vehiculo_id',
    	'conductor',
        'fechaSiniestro',
        'fechaDenunciaInterna',
        'exposicionPolicial',
        'fotocopiaDni',
        'fotocopiaCV',
        'fotocopiaCC',
        'fotocopiaVTV',
        'otros',
    	'terceroUno',
    	'dominioUno',
    	'conductorUno',
    	'terceroDos',
    	'dominioDos',
    	'conductorDos',
    	'fechaReclamoTercero',
    	'exposicionPolicialTercero',
    	'fotocopiaCVTercero',
    	'fotocopiaCCTercero',
    	'boletaCompra',
    	'certificadoCobertura',
    	'denunciaAdministrativa',
    	'presupuesto',
    	'presupuestoDos',
    	'totalPresupuesto',
    	'gastosMedicos',
    	'informeMedico',
    	'fechaEnvioDI',
    	'fechaEnvioRT',
    	'fechaDictamen',
    	'dictamen',
    	'ofrecimiento',
    	'vencimientoReclamo',
    	
    ];

    protected $guarder = [];

    public function Poliza(){
        return $this->belongsTo(Poliza::class,'poliza_id');
    }

    public function Cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    public function Vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id');
    }    
    
}
