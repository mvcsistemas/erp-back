<?php

namespace MVC\Models\DreGrupo;

use MVC\Base\MVCService;

class DreGrupoService extends MVCService {

    protected DreGrupo $model;

    public function __construct(DreGrupo $model)
    {
        $this->model = $model;
    }
}
