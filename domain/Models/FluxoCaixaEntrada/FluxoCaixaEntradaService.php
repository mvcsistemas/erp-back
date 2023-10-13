<?php

namespace MVC\Models\FluxoCaixaEntrada;

use MVC\Base\MVCService;

class FluxoCaixaEntradaService extends MVCService {

    protected FluxoCaixaEntrada $model;

    public function __construct(FluxoCaixaEntrada $model)
    {
        $this->model = $model;
    }
}
