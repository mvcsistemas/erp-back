<?php

namespace MVC\Models\DreItemGrupo;

use MVC\Base\MVCService;

class DreItemGrupoService extends MVCService {

    protected DreItemGrupo $model;

    public function __construct(DreItemGrupo $model)
    {
        $this->model = $model;
    }
}
