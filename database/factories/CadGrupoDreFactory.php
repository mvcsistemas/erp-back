<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MVC\Models\CadGrupoDre\CadGrupoDre;

class CadGrupoDreFactory extends Factory
{
    protected $model = CadGrupoDre::class;

    public function definition(): array
    {
        return [
            'dsc_grupo_dre' => ''
        ];
    }
}
