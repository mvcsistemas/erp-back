<?php

namespace MVC\Models\CadConsulta;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CadConsultaResourceHistorico extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'id_paciente'   => $this->id_paciente,
            'nome_paciente' => $this->nome_paciente,
            'id_consulta'   => $this->id_consulta,
            'data_consulta' => Carbon::parse($this->data_consulta)->locale('pt-BR')->isoFormat('DD [de] MMMM[,] YYYY'),
            'procedimento'  => $this->procedimento,
            'id_podologo'   => $this->id_podologo,
            'nome_podologo' => $this->nome_podologo,
            'valor'         => $this->valor,
        ];

        return $retorno;
    }
}
