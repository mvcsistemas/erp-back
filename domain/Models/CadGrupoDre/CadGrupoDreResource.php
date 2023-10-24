<?php

namespace MVC\Models\CadGrupoDre;

use Illuminate\Http\Resources\Json\JsonResource;

class CadGrupoDreResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'          => $this->uuid,
            'dsc_grupo_dre' => $this->dsc_grupo_dre
        ];

        return $retorno;
    }
}
