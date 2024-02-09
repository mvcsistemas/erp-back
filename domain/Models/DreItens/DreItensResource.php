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
            'valor_original'    => $this->valor_dre_item,
            'dsc_tipo_item'     => $this->dsc_tipo_item,
            'tipo_item_uuid'    => $this->tipo_item_uuid,
            'tipo_item_model'   => $this->tipo_item_model,
            'dsc_grupo_dre'     => $this->dsc_grupo_dre,
            'fk_uuid_grupo_dre' => $this->fk_uuid_grupo_dre,
            'fk_uuid_dre'       => $this->fk_uuid_dre
        ];

        return $retorno;
    }
}
