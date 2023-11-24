<?php

namespace MVC\Models\Dre;

use Illuminate\Http\Resources\Json\JsonResource;

class DreResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'            => $this->uuid,
            'competencia_dre' => $this->competencia_dre,
            'fechamento_dre'  => $this->fechamento_dre
        ];

        return $retorno;
    }
}
