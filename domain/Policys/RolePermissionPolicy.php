<?php

namespace MVC\Policys;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Lang;
use MVC\Models\User\User;

class RolePermissionPolicy {

    use HandlesAuthorization;

    const model = 'MVC\Models\CadPodologo\CadPodologo';

    public function view(User $user)
    {
        return $user->tipo_cadastro_type == self::model ? Response::allow() : Response::deny(Lang::get('sem_permissao'));
    }

    public function create(User $user)
    {
        return $user->tipo_cadastro_type == self::model ? Response::allow() : Response::deny(Lang::get('sem_permissao'));
    }

    public function update(User $user)
    {
        return $user->tipo_cadastro_type == self::model ? Response::allow() : Response::deny(Lang::get('sem_permissao'));
    }

    public function delete(User $user)
    {
        return $user->tipo_cadastro_type == self::model ? Response::allow() : Response::deny(Lang::get('sem_permissao'));
    }
}
