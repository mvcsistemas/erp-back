<?php

namespace MVC\Models\CadGrupoFinanceiro;

use Illuminate\Http\Resources\Json\JsonResource;

class CadGrupoFinanceiroResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                 => $this->uuid,
            'dsc_grupo_financeiro' => $this->dsc_grupo_financeiro
        ];

        return $retorno;
    }
}
