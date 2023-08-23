<?php

namespace MVC\Models\User;

use MVC\Base\MVCService;

class UserService extends MVCService {

    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
