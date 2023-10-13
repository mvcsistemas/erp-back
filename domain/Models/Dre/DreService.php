<?php

namespace MVC\Models\Dre;

use MVC\Base\MVCService;

class DreService extends MVCService {

    protected Dre $model;

    public function __construct(Dre $model)
    {
        $this->model = $model;
    }
}
