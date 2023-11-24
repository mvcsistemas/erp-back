<?php

namespace MVC\Models\FluxoCaixa;

use MVC\Base\MVCService;
use MVC\Services\BalanceDayFluxoCaixa;

class FluxoCaixaService extends MVCService {

    protected FluxoCaixa $model;

    public function __construct(FluxoCaixa $model)
    {
        $this->model = $model;
    }

    public function checkOpenFluxoCaixa(): int
    {
        return $this->model->where('fechamento_fluxo_caixa', 1)->count();
    }

    public function balanceDay(string $uuid): string
    {
        $request = transformUuidToId([], [
            ['tabela' => 'fluxo_caixa', 'chave_atribuir' => 'fk_id_fluxo_caixa', 'campo_pesquisar' => 'id_fluxo_caixa', 'uuid' => $uuid]
        ]);

        $saldo = app()->make(BalanceDayFluxoCaixa::class);

        return $saldo->getSaldoDia($request['fk_id_fluxo_caixa']);
    }

    public function getSaldoAnteriorFluxoCaixa(): mixed
    {
        return $this->model->select('valor_liquido_fluxo_caixa')
                           ->where('fechamento_fluxo_caixa', 0)
                           ->orderByDesc('competencia_fluxo_caixa')
                           ->first();
    }
}
