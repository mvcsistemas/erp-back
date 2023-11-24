<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use MVC\Models\FluxoCaixa\FluxoCaixa;
use MVC\Models\FluxoCaixaEntrada\FluxoCaixaEntrada;
use MVC\Models\FluxoCaixaSaida\FluxoCaixaSaida;
use MVC\Policies\FluxoCaixaItensPolicy;
use MVC\Policies\FluxoCaixaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        FluxoCaixa::class        => FluxoCaixaPolicy::class,
        FluxoCaixaEntrada::class => FluxoCaixaItensPolicy::class,
        FluxoCaixaSaida::class   => FluxoCaixaItensPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
