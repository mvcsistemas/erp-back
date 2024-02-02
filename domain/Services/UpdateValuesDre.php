<?php

namespace MVC\Services;

use MVC\Models\Dre\Dre;
use MVC\Models\FluxoCaixaEntrada\FluxoCaixaEntrada;
use MVC\Models\FluxoCaixaSaida\FluxoCaixaSaida;

class UpdateValuesDre {

    public function updateSaldoDreFluxoCaixaEntrada(FluxoCaixaEntrada $model): bool
    {
        $dre = Dre::join('dre_itens', 'dre_itens.fk_id_dre', 'id_dre')
                    ->where('competencia_dre', $model->fluxoCaixa->competencia_fluxo_caixa)
                    ->where('dre_itens.tipo_item_id', $model->fk_id_tipo_entrada)
                    ->where('dre_itens.tipo_item_model', 'CadTipoEntrada');

        if(! $dre->get()){
            return true;
        }

        $novo_valor = FluxoCaixaEntrada::where('fk_id_fluxo_caixa', $model->fk_id_fluxo_caixa)
                                        ->where('fk_id_tipo_entrada', $model->fk_id_tipo_entrada)
                                        ->sum('valor_fluxo_caixa_entrada');

        return $dre->update(['valor_dre_item' => $novo_valor ?? 0.00]);
    }

    public function updateSaldoDreFluxoCaixaSaida(FluxoCaixaSaida $model): bool
    {
        $dre = Dre::join('dre_itens', 'dre_itens.fk_id_dre', 'id_dre')
                    ->where('competencia_dre', $model->fluxoCaixa->competencia_fluxo_caixa)
                    ->where('dre_itens.tipo_item_id', $model->fk_id_tipo_saida)
                    ->where('dre_itens.tipo_item_model', 'CadTipoSaida');

        if(! $dre->get()){
            return true;
        }

        $novo_valor = FluxoCaixaSaida::where('fk_id_fluxo_caixa', $model->fk_id_fluxo_caixa)
                                        ->where('fk_id_tipo_saida', $model->fk_id_tipo_saida)
                                        ->sum('valor_fluxo_caixa_saida');

        return $dre->update(['valor_dre_item' => $novo_valor ?? 0.00]);
    }
}
