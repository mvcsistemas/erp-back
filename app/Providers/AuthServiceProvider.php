<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use MVC\Models\Dre\Dre;
use MVC\Models\DreItemGrupo\DreItemGrupo;
use MVC\Models\FluxoCaixa\FluxoCaixa;
use MVC\Models\FluxoCaixaEntrada\FluxoCaixaEntrada;
use MVC\Models\FluxoCaixaSaida\FluxoCaixaSaida;
use MVC\Policies\DreItemGrupoPolicy;
use MVC\Policies\DrePolicy;
use MVC\Policies\FluxoCaixaItensPolicy;
use MVC\Policies\FluxoCaixaPolicy;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        FluxoCaixa::class        => FluxoCaixaPolicy::class,
        FluxoCaixaEntrada::class => FluxoCaixaItensPolicy::class,
        FluxoCaixaSaida::class   => FluxoCaixaItensPolicy::class,
        Dre::class               => DrePolicy::class,
        DreItemGrupo::class      => DreItemGrupoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
