<?php

namespace gps\Providers;

/*use gps\Beneficiario;
use gps\Carroceria;
use gps\Categoria;
use gps\Cliente;
use gps\Cobertura;
use gps\CompaniaSeguro;
use gps\Localidad;
use gps\Marca;
use gps\ModeloCarroceria;
use gps\Modelo;
use gps\Pago;
use gps\Poliza;
use gps\Siniestro;
use gps\Vehiculo;
use gps\User;

use gps\Policies\BeneficiarioPolicy;
use gps\Policies\CarroceriaPolicy;
use gps\Policies\CategoriaPolicy;
use gps\Policies\ClientePolicy;
use gps\Policies\CompaniaSeguroPolicy;
use gps\Policies\CoberturaPolicy;
use gps\Policies\LocalidadPolicy;
use gps\Policies\MarcaPolicy;
use gps\Policies\ModeloCarroceriaPolicy;
use gps\Policies\ModeloPolicy;
use gps\Policies\PagoPolicy;
use gps\Policies\PolizaPolicy;
use gps\Policies\SiniestroPolicy;
use gps\Policies\VehiculoPolicy;
use gps\Policies\UsuarioPolicy;*/

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'gps\Model' => 'gps\Policies\ModelPolicy',
        /*Beneficiario::class => BeneficiarioPolicy::class,
        Carroceria::class => CarroceriaPolicy::class,
        Categoria::class => CategoriaPolicy::class,
        Cliente::class => ClientePolicy::class,
        Cobertura::class => CoberturaPolicy::class,
        CompaniaSeguro::class => CompaniaSeguroPolicy::class,
        Localidad::class => LocalidadPolicy::class,
        Marca::class => MarcaPolicy::class,
        ModeloCarroceria::class => ModeloCarroceriaPolicy::class,
        Modelo::class => ModeloPolicy::class,
        Pago::class => PagoPolicy::class,
        Poliza::class => PolizaPolicy::class,
        Siniestro::class => SiniestroPolicy::class,
        Vehiculo::class => VehiculoPolicy::class,
        User::class => UsuarioPolicy::class,*/
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('privilegio-alto', function ($user) {
            if($user->privilegio == 'ALTO' || $user->privilegio == 'MEDIO'){
                return true;
            }
            return false;
        });

        //
    }
}
