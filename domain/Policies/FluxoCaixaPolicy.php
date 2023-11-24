<?php

namespace MVC\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Lang;
use MVC\Models\FluxoCaixa\FluxoCaixa;
use MVC\Models\User\User;

class FluxoCaixaPolicy {

    use HandlesAuthorization;

    public function create(User $user)
    {
        $existe_fluxo_caixa_aberto = FluxoCaixa::where('fechamento_fluxo_caixa', 1)->count();

        if ($existe_fluxo_caixa_aberto > 0) {
            return Response::deny(Lang::get('exite_fluxo_caixa_aberto'));
        }

        return Response::allow();
    }

    public function checkIfFluxoCaixaIsOpen(User $user, array $data)
    {
        $fluxo_caixa = FluxoCaixa::findByUuid($data['uuid']);

        if ($fluxo_caixa->fechamento_fluxo_caixa == 0) {
            return Response::deny(Lang::get('fluxo_caixa_encerrado'));
        }

        return Response::allow();
    }
}
