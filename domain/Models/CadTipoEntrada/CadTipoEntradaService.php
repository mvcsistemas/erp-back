<?php

namespace MVC\Models\CadTipoEntrada;

use MVC\Base\MVCService;

class CadTipoEntradaService extends MVCService {

    protected CadTipoEntrada $model;

    public function __construct(CadTipoEntrada $model)
    {
        $this->model = $model;
    }
}
