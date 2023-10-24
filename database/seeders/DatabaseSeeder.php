<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MVC\Models\CadGrupoDre\CadGrupoDre;
use MVC\Models\CadGrupoFinanceiro\CadGrupoFinanceiro;
use MVC\Models\CadTipoEntrada\CadTipoEntrada;
use MVC\Models\CadTipoSaida\CadTipoSaida;
use MVC\Models\User\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        CadTipoEntrada::factory(10)->create();
        CadTipoSaida::factory(10)->create();
        CadGrupoFinanceiro::factory(10)->create();
        CadGrupoDre::factory(10)->create();
    }
}
