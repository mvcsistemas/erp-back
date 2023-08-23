<?php

namespace MVC\Models\CadConsulta\CadConsultaImagem;

use Illuminate\Http\Resources\Json\JsonResource;

class CadConsultaImagemResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'id_arquivo'   => $this->id_arquivo,
            'nome_arquivo' => $this->nome_arquivo,
            'observacao'   => $this->observacao,
            'id_consulta'  => $this->id_consulta,
            'path'         => $this->path
        ];

        return $retorno;
    }
}
