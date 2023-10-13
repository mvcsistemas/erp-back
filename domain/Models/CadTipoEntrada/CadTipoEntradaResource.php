<?php

namespace MVC\Models\CadTipoEntrada;

use Illuminate\Http\Resources\Json\JsonResource;

class CadTipoEntradaResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                   => $this->uuid,
            'dsc_tipo_entrada'       => $this->dsc_tipo_entrada,
            'fk_id_grupo_financeiro' => $this->fk_id_grupo_financeiro
        ];

        return $retorno;
    }
}
