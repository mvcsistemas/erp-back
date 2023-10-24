<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MVC\Models\CadTipoEntrada\CadTipoEntrada;

class CadTipoEntradaFactory extends Factory
{
    protected $model = CadTipoEntrada::class;

    public function definition(): array
    {
        return [
            'dsc_tipo_entrada' => fake()->name()
        ];
    }
}
