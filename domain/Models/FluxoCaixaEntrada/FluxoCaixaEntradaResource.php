<?php

namespace MVC\Models\FluxoCaixaEntrada;

use Illuminate\Http\Resources\Json\JsonResource;

class FluxoCaixaEntradaResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                      => $this->uuid,
            'data_fluxo_caixa_entrada'  => $this->data_fluxo_caixa_entrada,
            'valor_fluxo_caixa_entrada' => $this->valor_fluxo_caixa_entrada,
            'fk_id_tipo_entrada'        => $this->fk_id_tipo_entrada,
            'fk_id_fluxo_caixa'         => $this->fk_id_fluxo_caixa
        ];

        return $retorno;
    }
}
