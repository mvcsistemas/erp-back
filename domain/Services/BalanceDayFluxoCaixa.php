<?php

namespace MVC\Services;

use MVC\Models\FluxoCaixa\FluxoCaixa;
use MVC\Models\FluxoCaixaEntrada\FluxoCaixaEntrada;
use MVC\Models\FluxoCaixaSaida\FluxoCaixaSaida;

class BalanceDayFluxoCaixa {

    public function getSaldoDia(int $fk_id_fluxo_caixa): string
    {
        $saldo_dia = $this->getSaldoEntrada($fk_id_fluxo_caixa)->saldo_entrada - $this->getSaldoSaida($fk_id_fluxo_caixa)->saldo_saida;

        return number_format($saldo_dia, 2);
    }

    public function getSaldoEntrada(int $fk_id_fluxo_caixa): FluxoCaixaEntrada
    {
        return FluxoCaixaEntrada::selectRaw('SUM(valor_fluxo_caixa_entrada) as saldo_entrada')
        ->where('fk_id_fluxo_caixa', $fk_id_fluxo_caixa)
        ->where('data_fluxo_caixa_entrada', date('Y-m-d'))
        ->first();
    }

    public function getSaldoSaida(int $fk_id_fluxo_caixa): FluxoCaixaSaida
    {
        return FluxoCaixaSaida::selectRaw('SUM(valor_fluxo_caixa_saida) as saldo_saida')
        ->where('fk_id_fluxo_caixa', $fk_id_fluxo_caixa)
        ->where('data_fluxo_caixa_saida', date('Y-m-d'))
        ->first();
    }
}
