<?php

namespace MVC\Models\DreItemGrupo;

use Illuminate\Http\Resources\Json\JsonResource;

class DreItemGrupoResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                 => $this->uuid,
            'valor_dre_item_grupo' => $this->valor_dre_item_grupo,
            'fk_uuid_grupo_dre'    => $this->fk_uuid_grupo_dre,
            'fk_uuid_dre'          => $this->fk_uuid_dre
        ];

        return $retorno;
    }
}
