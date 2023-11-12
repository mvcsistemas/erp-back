<?php

namespace MVC\Models\FluxoCaixaSaida;

use Illuminate\Http\Resources\Json\JsonResource;

class FluxoCaixaSaidaResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                     => $this->uuid,
            'data_fluxo_caixa_saida'   => $this->data_fluxo_caixa_saida,
            'valor_fluxo_caixa_saida'  => $this->valor_fluxo_caixa_saida,
            'fk_uuid_tipo_saida'       => $this->fk_uuid_tipo_saida,
            'dsc_tipo_saida'           => $this->dsc_tipo_saida,
            'fk_uuid_fluxo_caixa'      => $this->fk_uuid_fluxo_caixa,
            'fk_uuid_grupo_financeiro' => $this->fk_uuid_grupo_financeiro,
            'dsc_grupo_financeiro'     => $this->dsc_grupo_financeiro
        ];

        return $retorno;
    }
}
