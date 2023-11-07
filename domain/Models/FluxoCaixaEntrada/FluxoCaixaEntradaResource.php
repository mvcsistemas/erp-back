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
            'fk_uuid_tipo_entrada'      => $this->fk_uuid_tipo_entrada,
            'dsc_tipo_entrada'          => $this->dsc_tipo_entrada,
            'fk_uuid_fluxo_caixa'       => $this->fk_uuid_fluxo_caixa,
            'fk_uuid_grupo_financeiro'  => $this->fk_uuid_grupo_financeiro,
            'dsc_grupo_financeiro'      => $this->dsc_grupo_financeiro
        ];

        return $retorno;
    }
}
