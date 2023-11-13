<?php

namespace MVC\Models\DreItens;

use Illuminate\Http\Resources\Json\JsonResource;

class DreItensResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'              => $this->uuid,
            'aliquota'          => $this->aliquota,
            'valor_dre_item'    => $this->valor_dre_item,
            'dsc_dre_item'      => $this->dsc_dre_item,
            'fk_uuid_grupo_dre' => $this->fk_uuid_grupo_dre
        ];

        return $retorno;
    }
}
