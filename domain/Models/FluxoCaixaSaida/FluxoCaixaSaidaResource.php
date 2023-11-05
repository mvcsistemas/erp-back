<?php

namespace MVC\Models\FluxoCaixaSaida;

use Illuminate\Http\Resources\Json\JsonResource;

class FluxoCaixaSaidaResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                    => $this->uuid,
            'data_fluxo_caixa_saida'  => $this->data_fluxo_caixa_saida,
            'valor_fluxo_caixa_saida' => $this->valor_fluxo_caixa_saida,
            'fk_id_tipo_saida'        => $this->fk_id_tipo_saida,
            'fk_id_fluxo_caixa'       => $this->fk_id_fluxo_caixa,
            'fk_id_grupo_financeiro'  => $this->fk_id_grupo_financeiro
        ];

        return $retorno;
    }
}
