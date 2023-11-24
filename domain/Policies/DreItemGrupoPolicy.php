<?php

namespace MVC\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Lang;
use MVC\Models\Dre\Dre;
use MVC\Models\User\User;

class DreItemGrupoPolicy {

    use HandlesAuthorization;

    public function checkIfDreIsOpen(User $user, array $data)
    {
        $dre = Dre::findByUuid($data['fk_uuid_dre']);

        if ($dre->fechamento_dre == 0) {
            return Response::deny(Lang::get('dre_encerrado'));
        }

        return Response::allow();
    }
}
