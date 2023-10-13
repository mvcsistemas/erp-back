<?php

namespace MVC\Models\FluxoCaixaSaida;

use MVC\Base\MVCService;

class FluxoCaixaSaidaService extends MVCService {

    protected FluxoCaixaSaida $model;

    public function __construct(FluxoCaixaSaida $model)
    {
        $this->model = $model;
    }
}
