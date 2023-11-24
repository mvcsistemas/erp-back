<?php

namespace MVC\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Lang;
use MVC\Models\FluxoCaixa\FluxoCaixa;
use MVC\Models\User\User;

class FluxoCaixaItensPolicy {

    use HandlesAuthorization;

    public function checkIfFluxoCaixaIsOpen (User $user, array $data)
    {
        $fluxo_caixa = FluxoCaixa::findByUuid($data['fk_uuid_fluxo_caixa']);

        if($fluxo_caixa->fechamento_fluxo_caixa == 0) {
            return Response::deny(Lang::get('fluxo_caixa_encerrado'));
        }

        return Response::allow();
    }
}
