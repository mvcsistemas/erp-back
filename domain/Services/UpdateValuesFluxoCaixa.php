<?php

namespace MVC\Services;

use MVC\Models\FluxoCaixa\FluxoCaixa;
use MVC\Models\FluxoCaixaEntrada\FluxoCaixaEntrada;
use MVC\Models\FluxoCaixaSaida\FluxoCaixaSaida;

class UpdateValuesFluxoCaixa {

    public function updateSaldoFluxoCaixa(int $fk_id_fluxo_caixa)
    {
        $saldo_mensal = $this->getSaldoEntrada($fk_id_fluxo_caixa)->saldo_entrada - $this->getSaldoSaida($fk_id_fluxo_caixa)->saldo_saida;

        $fluxo_caixa = FluxoCaixa::find($fk_id_fluxo_caixa);
        $fluxo_caixa->update([
            'saldo_mensal_fluxo_caixa' => $saldo_mensal,
            'valor_liquido_fluxo_caixa' => $saldo_mensal + $fluxo_caixa->saldo_anterior_fluxo_caixa
        ]);
    }

    public function getSaldoEntrada(int $fk_id_fluxo_caixa): FluxoCaixaEntrada
    {
        return FluxoCaixaEntrada::selectRaw('SUM(valor_fluxo_caixa_entrada) as saldo_entrada')
        ->where('fk_id_fluxo_caixa', $fk_id_fluxo_caixa)
        ->first();
    }

    public function getSaldoSaida(int $fk_id_fluxo_caixa): FluxoCaixaSaida
    {
        return FluxoCaixaSaida::selectRaw('SUM(valor_fluxo_caixa_saida) as saldo_saida')
        ->where('fk_id_fluxo_caixa', $fk_id_fluxo_caixa)
        ->first();
    }
}
