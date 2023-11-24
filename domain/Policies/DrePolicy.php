<?php

namespace MVC\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Lang;
use MVC\Models\Dre\Dre;
use MVC\Models\User\User;

class DrePolicy {

    use HandlesAuthorization;

    public function create(User $user)
    {
        $existe_dre_aberto = Dre::where('fechamento_dre', 1)->count();

        if ($existe_dre_aberto > 0) {
            return Response::deny(Lang::get('exite_dre_aberto'));
        }

        return Response::allow();
    }

    public function checkIfDreIsOpen(User $user, array $data)
    {
        $dre = Dre::findByUuid($data['uuid']);

        if ($dre->fechamento_dre == 0) {
            return Response::deny(Lang::get('dre_encerrado'));
        }

        return Response::allow();
    }
}
