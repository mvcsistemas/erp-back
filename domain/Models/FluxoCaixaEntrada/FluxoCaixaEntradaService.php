<?php

namespace MVC\Models\FluxoCaixaEntrada;

use MVC\Base\MVCService;

class FluxoCaixaEntradaService extends MVCService {

    protected FluxoCaixaEntrada $model;

    public function __construct(FluxoCaixaEntrada $model)
    {
        $this->model = $model;
    }

    public function getFluxoCaixa(string $uuid): FluxoCaixaEntrada
    {
        return FluxoCaixaEntrada::select('fluxo_caixa.uuid as fk_uuid_fluxo_caixa')
                                ->join('fluxo_caixa', 'fluxo_caixa.id_fluxo_caixa', 'fluxo_caixa_entrada.fk_id_fluxo_caixa')
                                ->where('fluxo_caixa_entrada.uuid', $uuid)
                                ->first();
    }
}
