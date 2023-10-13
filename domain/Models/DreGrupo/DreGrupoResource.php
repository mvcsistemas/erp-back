<?php

namespace MVC\Models\DreGrupo;

use Illuminate\Http\Resources\Json\JsonResource;

class DreGrupoResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'          => $this->uuid,
            'dsc_gre_grupo' => $this->dsc_gre_grupo
        ];

        return $retorno;
    }
}
