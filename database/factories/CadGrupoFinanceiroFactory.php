<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MVC\Models\CadGrupoFinanceiro\CadGrupoFinanceiro;

class CadGrupoFinanceiroFactory extends Factory
{
    protected $model = CadGrupoFinanceiro::class;

    public function definition(): array
    {
        return [
            'dsc_grupo_financeiro' => fake()->name()
        ];
    }
}
