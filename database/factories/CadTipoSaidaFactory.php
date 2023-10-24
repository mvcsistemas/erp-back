<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MVC\Models\CadTipoSaida\CadTipoSaida;

class CadTipoSaidaFactory extends Factory
{
    protected $model = CadTipoSaida::class;

    public function definition(): array
    {
        return [
            'dsc_tipo_saida' => fake()->name()
        ];
    }
}
