<?php

namespace MVC\Models\DreItemGrupo;

use Illuminate\Http\Resources\Json\JsonResource;

class DreItemGrupoResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                 => $this->uuid,
            'valor_dre_item_grupo' => $this->valor_dre_item_grupo,
            'fk_id_grupo_dre'      => $this->fk_id_grupo_dre,
            'fk_id_dre'            => $this->fk_id_dre
        ];

        return $retorno;
    }
}
