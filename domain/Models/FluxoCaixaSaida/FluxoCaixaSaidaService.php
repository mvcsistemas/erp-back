<?php

namespace MVC\Models\FluxoCaixaSaida;

use MVC\Base\MVCService;

class FluxoCaixaSaidaService extends MVCService {

    protected FluxoCaixaSaida $model;

    public function __construct(FluxoCaixaSaida $model)
    {
        $this->model = $model;
    }

    public function getFluxoCaixa(string $uuid): FluxoCaixaSaida
    {
        return FluxoCaixaSaida::select('fluxo_caixa.uuid as fk_uuid_fluxo_caixa')
                                ->join('fluxo_caixa', 'fluxo_caixa.id_fluxo_caixa', 'fluxo_caixa_saida.fk_id_fluxo_caixa')
                                ->where('fluxo_caixa_saida.uuid', $uuid)
                                ->first();
    }
}
