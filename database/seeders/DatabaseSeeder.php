<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use MVC\Models\CadGrupoDre\CadGrupoDre;
use MVC\Models\CadGrupoFinanceiro\CadGrupoFinanceiro;
use MVC\Models\CadTipoEntrada\CadTipoEntrada;
use MVC\Models\CadTipoSaida\CadTipoSaida;
use MVC\Models\User\User;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        CadTipoEntrada::factory(10)->create();
        CadTipoSaida::factory(10)->create();
        CadGrupoFinanceiro::factory(10)->create();
        CadGrupoDre::factory(6)
                   ->state(new Sequence(
                       ['dsc_grupo_dre' => 'Receita Bruta'],
                       ['dsc_grupo_dre' => 'Impostos e Deduções'],
                       ['dsc_grupo_dre' => 'Custos'],
                       ['dsc_grupo_dre' => 'Despesas Operacionais'],
                       ['dsc_grupo_dre' => 'Depreciação e Amortização'],
                       ['dsc_grupo_dre' => 'Juros e Impostos']
                ))
                   ->create();
    }
}
