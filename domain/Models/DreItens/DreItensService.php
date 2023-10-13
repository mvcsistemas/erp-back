<?php

namespace MVC\Models\DreItens;

use MVC\Base\MVCService;

class DreItensService extends MVCService {

    protected DreItens $model;

    public function __construct(DreItens $model)
    {
        $this->model = $model;
    }
}
