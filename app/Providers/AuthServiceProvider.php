<?php

namespace App\Providers;

use App\Models\Perfil;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param GateContract $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /*
         * Verifica se é Admin
         * Retorna true se o usuário autenticado for do tipo admin
         */
        $gate->define('isAdmin', function($user){
            return $user->perfil->descricao == 'admin';
        });

    }
}
