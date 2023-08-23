<?php

namespace MVC\Models\CadAgendamento;

use Illuminate\Http\Resources\Json\JsonResource;

class CadAgendamentoResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'               => $this->uuid,
            'agenda_ou_bloqueia' => $this->agenda_ou_bloqueia,
            'data_agendamento'   => setDataFormatoBr($this->data_agendamento),
            'hora_inicio'        => setTimeHoursMinutes($this->hora_inicio),
            'hora_fim'           => setTimeHoursMinutes($this->hora_fim),
            'telefone'           => $this->telefone,
            'celular'            => $this->celular,
            'observacao'         => $this->observacao,
            'id_status'          => $this->id_status,
            'dsc_status'         => $this->dsc_status,
            'id_paciente'        => $this->id_paciente,
            'nome_paciente'      => $this->nome_paciente,
            'id_podologo'        => $this->id_podologo,
            'nome_podologo'      => $this->nome_podologo,
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
        ];

        return $retorno;
    }
}
