<?php

namespace MVC\Models\CadTipoSaida;

use MVC\Base\MVCService;

class CadTipoSaidaService extends MVCService {

    protected CadTipoSaida $model;

    public function __construct(CadTipoSaida $model)
    {
        $this->model = $model;
    }
}
