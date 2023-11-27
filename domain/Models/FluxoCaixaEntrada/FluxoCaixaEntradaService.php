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
        return $this->model->select('fluxo_caixa.uuid as fk_uuid_fluxo_caixa')
                           ->join('fluxo_caixa', 'fluxo_caixa.id_fluxo_caixa', 'fluxo_caixa_entrada.fk_id_fluxo_caixa')
                           ->where('fluxo_caixa_entrada.uuid', $uuid)
                           ->first();
    }

    public function getValorTipoEntrada(array $data): mixed
    {
        return $this->model->selectRaw('SUM(valor_fluxo_caixa_entrada) as saldo')
                           ->join('fluxo_caixa', 'fluxo_caixa.id_fluxo_caixa', 'fluxo_caixa_entrada.fk_id_fluxo_caixa')
                           ->join('cad_tipo_entrada as entrada', 'entrada.id_tipo_entrada', 'fluxo_caixa_entrada.fk_id_tipo_entrada')
                           ->where('fluxo_caixa.competencia_fluxo_caixa', $data['competencia'])
                           ->where('entrada.uuid', $data['tipo_item_uuid'])
                           ->first();
    }
}
