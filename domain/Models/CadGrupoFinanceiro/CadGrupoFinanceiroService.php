<?php

namespace MVC\Models\CadGrupoFinanceiro;

use MVC\Base\MVCService;

class CadGrupoFinanceiroService extends MVCService {

    protected CadGrupoFinanceiro $model;

    public function __construct(CadGrupoFinanceiro $model)
    {
        $this->model = $model;
    }
}
