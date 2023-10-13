<?php

namespace MVC\Models\FluxoCaixa;

use Illuminate\Http\Resources\Json\JsonResource;

class FluxoCaixaResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                       => $this->uuid,
            'data_fluxo_caixa'           => $this->data_fluxo_caixa,
            'valor_liquido_fluxo_caixa'  => $this->valor_liquido_fluxo_caixa,
            'fechamento_fluxo_caixa'     => $this->fechamento_fluxo_caixa,
            'saldo_anterior_fluxo_caixa' => $this->saldo_anterior_fluxo_caixa,
            'saldo_dia_fluxo_caixa'      => $this->saldo_dia_fluxo_caixa,
        ];

        return $retorno;
    }
}
