<?php

namespace MVC\Models\CadConsulta;

use Illuminate\Http\Resources\Json\JsonResource;

class CadConsultaResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'id_consulta'   => $this->id_consulta,
            'uuid'          => $this->uuid,
            'data_consulta' => setDataFormatoBr($this->data_consulta),
            'procedimento'  => $this->procedimento,
            'valor'         => $this->valor,
            'id_paciente'   => $this->id_paciente,
            'nome_paciente' => $this->nome_paciente,
            'uuid_paciente' => $this->uuid_paciente,
            'id_podologo'   => $this->id_podologo,
            'nome_podologo' => $this->nome_podologo,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];

        return $retorno;
    }
}
