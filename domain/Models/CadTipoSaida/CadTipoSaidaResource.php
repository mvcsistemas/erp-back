<?php

namespace MVC\Models\CadTipoSaida;

use Illuminate\Http\Resources\Json\JsonResource;

class CadTipoSaidaResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                   => $this->uuid,
            'dsc_tipo_saida'         => $this->dsc_tipo_saida,
            'fk_id_grupo_financeiro' => $this->fk_id_grupo_financeiro
        ];

        return $retorno;
    }
}
