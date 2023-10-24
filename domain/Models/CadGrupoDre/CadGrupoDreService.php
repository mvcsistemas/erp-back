<?php

namespace MVC\Models\CadGrupoDre;

use MVC\Base\MVCService;

class CadGrupoDreService extends MVCService {

    protected CadGrupoDre $model;

    public function __construct(CadGrupoDre $model)
    {
        $this->model = $model;
    }
}
