<?php

namespace MVC\Models\FluxoCaixa;

use MVC\Base\MVCService;

class FluxoCaixaService extends MVCService {

    protected FluxoCaixa $model;

    public function __construct(FluxoCaixa $model)
    {
        $this->model = $model;
    }

    public function checkOpenFluxoCaixa()
    {
        return $this->model->where('fechamento_fluxo_caixa', 1)->count();
    }
}
